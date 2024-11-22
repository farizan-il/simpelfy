@extends('gondowangi.frontend.layout.main')

@section('head')
    <title>{{ $title }}</title>

    <style>
        .col-lg-9 {
            scrollbar-width: thin; /* Firefox */
        }

        .col-lg-9::-webkit-scrollbar {
            width: 6px; /* Mengatur lebar scrollbar di Chrome/Safari */
        }

        .col-lg-9::-webkit-scrollbar-thumb {
            background-color: #888; /* Warna scrollbar */
            border-radius: 10px; /* Membuat sudut scroll lebih halus */
        }

        .col-lg-9::-webkit-scrollbar-thumb:hover {
            background-color: #555; /* Warna scrollbar saat di-hover */
        }


        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* Aspect ratio 16:9 */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
        }
        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        #progressBarContainer {
            background-color: #ddd; /* Warna dasar progress bar */
            position: relative;
        }

        #videoProgressBar {
            background-color: #00aaff; /* Warna progress yang menunjukkan waktu berjalan */
        }

        #quizMarker {
            background-color: red; /* Warna marker untuk kuis */
            width: 2px;
            height: 10px;
            position: absolute;
            top: 0;
        }

        .rating i {
            color: gray;
            cursor: pointer;
            transition: color 0.3s;
        }

        .rating i.hovered {
            color: #ffab00;
        }


    </style>
@endsection

@section('hide')
    style="display:none;"
@endsection

@section('content-belajar')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        {{-- card untuk tampilan video --}}
        <div class="col-lg-8" style="max-height: 85vh; overflow-y: auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-6 gap-2">
                        <div class="me-1">
                            <h5 class="mb-0">{{ $detailpelajaran->title }}</h5>
                            <p class="mb-0">Video by:<span class="fw-medium text-heading"> {{ $detailpelajaran->instruktur }} </span></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-label-warning">{{ $detailpelajaran->kategori->namaKategori }}</span>
                        </div>
                    </div>
                    <div class="card academy-content shadow-none">
                        <div class="p-2" style="height: 480px;">
                            <div class="cursor-pointer">
                                <div class="position-relative">
                                    <!-- Video Player -->
                                    <iframe id="videoPlayer" class="w-100 rounded"
                                        src="" 
                                        title="Video player" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen
                                        style="position: relative; top: 0; left: 0; width: 100%; height: 450px;">
                                    </iframe>
                                    <!-- Tombol Next -->
                                    <button id="nextButton" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 10px 20px; font-size: 16px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Next</button>
                                </div>

                                <!-- Custom Progress Bar -->
                                <div class="progress mt-2" id="progressBarContainer" style="height: 10px; position: relative;">
                                    <div class="progress-bar" id="videoProgressBar" style="width: 0%;"></div>
                                    <!-- Marker untuk waktu kuis -->
                                    <div id="quizMarker" style="position: absolute; top: 0; width: 2px; height: 10px; background-color: red;"></div>
                                </div>
                            </div>                   
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-fill rounded-0 timeline-indicator-advanced" role="tablist">
                                <li class="nav-item">
                                  <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-new" aria-controls="navs-justified-new" aria-selected="true">Deskripsi</button>
                                </li>
                                <li class="nav-item">
                                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-link-shipping" aria-controls="navs-justified-link-shipping" aria-selected="false">Review</button>
                                </li>
                            </ul>

                            <div class="tab-content border-0 p-0 m-0">
                                <div class="tab-content border-0 p-0 m-0">
                                    <div class="tab-pane fade p-0 m-0 show active" id="navs-justified-new" role="tabpanel">
                                        <div class="card-body pt-4">
                                            <h5>Sertifikat</h5>
                                            <p class="mb-0">
                                                Dapatkan sertifikat LMS Gondowangi dengan menyelesaikan seluruh modul
                                            </p>
                                            <div class="demo-inline-spacing mt-2">
                                                @if($userHasComment) 
                                                    <a href="" class="btn rounded btn-label-slack">
                                                        <i class='bx bxs-cloud-download bx-sm'> </i> Unduh Sertifikat
                                                    </a>
                                                @else
                                                    <button type="button" class="btn rounded btn-label-slack" data-bs-toggle="modal" data-bs-target="#backDropModal">
                                                        <i class='bx bxs-cloud-download bx-sm'> </i> Unduh Sertifikat
                                                    </button>
                                                @endif
                                            </div>
                                            
                                            <hr class="my-6">
                                            <h5>Tentang Kelas ini</h5>
                                            <p class="mb-0">{{ $detailpelajaran->subtitle }}</p>
                                            <hr class="my-6">
                                            <h5>Keuntungan</h5>
                                            <div class="d-flex flex-wrap row-gap-2">
                                              @foreach($keuntungan as $benefit)
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
                                                {!! $detailpelajaran->deskripsi !!}
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
                                    
                                    <div class="tab-pane fade p-0 m-0" id="navs-justified-link-shipping" role="tabpanel">
                                        <div class="card-body row widget-separator g-0">
                                            <div class="col-sm-5 border-shift border-end pe-sm-6">
                                                <h3 class="text-primary d-flex align-items-center gap-2 mb-2">{{ $totalRating }} ⭐</h3>
                                                <p class="h6 mb-2">Total {{ $totalReviews }} ulasan</p>
                                                <p class="pe-2 mb-2">Semua ulasan berasal dari karyawan</p>
                                                <span class="badge bg-label-primary mb-4 mb-sm-0">+{{ $newReviewsCount }} minggu ini</span>
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
            </div>
        </div>

        {{-- card untuk modul --}}
        <div class="col-lg-4" style="max-height: 85vh; overflow-y: auto;">
            <div class="accordion stick-top accordion-custom-button" id="courseContent"> 

                {{-- acordion untuk pre-test --}}
                @if ($preTest)
                    {{-- tampilan untuk pre-test --}}
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
                                <div class="form-check d-flex p-0 align-items-center gap-1 mb-4">
                                    <i class='bx bxs-book-add bx-sm text-primary'></i>
                                    <label class="form-check-label ms-4">
                                        <a href="javascript:void(0)" onclick="confirmPreTest()">
                                            <span class="mb-0 h6 detailSubModul">Pre-test</span>
                                            <small class="text-body d-block">Durasi: {{ $preTest->duration }} min</small>
                                        </a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            
                {{-- tapimpilan mid-test modules --}}
                @foreach ($bagian as $item)
                <div class="accordion-item mb-0">
                    <div class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#chapterOne{{$item->id }}" aria-expanded="false" aria-controls="chapterOne">
                            <span class="d-flex flex-column">
                                <span class="h5 mb-0">{{ $item->judulModul }}</span>
                                <span class="text-body fw-normal">{{ $item->lessonCount }} Pelajaran | total {{ $item->formattedDuration }}</span>
                            </span>
                        </button>
                    </div>
                    <div id="chapterOne{{$item->id }}" class="accordion-collapse collapse" data-bs-parent="#courseContent">
                        <div class="accordion-body py-4">
                            @foreach ($pelajaran->where('id_modul', $item->id) as $detailModul)
                                <div class="form-check d-flex align-items-center gap-1 mb-4 detailSubModul"
                                    data-video-src="{{ filter_var($detailModul->file, FILTER_VALIDATE_URL) ? $detailModul->file : asset('files/kursus/' . $detailModul->file) }}"
                                    data-modul-detail-id="{{ $detailModul->id }}">
                                    
                                    <!-- Jika statusnya 'selesai', tampilkan checkbox yang dicentang -->
                                    <input class="form-check-input" type="checkbox" id="defaultCheck1{{ $detailModul->id }}"
                                        {{ $detailModul->userprogress->status == 'selesai' ? 'checked' : '' }} />

                                    <label for="defaultCheck1{{ $detailModul->id }}" class="form-check-label ms-4">
                                        <span class="mb-0 h6">
                                            {{ $detailModul->detailSubModul }}
                                        </span>
                                        <small class="text-body d-block">
                                            {{ $detailModul->duration < 60 ? "{$detailModul->duration} Menit" : floor($detailModul->duration / 60) . ' Jam ' . ($detailModul->duration % 60) . ' Menit' }}
                                        </small>
                                    </label>
                                </div>
                            @endforeach

                            {{-- Tampilkan mid-test jika ada --}}
                            @if ($item->midTest)
                                <div class="form-check d-flex p-0 align-items-center gap-1 mb-4">
                                    <i class='bx bxs-lock-alt bx-sm'></i>
                                    <label class="form-check-label ms-2">
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
                                <div class="form-check d-flex p-0 align-items-center gap-1 mb-4">
                                    <i class='bx bxs-lock-alt bx-sm'></i>
                                    <label class="form-check-label ms-2">
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
    </div>
</div>

<!-- Kontainer Kuis -->
<div class="modal fade" id="quizModal1" tabindex="-1" aria-labelledby="quizModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" id="quizModalLabel1">Soal 1</h5>
            </div>
            <div class="modal-body">
                <p class="h5 text-start text-dark">Apa fungsi dari YouTube API?</p>
                <div class="form-check align-items-start d-flex">
                    <input type="radio" name="q1" id="kuis1" value="A" class="form-check-input me-2">
                    <label class="form-check-label" for="kuis1">A. Memutar video</label>
                </div>
                <div class="form-check align-items-start d-flex">
                    <input type="radio" name="q1" id="kuis2" value="B" class="form-check-input me-2">
                    <label class="form-check-label" for="kuis2">B. Mengontrol video dengan JavaScript</label>
                </div>
                <div class="form-check align-items-start d-flex">
                    <input type="radio" name="q1" id="kuis3" value="C" class="form-check-input me-2">
                    <label class="form-check-label" for="kuis3">C. Menonton video offline</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-target="#quizModal2" data-bs-toggle="modal">Soal Berikutnya</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Soal 2 -->
<div class="modal fade" id="quizModal2" tabindex="-1" aria-labelledby="quizModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" id="quizModalLabel2">Soal 2</h5>
            </div>
            <div class="modal-body">
                <p class="h5 text-start text-dark">Berapa durasi video ini?</p>
                <div class="form-check align-items-start d-flex">
                    <input type="radio" name="q2" id="kuis1" value="A" class="form-check-input me-2">
                    <label class="form-check-label" for="kuis1">A. 10 menit</label>
                </div>
                <div class="form-check align-items-start d-flex">
                    <input type="radio" name="q2" id="kuis2" value="B" class="form-check-input me-2">
                    <label class="form-check-label" for="kuis2">B. 20 menit</label>
                </div>
                <div class="form-check align-items-start d-flex">
                    <input type="radio" name="q2" id="kuis3" value="C" class="form-check-input me-2">
                    <label class="form-check-label" for="kuis3">C. 5 menit</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-target="#quizModal3" data-bs-toggle="modal">Soal Berikutnya</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Soal 3 -->
<div class="modal fade" id="quizModal3" tabindex="-1" aria-labelledby="quizModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" id="quizModalLabel3">Soal 3</h5>
            </div>
            <div class="modal-body">
                <p class="h5 text-start text-dark">Apa yang terjadi jika video mencapai akhir durasi?</p>
                <div class="form-check align-items-start d-flex">
                    <input type="radio" name="q3" id="kuis1" value="A" class="form-check-input me-2">
                    <label class="form-check-label" for="kuis1">A. Video berhenti</label>
                </div>
                <div class="form-check align-items-start d-flex">
                    <input type="radio" name="q3" id="kuis2" value="B" class="form-check-input me-2">
                    <label class="form-check-label" for="kuis2">B. Kuis muncul</label>
                </div>
                <div class="form-check align-items-start d-flex">
                    <input type="radio" name="q3" id="kuis3" value="C" class="form-check-input me-2">
                    <label class="form-check-label" for="kuis3">C. Video diulang</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="showResults">Lihat Kunci Jawaban</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kunci Jawaban -->
<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultModalLabel">Kunci Jawaban</h5>
            </div>
            <div class="modal-body text-start">
                <p><strong>Soal 1:</strong> Jawaban yang Anda pilih adalah <span id="userAnswer1"></span><br> Jawaban yang benar adalah B.</p>
                <p><strong>Soal 2:</strong> Jawaban yang Anda pilih adalah <span id="userAnswer2"></span><br> Jawaban yang benar adalah C.</p>
                <p><strong>Soal 3:</strong> Jawaban yang Anda pilih adalah <span id="userAnswer3"></span><br> Jawaban yang benar adalah B.</p>
                <hr>
                <p id="totalScore"></p>
                <p id="reward"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="finishButton">Selesai</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Rating -->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="{{ url('kelassaya/'.$detailpelajaran->id.'/submit-review') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Masukan Review Terlebih Dahulu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <label for="komentar" class="form-label">Komentar terkait kelas ini:</label>
                        <textarea name="komentartext" class="form-control message-input" placeholder="Masukan komentar anda" rows="2"></textarea>
                    </div>
                    {{-- rating kelas --}}
                    <div class="col-12 rating">
                        <i class="bx bxs-star bx-sm" data-index="1"></i>
                        <i class="bx bxs-star bx-sm" data-index="2"></i>
                        <i class="bx bxs-star bx-sm" data-index="3"></i>
                        <i class="bx bxs-star bx-sm" data-index="4"></i>
                        <i class="bx bxs-star bx-sm" data-index="5"></i>
                    </div>
                    <input type="hidden" name="rating" id="rating-value">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
    {{-- script ubah status --}}
    <script>
        document.querySelectorAll('.detailSubModul').forEach(element => {
            element.addEventListener('click', function() {
                const modulDetailId = this.getAttribute('data-modul-detail-id');

                fetch(`/update-status/${modulDetailId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: 'selesai' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Optionally refresh or update the UI to indicate the status is now 'selesai'
                        this.querySelector('input.form-check-input').checked = true;
                        this.querySelector('i').classList.add('bx-sm', 'text-primary');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>

    {{-- script untuk time_spent --}}
    {{-- <script>
        let startTime = null; // waktu mulai
        let previousModulDetailId = null; // ID modul sebelumnya
    
        document.querySelectorAll('.detailSubModul').forEach(element => {
            element.addEventListener('click', function() {
                const modulDetailId = this.getAttribute('data-modul-detail-id');
                
                // Jika ada modul sebelumnya yang diklik, hitung waktu yang dihabiskan
                if (previousModulDetailId) {
                    const endTime = new Date();
                    const spentTime = Math.floor((endTime - startTime) / 60000); // Waktu dalam menit
                    
                    // Kirim waktu yang dihabiskan ke server
                    fetch(`/update-spent-time/${previousModulDetailId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ time_spent: spentTime })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Spent time updated for modul detail:', previousModulDetailId);
                        } else {
                            console.error('Failed to update spent time:', data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
    
                // Mulai tracking waktu untuk modul yang baru diklik
                startTime = new Date();
                previousModulDetailId = modulDetailId;
    
                // Set video src untuk modul ini
                const videoSrc = this.getAttribute('data-video-src');
                document.getElementById('videoPlayer').src = videoSrc.includes('youtube') ? videoSrc + '&rel=0' : videoSrc;
    
                // Sembunyikan tombol Next setiap kali video dimulai
                const nextButton = document.getElementById('nextButton');
                nextButton.style.display = 'none';
    
                // Tambahkan event listener untuk memastikan video selesai diputar
                const videoPlayer = document.getElementById('videoPlayer');
                videoPlayer.onended = function() {
                    nextButton.style.display = 'block';
                };
            });
        });
    
        // Event listener untuk tombol Next
        document.getElementById('nextButton').addEventListener('click', function() {
            alert('Next button clicked!');
        });
    </script> --}}

    <script>
        let startTime;
        let modulDetailId;

        // Start timer when detailSubModul is clicked
        document.querySelectorAll('.detailSubModul').forEach(element => {
            element.addEventListener('click', function () {
                startTime = new Date();
                modulDetailId = this.dataset.modulDetailId;
            });
        });

        // Stop timer and send data to backend
        function stopTimer(type) {
            if (!startTime || !modulDetailId) return;

            const endTime = new Date();
            const timeSpent = Math.floor((endTime - startTime) / 1000);
            startTime = null; // reset start time

            fetch('/save-time-spent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    modul_detail_id: modulDetailId,
                    time_spent: timeSpent,
                    type: type
                })
            });
        }

        // Listen for "test" or exit events
        document.querySelector('a[href*="ujian.index"]').addEventListener('click', () => stopTimer('test'));
        window.addEventListener('beforeunload', () => stopTimer('exit'));
    </script>

    {{-- script untuk memunculkan kuis --}}
    <script>
        var player;
        var videoDuration = 0;
        var quizStartTime = 0;
        var quizDisplayed = false;
    
        // Muat YouTube API
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    
        // Fungsi YouTube API
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('videoPlayer', {
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }
    
        function onPlayerReady(event) {
            videoDuration = player.getDuration();
            quizStartTime = videoDuration - 100;
    
            var quizMarkerPosition = (quizStartTime / videoDuration) * 100;
            document.getElementById('quizMarker').style.left = quizMarkerPosition + '%';
        }
    
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !quizDisplayed) {
                var updateProgressBar = setInterval(function() {
                    var currentTime = player.getCurrentTime();
                    var progressBarWidth = (currentTime / videoDuration) * 100;
                    document.getElementById('videoProgressBar').style.width = progressBarWidth + '%';
    
                    if (currentTime >= quizStartTime) {
                        player.pauseVideo();
                        clearInterval(updateProgressBar);
    
                        var quizModal1 = new bootstrap.Modal(document.getElementById('quizModal1'), {
                            backdrop: 'static',
                            keyboard: false
                        });
                        quizModal1.show();
                        quizDisplayed = true;
                    }
                }, 1000);
            }
        }
    
        // Script untuk jawaban dan kunci
        let answers = { q1: null, q2: null, q3: null };
        
        document.querySelectorAll('input[type=radio]').forEach(radio => {
            radio.addEventListener('change', function() {
                answers[this.name] = this.value;
            });
        });
    
        document.getElementById('showResults').addEventListener('click', function() {
            let score = 0;
            let correctAnswers = { q1: "B", q2: "C", q3: "B" };
    
            for (let question in correctAnswers) {
                if (answers[question] === correctAnswers[question]) {
                    score++;
                }
            }
    
            document.getElementById('userAnswer1').innerText = answers.q1 || 'Belum dijawab';
            document.getElementById('userAnswer2').innerText = answers.q2 || 'Belum dijawab';
            document.getElementById('userAnswer3').innerText = answers.q3 || 'Belum dijawab';
    
            let reward;
            switch (score) {
                case 3: reward = '1.000.000 Coin'; break;
                case 2: reward = '700.000 Coin'; break;
                case 1: reward = '500.000 Coin'; break;
                default: reward = '0 Coin'; break;
            }
    
            document.getElementById('totalScore').innerText = `Total Skor: benar ${score} dari 3 soal`;
            document.getElementById('reward').innerText = `Anda mendapatkan: ${reward}`;
            document.getElementById('reward').classList.add("text-warning");
    
            let resultModal = new bootstrap.Modal(document.getElementById('resultModal'), {
                backdrop: 'static',
                keyboard: false
            });
            resultModal.show();
        });
    
        document.getElementById('finishButton').addEventListener('click', function() {
            // Tutup semua modal
            document.querySelectorAll('.modal.show').forEach(modal => {
                let modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
            });
    
            // Putar video kembali
            player.playVideo();
        });
    </script>

    {{-- kunci jawaban kuis --}}
    <script>
        // Menangkap jawaban pengguna
        let answers = {
            q1: null,
            q2: null,
            q3: null,
        };

        // Fungsi untuk menyimpan jawaban saat pindah ke modal berikutnya
        document.querySelectorAll('input[type=radio]').forEach(radio => {
            radio.addEventListener('change', function() {
                answers[this.name] = this.value; // Menyimpan jawaban
            });
        });

        // Menangani penampilan modal kunci jawaban
        document.getElementById('showResults').addEventListener('click', function() {
            // Hitung total skor dan reward
            let score = 0;
            let correctAnswers = {
                q1: "B",
                q2: "C",
                q3: "B"
            };

            // Cek jawaban dan simpan hasil
            for (let question in correctAnswers) {
                if (answers[question] === correctAnswers[question]) {
                    score++;
                }
            }

            // Tampilkan jawaban pengguna dan kunci jawaban
            document.getElementById('userAnswer1').innerText = answers.q1 || 'Belum dijawab';
            document.getElementById('userAnswer2').innerText = answers.q2 || 'Belum dijawab';
            document.getElementById('userAnswer3').innerText = answers.q3 || 'Belum dijawab';

            // Hitung reward berdasarkan skor
            let reward;
            switch (score) {
                case 3:
                    reward = '1.000.000 Coin';
                    break;
                case 2:
                    reward = '700.000 Coin';
                    break;
                case 1:
                    reward = '500.000 Coin';
                    break;
                default:
                    reward = '0 Coin';
                    break;
            }

            // Tampilkan skor dan reward
            document.getElementById('totalScore').innerText = `Total Skor: ${score} dari 3`;
            document.getElementById('reward').innerText = `Anda mendapatkan: ${reward}`;

            // Tampilkan modal kunci jawaban
            let resultModal = new bootstrap.Modal(document.getElementById('resultModal'), {
                backdrop: 'static',
                keyboard: false
            });
            resultModal.show();
        });

        // Fungsi untuk menutup modal dan memutar video kembali
        document.getElementById('finishButton').addEventListener('click', function() {
            // Tutup semua modal
            let resultModal = bootstrap.Modal.getInstance(document.getElementById('resultModal'));
            resultModal.hide();

            // Memutar video kembali
            const videoPlayer = document.getElementById('videoPlayer');
            videoPlayer.play();
        });
    </script>

    {{-- script untuk manipulasi video, agar terdapat kuis ketika durasi videonya mau selesai --}}
    <script>
        window.addEventListener('scroll', function() {
            let eventFilter = document.querySelector('.event_filter');

            if (window.scrollY > 100) {
                eventFilter.classList.add('bounce');
            } else {
                eventFilter.classList.remove('bounce');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen link video
            var videoLinks = document.querySelectorAll('.video-link');

            // Tambahkan event listener untuk setiap link
            videoLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Ambil URL file dari atribut data-file
                    var videoFile = this.getAttribute('data-file');

                    // Ganti source video
                    var videoSource = document.getElementById('videoSource');
                    videoSource.src = videoFile;

                    // Muat ulang video
                    var videoPlayer = document.getElementById('videoPlayer');
                    videoPlayer.load();
                    videoPlayer.play();
                });
            });
        });

        // Script untuk quiz pengguna
        const videoPlayer = document.getElementById('videoPlayer');
        const quizOverlay = document.getElementById('quizOverlay');
        const submitAnswer = document.getElementById('submitAnswer');
        let isQuizAnswered = false; // Menyimpan status apakah soal sudah dijawab
        let quizShown = false; // Status apakah quiz sudah pernah ditampilkan

        // Deteksi saat waktu video mencapai 90% dan tampilkan quiz
        videoPlayer.addEventListener('timeupdate', function () {
            const currentTime = videoPlayer.currentTime;
            const duration = videoPlayer.duration;

            // Tampilkan quiz jika video sudah mencapai 90% dan belum pernah menampilkan quiz
            if (currentTime >= 0.9 * duration && !quizShown) {
                videoPlayer.pause(); // Jeda video
                quizOverlay.classList.remove('d-none'); // Tampilkan quiz
                quizShown = true; // Pastikan quiz hanya ditampilkan sekali
            }
        });

        // Logika untuk memeriksa jawaban dan melanjutkan video
        submitAnswer.addEventListener('click', function () {
            const selectedAnswer = document.querySelector('input[name="quizAnswer"]:checked');

            if (selectedAnswer && selectedAnswer.value === '4') { // Jika jawaban benar
                isQuizAnswered = true; // Soal sudah dijawab
                quizOverlay.classList.add('d-none'); // Sembunyikan quiz
                videoPlayer.play(); // Lanjutkan video
            } else {
                alert('Jawaban salah. Silakan coba lagi!');
            }
        });

    </script>

    {{-- script untuk rating --}}
    <script>
        document.querySelectorAll('.rating i').forEach(star => {
            star.addEventListener('mouseover', function() {
                const index = this.getAttribute('data-index');
                document.querySelectorAll('.rating i').forEach(s => {
                    if (s.getAttribute('data-index') <= index) {
                        s.classList.add('hovered');
                    } else {
                        s.classList.remove('hovered');
                    }
                });
            });
    
            star.addEventListener('mouseout', function() {
                document.querySelectorAll('.rating i').forEach(s => s.classList.remove('hovered'));
            });
    
            // Set rating on click
            star.addEventListener('click', function() {
                const index = this.getAttribute('data-index');
                document.getElementById('rating-value').value = index;
                document.querySelectorAll('.rating i').forEach(s => {
                    if (s.getAttribute('data-index') <= index) {
                        s.classList.add('hovered');
                    } else {
                        s.classList.remove('hovered');
                    }
                });
            });
        });
    </script>
    
    {{-- script untuk video yg ditampilkan menyesuaikan modul yang dipilih --}}
    <script>
       document.querySelectorAll('.detailSubModul').forEach(item => {
        item.addEventListener('click', function() {
            console.log('Video item diklik'); 
            const videoSrc = this.getAttribute('data-video-src');
            const modulDetailId = this.getAttribute('data-modul-detail-id');

            // Set src iframe untuk memutar video tanpa rekomendasi
            document.getElementById('videoPlayer').src = videoSrc.includes('youtube') ? videoSrc + '&rel=0' : videoSrc;

            // Sembunyikan tombol Next setiap kali video dimulai
            const nextButton = document.getElementById('nextButton');
            nextButton.style.display = 'none';

            // Tambahkan event listener untuk memastikan video selesai diputar
            const videoPlayer = document.getElementById('videoPlayer');
            videoPlayer.onended = function() {
                console.log('Video selesai diputar'); 

                // Tampilkan tombol Next di tengah layar
                nextButton.style.display = 'block';

                // Kirim permintaan AJAX untuk memperbarui status
                fetch('/update-video-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        modul_detail_id: modulDetailId,
                        status: 'selesai'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response Data:', data); 
                    if (data.success) {
                        alert('Status berhasil diperbarui menjadi selesai.');
                    } else {
                        alert('Gagal memperbarui status: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error); 
                    alert('Terjadi kesalahan saat memperbarui status.');
                });
            };
        });
        });

        // Event listener untuk tombol Next
        document.getElementById('nextButton').addEventListener('click', function() {
            alert('Next button clicked!'); // Ganti dengan aksi yang Anda inginkan
            // Misalnya, arahkan ke halaman berikutnya
            // window.location.href = 'URL_berikutnya';
        });
    </script>  

    {{-- script untuk alert aturan ketika ujian --}}
    <script>
        function confirmPreTest() {
            // Pastikan preTest ada sebelum memproses
            @if(isset($preTest))
                Swal.fire({
                    title: 'Penting!',
                    html: 
                        `<p>Waktu akan dimulai setelah Anda klik "Mulai".</p>
                        <p>Perhatian: Jika Anda membuka tab lain atau membagi layar, nilai Anda akan menjadi nol.</p>
                        
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="agreeCheck" required />
                                <label for="agreeCheck" class="form-check-label">Saya telah membacanya.</label>
                            </div>
                        </div>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Mulai Pre-test',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    preConfirm: () => {
                        // Cek apakah checkbox sudah dicentang
                        if (!document.getElementById('agreeCheck').checked) {
                            Swal.showValidationMessage('Anda harus menyetujui aturan ujian terlebih dahulu!');
                            return false;
                        }
                        return true;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Arahkan ke halaman ujian jika sudah menyetujui aturan
                        window.location.href = "{{ route('ujian.index', ['kelasId' => $preTest->kelas_id]) }}";
                    } else {
                        // Jika dibatalkan
                        Swal.fire(
                            'Dibatalkan',
                            'Anda tidak akan melanjutkan ke Pre-test.',
                            'info'
                        );
                    }
                });
            @else
                console.log('Pre-test tidak tersedia untuk kelas ini.');
            @endif
        }
    </script>    
@endsection