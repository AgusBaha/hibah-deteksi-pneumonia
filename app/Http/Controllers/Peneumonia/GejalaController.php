<?php

namespace App\Http\Controllers\Peneumonia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\gejala;

class GejalaController extends Controller
{
    public function index()
    {
        $dataGejala = gejala::latest()->paginate(10);

        return view('pneumonia.gejala.index', compact('dataGejala'));
    }

    public function create()
    {
        return view('pneumonia.gejala.create');
    }

    public function store(Request $request)
    {
        // Validasi data dari $request
        $request->validate([
            'nama' => 'required|string|max:255',
            'bobot' => 'required|numeric',
            //Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        gejala::create([
            'nama_gejala' => $request->nama,
            'bobot' => $request->bobot
        ]);
        return redirect()->route('gejala.index');
    }

    public function edit($id)
    {
        $data = gejala::findOrFail($id);
        return view('pneumonia.gejala.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Update data dalam database
        $data = gejala::find($id);
        $data->nama_gejala = $request->input('nama');
        $data->bobot = $request->input('bobot');
        // Tambahkan semua kolom yang perlu diperbarui

        $data->save();

        return redirect()->route('gejala.index')->with('success', 'Data berhasil diperbarui');
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
