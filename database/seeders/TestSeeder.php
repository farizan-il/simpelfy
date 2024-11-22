<?php

namespace Database\Seeders;

use App\Models\KelasHasTest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        KelasHasTest::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'kelas_id' => '9d21a5a8-8d11-416f-b39a-27c267f6dbd4', // Ganti dengan UUID kelas yang sesuai
            'type' => 'pre-test',
            'duration' => 30, // Durasi dalam menit
        ]);

        KelasHasTest::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'kelas_id' => '9d21a5a8-8d11-416f-b39a-27c267f6dbd4', // Ganti dengan UUID kelas yang sesuai
            'type' => 'mid-test',
            'duration' => 40,
        ]);

        KelasHasTest::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'kelas_id' => '9d21a5a8-8d11-416f-b39a-27c267f6dbd4', // Ganti dengan UUID kelas yang sesuai
            'type' => 'post-test',
            'duration' => 60,
        ]);
    }
}
