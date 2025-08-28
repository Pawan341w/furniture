<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductQRCode;
use App\Models\User;
use App\Models\WalletTransaction;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->adminDashboard();
        } elseif ($user->role === 'user') {
            return $this->userDashboard($user);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    private function adminDashboard()
    {
        $totalProducts = Product::count();
        $totalQRCodes = ProductQRCode::count();
        $totalUsers = User::count();

        $usedQRCodes = ProductQRCode::with(['product', 'usedUser'])
            ->where('is_used', true)
            ->orderByDesc('updated_at')
            ->get();

        return view('admin.dashboard', compact('totalProducts', 'totalQRCodes', 'totalUsers', 'usedQRCodes'));
    }

    private function userDashboard($user)
    {

    $walletTransactions = WalletTransaction::where('user_id', $user->id)->latest()->get();
    $usedQRCodes = ProductQRCode::with('product')->where('used_by', $user->id)->get();
$usedQRCodesToday = $usedQRCodes->filter(function ($qr) {
    return $qr->updated_at->isToday();
});
       $totalcoinToday = $usedQRCodesToday->sum('coin_reward');

$totalUsedToday = $usedQRCodesToday->count();
    $creditTransactions = $walletTransactions->where('type', 'credit');
    $debitTransactions = $walletTransactions->where('type', 'debit')->where('bank_details', '!=', 'wallet');
       $totalCredit = $usedQRCodes->sum('coin_reward');
    $usedQRCodeCount = $usedQRCodes->count();
    $totalDebit  = $debitTransactions->sum('amount');
$recentWalletTransactions = $walletTransactions->take(5);
    return view('user.dasboard', compact(
        'recentWalletTransactions',
        'totalCredit',
        'totalDebit',
        'usedQRCodeCount',
        'totalUsedToday',
        'usedQRCodesToday',
        'totalcoinToday'
    ));
    }

   public function qrFilterByDate(Request $request)
{
    $user = Auth::user();
    $selectedDate = $request->input('date');

    $usedQRCodes = ProductQRCode::with('product')->where('used_by', $user->id)
        ->whereDate('updated_at', Carbon::parse($selectedDate))
        ->get();
       $totalcoinToday = $usedQRCodes->sum('coin_reward');

    $totalUsedOnDate = $usedQRCodes->count();

    return response()->json([
        'totalUsedOnDate' => num_format($totalUsedOnDate),
        'usedQRCodes'     => $usedQRCodes,
          'totalcoinToday'=>num_format($totalcoinToday)

    ]);
}

}
