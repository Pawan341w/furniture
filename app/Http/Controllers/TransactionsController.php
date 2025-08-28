<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WalletTransaction;
use App\Models\BankAccount;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;

class TransactionsController extends Controller
{

public function showWithdrawals()
{
    $withdrawals = WalletTransaction::where('user_id', Auth::id())
        ->where('type', 'debit')->where('bank_details', '!=', '"wallet"')
        ->latest()
        ->paginate(6);
    $bank = BankAccount::where('user_id', Auth::id())->first();

    return view('user.withdrawal', compact('withdrawals','bank'));
}


public function request(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'message' => 'nullable|string',
        'bank_id' => 'required|exists:bank_accounts,id',
    ]);
            $userId = Auth::id();

  $result = WalletTransaction_help($request, 'debit', $request->message,'pending',$userId);
    if ($result['success']) {
        return back()->with('success', 'Withdrawal requested successfully.');
    } else {
        return back()->with('error', $result['error']);
    }
}



public function wallethistory()
{
    $historys = WalletTransaction::where('user_id', Auth::id())->latest()->paginate(6);

    return view('user.wallethistory', compact('historys'));
}


public function withdrawal_management()
{
    $historys = WalletTransaction::with('user')->where('type', 'debit')
    ->where('bank_details', '!=', '"wallet"')->latest()->get();
    
    return view('admin.withdrawal.index', compact('historys'));
}

public function updateStatus(Request $request)
{
    $request->validate([
        'id' => 'required|exists:wallet_transactions,id',
        'status' => 'required|in:pending,completed,failed'
    ]);
    


    $history = WalletTransaction::find($request->id);
    
 if (!$history) {
    return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
}

if ($history->status === 'failed') {
    return response()->json(['success' => false, 'message' => 'Transaction already failed'], 400);
}

if ($history->status === 'completed') {
    return response()->json(['success' => false, 'message' => 'Transaction already completed'], 400);
}

if ($request->status == 'failed') {
        $message = "Your withdrawal request failed. Transaction ID: {$history->transaction_id}. Amount refunded.";
        WalletTransaction_help($history, 'credit', $message, 'completed',$history->user_id);
    }
    $history->status = $request->status;
    $history->save();

return response()->json(['success' => true, 'message' => 'Status updated successfully']);
}


}
