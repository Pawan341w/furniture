<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
    // Show account or form
    public function index()
    {
        $bank = BankAccount::where('user_id', Auth::id())->first();
        return view('user.bank', compact('bank'));
    }

    // Handle AJAX add/update
    public function ajaxUpdate(Request $request)
    {
        $request->validate([
            'account_holder_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'ifsc_code' => 'required|string|max:20',
        ]);

        $bank = BankAccount::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'account_holder_name' => $request->account_holder_name,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'ifsc_code' => $request->ifsc_code,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Bank details saved successfully.',
            'bank' => $bank,
        ]);
    }

    // Delete account
    public function destroy()
    {
        BankAccount::where('user_id', Auth::id())->delete();

        return redirect()->route('bank.details.index')
            ->with('success', 'Bank account deleted.');
    }
}
