{{-- dashboard sebelah kiri --}}
<div class="col-xl-8 col-md-6">
    <div class="row">
        <div class="col-sm-6 col-lg-4 mb-6">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-primary"><i class='bx bxs-videos bx-sm'></i></span>
                        </div>
                        <h4 class="mb-0">{{ $totalKelasKeseluruhan }}</h4>
                    </div>
                    <p class="mb-2">Total kelas yang anda beli</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+{{ $totalKelasBulanIni }}</span>
                        <span class="text-muted">bulan ini</span>
                    </p>
                </div> 
            </div>
        </div>

        <!-- Card Kelas Dalam Proses -->
        <div class="col-sm-6 col-lg-4 mb-6">
            <div class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-danger"><i class='bx bx-error bx-sm'></i></span>
                        </div>
                        <h4 class="mb-0">{{ $kelasDalamProses }}</h4>
                        <a href="#detailprogress" class="btn btn-label-danger p-1 ms-auto" id="detail" role="button">detail</a>
                    </div>
                    <p class="mb-2">Kelas dalam proses</p>
                    <p class="mb-0">
                        <span class="text-muted text-danger">selesaikan sekarang</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Card Kelas Selesai -->
        <div class="col-sm-6 col-lg-4 mb-6">
            <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-success"><i class='bx bx-git-repo-forked bx-sm'></i></span>
                        </div>
                        <h4 class="mb-0 me-2">{{ $kelasSelesai }}</h4>
                    </div>
                    <p class="mb-2">Kelas selesai</p>
                    <p class="mb-0">
                        {{-- <span class="text-heading fw-medium me-2">+{{ $kelasSelesaiBulanIni }}</span> --}}
                        <span class="text-muted">Total keseluruhan</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Card Kelas Tidak Tuntas -->
        <div class="col-sm-6 col-lg-4 mb-6">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-warning"><i class='bx bx-task-x bx-sm'></i></span>
                        </div>
                        <h4 class="mb-0 me-2">{{ $kelasTidakTuntas }}</h4>
                    </div>
                    <p class="mb-2">Kelas tidak tuntas</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+{{ $kelasTidakTuntasBulanIni }}</span>
                        <span class="text-muted">bulan ini</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4 mb-6">
            <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="text-heading mb-1">Pengeluaran</p>
                            <div class="d-flex align-items-center mb-1">
                                <h4 class="card-title mb-0 me-2">IDR {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
                                {{-- <span class="{{ $perubahan >= 0 ? 'text-success' : 'text-danger' }}">
                                    ({{ $perubahan >= 0 ? '+' : '' }}{{ round($perubahan, 2) }}%)
                                </span> --}}
                            </div>
                            <span>Total keseluruhan</span>
                        </div>
                        <div class="card-icon">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                detail
                            </button>
                            {{-- <span class="badge bg-label-success rounded p-2">
                                <i class='bx bx-trending-up bx-sm'></i>
                            </span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4 mb-6">
            <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-info"><i class='bx bx-credit-card-alt bx-sm'></i></span>
                    </div>
                    <h4 class="mb-0">{{ number_format( Auth::user()->gonpay, 0, ',', '.') }}</h4>
                    </div>
                    <p class="mb-2">Sisa Coin Anda</p>
                    <p class="mb-0">
                    {{-- <span class="text-heading fw-medium me-2">+250.000</span> --}}
                    <span class="text-muted">Total keseluruhan</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- statistik waktu yang di habiskan untuk belajar --}}
    <div class="card">
        <div class="row row-bordered g-0">
            <div class="col-lg-8">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Waktu yang dihabiskan</h5>
                    </div>
                    <div class="d-flex">
                        <div class="dropdown">
                            <select id="select2Basic" class="select2 form-select form-select-lg form-select-sm" data-allow-clear="true">
                                <option value="2024" selected>2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="totalRevenue" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded bx-sm text-muted"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalRevenue">
                                <label for="" class="p-2"><small>filter by:</small></label>
                                <a class="dropdown-item" href="javascript:void(0);">Minggu</a>
                                <a class="dropdown-item" href="javascript:void(0);">Tahun</a>
                            </div>
                        </div>
                    </div>
                </div>
                <canvas id="shipmentDeliveryChart"></canvas>
            </div>

            {{-- statistik Status Kelas --}}
            <div class="col-lg-4 align-items-bottom">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Statistik Status Kelas</h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="totalRevenue" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded bx-sm text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalRevenue">
                        <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myDoughnutChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- statistik kategori kelas yg di sukai --}}
    <div class="card mt-5">
        <div class="row row-bordered g-0">
            <div class="col-12">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Kategori yang paling disukai</h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="totalRevenue" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded bx-sm text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalRevenue">
                        <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <canvas id="myHorizontalBarChart" class="px-3" width="160" height="40"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- dashboard sebelah kanan --}}
<div class="col-xl-4 col-md-6">
    <div class="card mb-5">
        <div class="d-flex align-items-center">
            <div class="row">
                <div class="col-4">
                    <div class="card-body pb-0">
                        <img src="https://img.freepik.com/fotos-premium/woman-smiling-wear-formal-uniform_519183-2075.jpg" width="91" height="91" class="rounded" alt="View Sales">
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-body">

                        
            
                        <div class="d-flex align-items-center mt-3">
                            <h5 class="card-title text-primary mb-0">IDR {{ number_format(Auth::user()->gonpay) }}</h5>
                            <button type="button" class="btn btn-white" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Ini adalah coin yang dimiliki karyawan dibulan ini</span>">
                                <i class='bx bxs-help-circle text-primary' ></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- tanggal realtime --}}
    <div class="card mb-5 card-rounded">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12" >
                <div class="calendar">
                    <div class="header-calender">
                        <button id="prev-week" class="nav-btn">←</button>
                        <div id="current-month" class="month-display"></div>
                        <button id="next-week" class="nav-btn">→</button>
                    </div>
                    
                    <div class="weekdays">
                        <span>S</span>
                        <span>M</span>
                        <span>T</span>
                        <span>W</span>
                        <span>T</span>
                        <span>F</span>
                        <span>S</span>
                    </div>
                    <div id="days" class="days"></div>
                </div>
                </div>
            </div>
        </div>
    </div>

    {{-- aktivitas terbaru --}}
    <div class="card">
        <h5 class="card-header">Aktivitas Terbaru</h5>
        <div class="card-body" style="height: 375px;">
            <ul class="timeline mb-0">
                @forelse ($userActivities as $activity)
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-3">
                                <h6 class="mb-0">{{ $activity->aktivitas }}</h6>
                                <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-2">
                                {{ $activity->keterangan }}
                            </p>
                        </div>
                    </li>
                @empty
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-3">
                                <h6 class="mb-0">Belum ada aktivitas</h6>
                            </div>
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
        <div class="card-footer position-relative">
            <button type="button" id="applyVoucherBtn" class="btn btn-label-warning w-100">Lihat Semua Aktivitas</button>
            <div class="blur-overlay"></div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="row row-bordered g-0">                   
            <div class="col-lg-4 align-items-bottom">
                <div class="card-header d-flex align-items-center mb-0 justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Skor Anda</h5>
                    </div>
                    <div class="btn-group">
                        <!-- Tombol utama yang menampilkan tahun -->
                        <button type="button" class="btn btn-label-primary" id="selectedYear">
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </button>
                        <!-- Tombol dropdown -->
                        <button type="button" class="btn btn-label-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <!-- Daftar dropdown tahun -->
                        <ul class="dropdown-menu" id="yearDropdown"></ul>
                    </div>
                </div>
                <div class="card-body">
                    <div id="scoreChart"></div>
                    <div class="d-flex flex-column align-items-center">
                        <p class="mb-0">Skor Anda dihitung dari 1 tahun terakhir</p>
                        <h6>Peringkat <span class="text-danger fw-bold"><strong>#{{ $ranking }}</strong></span> dari {{ $totalEmployees }} karyawan</h6>
                    </div>
                    <div class="resize-triggers">
                        <div class="expand-trigger">
                            <div style="width: 481px; height: 292px;"></div>
                        </div>
                        <div class="contract-trigger"></div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-8">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-1">Riwayat Pengeluaran</h5>
                        <p class="card-subtitle">Ringkasan laporan tahunan</p>
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
                    <div id="chart"></div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

<div class="col-12" id="detailprogress">
    <div class="card mb-6">
        <div class="table-responsive mb-4">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header py-4 d-flex justify-content-between">
                    <div class="head-label text-start">
                        <h5 class="card-title mb-0 text-nowrap">Riwayat Kelas Anda</h5>
                    </div>
                    <div class="d-flex">
                        <div class="dropdown me-5">
                            <select id="select2Basic" class="select2 form-select form-select-lg form-select-sm" data-allow-clear="true">
                                <option value="" selected>Terbaru</option>
                                <option value="">Terlama</option>
                            </select>
                        </div>
                        <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search"
                            class="form-control" placeholder="Cari Kelas" aria-controls="DataTables_Table_0"></label>
                        </div>
                    </div>
                </div>

                <table class="table table-sm datatables-academy-course dataTable no-footer dtr-column"
                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                    <thead class="border-top">
                        <tr>
                            <th>   
                            </th>
                            <th >Nama Kelas</th>
                            <th >Tanggal Mulai</th>
                            <th >Sisa Waktu</th>
                            <th >Progress</th>
                            <th ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $index => $item)
                        @php
                            $totalModul = $item->userprogress->count();  
                            $completedModul = $item->userprogress->where('status', 'selesai')->count(); 
                            $progress = $totalModul > 0 ? ($completedModul / $totalModul) * 100 : 0; 
                            $titleWords = explode(' ', $item->kelas->title); 
                            $titleFirstLine = implode(' ', array_slice($titleWords, 0, 8)); 
                            $titleSecondLine = implode(' ', array_slice($titleWords, 8));
                        @endphp
                        <tr>
                            <td class="dt-checkboxes-cell">
                                {{ $index + 1 }}
                            </td>
                            <td class="sorting_1">
                                <div class="d-flex align-items-center">
                                    <span class="me-4">
                                        <span class="badge bg-label-warning rounded p-1_5">
                                            <img src="{{ asset('image/kelas-sampul/' . $item->kelas->foto) }}" alt="" width="60px" class="rounded">
                                        </span>
                                    </span>
                                    <div>
                                        <a class="text-heading text-truncate fw-medium mb-2">
                                            {{ $titleFirstLine }}
                                            @if ($titleSecondLine)
                                                <br>{{ $titleSecondLine }}
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-medium text-nowrap text-heading">
                                    {{ $item->created_at ? $item->created_at->locale('id')->format('j F y') : '-' }}
                                </span>
                            </td>                                       
                            
                            <td class="">
                                <span class="fw-medium text-nowrap rounded p-1 {{ $item->sisa_waktu_class }}">
                                    {{ $item->sisa_waktu }}
                                </span>
                            </td>
                                                                                                                                    
                            <td>
                                <div class="d-flex align-items-center gap-3 {{ $progress == 100 ? 'text-success' : 'text-warning' }}">
                                    <p class="fw-medium mb-0 text-heading">{{ round($progress) }}%</p>
                                    <div class="progress w-{{ round($progress) }}" style="height: 6px;">
                                        <div class="progress-bar {{ $progress == 100 ? 'bg-success' : 'bg-warning' }}" style="width: {{ round($progress) }}%" aria-valuenow="{{ round($progress) }}" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    {{-- <small>{{ $progress == 100 ? 'selesai' : 'proses' }}</small> --}}
                                </div>
                            </td>                                    
                            <td>
                                @if ($item->sisa_waktu == 'expired' && $progress < 100 )
                                    <a class="btn btn-label-dark ms-auto disabled" role="button">Belajar Sekarang</a>
                                @else
                                    <a href="" class="btn btn-label-primary ms-auto" role="button">Belajar Sekarang</a>    
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="row mx-md-4 mt-3 flex-column flex-md-row align-items-center">
                    <div class="col-sm-6 col-12 text-center text-md-start pb-2 pb-xl-0 px-0">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1
                            to 5 of 25 entries</div>
                    </div>
                    <div class="col-sm-6 col-12 d-flex justify-content-center justify-content-md-end px-0">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a
                                        aria-controls="DataTables_Table_0" aria-disabled="true" role="link"
                                        data-dt-idx="previous" tabindex="-1" class="page-link"><i
                                            class="bx bx-chevron-left bx-18px"></i></a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0"
                                        role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a>
                                </li>
                                <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#"
                                        aria-controls="DataTables_Table_0" role="link" data-dt-idx="next" tabindex="0"
                                        class="page-link"><i class="bx bx-chevron-right bx-18px"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="width: 1%;"></div>
            </div>
        </div>
    </div>
</div>