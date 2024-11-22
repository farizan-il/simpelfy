@extends('gondowangi.backend.layout.main')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

<style>
    #navs-justified-karyawan::-webkit-scrollbar-track {
        display: none;
    }
    #contributionChart svg {
        width: 100%;
        height: auto;
        overflow: visible;
    }
    
    .card-body {
        overflow-x: auto;
        padding: 1rem;
    }

    #contributionChart svg {
        width: 100%;
        min-width: 750px; 
        height: auto;
    }

    .chart-container {
            margin-bottom: 2rem;
            transition: all 0.3s ease;
    }
    .chart-container:hover {
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav class="navbar navbar-expand-lg border-secondary border-bottom mb-12 ">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-primary" aria-current="page" href="javascript:void(0)">Overview</a>
                    </li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="/pemantauanTraining">Laporan Training</a>
                    </li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="/dashboardkaryawan">Karyawan</a>
                    </li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                </ul>
                <form class="d-flex" onsubmit="return false">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-primary btn-sm py-0 px-2" type="submit"><i class='bx bxs-cloud-download me-2'></i> export</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="row">
        <!-- Total Kelas -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 mb-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-book-open bx-sm'></i></span>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded text-muted"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <p class="mb-1">Total Kelas: 
                        <small class="text-primary fw-bold"> {{ $totalkls }}</small>
                        <button type="button" class="btn btn-white btn-sm px-1 mb-0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Ini adalah kelas yang baru ditambahkan di bulan ini</span>">
                            <i class='bx bxs-help-circle text-primary' ></i>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    
        <!-- Kelas Baru -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 mb-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-slack"><i class='bx bx-book-add bx-sm'></i></span>
                        </div>
                    </div>
                    <p class="mb-1">Kelas Baru: 
                        <small class="text-danger fw-bold"> {{ $totalkls }}</small>
                        <button type="button" class="btn btn-white btn-sm px-1 mb-0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Ini adalah kelas yang baru ditambahkan di bulan ini</span>">
                            <i class='bx bxs-help-circle text-danger' ></i>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    
        <!-- Video Pembelajaran -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 mb-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-danger"><i class='bx bx-play-circle bx-sm'></i></span>
                        </div>
                    </div>
                    <p class="mb-1">Video:
                        <small class="text-danger fw-bold"> 62</small>
                        <button type="button" class="btn btn-white btn-sm px-1 mb-0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Ini adalah kelas yang baru ditambahkan di bulan ini</span>">
                            <i class='bx bxs-help-circle text-danger' ></i>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    
        <!-- Kuis dan Test -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 mb-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-warning"><i class='bx bx-edit-alt bx-sm'></i></span>
                        </div>
                    </div>
                    <p class="mb-1">Kuis dan Test
                        <small class="text-warning fw-bold"> 62</small>
                        <button type="button" class="btn btn-white btn-sm px-1 mb-0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Ini adalah kelas yang baru ditambahkan di bulan ini</span>">
                            <i class='bx bxs-help-circle text-slack' ></i>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    
        <!-- Total Karyawan -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 mb-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-info"><i class='bx bx-user bx-sm'></i></span>
                        </div>
                    </div>
                    <p class="mb-1">Total Karyawan
                        <small class="text-info fw-bold"> 62</small>
                        <button type="button" class="btn btn-white btn-sm px-1 mb-0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Ini adalah kelas yang baru ditambahkan di bulan ini</span>">
                            <i class='bx bxs-help-circle text-slack' ></i>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    
        <!-- Karyawan Sedang Online -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 mb-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-success"><i class='bx bx-user-check bx-sm'></i></span>
                        </div>
                    </div>
                    <p class="mb-1">Online
                        <small class="text-success fw-bold"> 62</small>
                        <button type="button" class="btn btn-white btn-sm px-1 mb-0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Data ini adalah total karyawan yang sedang membuka aplikasi lms </span>">
                            <i class='bx bxs-help-circle text-slack' ></i>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- waktu yang dihabiskan --}}
    <div class="row mb-6 g-6">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h6 class="m-0 me-2">Waktu yang dihabiskan</h6>
                        <p class="card-subtitle">Ringkasan Semua Departemen</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <select id="dateRangeSelect" class="form-select me-2" style="width: 200px;">
                            <option value="week">Minggu Ini</option>
                            <option value="month">Bulan Sebelumnya</option>
                            <option value="year">Tahun Ini</option>
                            <option value="custom">Custom</option>
                        </select>
                        <input type="text" id="dateRangePicker" class="form-control me-2" placeholder="Atur rentang tanggal" style="display:none; width: 200px;">
                        <button id="applyFilter" class="btn btn-primary btn-sm">Terapkan</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="SpentTimeChart"></div>
                </div>
            </div>
        </div>

        {{-- aktivitas karyawan --}}
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h6 class="mb-0">Aktivitas Terbaru</h6>
                    </div>
                    <div class="dropdown">
                        <button class="btn text-muted p-0" type="button" id="ordersCountries" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded bx-sm"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="ordersCountries">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="nav-align-top">
                        <ul class="nav nav-tabs nav-fill rounded-0 timeline-indicator-advanced" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-karyawan" aria-controls="navs-justified-karyawan" aria-selected="false">Karyawan</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-admin" aria-controls="navs-justified-admin" aria-selected="true">Admin</button>
                            </li>
                        </ul>
                        <div class="tab-content border-0 mx-1">
                            <!-- Aktivitas Karyawan -->
                            <div class="tab-pane fade show active" id="navs-justified-karyawan" role="tabpanel" style="height: 320px; overflow-y: auto; overflow-x: hidden;">
                                <ul class="timeline mb-0">
                                    @foreach ($aktivitasKaryawan as $karyawan)
                                        <li class="timeline-item ps-6 border-left-dashed">
                                            <span class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                                <i class='bx bx-check-circle'></i>
                                            </span>
                                            <div class="timeline-event ps-1">
                                                <div class="timeline-header">
                                                    <small class="text-success"><strong>{{ $karyawan->credentials->profile->nama ?? 'N/A' }}</strong></small>
                                                </div>
                                                <h6 class="my-50">{{ $karyawan->keterangan }}</h6>
                                                <p class="text-body mb-0">
                                                    {{ \Carbon\Carbon::parse($karyawan->created_at)->translatedFormat('l, d M Y - H.i') }}
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Aktivitas Admin -->
                            <div class="tab-pane fade" id="navs-justified-admin" role="tabpanel">
                                <ul class="timeline mb-0">
                                    @foreach ($aktivitasAdmin as $admin)
                                        <li class="timeline-item ps-6 border-left-dashed">
                                            <span class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                                <i class='bx bx-check-circle'></i>
                                            </span>
                                            <div class="timeline-event ps-1">
                                                <div class="timeline-header">
                                                    <small class="text-success text-uppercase">{{ $admin->credentials->profile->nama ?? 'N/A' }}</small>
                                                </div>
                                                <h6 class="my-50">{{ $admin->aktivitas }}</h6>
                                                <p class="text-body mb-0">                                                    {{ \Carbon\Carbon::parse($admin->created_at)->translatedFormat('l, d M Y - H.i') }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    {{-- statistik pengeluaran --}}
    <div class="col-lg-12 mb-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="card-title mb-4">
                        <h6 class="m-0 me-2">Riwayat Transaksi</h6>
                        <p class="card-subtitle">Ringkasan Keseluruhan Transaksi</p>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex align-items-center">
                            <select id="departmentSelect" class="form-select me-2" style="width: 210px;">
                                <option value="all">Semua Departemen</option>
                                <option value="Sales">Sales</option>
                                <option value="Finance">Finance</option>
                                <option value="Bussines">Bussines</option>
                                <option value="HCD">HCD</option>
                            </select>
                        </div>
                        <div class="d-flex align-items-center">
                            <select id="dateRangeSelectTransaksi" class="form-select me-2" style="width: 140px;">
                                <option value="month">Bulan ini</option>
                                <option value="year">Tahun ini</option>
                                <option value="custom">Custom</option>
                            </select>
                            <input type="text" id="dateRangePickerTransaksi" class="form-control me-2" 
                                   placeholder="Atur rentang tanggal" style="display:none; width: 200px;">
                            <button id="applyFilterTransaksi" class="btn btn-primary btn-sm">Terapkan</button>
                        </div>
                    </div>
                </div>
                <div style="position: relative; height: 280px; width: 100%;">
                    <canvas class="p-3" id="weeklyReportChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- statistik riwayat pengeluaran --}}
    <div class="col-12 mb-6">
        <div class="card">
            <div class="row row-bordered g-0">                   
                <div class="col-lg-4 border border-end d-flex flex-column">
                    <div class="card-header mb-0 d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">Jumlah Kelas Tiap Kategori</h5>
                            <p class="card-subtitle">Laporan Semua Kategori</p>
                        </div>
                    </div>
                    <div class="card-body  p-0 m-0">
                        <canvas id="myDoughnutChart" style="width: 200px; height: 200px;"></canvas>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">Aktivitas Karyawan</h5>
                            <p class="card-subtitle">Laporan Semua Aktivitas Karywan</p>
                        </div>
                        <div class="dropdown">
                            <select id="select2Basic" class="select2 form-select form-select-lg form-select-sm" data-allow-clear="true">
                                <option value="2024" selected>2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body" style="position: relative;">
                        <div class="p-3" id="contributionChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- statistik perbandingan riwayat pengeluaran --}}
    <div class="col-12 mb-6">
        <div class="card">
            <div class="row  g-0">
                <div class="col-lg-9 mb-4 border-end">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="m-0">Riwayat Perbandingan Transaksi</h5>
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <select id="dateRangeSelectTransaksi" class="form-select me-2" style="width: 140px;">
                                    <option value="month">Bulan ini</option>
                                    <option value="year">Tahun ini</option>
                                    <option value="custom">Custom</option>
                                </select>
                                <input type="text" id="dateRangePickerPerbandingan" class="form-control me-2" 
                                       placeholder="Atur rentang tanggal" style="display:none; width: 200px;">
                                <button id="applyFilterTransaksiPerbandingan" class="btn btn-primary btn-sm">Terapkan</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="incomeChart" height="400"></canvas>
                    </div>
                </div>
        
                <!-- Report Summary -->
                <div class="col-lg-3 mb-4">
                    <div class="card-header">
                        <h5 class="m-0">Peringkat Tertinggi</h5>
                        <small class="text-muted">Kalkulasi Di tahun sekarang</small>
                    </div>
                    <div class="card-body">
                        <!-- Income -->
                        <div class="bg-label-warning p-3 rounded mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0 mt-2">Sales</h6>
                                    <h4 class="mb-0">IDR 420,845</h4>
                                </div>
                                <small class="text-success">+2.34k</small>
                            </div>
                        </div>
    
                        <!-- Expense -->
                        <div class="bg-label-primary p-3 rounded mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0 mt-2">Marketing</h6>
                                    <h4 class="mb-0">IDR 338,658</h4>
                                </div>
                                <small class="text-danger">-1.15k</small>
                            </div>
                        </div>
    
                        <!-- Profit -->
                        <div class="bg-label-info p-3 rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0 mt-2">Finance</h6>
                                    <h4 class="mb-0">IDR 218,220</h4>
                                </div>
                                <small class="text-success">+1.35k</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- kelas terpopuler, tidak diminati --}}
    <div class="col-12 order-3 order-lg-4 mb-6">
        <div class="card text-center h-100">
            <div class="card-header nav-align-top pb-1">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-os" aria-controls="navs-pills-os" aria-selected="false">Kelas Terpopuler</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-browser" aria-controls="navs-pills-browser" aria-selected="true">Kelas Kurang Diminati</button>
                    </li>
                </ul>
            </div>
            <div class="tab-content pt-0 pb-4">
                <hr>
                {{-- Table Kelas Terpopuler --}}
                <div class="tab-pane fade  show active" id="navs-pills-os" role="tabpanel">
                    <div class="table-responsive text-start text-nowrap">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="w-50">Nama Kelas</th>
                                    <th>Kategori</th>
                                    <th>Pendaftar</th>
                                    <th>Rating</th>
                                    <th>Dipublish pada:</th>
                                    <th>Total Coin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kelasTerpopuler as $index => $kelas)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('image/kelas-sampul/' . $kelas->foto) }}" alt="{{ $kelas->title }}" height="24" width="42" class="me-3 border-secondary border rounded">
                                                <span class="text-heading">{{ $kelas->title }}</span>
                                            </div>
                                        </td>
                                        <td class="text-heading">{{ $kelas->kategori->namaKategori }}</td>
                                        <td class="text-heading">{{ $kelas->orders_count }} <span class="text-secondary">Karyawan</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @php
                                                    $rating = $kelas->userkomentar_avg_rating ?? 0;
                                                    $fullStars = floor($rating); // Bintang penuh
                                                    $halfStar = $rating - $fullStars >= 0.5; // Bintang setengah
                                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Bintang kosong
                                                @endphp
                
                                                @for($i = 0; $i < $fullStars; $i++)
                                                    <span class="text-warning me-1"><i class='bx bxs-star'></i></span>
                                                @endfor
                
                                                @if($halfStar)
                                                    <span class="text-warning me-1"><i class='bx bxs-star-half'></i></span>
                                                @endif
                
                                                @for($i = 0; $i < $emptyStars; $i++)
                                                    <span class="text-muted me-1"><i class='bx bx-star'></i></span>
                                                @endfor
                
                                                <small class="fw-medium">({{ number_format($rating, 1) }})</small>
                                            </div>
                                        </td>
                                        <td>{{ $kelas->created_at->format('d/m/Y') }}</td>
                                        <td>IDR {{ number_format($kelas->orders_sum_harga, 2, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data kelas terpopuler</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div> 

                {{-- Table Kelas Tidak Diminati --}}
                <div class="tab-pane fade" id="navs-pills-browser" role="tabpanel">
                    <div class="table-responsive text-start text-nowrap">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="w-50">Nama Kelas</th>
                                    <th>Kategori</th>
                                    <th>Dipublish pada:</th>
                                    <th>Pendaftar</th>
                                    <th>Rating</th>
                                    <th>Total Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kelasTidakDiminati as $index => $kelas)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('image/kelas-sampul/' . $kelas->foto) }}" alt="{{ $kelas->title }}" height="24" width="42" class="me-3 border-secondary border rounded">
                                                <span class="text-heading">{{ $kelas->title }}</span>
                                            </div>
                                        </td>
                                        <td class="text-heading">{{ $kelas->kategori->namaKategori ?? '-' }}</td>
                                        <td>{{ $kelas->created_at->format('d/m/Y') }}</td>
                                        <td class="text-heading">{{ $kelas->orders_count }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @php
                                                    $rating = $kelas->userkomentar_avg_rating ?? 0;
                                                    $fullStars = floor($rating);
                                                    $halfStar = $rating - $fullStars >= 0.5;
                                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                                @endphp
                
                                                @for($i = 0; $i < $fullStars; $i++)
                                                    <span class="text-warning me-1"><i class='bx bxs-star'></i></span>
                                                @endfor
                
                                                @if($halfStar)
                                                    <span class="text-warning me-1"><i class='bx bxs-star-half'></i></span>
                                                @endif
                
                                                @for($i = 0; $i < $emptyStars; $i++)
                                                    <span class="text-muted me-1"><i class='bx bx-star'></i></span>
                                                @endfor
                
                                                <small class="fw-medium">({{ number_format($rating, 1) }})</small>
                                            </div>
                                        </td>
                                        <td>IDR {{ number_format($kelas->orders_sum_harga, 2, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data kelas yang kurang diminati</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik perolehan bintang karyawan --}}
    <div class="col-12 order-3 order-lg-4 mb-6">
        <div class="card h-100">
            <div class="card-header pb-1">
                <div class="card-title mb-4">
                    <h5 class="m-0 me-2">Statisktik Perolehan Bintang Karyawan</h5>
                    <p class="card-subtitle">Laporan 3 Bulan</p>
                </div>
            </div>
            <div class="tab-content pt-0 pb-4">
                <div class="tab-pane fade  show active" id="navs-pills-os" role="tabpanel">
                    <div class="table-responsive text-start text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Departemen</th>
                                    <th>Skor Diperoleh:</th>
                                    <th>Video:
                                        <button type="button" class="btn btn-white btn-sm px-1 mb-1" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Ini adalah total waktu yang dihabiskan untuk menonton video pembelajaran</span>">
                                            <i class='bx bxs-help-circle text-info' ></i>
                                        </button>
                                    </th>
                                    <th>Soal:
                                        <button type="button" class="btn btn-white btn-sm px-1 mb-1" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Ini adalah total waktu yang dihabiskan untuk mengerjakan soal</span>">
                                            <i class='bx bxs-help-circle text-success' ></i>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peringkatKaryawan as $index => $karyawan)
                                    <tr>
                                        <td class="fw-bold">#{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="text-heading fw-bold">
                                                    {{ $karyawan->credentials->profile->nama ?? 'Tidak Ada Nama' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-heading fw-bold">
                                            {{ $karyawan->credentials->profile->departement->departement ?? 'Tidak Ada Departemen' }}
                                        </td>
                                        <td>
                                            <span class="fw-bold bg-label-warning p-1 rounded">
                                                {{ $karyawan->skor }}
                                            </span> ⭐
                                        </td>
                                        <td>
                                            <span class="fw-bold bg-label-info p-1 rounded">
                                                {{ $karyawan->total_video_time ?? 0 }} Jam
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-bold bg-label-success p-1 rounded">
                                                {{ $karyawan->total_test_time ?? 0 }} Jam
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data karyawan</td>
                                    </tr>
                                @endforelse
                            </tbody>                            
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>

    <!-- Modal for error alert -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Rentang Tanggal Tidak Valid</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Rentang tanggal yang dipilih melebihi batas maksimal 14 hari. Silakan pilih rentang tanggal yang lebih pendek.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    {{-- filter date untuk perbandingan transaksi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const applyFilterTransaksiPerbandingan = document.getElementById('dateRangePickerTransaksi');
            const dateRangePickerTransaksi = document.getElementById('dateRangePickerTransaksi');
    
            // Inisialisasi Flatpickr
            const fp = flatpickr("#dateRangePickerTransaksi", {
                mode: "range",
                dateFormat: "Y-m-d",
                theme: "material_blue",
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        const diff = (selectedDates[1] - selectedDates[0]) / (1000 * 60 * 60 * 24);
                        if (diff > 14) {
                            // Tampilkan modal error
                            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                            errorModal.show();
    
                            // Hapus pilihan
                            instance.clear();
                        }
                    }
                },
            });
    
            // Event listener untuk dropdown rentang waktu
            document.getElementById('applyFilterTransaksiPerbandingan').addEventListener('change', function() {
                const selectedValue = this.value;
                const today = new Date();
                
                switch(selectedValue) {
                    case 'week':
                        // Minggu ini (Senin - Minggu saat ini)
                        const startOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 1));
                        const endOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 7));
                        fp.setDate([startOfWeek, endOfWeek]);
                        dateRangePickerTransaksi.style.display = 'none';
                        break;
                    
                    case 'month':
                        // Bulan ini
                        const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                        const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                        fp.setDate([startOfMonth, endOfMonth]);
                        dateRangePickerTransaksi.style.display = 'none';
                        break;
                    
                    case 'year':
                        // Tahun ini
                        const startOfYear = new Date(today.getFullYear(), 0, 1);
                        const endOfYear = new Date(today.getFullYear(), 11, 31);
                        fp.setDate([startOfYear, endOfYear]);
                        dateRangePickerTransaksi.style.display = 'none';
                        break;
                    
                    case 'custom':
                        // Tampilkan date picker untuk custom
                        dateRangePickerTransaksi.style.display = 'block';
                        fp.clear();
                        break;
                    
                    default:
                        dateRangePickerTransaksi.style.display = 'none';
                        fp.clear();
                }
            });
        });
    </script>
    
    {{-- filter date untuk spent time --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateRangeSelect = document.getElementById('dateRangePicker');
            const dateRangePicker = document.getElementById('dateRangePicker');
    
            // Inisialisasi Flatpickr
            const fp = flatpickr("#dateRangePicker", {
                mode: "range",
                dateFormat: "Y-m-d",
                theme: "material_blue",
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        const diff = (selectedDates[1] - selectedDates[0]) / (1000 * 60 * 60 * 24);
                        if (diff > 14) {
                            // Tampilkan modal error
                            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                            errorModal.show();
    
                            // Hapus pilihan
                            instance.clear();
                        }
                    }
                },
            });
    
            // Event listener untuk dropdown rentang waktu
            document.getElementById('dateRangeSelect').addEventListener('change', function() {
                const selectedValue = this.value;
                const today = new Date();
                
                switch(selectedValue) {
                    case 'week':
                        // Minggu ini (Senin - Minggu saat ini)
                        const startOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 1));
                        const endOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 7));
                        fp.setDate([startOfWeek, endOfWeek]);
                        dateRangePicker.style.display = 'none';
                        break;
                    
                    case 'month':
                        // Bulan ini
                        const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                        const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                        fp.setDate([startOfMonth, endOfMonth]);
                        dateRangePicker.style.display = 'none';
                        break;
                    
                    case 'year':
                        // Tahun ini
                        const startOfYear = new Date(today.getFullYear(), 0, 1);
                        const endOfYear = new Date(today.getFullYear(), 11, 31);
                        fp.setDate([startOfYear, endOfYear]);
                        dateRangePicker.style.display = 'none';
                        break;
                    
                    case 'custom':
                        // Tampilkan date picker untuk custom
                        dateRangePicker.style.display = 'block';
                        fp.clear();
                        break;
                    
                    default:
                        dateRangePicker.style.display = 'none';
                        fp.clear();
                }
            });
        });
    </script>
    
    {{-- filter date untuk perbandingan transaksi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateRangeSelectTransaksi = document.getElementById('dateRangePickerTransaksi');
            const dateRangePickerTransaksi = document.getElementById('dateRangePickerTransaksi');
    
            // Inisialisasi Flatpickr
            const fp = flatpickr("#dateRangePickerTransaksi", {
                mode: "range",
                dateFormat: "Y-m-d",
                theme: "material_blue",
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        const diff = (selectedDates[1] - selectedDates[0]) / (1000 * 60 * 60 * 24);
                    }
                },
            });
    
            // Event listener untuk dropdown rentang waktu
            document.getElementById('dateRangeSelectTransaksi').addEventListener('change', function() {
                const selectedValue = this.value;
                const today = new Date();
                
                switch(selectedValue) {
                    case 'week':
                        // Minggu ini (Senin - Minggu saat ini)
                        const startOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 1));
                        const endOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 7));
                        fp.setDate([startOfWeek, endOfWeek]);
                        dateRangePickerTransaksi.style.display = 'none';
                        break;
                    
                    case 'month':
                        // Bulan ini
                        const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                        const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                        fp.setDate([startOfMonth, endOfMonth]);
                        dateRangePickerTransaksi.style.display = 'none';
                        break;
                    
                    case 'year':
                        // Tahun ini
                        const startOfYear = new Date(today.getFullYear(), 0, 1);
                        const endOfYear = new Date(today.getFullYear(), 11, 31);
                        fp.setDate([startOfYear, endOfYear]);
                        dateRangePickerTransaksi.style.display = 'none';
                        break;
                    
                    case 'custom':
                        // Tampilkan date picker untuk custom
                        dateRangePickerTransaksi.style.display = 'block';
                        fp.clear();
                        break;
                    
                    default:
                        dateRangePickerTransaksi.style.display = 'none';
                        fp.clear();
                }
            });
        });
    </script>

    {{-- script untuk spent time --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data dummy yang dapat difilter
            const dummyData = {
                'week': {
                    videoData: [10, 15, 22, 28, 20, 25, 12],
                    soalData: [8, 25, 10, 11, 27, 22, 24],
                    categories: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']
                },
                'month': {
                    videoData: [40, 55, 50, 25, 30, 60, 75, 20, 15, 75, 70, 90, 25, 85, 80, 70, 75, 65, 60, 50, 55, 45, 50, 55, 65, 75, 80, 70, 60, 50, 40],
                    soalData: [50, 14, 30, 55, 65, 20, 30, 70, 55, 15, 20, 15, 60, 70, 75, 85, 90, 95, 85, 80, 75, 65, 60, 55, 50, 45, 40, 50, 55, 60, 50],
                    categories: ['1 Oktober', '2 Oktober', '3 Oktober', '4 Oktober', '5 Oktober', '6 Oktober', '7 Oktober', '8 Oktober', '9 Oktober', '10 Oktober', '11 Oktober', '12 Oktober', '13 Oktober', '14 Oktober', '15 Oktober', '16 Oktober', '17 Oktober', '18 Oktober', '19 Oktober', '20 Oktober', '21 Oktober', '22 Oktober', '23 Oktober', '24 Oktober', '25 Oktober', '26 Oktober', '27 Oktober', '28 Oktober', '29 Oktober', '30 Oktober', '31 Oktober']
                },
                'year': {
                    videoData: [150, 160, 170, 180, 190, 200, 210, 220, 230, 240, 250, 260],
                    soalData: [130, 140, 150, 160, 170, 180, 190, 200, 210, 220, 230, 240],
                    categories: [ 'Dec','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov']
                }
            };
        
            let chart;
        
            function initializeChart(data) {
                const options = {
                    series: [
                        {
                            name: 'Video',
                            data: data.videoData
                        },
                        {
                            name: 'Soal',
                            data: data.soalData
                        }
                    ],
                    chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                            show: false
                        }
                    },
                    colors: ['#696cff', '#ff9900'],
                    dataLabels: { enabled: false },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    fill: {
                        type: ['gradient', 'solid'],
                        gradient: {
                            shadeIntensity: 0.1,
                            opacityFrom: 0.8,
                            opacityTo: 0.2,
                            stops: [0, 90, 100]
                        },
                        opacity: [1, 0]
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2.2,
                        dashArray: [0, 5]
                    },
                    xaxis: {
                        categories: data.categories,
                        labels: {
                            rotate: 0,
                            maxHeight: 50,
                            style: {
                                fontSize: '10px' // Perkecil ukuran font
                            },
                            trim: true 
                        },
                       
                    },
                    // Tambahkan margin untuk mengakomodasi label yang miring
                    grid: {
                        padding: {
                            bottom: 20 // Tambahkan padding bawah
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value.toFixed(0) + ' jam';
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return value.toFixed(0) + ' jam';
                            }
                        },
                        // x: {
                        //     formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                        //         const categories = w.config.xaxis.categories;
                        //         const date = new Date(categories[dataPointIndex]);
                        //         const day = date.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'short' });
                        //         return day;
                        //     }
                        // }
                    }

                };
        
                if (chart) {
                    chart.destroy();
                }
        
                chart = new ApexCharts(document.querySelector("#SpentTimeChart"), options);
                chart.render();
            }
            
            function generateCustomData(startDate, endDate) {
                const diffDays = Math.round((endDate - startDate) / (1000 * 60 * 60 * 24));
                
                // Batasi jumlah titik data untuk menghindari overload
                const MAX_POINTS = 30;
                const interval = Math.max(1, Math.floor(diffDays / MAX_POINTS));

                const videoData = [];
                const soalData = [];
                const categories = [];

                for (let i = 0; i <= diffDays; i += interval) {
                    const date = new Date(startDate);
                    date.setDate(date.getDate() + i);
                    
                    videoData.push(Math.floor(Math.random() * 30));
                    soalData.push(Math.floor(Math.random() * 25));
                    
                    // Format tanggal yang lebih ringkas
                    categories.push(date.toLocaleDateString('id-ID', { 
                        day: 'numeric', 
                        month: 'short' 
                    }));
                }

                return {
                    videoData,
                    soalData,
                    categories
                };
            }

            function generateLabelCategories(startDate, endDate) {
                const diffDays = Math.round((endDate - startDate) / (1000 * 60 * 60 * 24));
                const categories = [];

                if (diffDays <= 14) {
                    // Jika <= 14 hari, pakai tanggal asli
                    for (let i = 0; i <= diffDays; i++) {
                        const date = new Date(startDate);
                        date.setDate(date.getDate() + i);
                        categories.push(date.toLocaleDateString('id-ID', { 
                            day: 'numeric', 
                            month: 'short' 
                        }));
                    }
                } else if (diffDays <= 31 * 2) {
                    // Jika > 14 hari dan <= 2 bulan, pakai minggu
                    const weeks = Math.ceil(diffDays / 7);
                    for (let i = 1; i <= weeks; i++) {
                        categories.push(`Minggu ${i}`);
                    }
                } else if (diffDays <= 365) {
                    // Jika > 2 bulan dan <= 1 tahun, pakai bulan
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    const startMonth = startDate.getMonth();
                    const endMonth = endDate.getMonth();

                    for (let i = startMonth; i <= endMonth; i++) {
                        categories.push(months[i]);
                    }
                } else {
                    // Jika > 1 tahun, pakai tahun
                    categories.push(startDate.getFullYear().toString());
                }

                return categories;
            }

            function generateCustomData(startDate, endDate) {
                const diffDays = Math.round((endDate - startDate) / (1000 * 60 * 60 * 24));
                const categories = generateLabelCategories(startDate, endDate);
                
                // Generate data sesuai jumlah kategori
                const videoData = categories.map(() => Math.floor(Math.random() * 30));
                const soalData = categories.map(() => Math.floor(Math.random() * 25));

                return {
                    videoData,
                    soalData,
                    categories
                };
            }
        
            // Inisialisasi Flatpickr untuk date range picker
            const fp = flatpickr("#dateRangePicker", {
                mode: "range",
                dateFormat: "Y-m-d"
            });
        
            // Fungsi untuk menghasilkan data custom
            function generateCustomData(startDate, endDate) {
                // Hitung perbedaan hari antara startDate dan endDate
                const diffDays = Math.round((endDate - startDate) / (1000 * 60 * 60 * 24));
                
                // Generate data dummy untuk rentang custom
                const videoData = Array.from({length: diffDays + 1}, () => Math.floor(Math.random() * 30));
                const soalData = Array.from({length: diffDays + 1}, () => Math.floor(Math.random() * 25));
                
                // Generate label tanggal
                const categories = Array.from({length: diffDays + 1}, (_, i) => {
                    const date = new Date(startDate);
                    date.setDate(date.getDate() + i);
                    return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
                });
        
                return {
                    videoData,
                    soalData,
                    categories
                };
            }
        
            // Event listener untuk dropdown
            document.getElementById('dateRangeSelect').addEventListener('change', function() {
                const selectedValue = this.value;
                const dateRangePicker = document.getElementById('dateRangePicker');
        
                switch(selectedValue) {
                    case 'week':
                    case 'month':
                    case 'year':
                        dateRangePicker.style.display = 'none';
                        initializeChart(dummyData[selectedValue]);
                        break;
                    
                    case 'custom':
                        dateRangePicker.style.display = 'block';
                        break;
                }
            });
        
            // Event listener untuk tombol Terapkan
            document.getElementById('applyFilter').addEventListener('click', function() {
                const selectedRange = document.getElementById('dateRangeSelect').value;
        
                if (selectedRange === 'custom') {
                    const dates = fp.selectedDates;
                    if (dates.length === 2) {
                        // Generate data untuk rentang tanggal custom
                        const customData = generateCustomData(dates[0], dates[1]);
                        initializeChart(customData);
                    } else {
                        alert('Silakan pilih rentang tanggal terlebih dahulu');
                    }
                } else {
                    // Gunakan data dummy sesuai pilihan
                    initializeChart(dummyData[selectedRange]);
                }
            });
        
            // Inisialisasi chart pertama kali
            initializeChart(dummyData['week']);
        });
    </script>

    {{-- script untuk transaksi tiap semua departement --}}
    <script>
        // Data dummy transaksi per departemen
        const transactionData = {
            // Data untuk semua departemen
            all: {
                thisMonth: Array.from({ length: 20 }, (_, i) => ({
                    date: `${i + 1} Nov`,
                    value: Math.floor(Math.random() * (95 - 40) + 40)
                })),
                lastMonth: Array.from({ length: 20 }, (_, i) => ({
                    date: `${i + 1} Oct`,
                    value: Math.floor(Math.random() * (90 - 35) + 35)
                })),
                thisYear: Array.from({ length: 12 }, (_, i) => ({
                    date: new Date(2024, i, 1).toLocaleString('id-ID', { month: 'short' }),
                    value: Math.floor(Math.random() * (1000 - 600) + 600)
                }))
            },
            
            // Data untuk departemen Sales
            Sales: {
                thisMonth: Array.from({ length: 20 }, (_, i) => ({
                    date: `${i + 1} Nov`,
                    value: Math.floor(Math.random() * (85 - 30) + 30)
                })),
                lastMonth: Array.from({ length: 20 }, (_, i) => ({
                    date: `${i + 1} Oct`,
                    value: Math.floor(Math.random() * (80 - 25) + 25)
                })),
                thisYear: Array.from({ length: 12 }, (_, i) => ({
                    date: new Date(2024, i, 1).toLocaleString('id-ID', { month: 'short' }),
                    value: Math.floor(Math.random() * (900 - 500) + 500)
                }))
            },
            
            // Data untuk departemen Finance
            Finance: {
                thisMonth: Array.from({ length: 20 }, (_, i) => ({
                    date: `${i + 1} Nov`,
                    value: Math.floor(Math.random() * (75 - 20) + 20)
                })),
                lastMonth: Array.from({ length: 20 }, (_, i) => ({
                    date: `${i + 1} Oct`,
                    value: Math.floor(Math.random() * (70 - 15) + 15)
                })),
                thisYear: Array.from({ length: 12 }, (_, i) => ({
                    date: new Date(2024, i, 1).toLocaleString('id-ID', { month: 'short' }),
                    value: Math.floor(Math.random() * (800 - 400) + 400)
                }))
            },
            
            // Data untuk departemen Business
            Bussines: {
                thisMonth: Array.from({ length: 20 }, (_, i) => ({
                    date: `${i + 1} Nov`,
                    value: Math.floor(Math.random() * (90 - 35) + 35)
                })),
                lastMonth: Array.from({ length: 20 }, (_, i) => ({
                    date: `${i + 1} Oct`,
                    value: Math.floor(Math.random() * (85 - 30) + 30)
                })),
                thisYear: Array.from({ length: 12 }, (_, i) => ({
                    date: new Date(2024, i, 1).toLocaleString('id-ID', { month: 'short' }),
                    value: Math.floor(Math.random() * (950 - 550) + 550)
                }))
            },
            
            // Data untuk departemen HCD
            HCD: {
                thisMonth: Array.from({ length: 20 }, (_, i) => ({
                    date: `${i + 1} Nov`,
                    value: Math.floor(Math.random() * (70 - 15) + 15)
                })),
                lastMonth: Array.from({ length: 20 }, (_, i) => ({
                    date: `${i + 1} Oct`,
                    value: Math.floor(Math.random() * (65 - 10) + 10)
                })),
                thisYear: Array.from({ length: 12 }, (_, i) => ({
                    date: new Date(2024, i, 1).toLocaleString('id-ID', { month: 'short' }),
                    value: Math.floor(Math.random() * (700 - 300) + 300)
                }))
            }
        };
        
        // Fungsi untuk mendapatkan data berdasarkan filter
        function getFilteredData(department = 'all', timeRange = 'month', startDate = null, endDate = null) {
            const deptData = transactionData[department] || transactionData.all;

            switch (timeRange) {
                case 'year':
                    return {
                        labels: deptData.thisYear.map((item, index) => {
                            const lastYearMonth = new Date(2023, index, 1).toLocaleString('id-ID', { month: 'short' });
                            const thisYearMonth = item.date;
                            return `${lastYearMonth} / ${thisYearMonth}`;
                        }),
                        thisMonth: deptData.thisYear.map(item => item.value),
                        lastMonth: deptData.thisYear.map(item => item.value * 0.9) // Simulasi data tahun lalu
                    };
                case 'custom':
                    if (startDate && endDate) {
                        const days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
                        const customData = Array.from({ length: days }, (_, i) => {
                            const currentDate = new Date(startDate);
                            currentDate.setDate(startDate.getDate() + i);
                            return {
                                date: formatDate(currentDate),
                                value: Math.floor(Math.random() * (95 - 40) + 40)
                            };
                        });

                        return {
                            labels: customData.map(item => item.date),
                            datasets: [
                                {
                                    label: `${formatDate(startDate)} - ${formatDate(endDate)}`,
                                    data: customData.map(item => item.value),
                                    backgroundColor: 'rgb(102, 199, 50)',
                                    borderColor: '#696CFF',
                                    barThickness: 20,
                                    borderRadius: 4,
                                    maxBarThickness: 15
                                }
                            ]
                        };
                    }
                    return {
                        labels: [],
                        thisMonth: [],
                        lastMonth: []
                    };
                default:
                    return {
                        labels: deptData.thisMonth.map(item => item.date),
                        thisMonth: deptData.thisMonth.map(item => item.value),
                        lastMonth: deptData.lastMonth.map(item => item.value)
                    };
            }
        }
        
        document.addEventListener("DOMContentLoaded", function () {
            // Inisialisasi Datepicker untuk custom range
            const dateRangePicker = document.getElementById('dateRangePickerTransaksi');
            const dateRangeSelect = document.getElementById('dateRangeSelectTransaksi');
            const departmentSelect = document.getElementById('departmentSelect');
            const applyFilterBtn = document.getElementById('applyFilterTransaksi');
            
            // Toggle tampilan date range picker
            dateRangeSelect.addEventListener('change', function() {
                dateRangePicker.style.display = this.value === 'custom' ? 'block' : 'none';
            });
        
            // Inisialisasi Chart
            const ctx = document.getElementById('weeklyReportChart');
            
            // Konfigurasi default chart
            const config = {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [
                        {
                            label: 'Bulan Ini',
                            data: [],
                            backgroundColor: 'rgb(102, 199, 50)',
                            borderColor: '#696CFF',
                            barThickness: 20,
                            borderRadius: 4,
                            maxBarThickness: 15
                        },
                        {
                            label: 'Bulan Lalu',
                            data: [],
                            backgroundColor: 'rgb(198, 241, 175)',
                            borderColor: '#E7E7FF',
                            barThickness: 20,
                            borderRadius: 4,
                            maxBarThickness: 15
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#566a7f',
                            bodyColor: '#566a7f',
                            borderColor: '#d9dee3',
                            borderWidth: 1,
                            padding: 10,
                            usePointStyle: true,
                            displayColors: false,
                            callbacks: {
                                label: function (context) {
                                    return `${context.dataset.label}: ${context.parsed.y}.000`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                stepSize: 20,
                                callback: function (value) {
                                    return value + '.000';
                                },
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                borderDash: [5, 5],
                                drawBorder: false,
                                color: '#ECEEF1'
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                color: '#566a7f',
                                font: {
                                    size: 11
                                },
                            },
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            };
        
            // Inisialisasi chart
            window.weeklyChart = new Chart(ctx, config);
        
            // Fungsi untuk update chart
            function updateChart(data) {
                if (window.weeklyChart) {
                    window.weeklyChart.data.labels = data.labels;
                    window.weeklyChart.data.datasets[0].data = data.thisMonth;
                    window.weeklyChart.data.datasets[1].data = data.lastMonth;
                    
                    // Update max value di y axis berdasarkan data tertinggi
                    const maxValue = Math.max(...data.thisMonth, ...data.lastMonth);
                    window.weeklyChart.options.scales.y.max = Math.ceil(maxValue / 100) * 100;
                    
                    window.weeklyChart.update();
                }
            }
        
            // Event listener untuk filter departemen
            departmentSelect.addEventListener('change', function() {
                const department = this.value;
                const timeRange = dateRangeSelect.value;
                const data = getFilteredData(department, timeRange);
                updateChart(data);
            });
        
            // Event listener untuk filter waktu
            dateRangeSelect.addEventListener('change', function() {
                const timeRange = this.value;
                const department = departmentSelect.value;
                const data = getFilteredData(department, timeRange);
                updateChart(data);
            });
        
            // Event listener untuk tombol apply filter
            applyFilterBtn.addEventListener('click', function() {
                const department = departmentSelect.value;
                const timeRange = dateRangeSelect.value;
                let startDate = null;
                let endDate = null;
        
                if (timeRange === 'custom' && dateRangePicker.value) {
                    // Parse tanggal dari date picker jika menggunakan custom range
                    [startDate, endDate] = dateRangePicker.value.split(' - ').map(date => new Date(date));
                }
        
                const data = getFilteredData(department, timeRange, startDate, endDate);
                updateChart(data);
            });
        
            // Load data awal
            const initialData = getFilteredData();
            updateChart(initialData);
        
            // Resize handler
            window.addEventListener('resize', function () {
                if (window.weeklyChart) {
                    window.weeklyChart.resize();
                }
            });
        });

        applyFilterBtn.addEventListener('click', function () {
            const department = departmentSelect.value;
            const timeRange = dateRangeSelect.value;
            let startDate = null;
            let endDate = null;

            if (timeRange === 'custom' && dateRangePicker.value) {
                // Parse tanggal dari date picker jika menggunakan custom range
                [startDate, endDate] = dateRangePicker.value.split(' - ').map(date => new Date(date));
            }

            const data = getFilteredData(department, timeRange, startDate, endDate);
            updateChart(data);
        });
    </script>

    {{-- script untuk riwayat aktivitas karyawan --}}
    <script>
        // Utility function to format date as YYYY-MM-DD
        const formatDate = (date) => {
            return date.toISOString().split('T')[0];
            };

            // Generate contribution data
            const generateContributionData = () => {
            const contributions = new Map();
            
            // Set start date to January 1, 2024
            const startDate = new Date(2024, 0, 1);
            // Set end date to November 20, 2024
            const endDate = new Date(2024, 10, 20);
            
            // Initialize all dates with 0 contributions
            let currentDate = new Date(startDate);
            while (currentDate <= endDate) {
                contributions.set(formatDate(currentDate), 0);
                currentDate.setDate(currentDate.getDate() + 1);
            }
            
            // Generate random contributions with some patterns
            currentDate = new Date(startDate);
            while (currentDate <= endDate) {
                const dayOfWeek = currentDate.getDay();
                const formattedDate = formatDate(currentDate);
                
                // More contributions on weekdays (Monday-Friday)
                if (dayOfWeek >= 1 && dayOfWeek <= 5) {
                // Generate between 1-15 contributions
                contributions.set(formattedDate, Math.floor(Math.random() * 15) + 1);
                } else {
                // Weekends: fewer contributions (0-5)
                contributions.set(formattedDate, Math.floor(Math.random() * 6));
                }
                
                // Simulate activity spikes every other week
                if (Math.floor(currentDate.getDate() / 7) % 2 === 0) {
                const existingValue = contributions.get(formattedDate);
                contributions.set(formattedDate, existingValue + Math.floor(Math.random() * 10));
                }
                
                currentDate.setDate(currentDate.getDate() + 1);
            }
            
            return contributions;
            };

            // Function to get color based on contribution count
            const getContributionColor = (count) => {
            if (count === 0) return '#edf4ff';
            if (count <= 5) return '#c9deff';
            if (count <= 10) return '#85b6ff';
            if (count <= 15) return '#4191ff';
            return '#0066ff';
            };

            // Function to create the SVG grid
            const createContributionGrid = () => {
            const contributionData = generateContributionData();
            const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
            svg.setAttribute("viewBox", "0 0 800 140");
            
            // Add months
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            months.forEach((month, index) => {
                const text = document.createElementNS("http://www.w3.org/2000/svg", "text");
                text.setAttribute("x", 30 + (index * 60));
                text.setAttribute("y", 20);
                text.setAttribute("font-size", "12");
                text.setAttribute("fill", "#666");
                text.textContent = month;
                svg.appendChild(text);
            });
            
            // Add days of week
            const days = ['Mon', 'Wed', 'Fri'];
            days.forEach((day, index) => {
                const text = document.createElementNS("http://www.w3.org/2000/svg", "text");
                text.setAttribute("x", 1);
                text.setAttribute("y", 40 + (index * 30));
                text.setAttribute("font-size", "12");
                text.setAttribute("fill", "#666");
                text.textContent = day;
                svg.appendChild(text);
            });
            
            // Add contribution squares
            let currentDate = new Date(2024, 0, 1);
            let weekIndex = 0;
            
            while (currentDate <= new Date(2024, 10, 20)) {
                const dayOfWeek = currentDate.getDay();
                if (dayOfWeek !== 0 && dayOfWeek !== 6) { // Skip weekends
                const count = contributionData.get(formatDate(currentDate)) || 0;
                const rect = document.createElementNS("http://www.w3.org/2000/svg", "rect");
                
                rect.setAttribute("x", 30 + (weekIndex * 15));
                rect.setAttribute("y", 30 + ((dayOfWeek - 1) * 15));
                rect.setAttribute("width", "12");
                rect.setAttribute("height", "12");
                rect.setAttribute("rx", "2");
                rect.setAttribute("fill", getContributionColor(count));
                
                // Add title for tooltip
                const title = document.createElementNS("http://www.w3.org/2000/svg", "title");
                title.textContent = `${count} aktivitas di ${formatDate(currentDate)}`;
                rect.appendChild(title);
                
                svg.appendChild(rect);
                }
                
                if (dayOfWeek === 6) weekIndex++;
                currentDate.setDate(currentDate.getDate() + 1);
            }
            
            // Add legend
            const legendItems = [
                { text: "Less", x: 620, color: "#edf4ff" },
                { x: 660, color: "#c9deff" },
                { x: 680, color: "#85b6ff" },
                { x: 700, color: "#4191ff" },
                { x: 720, color: "#0066ff" },
                { text: "More", x: 760 }
            ];
            
            legendItems.forEach(item => {
                if (item.color) {
                const rect = document.createElementNS("http://www.w3.org/2000/svg", "rect");
                rect.setAttribute("x", item.x);
                rect.setAttribute("y", 122);
                rect.setAttribute("width", "12");
                rect.setAttribute("height", "12");
                rect.setAttribute("rx", "2");
                rect.setAttribute("fill", item.color);
                svg.appendChild(rect);
                }
                if (item.text) {
                const text = document.createElementNS("http://www.w3.org/2000/svg", "text");
                text.setAttribute("x", item.x);
                text.setAttribute("y", 130);
                text.setAttribute("font-size", "12");
                text.setAttribute("fill", "#666");
                text.textContent = item.text;
                svg.appendChild(text);
                }
            });
            
            return svg;
            };

            document.addEventListener('DOMContentLoaded', function() {
                const chartContainer = document.getElementById('contributionChart');
                const svg = createContributionGrid();
                chartContainer.appendChild(svg);
                
                // Tambahkan event listener untuk select
                document.getElementById('select2Basic').addEventListener('change', function(e) {
                    const year = e.target.value;
                    // Update chart berdasarkan tahun yang dipilih
                    chartContainer.innerHTML = ''; // Bersihkan container
                    const newSvg = createContributionGrid(); // Buat chart baru
                    chartContainer.appendChild(newSvg);
                });
            });
    </script>

    {{-- script untuk perbandingan kelas tiap departemen --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const data = {
                labels: ['Sales', 'HCD', 'Bussines', 'Finance', 'Marketing'],
                datasets: [{
                    data: ['32', '55', '15', '65', '22'],
                    backgroundColor: [
                        '#FF6384', // Merah Muda
                        '#36A2EB', // Biru
                        '#FFCE56', // Kuning
                        '#4BC0C0', // Hijau Muda
                        '#9966FF'  // Ungu
                    ],
                    hoverOffset: 20,
                    borderRadius: 10
                }]
            };
      
            const config = {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 10,
                            },
                        },
                        tooltip: {
                            enabled: true,
                        },
                    },
                    layout: {
                        padding: {
                            top: 20,
                        }
                    },
                    onClick: function (event, elements) {
                        if (elements.length > 0) {
                            const clickedElementIndex = elements[0].index;
                            let dataset = this.data.datasets[0];
                            if (!dataset._originalHoverOffset) {
                                dataset._originalHoverOffset = dataset.hoverOffset;
                            }
                            dataset.hoverOffset = (dataset.hoverOffset === 20 && dataset.data[clickedElementIndex] === dataset._originalHoverOffset) ? 0 : 20;
                            this.update();
                        }
                    }
                }
            };
      
            const myDoughnutChart = new Chart(
                document.getElementById('myDoughnutChart'),
                config
            );
        });
    </script>

    {{-- script untuk perbandingan transaksi tiap departemen --}}
    <script>
        // Chart initialization
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('incomeChart').getContext('2d');
            
            const monthlyData = {
                Sales: 3200,
                Marketing: 3200,
                Finance: 4800,
                Logistik: 4800,
                PPIC: 2800,
                GA: 2800,
                'BD RND': 1800,
                Warehouse: 1800,
                'Sales Mizzu': 3800,
                QAC: 3800,
                Produksi: 5500,
                'dept ?': 5500
            };

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Object.keys(monthlyData),
                    datasets: [{
                        label: 'Riwayat Transaksi',
                        data: Object.values(monthlyData),
                        fill: true,
                        borderColor: 'rgb(99, 102, 241)',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        tension: 0,
                        pointRadius: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => 'IDR ' + value + 'k'
                            },
                            grid: {
                                borderDash: [5, 5]
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'index',
                            intersect: false
                        }
                    }
                }
            });
        });
    </script>
@endsection