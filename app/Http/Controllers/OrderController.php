<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use App\Models\ProductCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderStatusUpdated;
use App\Jobs\SendOrderStatusEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\WalletTransaction;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.orders.create', compact('users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:product_catalog,id',
        'address_id' => 'required|exists:addresses,id',
    ]);

    $product = ProductCatalog::findOrFail($request->product_id);
    $address = Address::findOrFail($request->address_id);
    $user = auth()->user();

    $shippingCharge = get_setting('shipping_charge');


    $discount = $product->discount_price ?? 0;
    $productPrice = max(0, $product->price - $discount);

    $totalAmount = $productPrice + $shippingCharge;


    // Check wallet balance
    if ($user->wallet <= $totalAmount) {
        return response()->json([
            'success' => false,
            'message' => 'Insufficient wallet balance.'
        ], 400);
    }


    if ($product->stock <= 0) {
        return response()->json([
            'success' => false,
            'message' => 'Sorry, this product is out of stock.'
        ], 400);
    }


    $product->stock -= 1;
    $product->save();


       $transactionId = 'TXN' . now()->format('YmdHis') . strtoupper(Str::random(4));

    $order = Order::create([
        'user_id'        => $user->id,
        'order_number'   => 'ORD-' . strtoupper(uniqid()),
        'product_name'   => $product->name,
        'product_amount' => $productPrice,
        'shipping_charge'=> $shippingCharge,
        'total_amount'   => $totalAmount,
        'payment_method' => 'wallet',
        'txn_id'=>$transactionId,
        'address'        => $address->address_line1 . ', ' . $address->city . ', ' . $address->state . ', ' . $address->country . ', ' . $address->pincode,
        'ordered_at'     => now(),
    ]);




$message = "Your Order has been placed.";

WalletTransaction::create([
    'user_id'         => $user->id,
    'type'            => 'debit',
    'amount'          => $totalAmount,
    'message'         => $message,
    'utr'             => null,
    'transaction_id'  => $transactionId,
    'balance_before'  => $user->wallet,
    'status'          => 'completed',
    'bank_details'    => 'wallet',
]);

$user->wallet -= $totalAmount;
    $user->save();
    // Notification::send($user, new OrderStatusUpdated($order));

    return response()->json([
        'success' => true,
        'message' => 'Purchase successful!'
    ]);
}

    public function edit(Order $order)
    {
        $users = User::all();
        return view('admin.orders.edit', compact('order', 'users'));
    }



   public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'order_status' => 'required|string|in:pending,processing,shipped,delivered,cancelled,returned'
    ]);

    $previous = strtolower($order->order_status);
    $new      = strtolower($request->order_status);
    if ($previous === $new) {
        return response()->json([
            'success' => false,
            'message' => 'Status is unchanged.'
        ], 422);
    }
 $user = User::find($order->user_id);

    $allowed = [
        'pending'    => ['processing', 'cancelled'],
        'processing' => ['shipped', 'cancelled'],
        'shipped'    => ['delivered', 'returned'],
        'delivered'  => ['returned'],
        'cancelled'  => [],
        'returned'   => [],
    ];

    if (!in_array($new, $allowed[$previous] ?? [], true)) {
        return response()->json([
            'success' => false,
            'message' => "Cannot change from ".ucfirst($previous)." to ".ucfirst($new)."."
        ], 422);
    }

    $order->order_status = $new;
    if ($new === 'delivered' && is_null($order->delivered_at)) {
        $order->delivered_at = now();
    }

   Mail::to($order->user->email)
    ->send(new \App\Mail\OrderStatusUpdated($order));
    // SendOrderStatusEmail::dispatch($order);
    $order->save();


if ($order->order_status == 'cancelled' || $order->order_status == 'returned') {
    $transactionId = 'TXN' . now()->format('YmdHis') . strtoupper(Str::random(4));

     $message = "Your Order has been {$order->order_status}. Transaction ID: {$order->txn_id}. Amount refunded.";

    WalletTransaction::create([
        'user_id'         => $user->id,
        'type'            => 'credit',   // refund = credit
        'amount'          => $order->total_amount,
        'message'         => $message,
        'utr'             => null,
        'transaction_id'  => $transactionId,
        'balance_before'  => $user->wallet,
        'status'          => 'completed',
        'bank_details'    => 'wallet',
    ]);

        $user->wallet += $order->total_amount;
        $user->save();
    }
    return response()->json([
        'success'         => true,
        'status'          => ucfirst($new),
        'previous_status' => ucfirst($previous),
        'message'         => "Order status updated from ".ucfirst($previous)." to ".ucfirst($new)."."
    ]);
}


   public function invoice($id)
{
    $order = Order::with('user')->findOrFail($id);

    $html = view('admin.orders.invoice-template', compact('order'))->render();

    return response()->json(['html' => $html]);
}

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted successfully.');
    }

    public function show_order()
    {
        $orders = Order::where('user_id', auth()->id()) ->orderBy('id', 'desc')->paginate(6);
        return view('user.orders.index', compact('orders'));
    }


    public function show_more_oder(Order $order)
    {

        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.orders.show', compact('order'));
    }


    public function cancel($id)
{
    $order = Order::findOrFail($id);

$user = auth()->user();

    if ($order->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }


    if (in_array($order->order_status, ['cancelled', 'completed'])) {
        return redirect()->back()->with('error', 'This order cannot be cancelled.');
    }

    $order->order_status = 'cancelled';


if ($order->order_status == 'cancelled' || $order->order_status == 'returned') {
    $transactionId = 'TXN' . now()->format('YmdHis') . strtoupper(Str::random(4));

     $message = "Your Order has been {$order->order_status}. Transaction ID: {$order->txn_id}. Amount refunded.";

    WalletTransaction::create([
        'user_id'         => $user->id,
        'type'            => 'credit',   // refund = credit
        'amount'          => $order->total_amount,
        'message'         => $message,
        'utr'             => null,
        'transaction_id'  => $transactionId,
        'balance_before'  => $user->wallet,
        'status'          => 'completed',
        'bank_details'    => 'wallet',
    ]);

        $user->wallet += $order->total_amount;
        $user->save();
    }
    $order->save();

    return redirect()->route('orders.show')->with('success', 'Order cancelled successfully.');
}

}
