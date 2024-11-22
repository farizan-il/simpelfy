<?php

namespace Database\Seeders;

use App\Models\TestHasSoal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $postTestId = 'cff4bf23-9cb4-11ef-bfb4-b520822a4d04'; // Ganti dengan UUID post-test yang sesuai

        // Array pertanyaan dan jawaban
        $questions = [
            [
                'question_text' => "Apa ibukota Indonesia?",
                'options' => [
                    'A' => 'Jakarta',
                    'B' => 'Surabaya',
                    'C' => 'Bandung',
                    'D' => 'Medan',
                ],
                'correct_answer' => 'Jakarta',
                'explanation' => "Ibukota Indonesia adalah Jakarta, pusat pemerintahan dan ekonomi.",
            ],
            [
                'question_text' => "Siapa presiden pertama Indonesia?",
                'options' => [
                    'A' => 'Sukarno',
                    'B' => 'Suharto',
                    'C' => 'BJ Habibie',
                    'D' => 'Megawati',
                ],
                'correct_answer' => 'Sukarno',
                'explanation' => "Sukarno adalah presiden pertama Republik Indonesia.",
            ],
            [
                'question_text' => "Apa bendera nasional Indonesia?",
                'options' => [
                    'A' => 'Merah Putih',
                    'B' => 'Biru Putih',
                    'C' => 'Hijau Putih',
                    'D' => 'Kuning Hitam',
                ],
                'correct_answer' => 'Merah Putih',
                'explanation' => "Bendera nasional Indonesia adalah Merah Putih.",
            ],
            [
                'question_text' => "Apa nama pulau terbesar di Indonesia?",
                'options' => [
                    'A' => 'Sumatra',
                    'B' => 'Jawa',
                    'C' => 'Kalimantan',
                    'D' => 'Sulawesi',
                ],
                'correct_answer' => 'Kalimantan',
                'explanation' => "Pulau terbesar di Indonesia adalah Kalimantan.",
            ],
            [
                'question_text' => "Apa nama makanan khas Indonesia yang terbuat dari nasi?",
                'options' => [
                    'A' => 'Sushi',
                    'B' => 'Nasi Goreng',
                    'C' => 'Kimchi',
                    'D' => 'Paella',
                ],
                'correct_answer' => 'Nasi Goreng',
                'explanation' => "Nasi Goreng adalah salah satu makanan khas Indonesia.",
            ],
            [
                'question_text' => "Siapa tokoh nasional yang dikenal sebagai Bapak Proklamasi?",
                'options' => [
                    'A' => 'Sukarno',
                    'B' => 'Mohammad Hatta',
                    'C' => 'Soekarno-Hatta',
                    'D' => 'Jenderal Sudirman',
                ],
                'correct_answer' => 'Soekarno-Hatta',
                'explanation' => "Soekarno dan Hatta adalah tokoh yang memproklamirkan kemerdekaan Indonesia.",
            ],
            [
                'question_text' => "Apa bahasa resmi negara Indonesia?",
                'options' => [
                    'A' => 'Bahasa Inggris',
                    'B' => 'Bahasa Indonesia',
                    'C' => 'Bahasa Jawa',
                    'D' => 'Bahasa Mandarin',
                ],
                'correct_answer' => 'Bahasa Indonesia',
                'explanation' => "Bahasa resmi negara Indonesia adalah Bahasa Indonesia.",
            ],
            [
                'question_text' => "Apa nama bunga nasional Indonesia?",
                'options' => [
                    'A' => 'Melati',
                    'B' => 'Anggrek',
                    'C' => 'Rafflesia',
                    'D' => 'Bunga Matahari',
                ],
                'correct_answer' => 'Melati',
                'explanation' => "Bunga nasional Indonesia adalah Melati.",
            ],
            [
                'question_text' => "Apa alat musik tradisional Indonesia yang terbuat dari bambu?",
                'options' => [
                    'A' => 'Angklung',
                    'B' => 'Gamelan',
                    'C' => 'Suling',
                    'D' => 'Seruling',
                ],
                'correct_answer' => 'Angklung',
                'explanation' => "Angklung adalah alat musik tradisional yang terbuat dari bambu.",
            ],
            [
                'question_text' => "Siapa pahlawan nasional yang dikenal sebagai Bapak Pendidikan?",
                'options' => [
                    'A' => 'Ki Hajar Dewantara',
                    'B' => 'R.A. Kartini',
                    'C' => 'Sukarno',
                    'D' => 'Mohammad Hatta',
                ],
                'correct_answer' => 'Ki Hajar Dewantara',
                'explanation' => "Ki Hajar Dewantara dikenal sebagai Bapak Pendidikan di Indonesia.",
            ],
            [
                'question_text' => "Apa nama tari tradisional Indonesia yang berasal dari Bali?",
                'options' => [
                    'A' => 'Tari Kecak',
                    'B' => 'Tari Jaipong',
                    'C' => 'Tari Piring',
                    'D' => 'Tari Saman',
                ],
                'correct_answer' => 'Tari Kecak',
                'explanation' => "Tari Kecak adalah tari tradisional yang berasal dari Bali.",
            ],
            [
                'question_text' => "Apa makanan khas Indonesia yang terbuat dari mie?",
                'options' => [
                    'A' => 'Soto',
                    'B' => 'Bakso',
                    'C' => 'Mie Goreng',
                    'D' => 'Nasi Padang',
                ],
                'correct_answer' => 'Mie Goreng',
                'explanation' => "Mie Goreng adalah salah satu makanan khas Indonesia.",
            ],
            [
                'question_text' => "Apa gunung tertinggi di Indonesia?",
                'options' => [
                    'A' => 'Gunung Semeru',
                    'B' => 'Gunung Rinjani',
                    'C' => 'Gunung Kerinci',
                    'D' => 'Gunung Jayawijaya',
                ],
                'correct_answer' => 'Gunung Jayawijaya',
                'explanation' => "Gunung tertinggi di Indonesia adalah Gunung Jayawijaya.",
            ],
            [
                'question_text' => "Apa nama laut yang memisahkan antara pulau Jawa dan Sumatra?",
                'options' => [
                    'A' => 'Laut Jawa',
                    'B' => 'Laut Banda',
                    'C' => 'Laut Flores',
                    'D' => 'Selat Sunda',
                ],
                'correct_answer' => 'Selat Sunda',
                'explanation' => "Selat Sunda adalah laut yang memisahkan pulau Jawa dan Sumatra.",
            ],
            [
                'question_text' => "Apa hewan yang menjadi simbol negara Indonesia?",
                'options' => [
                    'A' => 'Harimau',
                    'B' => 'Garuda',
                    'C' => 'Banteng',
                    'D' => 'Elang',
                ],
                'correct_answer' => 'Garuda',
                'explanation' => "Garuda adalah simbol negara Indonesia.",
            ],
            [
                'question_text' => "Apa alat musik tradisional yang dipukul?",
                'options' => [
                    'A' => 'Gamelan',
                    'B' => 'Suling',
                    'C' => 'Biola',
                    'D' => 'Piano',
                ],
                'correct_answer' => 'Gamelan',
                'explanation' => "Gamelan adalah alat musik tradisional yang dipukul.",
            ],
            [
                'question_text' => "Apa nama kota terbesar di Indonesia?",
                'options' => [
                    'A' => 'Jakarta',
                    'B' => 'Surabaya',
                    'C' => 'Bandung',
                    'D' => 'Medan',
                ],
                'correct_answer' => 'Jakarta',
                'explanation' => "Jakarta adalah kota terbesar di Indonesia.",
            ],
            [
                'question_text' => "Apa nama danau terbesar di Indonesia?",
                'options' => [
                    'A' => 'Danau Toba',
                    'B' => 'Danau Singkarak',
                    'C' => 'Danau Kerinci',
                    'D' => 'Danau Poso',
                ],
                'correct_answer' => 'Danau Toba',
                'explanation' => "Danau Toba adalah danau terbesar di Indonesia.",
            ],
            [
                'question_text' => "Apa nama tradisi selamatan di Jawa?",
                'options' => [
                    'A' => 'Syukuran',
                    'B' => 'Hajatan',
                    'C' => 'Resepsi',
                    'D' => 'Ruwahan',
                ],
                'correct_answer' => 'Selamatan',
                'explanation' => "Selamatan adalah tradisi syukuran dalam budaya Jawa.",
            ],
            [
                'question_text' => "Apa nama pahlawan nasional yang dikenal sebagai Bapak Riset?",
                'options' => [
                    'A' => 'B.J. Habibie',
                    'B' => 'Sukarno',
                    'C' => 'Soeharto',
                    'D' => 'Ki Hajar Dewantara',
                ],
                'correct_answer' => 'B.J. Habibie',
                'explanation' => "B.J. Habibie dikenal sebagai Bapak Riset Indonesia.",
            ],
            [
                'question_text' => "Apa pulau yang terkenal dengan budayanya yang beragam?",
                'options' => [
                    'A' => 'Jawa',
                    'B' => 'Bali',
                    'C' => 'Sumatra',
                    'D' => 'Sulawesi',
                ],
                'correct_answer' => 'Bali',
                'explanation' => "Bali terkenal dengan budayanya yang beragam.",
            ],
            [
                'question_text' => "Apa produk pertanian utama Indonesia?",
                'options' => [
                    'A' => 'Kedelai',
                    'B' => 'Padi',
                    'C' => 'Jagung',
                    'D' => 'Kentang',
                ],
                'correct_answer' => 'Padi',
                'explanation' => "Padi adalah produk pertanian utama Indonesia.",
            ],
            [
                'question_text' => "Apa festival budaya terbesar di Indonesia?",
                'options' => [
                    'A' => 'Festival Danau Toba',
                    'B' => 'Festival Bali',
                    'C' => 'Festival Budaya Betawi',
                    'D' => 'Festival Krakatau',
                ],
                'correct_answer' => 'Festival Danau Toba',
                'explanation' => "Festival Danau Toba adalah festival budaya terbesar di Indonesia.",
            ],
            [
                'question_text' => "Apa nama provinsi dengan jumlah pulau terbanyak di Indonesia?",
                'options' => [
                    'A' => 'Kepulauan Riau',
                    'B' => 'Bali',
                    'C' => 'Maluku',
                    'D' => 'Papua',
                ],
                'correct_answer' => 'Kepulauan Riau',
                'explanation' => "Kepulauan Riau memiliki jumlah pulau terbanyak di Indonesia.",
            ],
            [
                'question_text' => "Apa alat transportasi tradisional yang digunakan di pedesaan?",
                'options' => [
                    'A' => 'Becak',
                    'B' => 'Mobil',
                    'C' => 'Sepeda',
                    'D' => 'Kapal',
                ],
                'correct_answer' => 'Becak',
                'explanation' => "Becak adalah alat transportasi tradisional yang banyak digunakan di pedesaan.",
            ],
            [
                'question_text' => "Apa istilah untuk proses pemilihan kepala daerah di Indonesia?",
                'options' => [
                    'A' => 'Pilkada',
                    'B' => 'Pemilu',
                    'C' => 'Musrenbang',
                    'D' => 'Rakerda',
                ],
                'correct_answer' => 'Pilkada',
                'explanation' => "Pilkada adalah pemilihan kepala daerah di Indonesia.",
            ],
            [
                'question_text' => "Apa olahraga tradisional yang berasal dari Indonesia?",
                'options' => [
                    'A' => 'Sepak Bola',
                    'B' => 'Bulutangkis',
                    'C' => 'Karate',
                    'D' => 'Pencak Silat',
                ],
                'correct_answer' => 'Pencak Silat',
                'explanation' => "Pencak Silat adalah olahraga tradisional yang berasal dari Indonesia.",
            ],
        ];

        // Menyimpan pertanyaan ke database
        foreach ($questions as $question) {
            TestHasSoal::create([
                'id' => (string) \Illuminate\Support\Str::uuid(),
                'test_id' => $postTestId,
                'questionText' => $question['question_text'],
                'options' => json_encode($question['options']),
                'correctAnswer' => $question['correct_answer'],
                'explanation' => $question['explanation'],
            ]);
        }
    }
}
