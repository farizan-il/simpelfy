    @extends('gondowangi.frontend.layout.main')

    @section('head')
        <title>{{ $title }}</title>
        <style>
            
            
        </style>
    @endsection

    @section('content')
    {{-- kode dihalaman explore --}}
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-xxl-12" style="margin-bottom: 60px;">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://img.freepik.com/premium-vector/digital-business-webinar-banner-template_58780-578.jpg?w=1380" class="d-block w-100 rounded" alt="..." style="height: 360px; object-fit: cover;">
                    </div>
                    <div class="carousel-item position-relative">
                        <img src="https://img.freepik.com/premium-psd/digital-marketing-corporate-facebook-cover-timeline-web-banner-social-media-cover-templatete_139278-159.jpg?w=1380" 
                             class="d-block w-100 rounded" alt="..." style="height: 360px; object-fit: cover; cursor: pointer;"
                             data-bs-toggle="modal" data-bs-target="#videoModal">
                             
                        <!-- Play Icon -->
                        <span class="position-absolute top-50 start-50 translate-middle text-white" style="font-size: 3rem; pointer-events: none;">
                            <i class="bx bx-play-circle"></i>
                        </span>
                    </div>
                    <div class="carousel-item">
                        <img src="https://i.pinimg.com/736x/b5/16/45/b51645afb1fc125e1ddebc67a86f5444.jpg" class="d-block w-100 rounded" alt="..." style="height: 360px; object-fit: cover;">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <h4 class="mb-1">
            <span class="position-relative fw-extrabold" style="z-index: 2; font-size: 1.3rem">
                Kelas relevan
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/section-title-icon.png" 
                     alt="laptop charging" 
                     class="position-absolute start-50 translate-middle-x bottom-0 object-fit-contain" 
                     style="z-index: 1; width: 100%; height: auto;">
            </span> 
        </h4>
        <div class="row" style="margin-bottom: 40px;">
            <div class="col-md-12 col-xxl-12">
                {{-- carousel card Kelas --}}
                <div id="kelasCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner py-3">
                        @if ($kelasRelevan->isEmpty())
                            <p>Tidak ada kelas yang relevan untuk Anda saat ini.</p>
                        @else
                            <div class="carousel-inner py-3">
                                @foreach ($kelasRelevan->chunk(4) as $index => $kelasChunk)
                                <div class="carousel-item {{ $index == 1 ? 'active' : '' }}" style="height: 460px;">
                                    <div class="row justify-content-center">
                                        @foreach ($kelasChunk as $item)
                                        <div class="col-md-3" style="cursor: pointer;">
                                            <div class="card h-100 shadow-none border card-hover-shine-effect">
                                                <div class="rounded-2 text-center mb-0">
                                                    <img class="img-fluid rounded" src="{{ asset('image/kelas-sampul/' . $item->foto) }}" alt="tutor image 1" style="height: 200px; width: 100%; object-fit: cover;"/>
                                                </div>
                                                <div class="card-body pb-0 pt-3">
                                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                                        <div class="d-flex">
                                                            <span class="badge bg-label-info me-3">{{ $item->kategori->namaKategori }}</span>
                                                            {{-- <span class="badge bg-label-danger">Wajib</span> --}}
                                                        </div>
                                                        <p class="d-flex align-items-center justify-content-center fw-medium gap-1 mb-0">
                                                            {{ $item->totalRating ?? 'N/A' }} 
                                                            <span class="text-warning"><i class="bx bxs-star me-1 mb-1_5"></i></span>
                                                            <span class="fw-normal">({{ number_format($item->totalReviews) }})</span>
                                                        </p>                                
                                                    </div>
                                                    <a class="h6 text-dark">{{ $item->title }}</a>
                                                    <p class="mt-1">{{ \Illuminate\Support\Str::words($item->subtitle, 10) }}</p>
                                                </div>
                                                <div class="card-footer pb-3 pt-0">
                                                    <p class="d-flex align-items-center text-dark mb-2" style="font-size: 1.1rem;"><strong>IDR {{ number_format($item->harga, 0, ',', '.') }}</strong></p>
                                                    <div class="d-flex gap-4">
                                                        <a class="w-100 btn btn-label-primary btn-sm py-0 d-flex align-items-center" href="/detailkelas/{{ $item->id }}">
                                                            <span class="me-2" style="font-size: 0.9rem">Detail</span>
                                                            <i class="bx bx-chevron-right lh-1 scaleX-n1-rtl" style="font-size: 20px"></i>
                                                        </a>
                                                        <form action="{{ route('keranjang.tambah') }}" method="POST">
                                                            <button type="submit" class="btn btn-label-warning d-flex align-items-center">
                                                                @csrf
                                                                <input type="hidden" name="kelas_id" value="{{ $item->id }}">
                                                                <i class="bx bxs-shopping-bags align-middle" style="font-size: 20px"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        @endif

                    </div>

                    {{-- Kontrol carousel --}}
                    <button class="carousel-control-prev p-0 justify-content-center" 
                        style="height: 10px; top: 50%; transform: translateY(-50%);" 
                        type="button" data-bs-target="#kelasCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next p-0 justify-content-center" 
                        style="height: 10px; top: 50%; transform: translateY(-50%);" 
                        type="button" data-bs-target="#kelasCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>  
        </div>

        {{-- webinar --}}

        @foreach ($webinar as $webinar)
            @if ($webinar->status !== 'selesai')
            <div class="col-xxl-12" style="margin-bottom: 60px;">
                {{-- webinar --}}
                <h4 class="mb-1">
                    <span class="position-relative fw-extrabold" style="z-index: 2; font-size: 1.3rem">
                        Webinar Mendatang
                        <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/section-title-icon.png" 
                            alt="laptop charging" 
                            class="position-absolute start-50 translate-middle-x bottom-0 object-fit-contain" 
                            style="z-index: 1; width: 100%; height: auto;">
                    </span> 
                </h4>
                <div class="card h-100 d-flex flex-column mt-5">
                    <div class="card-body d-flex flex-column flex-grow-1">
                        <div class="row flex-grow-1">
                            <div class="col-lg-8 col-md-6 col-sm-12 rounded mb-2">
                                <div class="bg-label-primary rounded-3 text-center me-4 rounded">
                                    <img class="img-fluid rounded" src="https://i.pinimg.com/736x/74/06/cb/7406cbaec72ea1be523c30acc6997c91.jpg" alt="Card girl image" style="width: 100%; height: 320px; object-fit: cover;" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column">
                                <div class="content-webinar mb-3">
                                    <h5 class="mb-2">Webinar Mendatang</h5>
                                    <p>Next Generation Frontend Architecture Using Layout Engine And React Native Web.</p>
                                    <div class="row mb-4 g-3">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-calendar bx-sm text-secondary"></i></span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-nowrap">5 Nov 23</h6>
                                                    <small>Tanggal</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-time-five bx-sm text-secondary"></i></span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-nowrap">18:00 - 20:00</h6>
                                                    <small>Pukul</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <!-- Countdown Timer and Join button placed at the bottom -->
                                <div class="mt-auto">
                                    <div id="countdown" class="countdown-timer text-center">
                                        <div class="countdown-section">
                                            <span id="days" class="countdown-time text-danger"></span>
                                            <span class="countdown-label">Hari</span>
                                        </div>
                                        <div class="countdown-section">
                                            <span id="hours" class="countdown-time text-danger"></span>
                                            <span class="countdown-label">Jam</span>
                                        </div>
                                        <div class="countdown-section">
                                            <span id="minutes" class="countdown-time text-danger"></span>
                                            <span class="countdown-label">Menit</span>
                                        </div>
                                        <div class="countdown-section">
                                            <span id="seconds" class="countdown-time text-danger"></span>
                                            <span class="countdown-label">Detik</span>
                                        </div>
                                    </div>
            
                                    <!-- Join Button -->
                                    <div class="col-12 text-center mt-3">
                                        <a href="javascript:void(0);" class="btn btn-label-primary w-100 d-grid">Daftar Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach

        <!-- kursus kontent -->
        <div class="col-xxl-12" style="margin-bottom: 60px;">
            <div class="mb-4">
                <h4 class="mb-1">
                    <span class="position-relative fw-extrabold" style="z-index: 2; font-size: 1.3rem">
                        Kelas yang mungkin anda sukai
                        <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/section-title-icon.png" 
                             alt="laptop charging" 
                             class="position-absolute start-50 translate-middle-x bottom-0 object-fit-contain" 
                             style="z-index: 1; width: 100%; height: auto;">
                    </span> 
                </h4>
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
            <div class="row" id="kelasContainer">
                @include('gondowangi.frontend.explore.partials._kelas')
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="button" class="btn btn-danger d-flex align-items-center" id="loadMoreBtn">
                    Lihat Lebih Banyak <i class="bx bxs-chevron-down" style="margin-left: 6px;"></i>
                </button>
            </div>
        </div>

         {{-- artikel dan webinar --}}
        <div class="col-xxl-12" style="margin-bottom: 60px;">
            {{-- kelas wajib carousel --}}
            <h4 class="mb-1">
                <span class="position-relative fw-extrabold" style="z-index: 2; font-size: 1.3rem">
                    Artikel Populer
                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/section-title-icon.png" 
                         alt="laptop charging" 
                         class="position-absolute start-50 translate-middle-x bottom-0 object-fit-contain" 
                         style="z-index: 1; width: 100%; height: auto;">
                </span> 
            </h4>
            <div class="row" style="margin-bottom: 60px;">
                {{-- sampul Kelas --}}
                <div class="col-md-12 col-xxl-3 mt-2" style="height: 460px;">
                    <div class="card h-100">
                        <div class="card-body p-0">
                            <div class="bg-label-primary rounded-3 text-center mb-4 h-100">
                                <img class="img-fluid rounded h-100 w-100" src="https://i.pinimg.com/564x/25/35/73/253573111b1438cf246fd8724dbf27ec.jpg" alt="Card girl image" style="object-fit: cover;" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xxl-9">
                    {{-- carousel card Kelas webinar --}}
                    <div id="webinarCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner py-3">
                            @foreach ($artikel->chunk(3) as $index => $artikelChunk)
                                <div class="carousel-item {{ $index == 1 ? 'active' : '' }}" style="height: 460px;">
                                    <div class="row justify-content-center">
                                        @foreach ($artikelChunk as $item)
                                            <div class="col-md-4">
                                                <div class="card card-hover-shine-effect" style="height: 455px;">
                                                    <div class="card-body">
                                                        <div class="bg-label-primary rounded-3 text-center mb-4">
                                                            <img class="img-fluid rounded" 
                                                                    src="{{ asset('image/artikel-sampul/' . $item->foto) }}" 
                                                                    alt="{{ $item->foto }}" 
                                                                    style="height: 200px; width: 100%; object-fit: cover;" />
                                                        </div>
                                                        <h6 class="mb-2 text-dark" style="font-size: 1.1rem"><strong>{{ $item->title }}</strong></h6>
                                                        <p>{{ \Illuminate\Support\Str::words($item->content, 10) }}</p>
                                                    </div>
                                                    <div class="card-footer position-absolute bottom-0 w-100">
                                                        <p class="d-flex align-items-center text-dark mb-2" style="font-size: 1.1rem;"><strong>Gratis</strong></p>
                                                        <div class="d-flex gap-4">
                                                            <a class="w-100 btn btn-label-primary btn-sm py-0 d-flex align-items-center" href="/artikel/{{ $item->id }}">
                                                                <span class="me-2 p-3" style="font-size: 0.9rem">Baca Sekarang</span>
                                                                <i class="bx bx-chevron-right lh-1 scaleX-n1-rtl" style="font-size: 20px"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
            
                        {{-- Kontrol carousel --}}
                        <button class="carousel-control-prev" type="button" data-bs-target="#webinarCarousel" data-bs-slide="prev"
                        style="height: 10px; top: 50%; transform: translateY(-50%);">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#webinarCarousel" data-bs-slide="next"
                        style="height: 10px; top: 50%; transform: translateY(-50%);">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Testimoni --}}
    <div class="container-fluid" style="background-color: rgb(234, 234, 234); margin-bottom: 60px;">
        {{-- testomoni --}}
        <div class="container" style="padding: 60px 0px">
            <div class="row">
                <div class="col-md-12 col-xxl-3 mt-2 align-items-center pt-4" style="height: 287px;">
                    <div class="mb-4">
                        <span class="badge bg-label-primary">Real Customers Reviews</span>
                    </div>
                    <h4 class="mb-1">
                        <span class="position-relative fw-extrabold" style="z-index: 2;">
                            What people say
                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/section-title-icon.png" 
                                 alt="laptop charging" 
                                 class="position-absolute start-50 translate-middle-x bottom-0 object-fit-contain" 
                                 style="z-index: 1; width: 15rem; height: auto;">
                          </span> 
                    </h4>
                    <p class="mb-5 mb-md-12">
                        See what our customers have to<br class="d-none d-xl-block" />
                        say about their experience.
                    </p>
                    <div class="landing-reviews-btns">
                        <button id="reviews-previous-btn" class="btn btn-icon btn-label-primary reviews-btn me-3 swiper-button-prev" type="button" data-bs-target="#testomobiCarousel" data-bs-slide="prev">
                            <i class="bx bx-chevron-left bx-md"></i>
                        </button>
                        <button id="reviews-next-btn" class="btn btn-icon btn-label-primary reviews-btn swiper-button-next" type="button" data-bs-target="#testomobiCarousel" data-bs-slide="next">
                            <i class="bx bx-chevron-right bx-md"></i>
                        </button>
                    </div>
                </div>
    
                <div class="col-md-12 col-xxl-9">
                    {{-- carousel card Kelas testomoni --}}
                    <div id="testomobiCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner py-3">
                            <div class="carousel-item active">
                                <div class="row justify-content-center">
                                    <!-- Testimoni 1 -->
                                    <div class="col-md-4 col-sm-12">
                                        <div class="card card-hover-shine-effect" style="height: 260px;">
                                            <div class="col-md-6 col-xxl-12">
                                                <div class="card-body">
                                                    <h6 class="mb-2 text-dark"><strong>"LMS ini luar biasa! Fitur-fiturnya sangat intuitif, dan sekarang belajar jadi lebih efektif dan efisien."</strong></h6>
                                                </div>
                                                <div class="card-footer position-absolute bottom-0 w-100 border-0">
                                                    <div class="d-flex gap-2 mb-3">
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-3 avatar-sm">
                                                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 text-dark">Rina Maharani</h6>
                                                            <p class="small text-muted mb-0">Mahasiswa Ilmu Komputer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <!-- Testimoni 2 -->
                                    <div class="col-md-4 col-sm-12">
                                        <div class="card card-hover-shine-effect" style="height: 260px;">
                                            <div class="col-md-6 col-xxl-12">
                                                <div class="card-body">
                                                    <h6 class="mb-2 text-dark"><strong>"Pengalaman belajar online saya meningkat pesat sejak menggunakan LMS ini. Semua materi tersusun rapi dan mudah diakses kapan saja."</strong></h6>
                                                </div>
                                                <div class="card-footer position-absolute bottom-0 w-100 border-0">
                                                    <div class="d-flex gap-2 mb-3">
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-3 avatar-sm">
                                                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 text-dark">Andi Pratama</h6>
                                                            <p class="small text-muted mb-0">Instruktur Teknologi Informasi</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <!-- Testimoni 3 -->
                                    <div class="col-md-4 col-sm-12">
                                        <div class="card card-hover-shine-effect" style="height: 260px;">
                                            <div class="col-md-6 col-xxl-12">
                                                <div class="card-body">
                                                    <h6 class="mb-2 text-dark"><strong>"Saya senang bisa mengakses semua bahan ajar dan tugas hanya dengan beberapa klik. Sangat membantu untuk manajemen waktu dan progres belajar."</strong></h6>
                                                </div>
                                                <div class="card-footer position-absolute bottom-0 w-100 border-0">
                                                    <div class="d-flex gap-2 mb-3">
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-3 avatar-sm">
                                                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 text-dark">Siti Nurjanah</h6>
                                                            <p class="small text-muted mb-0">Mahasiswa Manajemen</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="carousel-item">
                                <div class="row">
                                    <!-- Testimoni 4 -->
                                    <div class="col-md-4 col-sm-12">
                                        <div class="card card-hover-shine-effect" style="height: 260px;">
                                            <div class="col-md-6 col-xxl-12">
                                                <div class="card-body">
                                                    <h6 class="mb-2 text-dark"><strong>"Aplikasi LMS ini sangat membantu untuk melacak progres belajar siswa. Saya bisa memberikan feedback lebih cepat dan efisien."</strong></h6>
                                                </div>
                                                <div class="card-footer position-absolute bottom-0 w-100 border-0">
                                                    <div class="d-flex gap-2 mb-3">
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-3 avatar-sm">
                                                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 text-dark">Dewi Ratnasari</h6>
                                                            <p class="small text-muted mb-0">Dosen Ekonomi</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <!-- Testimoni 5 -->
                                    <div class="col-md-4 col-sm-12">
                                        <div class="card card-hover-shine-effect" style="height: 260px;">
                                            <div class="col-md-6 col-xxl-12">
                                                <div class="card-body">
                                                    <h6 class="mb-2 text-dark"><strong>"Dengan LMS ini, saya bisa mengikuti kelas kapan saja dan di mana saja. Membantu sekali untuk mahasiswa yang memiliki jadwal padat."</strong></h6>
                                                </div>
                                                <div class="card-footer position-absolute bottom-0 w-100 border-0">
                                                    <div class="d-flex gap-2 mb-3">
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-3 avatar-sm">
                                                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 text-dark">Imran Syah</h6>
                                                            <p class="small text-muted mb-0">Mahasiswa Teknik Industri</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <!-- Testimoni 6 -->
                                    <div class="col-md-4 col-sm-12">
                                        <div class="card card-hover-shine-effect" style="height: 260px;">
                                            <div class="col-md-6 col-xxl-12">
                                                <div class="card-body">
                                                    <h6 class="mb-2 text-dark"><strong>"LMS ini sangat fleksibel dan menyediakan semua kebutuhan yang saya butuhkan untuk mengatur kelas online. Interface yang bersih dan mudah digunakan."</strong></h6>
                                                </div>
                                                <div class="card-footer position-absolute bottom-0 w-100 border-0">
                                                    <div class="d-flex gap-2 mb-3">
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                        <i class="bx bxs-star text-warning" style="font-size: 1.2rem"></i>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-3 avatar-sm">
                                                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 text-dark">Laila Amelia</h6>
                                                            <p class="small text-muted mb-0">Pengajar Matematika</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- faq --}}
    <section id="landingFAQ" class="section-py bg-body landing-faq" style="margin-bottom: 60px;">
        <div class="container"> 
            <h4 class="text-center mb-1">Pertanyaan yang Sering
            <span class="position-relative fw-extrabold" style="z-index: 2;">
                Diajukan
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/section-title-icon.png" 
                        alt="laptop charging" 
                        class="position-absolute start-50 translate-middle-x bottom-0 object-fit-contain" 
                        style="z-index: 1; width: 100px; height: auto;">
                </span>                      
            </h4>
            <p class="text-center mb-12 pb-md-4">Jelajahi FAQ ini untuk menemukan jawaban atas pertanyaan umum tentang sistem manajemen pembelajaran.</p>
            <div class="row gy-12 align-items-center">
            <div class="col-lg-5">
                <div class="text-center">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/landing-page/faq-boy-with-logos.png" alt="faq boy with logos" class="faq-image" style="width: 60%;"/>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="accordion" id="accordionExample">
                    @foreach ($faq as $item)
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne{{ $item->id }}" aria-expanded="true" aria-controls="accordionOne{{ $item->id }}">
                                    {{ $item->pertanyaan }}
                                </button>
                            </h2>
            
                            <div id="accordionOne{{ $item->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{ $item->jawaban }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </section>

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
                <div class="row">
                    <form id="filterForm" action="{{ route('explore.index') }}" method="GET">
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
                </div>                  
            </div>
        </div>
        </div>
    </div>

    <div id="tooltip"></div>

    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Video Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <!-- Embed YouTube Video -->
                        <iframe src="https://www.youtube.com/embed/nseU70tf098?si=qGSpt_FdyME0v-cs" 
                                title="YouTube video" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let perPage = 12; // Load pertama 12 kelas
        const increment = 4; // Tambah 4 kelas tiap klik

        document.getElementById('loadMoreBtn').addEventListener('click', function() {
            perPage += increment; // Tambah 4 kelas per klik
            loadMoreClasses(perPage);
        });

        function loadMoreClasses(perPage) {
            fetch(`{{ route('explore.index') }}?perPage=${perPage}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('kelasContainer').innerHTML = data;

                // Cek apakah jumlah kelas kurang dari `perPage`, sembunyikan tombol jika benar
                if (document.querySelectorAll('#kelasContainer > div').length < perPage) {
                    document.getElementById('loadMoreBtn').style.display = 'none';
                }
            });
        }
    </script>

    <script>
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            const submenu = item.querySelector('.menu-sub');
            if (submenu) {
            submenu.style.display = 'block';
            }
        });

        item.addEventListener('mouseleave', () => {
            const submenu = item.querySelector('.menu-sub');
            if (submenu) {
            submenu.style.display = 'none';
            }
        });
        });
    </script>

    <script>
        // Function untuk menampilkan alert dengan filter terpisah
        function showAlerts(selectedFilters) {
            const alertContainer = document.getElementById('alertContainer');
            alertContainer.innerHTML = ''; // Kosongkan alert container terlebih dahulu

            // Loop melalui setiap filter yang dipilih dan buat alert terpisah
            selectedFilters.forEach(function(filter) {
                const alertDiv = document.createElement('div');
                alertDiv.classList.add('alert', 'alert-danger', 'alert-dismissible', 'py-1', 'me-2');
                alertDiv.style.fontSize = '0.8rem';
                alertDiv.setAttribute('role', 'alert');
                
                // Teks kategori
                alertDiv.innerHTML = `
                    ${filter}
                    <button type="button" class="btn-close pb-1" data-bs-dismiss="alert" aria-label="Close"></button>
                `;

                // Ketika tombol close (silang) ditekan, hapus filter dari URL
                alertDiv.querySelector('.btn-close').addEventListener('click', function() {
                    removeFilterFromURL(filter);
                });

                // Tambahkan alert ke dalam container
                alertContainer.appendChild(alertDiv);
            });
        }

        // Function untuk mendapatkan nilai dari URL parameters
        function getFiltersFromURL() {
            const params = new URLSearchParams(window.location.search);
            let categories = params.getAll('category[]'); // Ambil semua kategori dari URL
            return categories;
        }

        // Fungsi untuk menghapus filter dari URL ketika alert disilang
        function removeFilterFromURL(filterToRemove) {
            let url = new URL(window.location.href);
            let params = new URLSearchParams(url.search);

            // Hapus kategori spesifik dari parameter URL
            let categories = params.getAll('category[]');
            categories = categories.filter(category => category !== filterToRemove); // Hilangkan filter yang di-close

            // Set ulang parameter 'category[]' dengan kategori yang tersisa
            params.delete('category[]');
            categories.forEach(category => params.append('category[]', category));

            // Update URL tanpa refresh halaman
            window.history.replaceState({}, '', `${url.pathname}?${params.toString()}`);

            // Refresh halaman agar checkbox terupdate
            window.location.reload();
        }

        // Saat halaman dimuat, tampilkan filter dari URL jika ada
        window.addEventListener('DOMContentLoaded', function() {
            const selectedFilters = getFiltersFromURL();

            // Tampilkan alert dengan kategori yang didapat dari URL
            showAlerts(selectedFilters);
        });
    </script>

    {{-- <script>
        function updateCountdown() {
            // Parse tanggal dan waktu webinar dengan format yang benar
            var webinarDate = new Date("{{ $item->dateTimeStart }}").getTime();
            
            function updateTimer() {
                // Get today's date and time
                var now = new Date().getTime();
            
                // Find the distance between now and the webinar date
                var distance = webinarDate - now;
            
                // Jika waktu sudah lewat
                if (distance < 0) {
                    clearInterval(timerInterval);
                    document.getElementById("countdown-timer").innerHTML = "Webinar telah dimulai";
                    return;
                }
            
                // Calculate days, hours, minutes, and seconds left
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
                // Display the countdown dengan pengecekan angka
                document.getElementById("countdown-timer").innerHTML = 
                    (days > 0 ? days + "d " : "") + 
                    (hours > 0 || days > 0 ? hours + "h " : "") + 
                    (minutes > 0 || hours > 0 || days > 0 ? minutes + "m " : "") + 
                    seconds + "s";
            }

            // Update pertama kali
            updateTimer();
            
            // Set interval untuk update setiap detik
            var timerInterval = setInterval(updateTimer, 1000);
        }

        // Jalankan countdown
        updateCountdown();
    </script> --}}
    
    <script>
        // Set the date for the webinar (year, month, day, hour, minute, second)
        var webinarDate = new Date("November 15, 2024 14:00:00").getTime();
        
        // Update the countdown every 1 second
        var countdownFunction = setInterval(function() {
        
            // Get today's date and time
            var now = new Date().getTime();
        
            // Find the distance between now and the webinar date
            var distance = webinarDate - now;
        
            // Time calculations for days, hours, minutes, and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
            // Display the result in the corresponding element
            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;
        
            // If the countdown is finished, display a message
            if (distance < 0) {
                clearInterval(countdownFunction);
                document.getElementById("countdown").innerHTML = "The webinar has started!";
            }
        }, 1000);
    </script>
    
@endsection