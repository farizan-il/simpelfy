@extends('gondowangi.frontend.layout.main')

@section('head')
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">

    <style>
        .hover-shadow:hover {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.113); /* Efek shadow */
            transition: box-shadow 0.5s ease; /* Efek transisi agar smooth */
        }
    </style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-6">
                <div class="card-body">
                    <small class="card-text text-uppercase text-muted small"><strong>Tentang Saya</strong></small>

                    <div class="justify-content-between row mt-5">
                        <div class="col-sm-12">
                            <div class="text-center mb-4">
                                <img src="https://static.vecteezy.com/system/resources/previews/012/177/622/original/man-avatar-isolated-png.png" alt="user image" class="d-block mx-auto rounded-circle user-profile-img" style="width: 120px; height: 120px; object-fit: cover;"> 
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div>
                                <ul class="list-unstyled my-3 py-1">
                                    <li class="d-flex align-items-center mb-4"><i class="bx bx-user"></i>
                                        <span class="fw-medium mx-2">Full Name:</span> <strong>{{ Auth::user()->profile->nama }}</strong>
                                    </li>
                                    <li class="d-flex align-items-center mb-4"><i class="bx bx-check"></i>
                                        <span class="fw-medium mx-2">NIK:</span> <strong>{{ Auth::user()->profile->nik }}</strong>
                                    </li>
                                    <li class="d-flex align-items-center mb-4"><i class="bx bx-crown"></i>
                                        <span class="fw-medium mx-2">Tanggal Masuk:</span> <strong>{{ Auth::user()->profile->tanggalMasuk }}</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <small class="card-text text-uppercase text-muted small">Struktur Organisasi</small>
                    <ul class="list-unstyled my-3 py-1">
                        <li class="d-flex align-items-center mb-4"><i class="bx bx-flag"></i><span
                                class="fw-medium mx-2">Jabatan:</span> <span>{{ Auth::user()->profile->jabatan }}</span></li>
                        <li class="d-flex align-items-center mb-4"><i class="bx bx-detail"></i><span
                                class="fw-medium mx-2">Golongan:</span> <span>{{ Auth::user()->profile->golongan->golongan }}</span></li>
                        <li class="d-flex align-items-center mb-4"><i class="bx bx-detail"></i><span
                                class="fw-medium mx-2">Departement:</span> <span>{{ Auth::user()->profile->departement->departement }}</span></li>
                        <li class="d-flex align-items-center mb-4"><i class="bx bx-detail"></i><span
                                class="fw-medium mx-2">Area:</span> <span>{{ Auth::user()->profile->area }}</span></li>
                        <li class="d-flex align-items-center mb-4"><i class="bx bx-detail"></i><span
                                class="fw-medium mx-2">Area:</span> <span>{{ Auth::user()->profile->jenisKelamin }}</span></li>
                        <li class="d-flex align-items-center mb-4"><i class="bx bx-detail"></i><span
                                class="fw-medium mx-2">Status:</span> <span>{{ Auth::user()->profile->status }}</span></li>
                    </ul>
                    
                </div>
            </div>
            <!--/ About User -->
            <!-- Profile Overview -->
            <div class="card mb-6">
                <div class="card-body">
                    <small class="card-text text-uppercase text-muted small">Overview</small>
                    <ul class="list-unstyled mb-0 mt-3 pt-1">
                        <li class="d-flex align-items-center mb-4"><i class="bx bx-check"></i><span
                                class="fw-medium mx-2">Kuis dan Test:</span> <span>135 Selesai</span></li>
                        <li class="d-flex align-items-center mb-4"><i class="bx bx-star"></i><span
                                class="fw-medium mx-2">Video ditonton:</span> <span>46 jam</span></li>
                        <li class="d-flex align-items-center"><i class="bx bx-user"></i><span
                                class="fw-medium mx-2">Komentar:</span> <span>4</span></li>
                    </ul>
                </div>
            </div>
            <!--/ Profile Overview -->
        </div>
        <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Activity Timeline -->
            <div class="card card-action mb-6">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Aktivitas minggu ini</h5>
                    <div class="col-2 mb-md-0 mb-6">
                        <input type="date" id="date-filter" class="form-control" placeholder="MM/DD/YYYY" />
                    </div>
                </div>
                <div class="card-body pt-3" id="activity-container">
                    <ul class="timeline mb-0" id="activity-list">
                        @foreach ($userActivities as $item)
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-success"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-3">
                                        <h6 class="mb-0">{{ $item->aktivitas }}</h6>
                                        <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-2">{{ $item->keterangan }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--/ Activity Timeline -->
            <!-- Projects table -->
            <div class="card mb-6">
                <h5 class="card-header pb-0 text-sm-start text-center">Kelas yang diikuti</h5>
                <div class="table-responsive mb-4">
                    <table class="table datatable-project">
                        <thead class="border-top">
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Project</th>
                                <th>Leader</th>
                                <th>Team</th>
                                <th class="w-px-200">Progress</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!--/ Projects table -->
        </div>
    </div>
    <!--/ User Profile Content -->
</div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#date-filter').on('change', function () {
                let selectedDate = $(this).val();
                $.ajax({
                    url: '{{ route("profile.filterActivity") }}',
                    type: 'GET',
                    data: { date: selectedDate },
                    success: function (response) {
                        $('#activity-list').html(response);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
