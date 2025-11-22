<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'id' => 1,
                'nama' => 'Aula',
                'kapasitas' => '100',
                'lokasi' => 'SMKN 1 CIMAHI',
                'deskripsi' => 'Sudah include dengan sarana nya.',
            ],
            [
                'id' => 2,
                'nama' => 'Lab RPL 1',
                'kapasitas' => '50',
                'lokasi' => 'SMKN 1 CIMAHI',
                'deskripsi' => 'Sudah include dengan sarana nya.',
            ],
            [
                'id' => 3,
                'nama' => 'Ruang Multimedia',
                'kapasitas' => '100',
                'lokasi' => 'SMKN 1 CIMAHI',
                'deskripsi' => 'Sudah include dengan sarana nya.',
            ],
            [
                'id' => 4,
                'nama' => 'Ruang Rapat Classroom',
                'kapasitas' => '200',
                'lokasi' => 'SMKN 1 CIMAHI',
                'deskripsi' => 'Sudah include dengan sarana nya.',
            ],
        ]);
    }
}
