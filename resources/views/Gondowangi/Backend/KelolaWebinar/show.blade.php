@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" style="margin-bottom: 10px;">
        {{-- webinar --}}
        <div class="card d-flex flex-column mt-5">
            <div class="card-body d-flex flex-column flex-grow-1">
                <div class="row flex-grow-1">
                    <div class="col-lg-8 col-md-6 col-sm-12 rounded mb-2">
                        <div class="bg-label-primary rounded-3 text-center me-4 rounded">
                            <img class="img-fluid rounded" src="https://i.pinimg.com/736x/74/06/cb/7406cbaec72ea1be523c30acc6997c91.jpg" alt="Card girl image" style="width: 100%; height: 320px; object-fit: cover;" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column">
                        <div class="content-webinar">
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

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card shadow">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                Data Pendaftar Webinar
            </h5>
            <div class="table-responsive text-nowrap px-4 mb-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Departemen</th>
                            <th>Golongan</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendaftarWebinar as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->credentials->profile->nama ?? 'N/A' }}</td>
                            <td>{{ $item->credentials->profile->departement_id ?? 'N/A' }}</td>
                            <td>{{ $item->credentials->profile->golongan_id ?? 'N/A' }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pendaftar</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
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