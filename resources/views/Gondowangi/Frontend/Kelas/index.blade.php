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
              /* Mengatur posisi agar setengah berada di atas dan setengah di bawah */
            left: 0;
            right: 0;
            z-index: 2;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid mb-5 bg-dark position-relative" style="padding-top: 100px; height: 250px;">
        <div class="container-xxl card-body">
            <h3 class="card-title text-white mb-3">{{ $detail->title }}</h3>
            <p class="mb-5 text-white">{{ $detail->subtitle }}</p>
        </div>
    
        {{-- card detail singkat kelas --}}
        <div class="container-xxl mb-6 position-absolute card-detail" style="top: 200px; left: 0; right: 0;">
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
        </div>
    </div>
    
    <div class="container-xxl" style="margin-top: 64px;">
        <div class="row">
            {{-- deskripsi kursus --}}
            <div class="col-sm-12 col-lg-8">
                <div class="card h-100">
                  <div class="card-body p-0 mt-3">
                        <div class="nav-align-top">
                            <ul class="nav nav-tabs nav-fill rounded-0 timeline-indicator-advanced" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-new" aria-controls="navs-justified-new" aria-selected="true">Deskripsi</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-link-preparing" aria-controls="navs-justified-link-preparing" aria-selected="false">Kurikulum</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-link-shipping" aria-controls="navs-justified-link-shipping" aria-selected="false">Review</button>
                                </li>
                            </ul>
                          <div class="tab-content border-0  mx-1">
                                <div class="tab-pane fade show active" id="navs-justified-new" role="tabpanel">
                                    <div class="card-body pt-4">
                                    <h5>Tentang Kelas ini</h5>
                                    <p class="mb-0">{{ $detail->subtitle }}</p>
                                    <hr class="my-6">
                                    <h5>Keuntungan</h5>
                                    <div class="d-flex flex-wrap row-gap-2">
                                        @foreach($benefits as $benefit)
                                        <div class="col-6" >
                                            <p class=" mb-2"><i class='bx bx-check text-primary me-2 align-center'></i>{{ $benefit }}</p>
                                        </div>
                                        <div class="col-6" >
                                            <p class=" mb-2"><i class='bx bx-check text-primary me-2 align-center'></i>{{ $benefit }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr class="my-6">
                                    <h5>Description</h5>
                                    <p class="mb-6" style="color: black">
                                        {!! $detail->deskripsi !!}
                                    </p>
                                    <hr class="my-6">
                                    <h5>Instructor</h5>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                        <div class="avatar me-4"><img src="../../assets/img/avatars/11.png" alt="Avatar" class="rounded-circle"></div>
                                        </div>
                                        <div class="d-flex flex-column">
                                        <h6 class="mb-1">Devonne Wallbridge</h6>
                                        <small>Web Developer, Designer, and Teacher</small>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="navs-justified-link-preparing" role="tabpanel">
                                    <h5>Konten Kelas</h5>
                                    <p class="text-primary mb-2">{{ $sections + $bagiantestCount }} bagian • {{ $lectures + $testCount }} pelajaran</p>
                                    <div class="accordion stick-top accordion-custom-button" id="courseContent">
                                
                                        <!-- Display Pre-Test -->
                                        @if ($preTest)
                                        <div class="accordion-item mb-0">
                                            <div class="accordion-header" id="headingPreTest">
                                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#preTest" aria-expanded="false" aria-controls="preTest">
                                                    <span class="d-flex flex-column">
                                                        <span class="h5 mb-0">Pre-Test</span>
                                                        <span class="text-body fw-normal"> Soal | {{ $preTest->duration }} min</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div id="preTest" class="accordion-collapse collapse" data-bs-parent="#courseContent">
                                                <div class="accordion-body py-4">
                                                    <div class="form-check d-flex align-items-center gap-1 mb-4">
                                                        <i class='bx bxs-lock-alt' style="font-size: 16px;"></i>
                                                        <label class="form-check-label ms-4">
                                                            {{-- <a href="{{ route('ujian.index', ['kelasId' => $preTest->kelas_id]) }}"> --}}
                                                            <a>
                                                                <span class="mb-0 h6 detailSubModul">Pre-test</span>
                                                                <small class="text-body d-block">Durasi: {{ $preTest->duration }} min</small>
                                                            </a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                
                                        <!-- Display Modules and Mid-Test -->
                                        @foreach ($modul as $item)
                                        <div class="accordion-item active mb-0">
                                            <div class="accordion-header" id="headingOne">
                                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#chapterOne{{ $item->id }}" aria-expanded="true" aria-controls="chapterOne">
                                                    <span class="d-flex flex-column">
                                                        <span class="h5 mb-0">{{ $item->judulModul }}</span>
                                                        <span class="text-body fw-normal">{{ $item->lessonCount }} Pelajaran | total {{ $item->formattedDuration }}</span>
                                                    </span>
                                                </button>
                                            </div>

                                            <div id="chapterOne{{ $item->id }}" class="accordion-collapse collapse" data-bs-parent="#courseContent">
                                                <div class="accordion-body py-4">
                                                    @foreach($item->detailModuls as $detailModul)
                                                        <div class="form-check d-flex align-items-center gap-1 mb-4">
                                                            <i class='bx bxs-lock-alt' style="font-size: 16px;"></i>
                                                            <label for="defaultCheck1" class="form-check-label ms-4">
                                                                <span class="mb-0 h6">{{ $detailModul->detailSubModul }}</span>
                                                                <small class="text-body d-block">
                                                                    total {{ $detailModul->duration < 60 ? "{$detailModul->duration} Menit" : floor($detailModul->duration / 60) . ' Jam ' . ($detailModul->duration % 60) . ' Menit' }}
                                                                </small>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    
                                                    {{-- Tampilkan mid-test jika ada --}}
                                                    @if ($item->midTest)
                                                        <div class="form-check d-flex align-items-center gap-1 mb-4">
                                                            <i class='bx bxs-lock-alt' style="font-size: 16px;"></i>
                                                            <label class="form-check-label ms-4">
                                                                <a>
                                                                    <span class="mb-0 h6 detailSubModul">Mid-test</span>
                                                                    <small class="text-body d-block">Durasi: {{ $item->midTest->duration }} min</small>
                                                                </a>
                                                            </label>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                
                                        <!-- Display Post-Test -->
                                        @if ($postTest)
                                        <div class="accordion-item mb-0">
                                            <div class="accordion-header" id="headingPostTest">
                                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#postTest" aria-expanded="false" aria-controls="postTest">
                                                    <span class="d-flex flex-column">
                                                        <span class="h5 mb-0">Post-Test</span>
                                                        <span class="text-body fw-normal"> Soal | {{ $postTest->duration }} min</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div id="postTest" class="accordion-collapse collapse" data-bs-parent="#courseContent">
                                                <div class="accordion-body py-4">
                                                    <div class="form-check d-flex align-items-center gap-1 mb-4">
                                                        <i class='bx bxs-lock-alt' style="font-size: 16px;"></i>
                                                        <label class="form-check-label ms-4">
                                                            <a href="{{ route('ujian.index', ['kelasId' => $postTest->kelas_id]) }}">
                                                                <span class="mb-0 h6 detailSubModul">Post-test</span>
                                                                <small class="text-body d-block">Durasi: {{ $postTest->duration }} min</small>
                                                            </a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                
                                    </div>
                                </div>                                

                                <div class="tab-pane fade" id="navs-justified-link-shipping" role="tabpanel">
                                    <div class="card-body row widget-separator g-0">
                                        <div class="col-sm-5 border-shift border-end pe-sm-6">
                                            <h3 class="text-primary d-flex align-items-center gap-2 mb-2">{{ $totalRating }} ⭐</h3>
                                            <p class="h6 mb-2">Total {{ $totalReviews }} reviews</p>
                                            <p class="pe-2 mb-2">Semua ulasan berasal dari karyawan</p>
                                            <span class="badge bg-label-primary mb-4 mb-sm-0">+{{ $newReviewsCount }} This week</span>
                                            <hr class="d-sm-none">
                                        </div>
                                
                                        <div class="col-sm-7 gap-2 mb-5 text-nowrap d-flex flex-column justify-content-between ps-sm-6 pt-2 py-sm-2">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <div class="d-flex align-items-center gap-2">
                                                    <small>⭐ {{ $i }}</small>
                                                    <div class="progress w-100 bg-label-primary" style="height:8px;">
                                                        @php
                                                            $percentage = isset($ratingCounts[$i]) ? ($ratingCounts[$i] / $totalReviews) * 100 : 0;
                                                        @endphp
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="w-px-20 text-end">{{ $ratingCounts[$i] ?? 0 }}</small>
                                                </div>
                                            @endfor
                                        </div>

                                        <div class="mt-5">
                                            <small class="text-light fw-medium">Komentar</small>
                                            <div class="mt-4 border-0">
                                                <div class="list-group mt-4">
                                                    @foreach($komentar as $comment)
                                                        @if ($comment->status == 'Disetujui')
                                                        <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between border-0 border-bottom">
                                                            <div class="li-wrapper d-flex justify-content-start align-items-center">
                                                                <div class="avatar me-3">
                                                                    <span class="avatar-initial rounded-circle bg-label-success">M</span>
                                                                </div>
                                                                <div class="list-content">
                                                                    <h6 class="mb-0">{{ $comment->komentartext }}</h6>
                                                                    <small class="text-muted">{{ $comment->credentials->profile->nama }}</small>
                                                                </div>
                                                            </div>
                                                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                        </a>
                                                        @endif
                                                    @endforeach
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
    
            {{-- card detail kursus --}}
            <div class="col-md-4 col-lg-4">
              <div class="card" style="position: sticky; top: 140px; transition: all 0.3s ease-in-out;">
                  <div class="card-body">
                      <div class="bg-label-primary rounded-3 text-center mb-4">
                          <img class="img-fluid rounded " src="{{ asset('image/kelas-sampul/' . $detail->foto) }}" alt="Card girl image" style="width: 100%; max-height: 200px; object-fit: cover;" />
                      </div>
                      <h5 class="mb-2">{{ $detail->title }}</h5>
                      <div class="mb-md-4">
                          <span class="text-primary" style="font-size: 1.3rem;"><strong>IDR {{ number_format( $detail->harga, 0, ',', '.') }}</strong></span>
                      </div>
                      
                      <div class="row mb-2">
                          <div class="col-10 text-center">
                            <form action="{{ route('payment.beli') }}" method="POST">
                              @csrf
                              <input type="hidden" name="kelas_id" value="{{ $detail->id }}">
                                <button type="submit" class="btn btn-label-primary w-100 d-grid">
                                  Beli Sekarang
                              </button>
                            </form>
                          </div>

                          <div class="col-2 text-center">
                            <form action="{{ route('keranjang.tambah') }}" method="POST">
                              @csrf
                              <button type="submit" class="btn btn-label-warning px-3 d-flex align-items-center">
                                  <input type="hidden" name="kelas_id" value="{{ $detail->id }}">
                                  <i class="bx bxs-shopping-bags" style="font-size: 18.5px;"></i>
                              </button>
                            </form>
                          </div>
                      </div>
                      <hr>
                      <div class="d-flex flex-wrap row-gap-2">
                        <div class="me-12">
                          <p class="text-nowrap mb-2"><i class='bx bx-check me-2 align-center'></i>Status: Umum</p>
                          <p class="text-nowrap mb-2"><i class='bx bx-group me-2 align-center'></i>Terdaftar: 102</p>
                          <p class="text-nowrap mb-2">
                            <i class='bx bx-globe me-2 align-center'></i>
                            Batas Waktu: 2 minngu
                          </p>
                        </div>
                        <div>
                          <p class="text-nowrap mb-2"><i class='bx bx-video me-2 align-center ms-50'></i>Sertifikasi: Yes</p>
                          <p class="text-nowrap mb-2"><i class='bx bx-video me-2 align-center ms-50'></i>Modul: {{ $lectures }}</p>
                          <p class="text-nowrap mb-0"><i class='bx bx-time-five me-2 align-center'></i>Video: 35 jam</p>
                        </div>
                      </div>
                  </div>
              </div>
          </div>          
        </div>
    </div>
@endsection