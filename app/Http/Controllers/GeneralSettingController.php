<?php
namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $settings = GeneralSetting::all();
        return view('admin.general_settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:general_settings',
            'value' => 'required',
        ]);

        GeneralSetting::create($request->only('key', 'value'));

        return response()->json(['message' => 'Setting added successfully']);
    }

    public function show($id)
    {
        return GeneralSetting::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $setting = GeneralSetting::findOrFail($id);

        $request->validate([
            'key' => 'required|unique:general_settings,key,' . $id,
            'value' => 'required',
        ]);

        $setting->update($request->only('key', 'value'));

        return response()->json(['message' => 'Setting updated successfully']);
    }

    public function destroy($id)
    {
        GeneralSetting::findOrFail($id)->delete();

        return response()->json(['message' => 'Setting deleted successfully']);
    }
}
