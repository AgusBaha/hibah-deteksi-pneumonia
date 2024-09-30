<?php

namespace App\Exports;

use App\Models\Kanker\UserResponse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class UserResponsesExport implements FromCollection, WithHeadings
{
    /**
     * Ambil koleksi data yang akan diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil semua data dari UserResponse dan kelompokan berdasarkan kategori
        return UserResponse::with('category')
            ->get()
            ->groupBy('category_id') // Kelompokkan berdasarkan category_id
            ->map(function ($responses, $categoryId) {
                // Agregasi data dalam setiap kelompok kategori
                return [
                    'ID' => $categoryId,
                    'Nama Kategori' => $responses->first()->category->name ?? 'Tidak Ada Kategori',
                    'Jumlah Iya' => $responses->sum('yes_count'),
                    'Jumlah Tidak' => $responses->sum('no_count'),
                    'Responden' => $responses->sum('respondent_count'),
                    'Tanggal Respon' => Carbon::parse($responses->first()->created_at)->format('d-m-Y'),
                ];
            })->values(); // Mengambil hanya nilai tanpa kunci (index numerik)
    }

    /**
     * Buat heading kolom untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Kategori',
            'Jumlah Iya',
            'Jumlah Tidak',
            'Responden',
            'Tanggal Respon',
        ];
    }
}
