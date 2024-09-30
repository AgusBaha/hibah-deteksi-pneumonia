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
        return UserResponse::with('category')
            ->get()
            ->map(function ($response) {
                return [
                    'ID' => $response->id,
                    'Nama Kategori' => $response->category->name ?? 'Tidak Ada Kategori',
                    'Jumlah Iya' => $response->yes_count,
                    'Jumlah Tidak' => $response->no_count,
                    'Responden' => $response->respondent_count,
                    'Tanggal Respon' => Carbon::parse($response->created_at)->format('d-m-Y'),
                ];
            });
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
