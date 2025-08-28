<?php
namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', auth()->id())->get();
        return view('user.address.index', compact('addresses')); 
    }

    public function create()
    {
        return view('user.address.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',
            'address_type' => 'required|string|max:50',
        ]);

        Address::create([
            'user_id' => auth()->id(),
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'landmark' => $request->landmark,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pincode' => $request->pincode,
            'address_type' => $request->address_type,
            'is_default' => false
        ]);

        return redirect()->route('address.index')->with('success', 'Address added successfully!');
    }

    public function edit(Address $address)
    {
        return view('user.address.edit', compact('address')); 
    }

    public function update(Request $request, Address $address)
    {
        $request->validate([
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',
            'address_type' => 'required|string|max:50',
        ]);

        $address->update($request->all());

        return redirect()->route('address.index')->with('success', 'Address updated successfully!');
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('address.index')->with('success', 'Address deleted successfully!');
    }
}
