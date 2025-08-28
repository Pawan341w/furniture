<?php
namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GeneralSettingController extends Controller
{
   public function index(Request $request)
{
    $settings = GeneralSetting::all()->map(function ($setting) {
        if ($setting->type === 'array') {
            $setting->value = json_decode($setting->value, true);
        } elseif ($setting->type === 'image') {
            $setting->value = asset('storage/' . $setting->value);
        }
        return $setting;
    });

    if ($request->ajax()) {
        return response()->json(['settings' => $settings]);
    }

    return view('admin.general_settings.index', ['settings' => $settings]);
}


    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:general_settings,key',
            'type' => 'required|in:text,image,array',
        ]);

        $data = [
            'key' => $request->key,
            'type' => $request->type,
        ];

        if ($request->type === 'image') {
            $request->validate(['value' => 'required|image']);
            $data['value'] = $request->file('value')->store('settings', 'public');
        } elseif ($request->type === 'array') {
            $request->validate(['value' => 'required|string']);
            $data['value'] = json_encode(array_map('trim', explode(',', $request->value)));
        } else {
            $request->validate(['value' => 'required|string']);
            $data['value'] = $request->value;
        }

        GeneralSetting::create($data);
clear_setting_cache();
        return response()->json(['message' => 'Setting added successfully']);
    }

    public function edit($id)
    {
        return GeneralSetting::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $setting = GeneralSetting::findOrFail($id);

        $request->validate([
            'type' => 'required|in:text,image,array',
        ]);

        $data = [
            'type' => $request->type,
        ];

        if ($request->type === 'image') {
            if ($request->hasFile('value')) {
                $request->validate(['value' => 'image']);
                $data['value'] = $request->file('value')->store('settings', 'public');
                if ($setting->value) {
                    Storage::disk('public')->delete($setting->value);
                }
            } else {
                $data['value'] = $setting->value;
            }
        } elseif ($request->type === 'array') {
            $request->validate(['value' => 'required|string']);
            $data['value'] = json_encode(array_map('trim', explode(',', $request->value)));
        } else {
            $request->validate(['value' => 'required|string']);
            $data['value'] = $request->value;
        }

        $setting->update($data);
clear_setting_cache();
        return response()->json(['message' => 'Setting updated successfully']);
    }

    public function destroy($id)
    {
        $setting = GeneralSetting::findOrFail($id);
        if ($setting->type === 'image' && $setting->value) {
            Storage::disk('public')->delete($setting->value);
        }
        $setting->delete();

        return response()->json(['message' => 'Setting deleted successfully']);
    }
}
