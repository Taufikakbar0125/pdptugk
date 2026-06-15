<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingMenu;
use Illuminate\Http\Request;

class LandingMenuController extends Controller
{
    public function index()
    {
        $data = LandingMenu::orderBy('order_num')->orderBy('id')->get();
        return view('admin.landing-menu.index', compact('data'));
    }

    public function create()
    {
        return view('admin.landing-menu.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'desc' => 'nullable|string',
            'icon' => 'nullable|string',
            'url' => 'nullable|string',
            'theme' => 'required|string',
            'order_num' => 'required|integer',
        ]);

        LandingMenu::create($validated);
        return redirect()->route('admin.landing-menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(LandingMenu $landingMenu)
    {
        return view('admin.landing-menu.edit', compact('landingMenu'));
    }

    public function update(Request $request, LandingMenu $landingMenu)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'desc' => 'nullable|string',
            'icon' => 'nullable|string',
            'url' => 'nullable|string',
            'theme' => 'required|string',
            'order_num' => 'required|integer',
        ]);

        $landingMenu->update($validated);
        return redirect()->route('admin.landing-menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(LandingMenu $landingMenu)
    {
        $landingMenu->delete();
        return redirect()->route('admin.landing-menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
