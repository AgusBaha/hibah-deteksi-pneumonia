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
            return $query->where(function ($query) use ($search) {
                $query->where('id_basis_kasus', 'like', '%' . $search . '%')
                    ->orWhere('nama_basis_kasus', 'like', '%' . $search . '%')
                    ->orWhere('detail_basis_kasus', 'like', '%' . $search . '%');
            });
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
        try {
            $basisKasus = new BasisKasus();
            $basisKasus->id_basis_kasus = $request->input('idBasisKasus');
            $basisKasus->nama_basis_kasus = $request->input('namaBasisKasus');
            $basisKasus->detail_basis_kasus = $request->input('detailBasisKasus');
            $basisKasus->save();

            // Simpan relasi dengan gejala yang dipilih
            $basisKasus->gejala()->sync($request->input('gejala'));

            return redirect()->route('basiskasus.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            // Tangani kesalahan di sini, misalnya log pesan kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
    public function edit($id)
    {
        $basisKasus = BasisKasus::find($id);
        // Pastikan $basisKasus ditemukan
        if (!$basisKasus) {
            return redirect()->route('basiskasus.index')->with('error', 'Data tidak ditemukan');
        }

        // Tampilkan view edit dengan data $basisKasus
        return view('basiskasus.edit', compact('basisKasus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $basisKasus = BasisKasus::find($id);
            // Pastikan $basisKasus ditemukan
            if (!$basisKasus) {
                return redirect()->route('basiskasus.index')->with('error', 'Data tidak ditemukan');
            }

            // Update data berdasarkan input dari form
            $basisKasus->id_basis_kasus = $request->input('idBasisKasus');
            $basisKasus->nama_basis_kasus = $request->input('namaBasisKasus');
            $basisKasus->detail_basis_kasus = $request->input('detailBasisKasus');
            $basisKasus->save();

            // Simpan relasi dengan gejala yang dipilih
            $basisKasus->gejala()->sync($request->input('gejala'));

            return redirect()->route('basiskasus.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            // Tangani kesalahan di sini, misalnya log pesan kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $basisKasus = BasisKasus::find($id);
            // Pastikan $basisKasus ditemukan
            if (!$basisKasus) {
                return redirect()->route('basiskasus.index')->with('error', 'Data tidak ditemukan');
            }

            // Hapus data
            $basisKasus->delete();

            return redirect()->route('basiskasus.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Tangani kesalahan di sini, misalnya log pesan kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function generateId()
    {
        $lastBasis = BasisKasus::orderBy('id', 'desc')->first();

        if ($lastBasis) {
            $lastId = $lastBasis->id_basis_kasus;
            $lastNumericPart = intval(substr($lastId, 3)); // Mengambil bagian numerik dan mengubahnya menjadi integer
            $nextNumericPart = $lastNumericPart + 1;
            $newId = 'BK-' . $nextNumericPart;
        } else {
            $newId = 'BK-1';
        }

        // Kemudian, Anda dapat mengembalikan $newId
        return response()->json($newId);
    }
}
