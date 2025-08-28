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
            $pesanans = User::find(auth()->id())->pelanggan->pesanan;
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
            'deskripsi_pesan' => 'nullable|string',
            'status' => 'required|in:Pending,Diproses,Selesai,Dibatalkan',
            'tanggal_pesan' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_pesan',
            'total_harga' => 'required|numeric|min:5000',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $pesanan = Pesanan::create($validated);

        if ($request->hasFile('file')) {
            $filename = sprintf('SIPEMPOL_%s.%s', time(), $request->file('file')->getClientOriginalExtension());
            $request->file('file')->move(public_path('images'), $filename);
            $pesanan->update(['file_desain' => $filename]);
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
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
        $initialPrice = (int)$pesanan->layanan->harga;

        if (!($pesanan->status == 'Pending') || !($pesanan->status == 'Diproses')) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = sprintf('SIPEMPOL_%s.%s', time(), $file->getClientOriginalExtension());
                $file->move(public_path('images'), $filename);
                $pesanan->update(['file_desain' => $filename]);
            }

            $validated = $request->validate([
                'status' => 'required|in:Pending,Diproses,Selesai,Dibatalkan',
                'tanggal_pesan' => 'required|date',
                'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_pesan',
                'total_harga' => 'required|numeric|min:' . $initialPrice,
            ]);

            $pesanan->update($validated);
            return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
        }

        if ($pesanan->status == 'Pending') {
            $validated = $request->validate([
                'status' => 'required|in:Diproses,Dibatalkan',
                'tanggal_pesan' => 'required|date',
                'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_pesan',
                'total_harga' => 'required|numeric|min:' . $initialPrice,
            ]);

            $pesanan->update(['status' => $validated['status']]);
            return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil Diperbarui.');
        }

        if ($pesanan->status == 'Diproses') {
            $validated = $request->validate([
                'status' => 'required|in:Selesai,Dibatalkan',
                'tanggal_pesan' => 'required|date',
                'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_pesan',
                'total_harga' => 'required|numeric|min:' . $initialPrice,
            ]);

            $pesanan->update(['status' => $validated['status']]);
            return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil Diperbarui.');
        }
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
