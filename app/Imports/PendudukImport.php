<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;

class PendudukImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Define the expected header values
        $expectedHeader = ['NO', 'NAMA', 'ALAMAT', 'RT', 'RW', 'TPS'];

        // Compare the current row with the expected header
        if ($row === $expectedHeader) {
            return null; // Skip the header row
        }
        if (!array_filter($row)) {
            return null;
        }

        return new Penduduk([
            //
            'nama' => $row[1],
            'alamat' => $row[2],
            'rt' => $row[3],
            'rw' => $row[4],
            'tps' => $row[5],
            'uid' => '1',
            'status' => 0,
        ]);
    }
}
