<?php

namespace App\Http\Controllers\Peneumonia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\gejala;

class GejalaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $dataGejala = gejala::when($search, function ($query) use ($search) {
            return $query->where('nama_gejala', 'like', '%' . $search . '%');
        })->latest()->paginate(5);

        return view('pneumonia.gejala.index', compact('dataGejala'));
    }


    public function create()
    {
        return view('pneumonia.gejala.create');
    }

    public function store(Request $request)
    {
        try {
            // Validasi data dari $request
            $request->validate([
                'nama' => 'required|string|max:255',
                'bobot' => 'required|numeric',
                //Tambahkan validasi lainnya sesuai kebutuhan
            ]);

            // Buat data gejala
            gejala::create([
                'nama_gejala' => $request->nama,
                'bobot' => $request->bobot
            ]);

            return redirect()->route('gejala.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            // Tangani kesalahan di sini, contohnya, tampilkan pesan kesalahan atau log kesalahan
            return redirect()->route('gejala.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = gejala::findOrFail($id);
        return view('pneumonia.gejala.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi data dari $request
            $request->validate([
                'nama' => 'required|string|max:255',
                'bobot' => 'required|numeric',
                //Tambahkan validasi lainnya sesuai kebutuhan
            ]);

            // Cari data berdasarkan ID
            $data = gejala::find($id);
            if (!$data) {
                // Handle jika data tidak ditemukan, misalnya, dengan melempar exception
                throw new \Exception('Data tidak ditemukan');
            }

            // Update data
            $data->nama_gejala = $request->input('nama');
            $data->bobot = $request->input('bobot');
            // Tambahkan semua kolom yang perlu diperbarui

            $data->save();

            return redirect()->route('gejala.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            // Tangani kesalahan di sini, contohnya, tampilkan pesan kesalahan atau log kesalahan
            return redirect()->route('gejala.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = gejala::find($id);

        if (!$data) {
            return redirect()->route('gejala.index')->with('error', 'Data not found');
        }

        $data->delete();

        return redirect()->route('gejala.index')->with('success', 'Data deleted successfully');
    }
}
