@extends('gondowangi.frontend.layout.main')

@section('head')
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .hover-underline {
            position: relative;
            cursor: pointer;
        }

        .hover-underline h6 {
            display: inline-block;
            position: relative;
            color: black;
            cursor: pointer;
        }

        .hover-underline h6::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: black;
            transition: width 0.4s ease, background-color 0.4s ease;
        }

        .hover-underline:hover h6::after {
            width: 100%;
            background-color: red;
        }

        .hover-underline {
            position: relative;
            overflow: hidden; 
            cursor: pointer;
        }

        .hover-underline .product__item__pic {
            transition: transform 0.4s ease;
        }

        .hover-underline:hover .product__item__pic {
            transform: scale(1.1); 
        }

    </style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-0 mb-6">
        <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-6">
          <div class="app-academy-md-25 card-body py-0 pt-6 ">
            <img src="{{ asset('frontend/img/illustrator/bulb-light.png') }}" class="img-fluid app-academy-img-height scaleX-n1-rtl" alt="Bulb in hand" data-app-light-img="illustrations/bulb-light.png" data-app-dark-img="illustrations/bulb-dark.png" style="height: 120px;"" />
          </div>
          <div class="app-academy-md-50 card-body d-flex align-items-center flex-column text-md-center mb-6">
            <span class="card-title mb-4 px-md-12 h4">
                Keahlian, bakat, dan <br> peluang karier.
                <span class="text-primary text-nowrap">Semua dalam satu tempat</span>.
            </span>
            <p class="mb-4">
                Tingkatkan keterampilan Anda dengan kelas dan sertifikasi daring paling tepercaya.
            </p>
            <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                <input type="search" placeholder="Find your course" class="form-control me-4" />
                <button type="submit" class="btn btn-primary btn-icon"><i class="bx bx-search bx-sm"></i></button>
            </div>
          </div>
          <div class="app-academy-md-25 d-flex align-items-end justify-content-end">
            <img src="{{ asset('frontend/img/illustrator/pencil-rocket.png') }}" alt="pencil rocket" height="180" class="scaleX-n1-rtl" />
          </div>
        </div>
    </div>

    <div class="card mb-6">
      <div class="card-header d-flex flex-wrap justify-content-between gap-4">
        <div class="card-title mb-0 me-1">
          <h5 class="mb-0">Kelas Saya</h5>
          <p class="mb-0">Total 6 course you have purchased</p>
        </div>
  
        <div class="form-check form-switch my-2 ms-2">
          <input type="checkbox" class="form-check-input" id="CourseSwitch" />
          <label class="form-check-label text-nowrap mb-0" for="CourseSwitch">Sembunyikan Selesai</label>
        </div>
      </div>
      <div class="card-body">
        <div class="row gy-6 mb-6">
  
          @foreach ($kelas as $item)
          @php
              $totalModul = optional($item->userprogress)->count() ?? 0;  
              $completedModul = optional($item->userprogress)->where('status', 'selesai')->count() ?? 0; 
              $progress = $totalModul > 0 ? ($completedModul / $totalModul) * 100 : 0; 
          @endphp

          <!-- Tambahkan class "completed-class" jika kelas sudah selesai -->
          <div class="col-sm-6 col-lg-3 kelas-item {{ $progress == 100 ? 'completed-class' : '' }}">
            <div class="card p-2 h-100 shadow-none card-hover-shine-effect border">
              <div class="rounded-2 text-center mb-2">
                <a><img class="img-fluid rounded" src="{{ asset('image/kelas-sampul/' . $item->kelas->foto) }}" alt="tutor image 1" style="height: 190px; object-fit: cover;"/></a>
              </div>
              <div class="card-body p-4 pt-2">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span class="badge bg-label-info">{{ $item->kelas->kategori->namaKategori }}</span>
                  <p class="d-flex align-items-center justify-content-center fw-medium gap-1 mb-0">
                  </p>
                </div>
                <a class="h6"><strong>{{ $item->kelas->title }}</strong></a>
                <p class="mt-1">{{ \Illuminate\Support\Str::words($item->kelas->subtitle, 6) }}</p>
              </div>
              <div class="card-footer pt-0">
                <p class="d-flex align-items-center mb-1" style="margin-top: 2px;">
                  <i class="bx bx-time-five me-1"></i>
                  {{ round($progress) }}%
                </p>

                <div class="progress mb-3" style="height: 6px;">
                  <div class="progress-bar" role="progressbar" style="width: {{ round($progress) }}%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex flex-column flex-md-row gap-4 text-nowrap flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                  <a class="w-100 btn btn-label-primary d-flex align-items-center" href="kelassaya/{{ $item->kelas->id }}">
                  <span class="me-2">Detail</span><i class="bx bx-chevron-right bx-sm lh-1 scaleX-n1-rtl"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
  
          <nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
              <ul class="pagination mb-0 pagination-rounded">
                <li class="page-item first disabled">
                  <a class="page-link" href="javascript:void(0);"><i class="bx bx-chevrons-left bx-sm scaleX-n1-rtl"></i></a>
                </li>
                <li class="page-item prev disabled">
                  <a class="page-link" href="javascript:void(0);"><i class="bx bx-chevron-left bx-sm scaleX-n1-rtl"></i></a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0);">1</a>
                </li>
                <li class="page-item next">
                  <a class="page-link" href="javascript:void(0);"><i class="bx bx-chevron-right bx-sm scaleX-n1-rtl"></i></a>
                </li>
                <li class="page-item last">
                  <a class="page-link" href="javascript:void(0);"><i class="bx bx-chevrons-right bx-sm scaleX-n1-rtl"></i></a>
                </li>
              </ul>
          </nav>
        </div>
      </div>
  </div>
</div>
@endsection


@section('script')
    <script>
        window.addEventListener('scroll', function() {
            let eventFilter = document.querySelector('.event_filter');

            if (window.scrollY > 100) {
                eventFilter.classList.add('bounce');
            } else {
                eventFilter.classList.remove('bounce');
            }
        });
        
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}'
            });
        </script>
    @endif


    <script>
      document.getElementById('CourseSwitch').addEventListener('change', function() {
        // Cek apakah switch dalam keadaan aktif (checked)
        var hideCompleted = this.checked;

        // Dapatkan semua elemen dengan class "completed-class"
        var completedClasses = document.querySelectorAll('.completed-class');

        // Sembunyikan atau tampilkan kelas yang sudah selesai
        completedClasses.forEach(function(element) {
            if (hideCompleted) {
                element.style.display = 'none'; // Sembunyikan jika checkbox diaktifkan
            } else {
                element.style.display = 'block'; // Tampilkan jika checkbox dimatikan
            }
        });
    });

    </script>

@endsection