<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanans = [];
        if (auth()->user()->hasRole('customer')) {
            $pesanans = User::findOrFail(auth()->user()->id)->first()->pelanggan->pesanan;
        } else {
            $pesanans = Pesanan::all();
        }
        return view('pages.pesanans.index', compact('pesanans'));
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
        $validated = $request->validate([
            'layanan_id' => 'required|exists:App\Models\Layanan,id',
            'pelanggan_id' => 'required|exists:App\Models\User,id',
            'jumlah_pemesanan' => 'required|numeric|min:1',
            'deskripsi_pesan' => 'nullable|string',
            'tanggal_pesan' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_pesan',
            'total_harga' => 'required|numeric|min:1',
        ]);

        Pesanan::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        return view('pages.pesanans.view', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
        return view('pages.pesanans.edit', compact('pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
