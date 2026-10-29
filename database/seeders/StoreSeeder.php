<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{Product, Setting, User};

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('SSTORE_ADMIN_EMAIL');
        $password = env('SSTORE_ADMIN_PASSWORD');

        if (!$email || !$password || strlen($password) < 5) {
            throw new \RuntimeException(
                'Atur SSTORE_ADMIN_EMAIL dan SSTORE_ADMIN_PASSWORD minimal 12 karakter di .env.'
            );
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin SStore',
                'password' => Hash::make($password),
            ]
        );

        $products = [
            ['Template Website Toko Online', 'Source Code', 49000, 25000, 'Website responsif siap dikembangkan'],
            ['Panduan Belajar Programming', 'E-Book', 29000, 5000, 'Panduan digital untuk pemula'],
            ['Template Desain Sosial Media', 'Desain', 35000, 9000, 'Paket desain media sosial'],
            ['Template Excel Keuangan', 'Template', 19000, 4000, 'Pencatatan pemasukan dan pengeluaran'],
        ];

        foreach ($products as $i => $p) {
            Product::firstOrCreate(
                ['name' => $p[0]],
                [
                    'category' => $p[1],
                    'price' => $p[2],
                    'cost' => $p[3],
                    'description' => $p[4],
                    'featured' => $i < 2,
                    'active' => true,
                ]
            );
        }

        Setting::firstOrCreate(
            ['key' => 'shop_name'],
            ['value' => 'SStore']
        );

        Setting::firstOrCreate(
            ['key' => 'wa_number'],
            ['value' => '6281234567890']
        );
    }
}
