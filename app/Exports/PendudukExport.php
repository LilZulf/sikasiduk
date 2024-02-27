<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendudukExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Use map to add a single quote in front of each NIK value
        return collect($this->data)->map(function ($item) {
            $item['nik'] = "'" . $item['nik'];
            return $item;
        });
    }
    public function headings(): array
    {
        return [
            'NIK',
            'NAMA',
            'Alamat',
            'RT',
            'RW',
            'TPS',
            'ALAMAT TPS'
        ];
    }
}
