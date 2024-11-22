@extends('gondowangi.frontend.layout.main')

@section('head')
    <title>{{ $title }}</title>
    <style>
        .container-fluid.bg-dark {
            position: relative;
            z-index: 1;
        }

        .card-detail {
            position: absolute;
            left: 0;
            right: 0;
            z-index: 2;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid mb-5 bg-dark position-relative" style="padding-top: 100px; height: 250px;">
        <div class="container-xxl card-body">
            <h3 class="card-title text-white mb-3">Cara Mengoptimalkan Sales Funnel untuk Hasil Penjualan Maksimal</h3>
            <p class="mb-5 text-white">Andik Chefasa - 12 Nov 24 - 5 menit membaca</p>
        </div>

        {{-- card detail singkat kelas --}}
        {{-- <div class="container-xxl mb-6 position-absolute card-detail" style="top: 200px; left: 0; right: 0;">
            <div class="card">
                <div class="card-widget-separator-wrapper">
                    <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                                <div>
                                    <h4 class="mb-0">{{ $registeredCount }}</h4>
                                    <p class="mb-0">Sudah Mendaftar</p>
                                </div>
                                <div class="avatar me-sm-6">
                                    <span class="avatar-initial rounded bg-label-secondary text-heading">
                                        <i class="bx bx-user bx-26px"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-6">
                        </div>
                        
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-center card-widget-2 border-end pb-4 pb-sm-0">
                                <div>
                                    <h4 class="mb-0">{{ $videoCount }} | {{ $testCount }}</h4>
                                    <p class="mb-0">Video dan Test</p>
                                </div>
                                <div class="avatar me-lg-6">
                                    <span class="avatar-initial rounded bg-label-secondary text-heading">
                                        <i class="bx bx-file bx-26px"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none">
                        </div>
                        
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-center border-end pb-4 pb-sm-0 card-widget-3">
                                <div>
                                    <h4 class="mb-0">{{ $totalStudyDuration }}</h4>
                                    <p class="mb-0">Total Durasi Belajar</p>
                                </div>
                                <div class="avatar me-sm-6">
                                    <span class="avatar-initial rounded bg-label-secondary text-heading">
                                        <i class="bx bx-check-double bx-26px"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-0">IDR {{ number_format($detail->harga, 0, ',', '.') }}</h4>
                                    <p class="mb-0">Harga</p>
                                </div>
                                <div class="avatar">
                                    <span class="avatar-initial rounded bg-label-secondary text-heading">
                                        <i class="bx bx-error-circle bx-26px"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="container-xxl mb-6 position-absolute card-detail" style="top: 200px; left: 0; right: 0;">
            <div class="row">
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-body p-3 mt-3">
                            <h5>Description</h5>
                            <h1>Cara Mengoptimalkan Sales Funnel untuk Hasil Penjualan Maksimal</h1>

                            <p>Sales funnel, atau corong penjualan, adalah proses yang digunakan untuk menarik dan mengonversi calon pelanggan menjadi pelanggan setia. Dengan mengoptimalkan setiap tahap dalam funnel, bisnis dapat meningkatkan peluang konversi dan meraih hasil penjualan yang maksimal. Berikut adalah langkah-langkah yang dapat dilakukan untuk mengoptimalkan sales funnel Anda.</p>

                            <h2>1. Menarik Perhatian (Awareness)</h2>
                            <p>Langkah pertama dalam sales funnel adalah meningkatkan kesadaran calon pelanggan terhadap produk atau layanan Anda. Pada tahap ini, penting untuk menggunakan berbagai kanal pemasaran seperti media sosial, konten blog, dan iklan berbayar untuk menarik perhatian audiens target.</p>
                            <ul>
                                <li>Buat konten yang menarik dan relevan dengan kebutuhan target market.</li>
                                <li>Gunakan SEO untuk meningkatkan visibilitas di mesin pencari.</li>
                                <li>Gunakan iklan media sosial untuk menjangkau audiens yang lebih luas.</li>
                            </ul>

                            <h2>2. Membangun Ketertarikan (Interest)</h2>
                            <p>Setelah menarik perhatian, langkah berikutnya adalah membangun ketertarikan calon pelanggan terhadap produk Anda. Pada tahap ini, berikan informasi yang lebih mendalam mengenai nilai dan manfaat dari produk Anda untuk mendorong calon pelanggan untuk ingin tahu lebih banyak.</p>
                            <ul>
                                <li>Tawarkan konten edukatif, seperti e-book atau webinar gratis.</li>
                                <li>Buat konten yang menjawab masalah spesifik yang dihadapi audiens.</li>
                                <li>Bangun kredibilitas dengan testimoni dan studi kasus dari pelanggan yang puas.</li>
                            </ul>

                            <h2>3. Mendorong Keputusan (Decision)</h2>
                            <p>Pada tahap ini, calon pelanggan mulai mempertimbangkan produk Anda sebagai solusi yang akan dibeli. Anda perlu memberikan dorongan yang lebih kuat agar mereka segera mengambil keputusan untuk membeli.</p>
                            <ul>
                                <li>Tawarkan diskon atau promosi khusus yang terbatas waktu.</li>
                                <li>Tampilkan ulasan dan testimoni positif dari pelanggan sebelumnya.</li>
                                <li>Sediakan informasi perbandingan antara produk Anda dengan produk pesaing.</li>
                            </ul>

                            <h2>4. Tindakan (Action)</h2>
                            <p>Ini adalah tahap akhir di mana calon pelanggan akhirnya mengambil keputusan untuk membeli. Pastikan proses pembelian berlangsung dengan mudah dan lancar agar tidak ada yang menghalangi calon pelanggan untuk menyelesaikan transaksi.</p>
                            <ul>
                                <li>Permudah proses checkout dengan sedikit mungkin langkah.</li>
                                <li>Sediakan berbagai metode pembayaran untuk memudahkan pelanggan.</li>
                                <li>Berikan konfirmasi dan tindak lanjut yang cepat setelah pembelian selesai.</li>
                            </ul>

                            <h2>5. Mempertahankan Pelanggan (Retention)</h2>
                            <p>Setelah berhasil mendapatkan pelanggan, penting untuk mempertahankan mereka agar terus melakukan pembelian ulang. Pelanggan yang setia dapat menjadi pendukung merek Anda dan menyebarkan pengalaman positif kepada orang lain.</p>
                            <ul>
                                <li>Tawarkan program loyalitas atau insentif untuk pembelian ulang.</li>
                                <li>Sediakan layanan pelanggan yang responsif dan solutif.</li>
                                <li>Jaga komunikasi secara berkala melalui email atau media sosial.</li>
                            </ul>

                            <h2>Kesimpulan</h2>
                            <p>Mengoptimalkan setiap tahap dalam sales funnel membutuhkan pemahaman yang baik tentang kebutuhan dan perilaku audiens target Anda. Dengan menerapkan strategi yang tepat pada setiap tahap, bisnis dapat meningkatkan konversi, menciptakan pengalaman positif bagi pelanggan, dan mencapai hasil penjualan yang maksimal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection