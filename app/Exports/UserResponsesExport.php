<?php

namespace App\Exports;

use App\Models\Kanker\UserResponse as KankerUserResponse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class UserResponsesExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil semua data respon user untuk diekspor, termasuk nama kategori
     */
    public function collection()
    {
        // Mengambil data termasuk nama kategori
        return KankerUserResponse::with('category') // Eager load relasi category
            ->get()
            ->map(function ($response) {
                return [
                    'id' => $response->id,
                    'category_name' => $response->category->name, // Menggunakan nama kategori
                    'jumlah_iya' => $response->yes_count,
                    'jumlah_tidak' => $response->no_count,
                    'responden' => $response->respondent_count,
                    // Format tanggal menjadi d-m-Y
                    'tanggal_respon' => Carbon::parse($response->created_at)->format('d-m-Y'),
                ];
            });
    }

    /**
     * Menentukan judul kolom dalam file Excel
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
