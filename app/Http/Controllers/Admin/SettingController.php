<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->hasFile('site_logo')) {
            $setting = Setting::firstOrCreate(['key' => 'site_logo']);
            
            // Delete old file if exists
            if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }

            $path = $request->file('site_logo')->store('logos', 'public');
            $setting->update(['value' => $path]);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan');
    }
}
