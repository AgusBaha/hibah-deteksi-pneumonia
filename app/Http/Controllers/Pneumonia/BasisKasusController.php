<?php

namespace App\Http\Controllers\Pneumonia;

use App\Http\Controllers\Controller;
use App\Models\BasisKasus;
use App\Models\gejala;
use Illuminate\Http\Request;

class BasisKasusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $dataBasisKasus = BasisKasus::when($search, function ($query) use ($search) {
            return $query->where('nama_gejala', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        return view('pneumonia.basiKasus.index', compact('dataBasisKasus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gejalaOptions = gejala::all();
        return view('pneumonia.basiKasus.create', compact('gejalaOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $basisKasus = new BasisKasus();
        $basisKasus->nama = $request->input('idBasisKasus');
        $basisKasus->deskripsi = $request->input('detailBasisKasus');
        $basisKasus->save();

        // Simpan relasi dengan gejala yang dipilih
        $basisKasus->gejala()->sync($request->input('gejala'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generateId()
    {
        // Mendapatkan ID Basis terakhir
        $lastBasis = BasisKasus::orderBy('id', 'desc')->first();

        // Menghasilkan ID Basis baru
        if ($lastBasis) {
            $id = 'BK-' . (intval(substr($lastBasis->id, 3)) + 1);
        } else {
            $id = 'BK-1';
        }

        return response()->json($id); // Mengembalikan ID Basis sebagai JSON
    }
}
