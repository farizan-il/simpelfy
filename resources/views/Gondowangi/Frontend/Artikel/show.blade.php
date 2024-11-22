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
            <h3 class="card-title text-white mb-3">{{ $detail->title }}</h3>
            <p class="mb-5 text-white">Penulis : {{ $detail->penulis }} | Durasi : {{ $detail->durasi }}</p>
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
                            <p class="mb-6" style="color: black">
                                {!! $detail->content !!}
                            </p>

                            <div class="d-flex">
                                <form action="" method="POST">
                                    <button type="submit" class="btn btn-label-succes d-flex align-items-center">
                                        @csrf
                                        <input type="hidden" name="kelas_id" value="{{ $detail->id }}">
                                        <i class="bx bxs-like align-middle text-primary" style="font-size: 20px; margin-right: 9px;"></i>
                                        {{ $detail->Disukai }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection