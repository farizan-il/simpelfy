<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('artikel')->insert([
            [
                'id' => (string) Str::uuid(),
                'foto' => 'example_foto1.jpg',
                'title' => 'Cara Mengoptimalkan Sales Funnel untuk Hasil Penjualan Maksimal',
                'penulis' => 'Ilham Farizan',
                'durasi' => '5 menit',
                'content' => 'Ini adalah contoh konten artikel untuk mengoptimalkan sales funnel.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'foto' => 'example_foto2.jpg',
                'title' => 'Strategi Pemasaran Digital untuk Bisnis Pemula',
                'penulis' => 'Jane Doe',
                'durasi' => '7 menit',
                'content' => 'Konten artikel tentang strategi pemasaran digital untuk bisnis pemula.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'foto' => 'example_foto3.jpg',
                'title' => 'Pentingnya SEO dalam Meningkatkan Traffic Website',
                'penulis' => 'John Doe',
                'durasi' => '8 menit',
                'content' => 'Pembahasan mendalam tentang SEO dan bagaimana cara meningkatkan traffic website.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'foto' => 'example_foto4.jpg',
                'title' => 'Membangun Brand Awareness melalui Media Sosial',
                'penulis' => 'Sarah Lee',
                'durasi' => '6 menit',
                'content' => 'Cara efektif membangun brand awareness melalui platform media sosial.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'foto' => 'example_foto5.jpg',
                'title' => 'Email Marketing: Cara Meningkatkan Penjualan Online',
                'penulis' => 'Michael Tan',
                'durasi' => '10 menit',
                'content' => 'Strategi email marketing untuk meningkatkan konversi dan penjualan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'foto' => 'example_foto6.jpg',
                'title' => 'Mengukur Keberhasilan Kampanye Iklan Facebook',
                'penulis' => 'Linda Wang',
                'durasi' => '4 menit',
                'content' => 'Langkah-langkah mengukur keberhasilan kampanye iklan menggunakan Facebook Ads.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'foto' => 'example_foto7.jpg',
                'title' => 'Pentingnya Analisis Data untuk Strategi Pemasaran',
                'penulis' => 'Kevin Smith',
                'durasi' => '9 menit',
                'content' => 'Menggunakan data untuk menganalisis dan merancang strategi pemasaran yang lebih efektif.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'foto' => 'example_foto8.jpg',
                'title' => 'Tips Mengelola Anggaran Pemasaran untuk Startup',
                'penulis' => 'Anna Johnson',
                'durasi' => '6 menit',
                'content' => 'Cara cerdas mengelola anggaran pemasaran dalam perusahaan startup.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'foto' => 'example_foto9.jpg',
                'title' => 'Strategi Pemasaran Konten yang Efektif untuk E-commerce',
                'penulis' => 'Daniel Kim',
                'durasi' => '7 menit',
                'content' => 'Strategi konten yang dapat meningkatkan penjualan di platform e-commerce.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'foto' => 'example_foto10.jpg',
                'title' => 'Menggunakan Influencer untuk Meningkatkan Penjualan',
                'penulis' => 'Rachel Green',
                'durasi' => '8 menit',
                'content' => 'Cara bekerja dengan influencer untuk meningkatkan brand awareness dan penjualan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
