<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\LandingMenu;

class LandingMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan data lama agar tidak terjadi duplikasi saat seeding ulang
        LandingMenu::truncate();

        $menus = [
            [ 'name' => 'Web PDPT', 'desc' => 'Portal utama pangkalan data institusi dan informasi akademik terpadu.', 'icon' => '🏛️', 'url' => '/pdpt/home', 'theme' => 'blue', 'order_num' => 1 ],
            [ 'name' => 'Konversi Nilai', 'desc' => 'Alat bantu konversi sistem penilaian antar kurikulum dan standar nasional.', 'icon' => '🔄', 'url' => '/konversi-nilai/login', 'theme' => 'green', 'order_num' => 2 ],
            [ 'name' => 'Validasi Data', 'desc' => 'Verifikasi dan validasi kebenaran data mahasiswa serta rekam akademik.', 'icon' => '✅', 'url' => '/validasi-data/login', 'theme' => 'brown', 'order_num' => 3 ],
            [ 'name' => 'Akreditasi Nasional', 'desc' => 'Status dan dokumen akreditasi program studi serta lembaga secara nasional.', 'icon' => '🏅', 'url' => '/pdpt/akreditasi-institusi', 'theme' => 'purple', 'order_num' => 4 ],
            [ 'name' => 'Akreditasi Internasional', 'desc' => 'Rekognisi dan pengakuan mutu program studi di tingkat internasional.', 'icon' => '🌐', 'url' => '/pdpt/akreditasi-prodi', 'theme' => 'cyan', 'order_num' => 5 ]
        ];

        foreach ($menus as $m) {
            LandingMenu::create($m);
        }
    }
}
