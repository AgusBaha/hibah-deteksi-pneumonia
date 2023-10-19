<?php

namespace App\Http\Controllers\Peneumonia;

use App\Http\Controllers\Controller;
use App\Models\BasisKasus;
use Illuminate\Http\Request;
use App\Models\gejala;

class GejalaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $dataGejala = gejala::when($search, function ($query) use ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama_gejala', 'like', '%' . $search . '%')
                    ->orWhere('bobot', 'like', '%' . $search . '%');
            });
        })->latest()->paginate(10);

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

    public function konsultasi()
    {
        $dataGejala = gejala::all();
        return view('pneumonia.konsultasi.show', compact('dataGejala'));
    }

    // public function calculateSimilarity(Request $request)
    // {
    //     // Mengambil data dari form checkbox yang dipilih
    //     $selectedGejala = $request->input('selected_gejala');

    //     // Mengambil semua basis kasus dari database
    //     $basisKasus = BasisKasus::all();

    //     // Inisialisasi variabel untuk menyimpan hasil similarity tertinggi
    //     $highestSimilarityResult = null;

    //     foreach ($basisKasus as $kasus) {
    //         $similarity = 0; // Nilai similarity awal

    //         // Mendapatkan gejala dari basis kasus
    //         $gejalaKasus = $kasus->gejala;

    //         // Inisialisasi array untuk menyimpan gejala yang dipilih
    //         $selectedGejalaData = [];

    //         // Memeriksa setiap gejala yang dipilih
    //         foreach ($selectedGejala as $gejalaId) {
    //             // Mengambil gejala yang dipilih dari database
    //             $gejala = Gejala::find($gejalaId);

    //             if ($gejala) {
    //                 // Cek apakah gejala ada dalam gejala basis kasus
    //                 $gejalaBasisKasus = $gejalaKasus->where('id', $gejala->id)->first();

    //                 if ($gejalaBasisKasus) {
    //                     // Tambahkan bobot gejala yang cocok ke similarity
    //                     $similarity += $gejalaBasisKasus->bobot;

    //                     // Simpan gejala yang dipilih beserta bobotnya
    //                     $selectedGejalaData[] = [
    //                         'nama_gejala' => $gejala->nama_gejala,
    //                         'bobot' => $gejalaBasisKasus->bobot,
    //                     ];
    //                 }
    //             }
    //         }

    //         // Periksa apakah similarity saat ini lebih tinggi dari similarity tertinggi yang ada
    //         if ($highestSimilarityResult === null || $similarity > $highestSimilarityResult['similarity']) {
    //             // Simpan hasil pencarian dengan nilai similarity tertinggi
    //             $highestSimilarityResult = [
    //                 'kasus' => $kasus->nama_basis_kasus,
    //                 'detailBasisKasus' => $kasus->detail_basis_kasus,
    //                 'similarity' => $similarity,
    //                 'selectedGejala' => $selectedGejalaData,
    //             ];
    //         }
    //     }

    //     // Tampilkan hasil pencarian dengan nilai similarity tertinggi
    //     return view('pneumonia.konsultasi.hasil_pencarian', ['result' => $highestSimilarityResult]);
    // }

    public function calculateSimilarity(Request $request)
    {
        // Mengambil data dari form checkbox yang dipilih
        $selectedGejala = $request->input('selected_gejala');

        // Mengambil semua basis kasus dari database
        $basisKasus = BasisKasus::all();

        // Inisialisasi variabel untuk menyimpan hasil similarity tertinggi
        $highestSimilarityResult = null;

        // Mendapatkan nilai "deteksi" dari input
        $deteksiValue = $request->input('deteksi');

        foreach ($basisKasus as $kasus) {
            $similarity = 0; // Nilai similarity awal

            // Mendapatkan gejala dari basis kasus
            $gejalaKasus = $kasus->gejala;

            // Inisialisasi array untuk menyimpan gejala yang dipilih
            $selectedGejalaData = [];

            // Memeriksa setiap gejala yang dipilih
            foreach ($selectedGejala as $gejalaId) {
                // Mengambil gejala yang dipilih dari database
                $gejala = Gejala::find($gejalaId);

                if ($gejala) {
                    // Cek apakah gejala ada dalam gejala basis kasus
                    $gejalaBasisKasus = $gejalaKasus->where('id', $gejala->id)->first();

                    if ($gejalaBasisKasus) {
                        // Tambahkan bobot gejala yang cocok ke similarity
                        $similarity += $gejalaBasisKasus->bobot;

                        // Simpan gejala yang dipilih beserta bobotnya
                        $selectedGejalaData[] = [
                            'nama_gejala' => $gejala->nama_gejala,
                            'bobot' => $gejalaBasisKasus->bobot,
                        ];
                    }
                }
            }

            // Periksa apakah similarity saat ini lebih tinggi dari similarity tertinggi yang ada
            if ($highestSimilarityResult === null || $similarity > $highestSimilarityResult['similarity']) {
                // Simpan hasil pencarian dengan nilai similarity tertinggi
                $highestSimilarityResult = [
                    'kasus' => $kasus->nama_basis_kasus,
                    'detailBasisKasus' => $kasus->detail_basis_kasus,
                    'similarity' => $similarity,
                    'selectedGejala' => $selectedGejalaData,
                ];
            }
        }

        // Periksa apakah nilai "deteksi" sama dengan nama_basis_kasus
        if ($highestSimilarityResult['kasus'] === $deteksiValue) {
            // Lakukan sesuatu jika mereka sama
            // Misalnya, tampilkan pesan keberhasilan
            $message = "Deteksi berhasil, hasil sesuai dengan basis kasus: " . $highestSimilarityResult['kasus'];
            return view('pneumonia.konsultasi.hasil_pencarian', ['result' => $highestSimilarityResult, 'message' => $message]);
        } else {
            // Lakukan sesuatu jika mereka tidak sama
            // Misalnya, tampilkan pesan kesalahan
            $errorMessage = "Deteksi gagal, hasil tidak sesuai dengan basis kasus.";
            return view('pneumonia.konsultasi.hasil_pencarian', ['result' => $highestSimilarityResult, 'errorMessage' => $errorMessage]);
        }
    }
}
