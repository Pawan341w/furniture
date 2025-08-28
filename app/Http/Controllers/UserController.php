<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->with('usedQRCodes')->get();
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['status' => true, 'message' => 'User created successfully']);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['status' => true, 'message' => 'User updated successfully']);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['status' => true, 'message' => 'User deleted successfully']);
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function getUsedQRCodes($id)
{
    $user = User::findOrFail($id);
    $qrcodes = $user->usedQRCodes()->with('product')->get();
    return response()->json($qrcodes);
}

}
