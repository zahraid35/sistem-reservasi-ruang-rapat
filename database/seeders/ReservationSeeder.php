<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservations')->insert([
            [
                'user_id' => 1,
                'room_id' => 2,
                'tanggal' => '2025-01-10',
                'waktu_mulai' => '08:00:00',
                'waktu_berakhir' => '10:00:00',
                'tujuan' => 'Praktikum Pemrograman Web'
            ],
            [
                'user_id' => 2,
                'room_id' => 3,
                'tanggal' => '2025-01-12',
                'waktu_mulai' => '13:00:00',
                'waktu_berakhir' => '15:00:00',
                'tujuan' => 'Rapat OSIS'
            ],
            [
                'user_id' => 3,
                'room_id' => 1,
                'tanggal' => '2025-01-15',
                'waktu_mulai' => '09:00:00',
                'waktu_berakhir' => '12:00:00',
                'tujuan' => 'Seminar Perusahaan'
            ],
        ]);
    }
}
