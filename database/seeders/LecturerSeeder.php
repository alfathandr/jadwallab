<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $lecturers = [
            'Sukmawati, S.Pd., M.Pd.',
            'Megawati Busra, S.Kom., M.Kom.',
            'Yayak Sundariani, S.Kom., M.Pd.',
            'Ulvah, S.Kom., M.M.',
            'Muh. Akram Hamzah, S.Kom., M.Kom.',
            'Abrihadi, S.Kom., M.Kom.',
            'Vicky Bin Djusmin, S.Kom., M.Kom.',
            'Cynthia, S.Pd., M.Pd.',
            'Risna Sari, S.Kom., M.Kom.',
            'Tri Bondan Kriswinarso, S.Pd., M.Pd.',
            'Muhammad Idham Rusdi, S.T., M.Kom.',
            'Safwan Kasma, S.Kom., M.Pd.',
            'Isnaeni, S.Kom., M.Pd.',
            'Syafriadi, S.Kom, M.Kom.',
            'Alim Surya Saruman, S.Kom., M.Pd.',
            'Bahar, S.Kom., M.Kom.',
            'M. Ilham Arief, S.Kom., M.Kom.',
            'Wisnu Kurniadi, S.Kom., M.Kom.',
        ];

        foreach ($lecturers as $lecturer) {
            DB::table('lecturers')->insert([
                'name' => $lecturer,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
