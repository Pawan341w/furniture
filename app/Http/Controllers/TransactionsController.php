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
        ->where('type', 'debit')
        ->latest()
        ->get();
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

    try {
        DB::transaction(function () use ($request, $userId) {
            $user = User::where('id', $userId)->lockForUpdate()->first();

            $pending = WalletTransaction::where('user_id', $userId)
                ->where('type', 'debit')
                ->where('status', 'pending')
                ->lockForUpdate()
                ->exists();

            if ($pending) {
                throw new \Exception('You already have a pending withdrawal request.');
            }

            if ($user->wallet < $request->amount) {
                throw new \Exception('Insufficient balance.');
            }

            WalletTransaction::create([
                'user_id' => $userId,
                'type' => 'debit',
                'amount' => $request->amount,
                'message' => $request->message,
                'utr' => null,
    'transaction_id' => 'TXN' . now()->format('YmdHis') . strtoupper(Str::random(4)),
                'balance_before' => $user->wallet,
                'status' => 'pending',
            ]);

            // Deduct balance
            $user->wallet -= $request->amount;
            $user->save();
        });

        return back()->with('success', 'Withdrawal requested successfully.');

    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}



public function wallethistory()
{
    $historys = WalletTransaction::where('user_id', Auth::id())->latest()->get();

    return view('user.wallethistory', compact('historys'));
}

}
