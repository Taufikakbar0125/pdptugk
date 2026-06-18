<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        // Single query, no N+1
        $data = HeroSlide::orderBy('order_num')->orderBy('id')->get();
        return view('admin.hero-slide.index', compact('data'));
    }

    public function create()
    {
        return view('admin.hero-slide.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'nullable|string|max:255',
            'image'     => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'order_num' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $path = $request->file('image')->store('hero-slides', 'public');

        HeroSlide::create([
            'title'      => $validated['title'] ?? null,
            'image_path' => $path,
            'order_num'  => $validated['order_num'],
            'is_active'  => $request->has('is_active'),
        ]);

        return redirect()->route('admin.hero-slide.index')->with('success', 'Slide berhasil ditambahkan.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slide.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'title'     => 'nullable|string|max:255',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'order_num' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data = [
            'title'     => $validated['title'] ?? null,
            'order_num' => $validated['order_num'],
            'is_active' => $request->has('is_active'),
        ];

        // Replace image if new one uploaded
        if ($request->hasFile('image')) {
            // Delete old file
            if ($heroSlide->image_path && Storage::disk('public')->exists($heroSlide->image_path)) {
                Storage::disk('public')->delete($heroSlide->image_path);
            }
            $data['image_path'] = $request->file('image')->store('hero-slides', 'public');
        }

        $heroSlide->update($data);

        return redirect()->route('admin.hero-slide.index')->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        // Delete file
        if ($heroSlide->image_path && Storage::disk('public')->exists($heroSlide->image_path)) {
            Storage::disk('public')->delete($heroSlide->image_path);
        }

        $heroSlide->delete();

        return redirect()->route('admin.hero-slide.index')->with('success', 'Slide berhasil dihapus.');
    }
}
