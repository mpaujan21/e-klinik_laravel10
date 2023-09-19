<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;
use Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                'username' => 'admin',
                'password' => Hash::make('password'),
                'email' => 'admin@gmail.com',
                'role' => 1,
                'nama' => 'Admin',
                'deleted' => false
                ],
                [
                'username' => 'dokter',
                'password' => Hash::make('password'),
                'email' => 'dokter@gmail.com',
                'role' => 3,
                'nama' => 'Dr. Dadan',
                'deleted' => false
                ],
                [
                'username' => 'dokter2',
                'password' => Hash::make('password'),
                'email' => 'dokter2@gmail.com',
                'role' => 3,
                'nama' => 'Dr. Hani',
                'deleted' => false
                ],
                [
                'username' => 'pasien',
                'password' => Hash::make('password'),
                'email' => 'pasien@gmail.com',
                'role' => 4,
                'nama' => 'Neida',
                'deleted' => false
                ],
                [
                'username' => 'pasien2',
                'password' => Hash::make('password'),
                'email' => 'pasien@gmail.com',
                'role' => 4,
                'nama' => 'Vidi',
                'deleted' => false
                ],
            ]
        );

        DB::table('dokters')->insert(
            [
                [
                'username' => 'dokter',
                'id_poli' => 1
                ],
                [
                'username' => 'dokter2',
                'id_poli' => 2
                ]
            ]
        );

        DB::table('kunjungans')->insert(
            [
                [
                'id_jadwal' => 1,
                'id_pasien' => 1,
                'no_antrian' => 1,
                'deleted' => false,
                ],
            ]
        );

        DB::table('pasiens')->insert(
            [
                [
                'username' => 'pasien',
                'nik' => '1234'
                ],
                [
                'username' => 'pasien2',
                'nik' => '1337'
                ],
                [
                'username' => 'admin',
                'nik' => '4566'
                ],
            ]
        );

        DB::table('jadwals')->insert(
            [
                [
                'id_dokter' => 1,
                'tanggal' => Carbon::parse('2023-09-20'),
                'kuota' => 10,
                'sisa_kuota' => 10,
                'no_antrian' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'id_dokter' => 2,
                'tanggal' => Carbon::parse('2023-09-21'),
                'kuota' => 10,
                'sisa_kuota' => 10,
                'no_antrian' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
            ]
        );

        DB::table('kode_icds')->insert(
            [
                [
                'kode' => 'A00.9',
                'nama_id' => 'Kolera'
                ],
                [
                'kode' => 'A01.0',
                'nama_id' => 'Demam tifoid'
                ],
            ]
        );

        DB::table('obats')->insert(
            [
                [
                'nama_obat' => 'Paramex',
                'jenis' => 'Tablet',
                'dosis' => 500,
                'satuan' => 'mg',
                'stok' => 10,
                'deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'nama_obat' => 'Metronidazole',
                'jenis' => 'Tablet',
                'dosis' => 400,
                'satuan' => 'mg',
                'stok' => 20,
                'deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'nama_obat' => 'Paracetamol',
                'jenis' => 'Tablet',
                'dosis' => 300,
                'satuan' => 'mg',
                'stok' => 30,
                'deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
                [
                'nama_obat' => 'Konidin',
                'jenis' => 'Kapsul',
                'dosis' => 200,
                'satuan' => 'mg',
                'stok' => 40,
                'deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
            ]
        );

        DB::table('labs')->insert(
            [
                [
                'nama' => 'Kolesterol',
                'satuan' => 'mg/dl',
                ],
                [
                'nama' => 'Asam Urat',
                'satuan' => 'mg/dl',
                ],
                [
                'nama' => 'Gula Darah Puasa',
                'satuan' => 'mg/dl',
                ],
                [
                'nama' => 'Hemoglobin',
                'satuan' => 'mg/dl',
                ],
            ]
        );

        DB::table('rekam_meds')->insert(
            [
                [
                'id_pasien' => 1,
                'id_dokter' => 1,
                'id_diagnosis' => 1,
                'keluhan' => 'Pusing',
                'anamnesis' => 'Pusing Dok',
                'pfisik' => 'Fisik OK',
                'id_labs' => '1|2',
                'hasil_labs' => '10|20',
                'id_obats' => '1|2',
                'jumlah_obats' => '1|1',
                'aturan_obats' => '3x1|2x1',
                'status_lab' => 2,
                'deleted' => 0,
                ],
                [
                'id_pasien' => 2,
                'id_dokter' => 2,
                'id_diagnosis' => 2,
                'keluhan' => 'Sakit Hati',
                'anamnesis' => 'Sakit Hati Dok',
                'pfisik' => 'Fisik OK',
                'id_labs' => '3|4',
                'hasil_labs' => '0|0',
                'id_obats' => '3|4',
                'jumlah_obats' => '1|1',
                'aturan_obats' => '3x1|2x1',
                'status_lab' => 1,
                'deleted' => 0,
                ],
            ]
        );
    }
}
