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

        /* Add CSS for expanded view */
        .expanded {
            width: 100% !important;
            max-width: 100% !important;
            transition: width 0.5s ease;
        }

        .video-container, #videoPlayer {
            transition: height 0.5s ease;
        }

        /* style untuk post-test dan pre-test */
        .question-btn {
            width: 15px;
            height: 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }


        /* style untuk fullscreen test */
        .fullscreen-card {
            width: 100%;
            height: 100%;
            overflow-y: auto;
        }
        body {
            user-select: none; /* Nonaktifkan pemilihan teks */
        }
    </style>
@endsection

@section('hide')
    style="display:none;"
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        <div class="col-lg-12" id="cardContainer">
            <div class="card" id="expandableCard">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-top flex-wrap mb-6 gap-2">
                        <div class="me-1">
                            <h5 class="mb-0">Online Pre-Test</h5>
                        </div>
                        <i id="fullscreenIcon" class='bx bx-fullscreen bx-sm' onclick="toggleFullscreen()" style="cursor: pointer;"></i>
                    </div>

                    <div class="card academy-content shadow-none border">
                        <div class="p-2 rounded">
                            <div class="container">
                                <div class="row p-4">
                                    <div class="col-md-8 border-end">
                                        <!-- Loop through all questions -->
                                        @if($preTest)
                                            @foreach($preTest->questions as $index => $question)
                                                <div class="question-container" id="questionContainer{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                                                    <h5 class="mb-4">{{ $question->questionText }}</h5>

                                                    <!-- Options -->
                                                    <div id="optionsContainer">
                                                        @foreach($question->options as $key => $option)
                                                            <div class="form-check">
                                                                <input class="form-check-input answer-option" type="radio" name="answer[{{ $index }}]" id="option{{ $index . '_' . $key }}" value="{{ $key }}" onclick="selectAnswer()">
                                                                <label class="form-check-label" for="option{{ $index . '_' . $key }}">{{ $option }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                        <!-- Navigation Buttons -->
                                        <div class="d-flex justify-content-between pt-5">
                                            <div class="btn-navigasi-soal">
                                                <button id="prevBtn" class="btn btn-label-primary btn-sm me-2" onclick="prevQuestion()">Previous</button>
                                                <button id="nextBtn" class="btn btn-label-primary btn-sm me-2" onclick="nextQuestion()">Next</button>
                                                <button id="doubtBtn" class="btn btn-label-warning btn-sm" onclick="markDoubt()">Ragu-ragu</button>
                                            </div>
                                            <div class="btn-submit-soal">
                                                <button type="button" class="btn btn-sm rounded btn-label-slack" onclick="showFinishConfirmation()">
                                                    Selesaikan
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sidebar Navigation -->
                                    <div class="col-md-4">
                                        @if($preTest)
                                            <div class="p-3 text-center mb-5 border rounded" style="background-color: #e8e8e8;">
                                                <h4 id="preTestTimer" class="text-danger"><strong>{{ gmdate("H:i:s", $preTest->duration * 60) }}</strong></h4>
                                                <p class="text-muted">Durasi Pengerjaan</p>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <h6 class="border-bottom p-2 text-secondary">Jumlah Soal</h6>
                                            <div class="d-flex flex-wrap gap-2" id="questionNav">
                                                <!-- Question Navigation -->
                                                @foreach($preTest->questions as $index => $question)
                                                    <button style="width: 2.5rem;" class="btn btn-sm btn-secondary question-nav-btn" id="questionNav{{ $index }}" onclick="goToQuestion({{ $index }})">{{ $index + 1 }}</button>
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


<!-- Modal Bootstrap untuk Peringatan -->
<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="warningModalLabel">Peringatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                Jika Anda berpindah tab lagi, maka tes akan dibatalkan dan nilai Anda menjadi nol.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- script untuk full screen --}}
    <script>
        function toggleFullscreen() {
            const card = document.getElementById('expandableCard');
            const icon = document.getElementById('fullscreenIcon'); 
    
            // Cek apakah elemen sudah dalam mode fullscreen
            if (!document.fullscreenElement) {
                // Masuk ke mode fullscreen
                if (card.requestFullscreen) {
                    card.requestFullscreen();
                } else if (card.webkitRequestFullscreen) { // Safari
                    card.webkitRequestFullscreen();
                } else if (card.msRequestFullscreen) { // IE/Edge
                    card.msRequestFullscreen();
                }
                card.classList.add('fullscreen-card');
                icon.classList.replace('bx-fullscreen', 'bx-exit-fullscreen');
            } else {
                // Keluar dari mode fullscreen
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) { // Safari
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { // IE/Edge
                    document.msExitFullscreen();
                }
                card.classList.remove('fullscreen-card');
                icon.classList.replace('bx-exit-fullscreen', 'bx-fullscreen');
            }
        }

        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'F12' || 
                (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) || 
                (e.ctrlKey && e.key === 'U')
            ) {
                e.preventDefault();
            }
        });


        // script peringatan jika user keluar dari halaman test -------------------------------------]
        let warningShown = false; // Status apakah peringatan sudah ditampilkan
        const warningModal = new bootstrap.Modal(document.getElementById('warningModal')); // Inisialisasi modal

        // Fungsi untuk menampilkan modal
        function showModal(message) {
            document.getElementById('modalBody').textContent = message;
            warningModal.show();
        }

        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                if (!warningShown) {
                    showModal("Jika Anda berpindah tab, maka tes akan dibatalkan dan nilai Anda menjadi nol.");
                    warningShown = true;
                } else {
                    showModal("Tes telah dibatalkan dan nilai Anda adalah nol.");
                    cancelTest();
                }
            }
        });

        function cancelTest() {
            console.log("Tes dibatalkan. Nilai: 0");
        }
    </script>

    {{-- script untuk navigasi soal --}}
    <script>
        let currentQuestionIndex = 0;
        const totalQuestions = {{ count($preTest->questions) }};
    
        function showQuestion(index) {
            // Hide all questions
            for (let i = 0; i < totalQuestions; i++) {
                document.getElementById(`questionContainer${i}`).style.display = 'none';
                document.getElementById(`questionNav${i}`).classList.remove('btn-primary');
            }
            // Show the selected question
            document.getElementById(`questionContainer${index}`).style.display = 'block';
            document.getElementById(`questionNav${index}`).classList.add('btn-primary');
        }
    
        // Fungsi untuk menandai jawaban yang dipilih
        function selectAnswer() {
            let currentNavButton = document.getElementById(`questionNav${currentQuestionIndex}`);
            currentNavButton.classList.remove('btn-secondary', 'btn-warning');
            currentNavButton.classList.add('btn-success');
        }
        
    
        // Menandai soal sebagai ragu-ragu
        function markDoubt() {
            let currentNavButton = document.getElementById(`questionNav${currentQuestionIndex}`);
            currentNavButton.classList.remove('btn-secondary', 'btn-success');
            currentNavButton.classList.add('btn-warning');
        }
    
        function nextQuestion() {
            if (currentQuestionIndex < totalQuestions - 1) {
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
            }
        }
    
        function prevQuestion() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                showQuestion(currentQuestionIndex);
            }
        }
    
        function goToQuestion(index) {
            currentQuestionIndex = index;
            showQuestion(currentQuestionIndex);
        }
    
        // Initialize the first question
        showQuestion(currentQuestionIndex);
    
    </script>

    {{-- script untuk hitung mundur durasi waktu --}}
    <script>
        // Fungsi untuk memulai hitung mundur
        function startCountdown(durationInMinutes, display) {
            let timer = durationInMinutes * 60; // Ubah menit menjadi detik
            const countdownInterval = setInterval(function () {
                let hours = Math.floor(timer / 3600);
                let minutes = Math.floor((timer % 3600) / 60);
                let seconds = timer % 60;

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = hours + ":" + minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(countdownInterval);
                    display.textContent = "Waktu Habis";
                    // Tambahkan tindakan ketika waktu habis, seperti men-submit jawaban
                }
            }, 1000);
        }

        // Mulai hitung mundur untuk setiap test yang tersedia
        @if($preTest)
            startCountdown({{ $preTest->duration }}, document.getElementById('preTestTimer'));
        @endif
    </script>

    {{-- script alert submit jawaban --}}
    <script>
        function showFinishConfirmation() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Anda akan menyelesaikan soal ini. Pastikan semua jawaban sudah benar sebelum melanjutkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Selesaikan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, arahkan ke halaman selesaikan atau lakukan tindakan lain
                    Swal.fire(
                        'Selesai!',
                        'Soal telah diselesaikan.',
                        'success'
                    );
                    // Tindakan selanjutnya seperti mengirim form atau mengarahkan pengguna
                } else {
                    // Jika dibatalkan, tidak ada tindakan lebih lanjut
                    Swal.fire(
                        'Dibatalkan',
                        'Silakan periksa soal kembali.',
                        'info'
                    );
                }
            });
        }
    </script>
    
@endsection