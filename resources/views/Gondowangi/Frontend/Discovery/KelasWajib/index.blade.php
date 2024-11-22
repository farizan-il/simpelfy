@extends('gondowangi.frontend.layout.main')

@section('head')
    <title>{{ $title }}</title>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if ($kelasWajib->isEmpty())
        @else
        <div class="card-header d-flex flex-wrap justify-content-between gap-4">
            <div class="mb-4">
                <h5><strong>Kelas Wajib</strong></h5>
                <div id="alertContainer" class="d-flex"></div>
            </div> 
            <div class="mb-4 d-flex">
                <form action="{{ route('explore.index') }}" method="GET">
                    <select class="form-select" name="sort" onchange="this.form.submit()" style="cursor: pointer;">
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}> Terbaru</option>
                        <option value="populer" {{ request('sort') == 'populer' ? 'selected' : '' }}> Populer</option>
                    </select>
                </form>
                <button type="button" class="btn btn-sm py-0" data-bs-toggle="modal" data-bs-target="#modalCenter" style="height: 38px;">
                    <i class='bx bx-filter-alt bx-sm text-primary p-0'></i>              
                </button>
            </div> 
        </div>
        @endif
        <div class="card-body">
            <div class="row gy-6 mb-6">
                <div class="row gy-6 mb-6">
                    @if ($kelasWajib->isEmpty())
                    <div class="col-lg-12 order-lg-2 order-1 align-self-end">
                        <div class="card">
                            <div class="d-flex align-items-start row">
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary mb-3">Selamat, {{ Auth::user()->profile->nama }}! 🎉</h5>
                                        <p class="mb-6">Anda telah menyelesaikan semua kelas wajib bulan ini dengan luar biasa!<br>Periksa skor baru Anda di profil.</p>
                            
                                        <a href="/dashboardkaryawan" class="btn btn-sm btn-label-primary">Kembali</a>
                                    </div>
                                </div>
                                <div class="col-sm-5 text-center text-sm-left">
                                    <div class="card-body pb-0 px-0 px-md-6">
                                        <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/man-with-laptop.png" height="175" class="scaleX-n1-rtl" alt="View Badge User">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                        @foreach ($kelasWajib as $item)
                            <div class="col-sm-6 col-lg-3" style="cursor: pointer;">
                                <div class="card p-2 h-100 shadow-none border card-hover card-hover-shine-effect">
                                    <div class="rounded-2 text-center mb-4">
                                        <img class="img-fluid rounded" src="{{ asset('image/kelas-sampul/' . $item->kelas->foto) }}" alt="tutor image 1" style="height: 200px; width: 100%; object-fit: cover;"/>
                                    </div>
                                    <div class="card-body p-4 pt-2">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="d-flex">
                                                <span class="badge bg-label-info me-3">{{ $item->kelas->kategori->namaKategori }}</span>
                                                <span class="badge bg-label-danger">Wajib</span>
                                            </div>
                                            <p class="d-flex align-items-center justify-content-center fw-medium gap-1 mb-0">
                                                {{ $item->totalRating ?? 'N/A' }}  <span class="text-warning"><i class="bx bxs-star me-1 mb-1_5"></i></span><span class="fw-normal">({{ number_format($item->totalReviews) }})</span>
                                            </p>
                                        </div>
                                        <a class="h6 text-dark">{{ $item->kelas->title }}</a>
                                        <p class="mt-1">{{ \Illuminate\Support\Str::words($item->kelas->subtitle, 6) }}</p>
                                        <p class="d-flex align-items-center text-dark mb-2" style="font-size: 1.1rem;"><strong>IDR {{ number_format($item->kelas->harga, 0, ',', '.') }}</strong></p>
                    
                                        <div class="d-flex flex-column flex-md-row gap-4 text-nowrap flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                            <a class="w-100 btn btn-label-primary btn-sm py-0 d-flex align-items-center" href="/detailkelas/{{ $item->kelas->id }}">
                                                <span class="me-2">Detail</span>
                                                <i class="bx bx-chevron-right lh-1 scaleX-n1-rtl" style="font-size: 20px"></i>
                                            </a>
                                            <form action="{{ route('keranjang.tambah') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="kelas_id" value="{{ $item->kelas->id }}">
                                                <button type="submit" class="btn btn-label-warning d-flex align-items-center">
                                                    <i class="bx bxs-shopping-bags align-middle" style="font-size: 20px"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>                
            </div>
            @if ($kelasWajib->isEmpty())
            @else
            <nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
                <ul class="pagination mb-0 pagination-rounded">
                    <li class="page-item {{ $kelasWajib->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $kelasWajib->previousPageUrl() }}">
                            <i class="bx bx-chevrons-left bx-sm scaleX-n1-rtl"></i>
                        </a>
                    </li>
                    <li class="page-item {{ $kelasWajib->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $kelasWajib->previousPageUrl() }}">
                            <i class="bx bx-chevron-left bx-sm scaleX-n1-rtl"></i>
                        </a>
                    </li>
        
                    @if ($kelasWajib->lastPage() > 1)
                        <li class="page-item">
                            <a class="page-link {{ ($kelasWajib->currentPage() == 1) ? 'active' : '' }}" href="{{ $kelasWajib->url(1) }}">1</a>
                        </li>
        
                        @if($kelasWajib->currentPage() > 3)
                            <li class="page-item disabled"><span>...</span></li>
                        @endif
        
                        @for ($i = max(2, $kelasWajib->currentPage() - 2); $i <= min($kelasWajib->currentPage() + 2, $kelasWajib->lastPage() - 1); $i++)
                            <li class="page-item">
                                <a class="page-link {{ ($kelasWajib->currentPage() == $i) ? 'active' : '' }}" href="{{ $kelasWajib->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
        
                        @if($kelasWajib->currentPage() < $kelasWajib->lastPage() - 2)
                            <li class="page-item disabled"><span>...</span></li>
                        @endif
        
                        <li class="page-item">
                            <a class="page-link {{ ($kelasWajib->currentPage() == $kelasWajib->lastPage()) ? 'active' : '' }}" href="{{ $kelasWajib->url($kelasWajib->lastPage()) }}">{{ $kelasWajib->lastPage() }}</a>
                        </li>
                    @endif
        
                    <li class="page-item {{ $kelasWajib->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $kelasWajib->nextPageUrl() }}">
                            <i class="bx bx-chevron-right bx-sm scaleX-n1-rtl"></i>
                        </a>
                    </li>
                    <li class="page-item {{ $kelasWajib->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $kelasWajib->nextPageUrl() }}">
                            <i class="bx bx-chevrons-right bx-sm scaleX-n1-rtl"></i>
                        </a>
                    </li>
                </ul>
            </nav> 
            @endif               
        </div>
    </div>

    <!-- Modal filter -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Filter Berdasarkan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group text-align-center" style="margin-bottom: 28px;">
                    <form action="{{ route('explore.index') }}" class="d-flex" method="GET">
                        <input type="text" class="form-control" placeholder="Cari kelas....." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button type="submit" class="btn-sm btn-white border-0 btn-transparent">
                            <span class="input-group-text bg-secondary text-white" id="basic-addon2">
                                <i class="bx bx-search bx-sm"></i>
                            </span>
                        </button>
                    </form>
                </div>
                {{-- <div class="row">
                    <form id="filterForm" action="{{ route('discovery.index') }}" method="GET">
                        <div class="col mb-6">
                            <div class="d-flex flex-wrap">
                                @foreach ($filterCategory as $item)
                                <div class="form-check me-5 mb-3" style="cursor: pointer;">
                                    <input class="form-check-input" type="checkbox" id="category{{ $item->id }}" name="category[]" value="{{ $item->namaKategori }}" 
                                        {{ in_array($item->namaKategori, request('category', [])) ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="category{{ $item->id }}">
                                        {{ $item->namaKategori }} ({{ $item->kelas_count }})
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Filter</button>
                        </div>
                    </form>
                </div>                   --}}
            </div>
        </div>
        </div>
    </div>
@endsection  
