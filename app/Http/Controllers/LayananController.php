<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanans = Layanan::all();
        return view('pages.layanans.index', compact('layanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        return view('pages.layanans.view', compact('layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        return view('pages.layanans.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = sprintf('SIPEMPOL_%s.%s', time(), $file->getClientOriginalExtension());
            $file->move(public_path('images/layanan'), $filename);

            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'harga' => 'required|numeric|min:10000',
            ]);
            $validated['gambar'] = $filename;
            $layanan->update($validated);
            return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:10000',
        ]);

        $layanan->update($validated);
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
