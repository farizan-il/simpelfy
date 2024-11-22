@extends('gondowangi.backend.layout.main')

@section('head')
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">


    <style>
        .header-calender {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .nav-btn {
            background-color: transparent;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .month-display {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .weekdays, .days {
            display: flex;
            justify-content: space-between;
        }

        .weekdays span, .days div {
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
        }

        .weekdays span {
            font-weight: bold;
        }

        .days div {
            cursor: pointer;
        }

        .today {
            background-color: #3f51b5;
            color: white;
        }

        .selected {
            background-color: #d5d5d5;
            color: white;
        }

        .text-heading-wrap {
            display: inline-block;
            max-width: 300px; /* Sesuaikan dengan lebar yang diinginkan */
            white-space: normal;
            word-wrap: break-word;
        }

        /* button untuk membuat blur */
        .card-footer {
            position: relative;
        }

        .blur-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(10px); /* Tingkatkan blur untuk lebih terlihat */
            background: rgba(255, 255, 255, 0.7); /* Ubah transparansi agar lebih terlihat */
            z-index: 1;
        }

        #applyVoucherBtn {
            position: relative;
            z-index: 2; /* Agar tombol berada di atas overlay */
        }
    </style>
@endsection

@section('content')    
<div class="container-xxl flex-grow-1 container-p-y">    
    <nav class="navbar navbar-expand-lg border-secondary border-bottom mb-5">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-secondary" aria-current="page" href="/dashboard">Overview</a>
                    </li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="/dashboarddeapartemen">Departemen</a>
                    </li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                    <li class="nav-item">
                        <a class="nav-link active text-primary" href="/dashboardkaryawan">Karyawan</a>
                    </li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                </ul>
                <select id="select2Basic" class="select2 form-select w-20 form-select-md me-4" data-allow-clear="true">
                    <option value="" disabled selected>Pilih Departemen</option>
                    @foreach ($dataDepartemen as $item)
                        <option value="{{ $item->id }}">{{ $item->departement }}</option>
                    @endforeach
                </select>
                <select id="select2Basic" class="select2 form-select w-20 form-select-md me-4" data-allow-clear="true">
                    <option value="" disabled selected>Pilih Karyawan</option>
                    @foreach ($dataKaryawan as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                <form class="d-flex" onsubmit="return false">
                    <button class="btn btn-primary btn-sm p-2" type="submit">
                        <i class='bx bxs-cloud-download me-2'></i> export
                    </button>
                </form>
            </div>
        </div>
    </nav>      
    
    <!-- Topic and Instructors -->
    <div class="row mb-6 g-6">
        @include('gondowangi.backend.dashboard.dashboardkaryawan.partials.dashboard-data', compact('pengeluaranBulanIni', 'perubahan', 'totalPengeluaran', 'bulan', 'dataTransaksi', 'totalKelasKeseluruhan', 'totalKelasBulanIni', 'kelas', 'kategoriLabels', 'kategoriCounts', 'kelasSelesai', 'kelasDalamProses', 'kelasTidakTuntas', 'kelasProsesBulanIni', 'kelasTidakTuntasBulanIni', 'userScore', 'percentage', 'ranking', 'userActivities', 'videoTimes', 'soalTimes', 'dataKaryawan'))
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card border border-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="card-info">
                                        <p class="text-heading mb-1">Total Transaksi Pembelian</p>
                                        <div class="d-flex align-items-center mb-1">
                                            <h4 class="card-title mb-0 me-2">IDR {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
                                            
                                        </div>
                                        <span>Total Keseluruhan</span>
                                    </div>
                                    <div class="card-icon">
                                        <span class="badge bg-label-success rounded p-2">
                                            <i class='bx bx-trending-up bx-sm'></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-6">
                        <div class="card border border-danger">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="card-info">
                                        <p class="text-heading mb-1">Total koin tidak digunakan</p>
                                        <div class="d-flex align-items-center mb-1">
                                            <h4 class="card-title mb-0 me-2">IDR 1.250.000</h4>
                                        </div>
                                        <span>Total Keseluruhan</span>
                                    </div>
                                    <div class="card-icon">
                                        <span class="badge bg-label-danger rounded p-2">
                                            <i class='bx bx-pie-chart-alt bx-sm'></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card border shadow border-primary">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title mb-1">Riwayat Koin Tidak Terpakai</h5>
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
                                <div id="chartKoinTerbuang"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize Flatpickr with max range of 14 days
        flatpickr("#dateRangePickerKaryawan", {
            mode: "range",
            dateFormat: "Y-m-d",
            theme: "material_blue", // Use modern theme
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    const diff = (selectedDates[1] - selectedDates[0]) / (1000 * 60 * 60 * 24);
                    if (diff > 14) {
                        // Show error modal
                        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();

                        // Clear the selection
                        instance.clear();
                    }
                }
            },
        });
    </script>

    <script>
        document.getElementById('select2Basic').addEventListener('change', function () {
            const selectedEmployeeId = this.value;
    
            if (selectedEmployeeId) {
                fetch(`/dashboard-data/${selectedEmployeeId}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('dashboard-content').innerHTML = html;
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
    
    {{-- script untuk statistik waktu yang dihabiskan --}}
    <script>
        // Data yang diambil dari controller
        const videoData = @json($videoTimes);
        const soalData = @json($soalTimes);
    
        // Fungsi untuk mendapatkan label hari berdasarkan tanggal real-time
        function getDayLabels() {
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const today = new Date();
            const week = [];
    
            // Mengambil label hari dimulai dari hari ini selama 7 hari ke belakang
            for (let i = 6; i >= 0; i--) {
                const day = new Date();
                day.setDate(today.getDate() - i);
                week.push(days[day.getDay()]);
            }
            return week;
        }
    
        // Fungsi untuk memfilter data hanya pada hari yang ada aktivitasnya
        function filterData(data) {
            return data.map((value, index) => value > 0 ? value : null);
        }
    
        const labels = getDayLabels();
    
        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Video',
                    data: filterData(videoData),
                    barThickness: 42,
                    backgroundColor: 'rgba(255, 171, 0, 0.8)',
                    borderWidth: 1,
                    borderRadius: {
                        topLeft: 0, topRight: 0, bottomLeft: 10, bottomRight: 10
                    },
                    order: 2,
                    stack: 'combined'
                },
                {
                    label: 'Soal',
                    data: filterData(soalData),
                    barThickness: 42,
                    backgroundColor: 'rgba(255, 223, 160, 0.8)',
                    borderWidth: 1,
                    borderRadius: {
                        topLeft: 10, topRight: 10, bottomLeft: 0, bottomRight: 0
                    },
                    order: 2,
                    stack: 'combined'
                }
            ]
        };
    
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value < 60 ? value + ' menit' : (value / 60).toFixed(1) + ' jam';
                            }
                        },
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle'
                        },
                        onClick: null
                    },
                    tooltip: {
                        mode: 'nearest',
                        intersect: true,
                        callbacks: {
                            label: function(tooltipItem) {
                                let label = tooltipItem.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                const value = tooltipItem.raw;
                                label += value < 60 ? `${value} menit` : `${(value / 60).toFixed(1)} jam`;
                                return label;
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    intersect: true
                }
            }
        };
    
        const ctx = document.getElementById('shipmentDeliveryChart').getContext('2d');
        new Chart(ctx, config);
    </script>    
    
    {{-- script untuk statistik perbandingan kelas  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
          const data = {
            labels: ['Selesai', 'Proses', 'Expired'],
            datasets: [{
                data: @json([$kelasSelesai, $kelasDalamProses, $kelasTidakTuntas]),
                backgroundColor: ['#4477CE', '#8CABFF', '#CBDCEB'],
                hoverOffset: 20,
                borderRadius: 10
            }]
          };
      
          const config = {
            type: 'doughnut',
            data: data,
            options: {
              responsive: true,
              plugins: {
                legend: {
                  position: 'bottom',
                  labels: {
                    usePointStyle: true,  // Mengubah ikon legend menjadi lingkaran
                    pointStyle: 'circle',
                    padding: 20,
                  },
                },
                tooltip: {
                  enabled: true
                },
            },
            layout: {
                padding: {
                    top: 20,
                }
            },
              onClick: function (event, elements) {
                if (elements.length > 0) {
                  const clickedElementIndex = elements[0].index;
                  let dataset = this.data.datasets[0];
                  if (!dataset._originalHoverOffset) {
                    dataset._originalHoverOffset = dataset.hoverOffset;
                  }
                  dataset.hoverOffset = (dataset.hoverOffset === 20 && dataset.data[clickedElementIndex] === dataset._originalHoverOffset) ? 0 : 20;
                  this.update();
                }
              }
            }
          };
      
          const myDoughnutChart = new Chart(
            document.getElementById('myDoughnutChart'),
            config
          );
        });
    </script>

    {{-- script untuk statistik kategori disukai --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data kursus yang disukai (dalam persentase)
            const data = {
                labels: @json($kategoriLabels),
                datasets: [{
                    label: 'Persentase Kursus yang Disukai',
                    data: @json($kategoriCounts), // Data dalam persentase
                    backgroundColor: [
                        '#ff6384', // Warna untuk masing-masing bar
                        '#36a2eb',
                        '#cc65fe',
                        '#ffce56',
                        '#4bc0c0'
                    ],
                    borderWidth: 1,
                    borderRadius: 10, // Membuat bar rounded
                    barThickness: 20, // Atur ketebalan bar
                    maxBarThickness: 20, // Batasi ketebalan maksimum bar
                }]
            };
    
            // Konfigurasi chart
            const config = {
                type: 'bar',
                data: data,
                options: {
                    indexAxis: 'y', // Membuat bar chart horizontal
                    scales: {
                        x: {
                            beginAtZero: true, // Mulai dari 0 di sumbu X
                            suggestedMax: Math.max(...data.datasets[0].data) + 10, // Sesuaikan sumbu X berdasarkan data
                            grid: {
                                display: true, // Tampilkan garis vertikal
                                drawBorder: false, // Hilangkan garis batas
                                color: 'rgba(0, 0, 0, 0.1)', // Garis vertikal lembut
                                borderDash: [5, 5], // Gaya garis-garis
                                lineWidth: 0.5 // Atur ketebalan garis vertikal agar lebih kecil
                            }
                        },
                        y: {
                            grid: {
                                display: false, // Hilangkan garis horizontal
                            }
                        }
                    },
                    responsive: true,
                    plugins: {
                        tooltip: {
                            enabled: true, // Aktifkan tooltips
                        },
                        legend: {
                            display: false // Sembunyikan legenda
                        }
                    },
                    onLeave: function() {
                        const chart = this;
    
                        // Kembalikan warna asli ketika tidak ada hover
                        chart.data.datasets[0].backgroundColor = ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#4bc0c0'];
                        chart.update();
                    },
                    barPercentage: 0.8, // Kurangi sedikit lebar bar
                    categoryPercentage: 0.6, // Kurangi jarak antar bar lebih agresif
                    layout: {
                        padding: {
                            top: 0,
                            bottom: 0
                        }
                    }
                }
            };
    
            // Inisialisasi chart dengan ID canvas 'myHorizontalBarChart'
            const myHorizontalBarChart = new Chart(
                document.getElementById('myHorizontalBarChart'),
                config
            );
        });
    </script>

    {{-- script untuk button scroll detail kelas progress --}}
    <script>
        document.getElementById("detail").addEventListener("click", function(event) {
            event.preventDefault();
            document.querySelector("#detailprogress").scrollIntoView({ behavior: "smooth" });
        });
    </script>

    {{-- script untuk melihat statistik skor karyawan --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const options = {
                chart: {
                    height: 250,
                    type: 'radialBar',
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                    },
                    toolbar: {
                        show: false
                    },
                },
                series: [{{ $percentage }}], // Persentase dari controller
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: '60%'
                        },
                        dataLabels: {
                            name: {
                                offsetY: -10,
                                color: '#646e78',
                                fontSize: '15px',
                                fontWeight: 500
                            },
                            value: {
                                offsetY: 5,
                                color: '#384551',
                                fontSize: '24px',
                                fontWeight: 500,
                                show: true
                            }
                        },
                        track: {
                            strokeWidth: '18',
                            background: '#e0e0e0',
                            strokeDashArray: 5
                        }
                    }
                },
                labels: ['Memiliki {{ $userScore }} ⭐'] // Skor dari controller
            };
    
            const chart = new ApexCharts(document.querySelector("#scoreChart"), options);
            chart.render();
        });
    </script>

    {{-- script untuk grafik riwayat transaksi --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var bulan = @json($bulan);
            var dataTransaksi = @json($dataTransaksi);

            var options = {
                series: [{
                name: 'Total Transaksi',
                data: dataTransaksi
                // data: "["3000", "8000", "7000", "5000", "5000", "9000"]" // example data
                }],
                chart: {
                    type: 'line',
                    height: 310,
                    toolbar: { show: false },
                    dropShadow: {
                        enabled: true,
                        color: '#6365f1b3',
                        top: 10,        // Menggeser shadow ke bawah
                        left: 0,       // Tetap lurus vertikal
                        blur: 5,      // Lebar blur shadow
                        opacity: 1,  // Opacity awal shadow
                        opacityTo: 0
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3,
                    colors: ['#6366F1']
                },
                fill: {
                    type: 'gradient'
                },
                xaxis: {
                    categories: bulan,
                    // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: {
                        style: {
                        colors: '#9CA3AF'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: (val) => `${val / 1000}k`,
                        style: {
                        colors: '#9CA3AF'
                        }
                    }
                },
                grid: {
                show: true,
                borderColor: '#E5E7EB',
                strokeDashArray: 7,
                },
                tooltip: {
                enabled: true,
                y: {
                    formatter: (val) => `IDR ${val}`
                }
                },
                markers: {
                size: 5,
                colors: ['#6366F1'],
                strokeColors: '#fff',
                strokeWidth: 2,
                hover: {
                    size: 8
                }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
            });

    </script>

    {{-- script untuk grafik koin terbuang --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var bulan = @json($bulan);
            var dataTransaksi = ["0","0","0","0","0","0","0","0","450000","800000","0","0"];

            var options = {
                series: [{
                name: 'Total Transaksi',
                data: dataTransaksi
                // data: "["3000", "8000"]" // example data
                }],
                chart: {
                    type: 'line',
                    height: 310,
                    toolbar: { show: false },
                    dropShadow: {
                        enabled: true,
                        color: '#6365f1b3',
                        top: 10,        // Menggeser shadow ke bawah
                        left: 0,       // Tetap lurus vertikal
                        blur: 5,      // Lebar blur shadow
                        opacity: 1,  // Opacity awal shadow
                        opacityTo: 0
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3,
                    colors: ['#6366F1']
                },
                fill: {
                    type: 'gradient'
                },
                xaxis: {
                    categories: bulan,
                    // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: {
                        style: {
                        colors: '#9CA3AF'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: (val) => `${val / 1000}k`,
                        style: {
                        colors: '#9CA3AF'
                        }
                    }
                },
                grid: {
                show: true,
                borderColor: '#E5E7EB',
                strokeDashArray: 7,
                },
                tooltip: {
                enabled: true,
                y: {
                    formatter: (val) => `IDR ${val}`
                }
                },
                markers: {
                size: 5,
                colors: ['#6366F1'],
                strokeColors: '#fff',
                strokeWidth: 2,
                hover: {
                    size: 8
                }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartKoinTerbuang"), options);
            chart.render();
            });
    </script>

    {{-- script tahun dropdown --}}
    <script>
        // Mendapatkan elemen tombol utama yang menampilkan tahun
        const selectedYearButton = document.getElementById('selectedYear');
        // Mendapatkan tahun saat ini
        const currentYear = new Date().getFullYear();
        const yearDropdown = document.getElementById('yearDropdown');
    
        // Menambahkan beberapa tahun ke dropdown, mulai dari tahun ini hingga 4 tahun sebelumnya
        for (let i = 0; i < 5; i++) {
            const yearItem = document.createElement('li');
            yearItem.innerHTML = `<a class="dropdown-item" href="javascript:void(0);">${currentYear - i}</a>`;
            
            // Menambahkan event listener untuk mengubah teks tahun pada tombol utama ketika dipilih
            yearItem.addEventListener('click', function() {
                selectedYearButton.innerText = this.innerText;
            });
    
            yearDropdown.appendChild(yearItem);
        }
    </script>

    {{-- script untuk kalender --}}
    <script>
        const daysElement = document.getElementById("days");
        const monthDisplay = document.getElementById("current-month");
        const prevWeekBtn = document.getElementById("prev-week");
        const nextWeekBtn = document.getElementById("next-week");

        let currentDate = new Date();
        let startOfWeek = getStartOfWeek(currentDate);

        function getStartOfWeek(date) {
            const day = date.getDay();
            const diff = date.getDate() - day; // Get the first day of the current week (Sunday)
            return new Date(date.setDate(diff));
        }

        function updateCalendar() {
            const year = startOfWeek.getFullYear();
            const month = startOfWeek.getMonth();

            // Set month display
            const monthNames = [
                "January", "February", "March", "April", "May", "June", 
                "July", "August", "September", "October", "November", "December"
            ];
            monthDisplay.innerText = `${monthNames[month]} ${year}`;

            // Generate 7 days starting from the current week
            daysElement.innerHTML = "";  // Clear previous days

            for (let i = 0; i < 7; i++) {
                const dayDiv = document.createElement("div");
                const date = new Date(startOfWeek);
                date.setDate(startOfWeek.getDate() + i);

                dayDiv.innerText = date.getDate();

                // Highlight today's date
                const today = new Date();
                if (
                    date.getDate() === today.getDate() &&
                    date.getMonth() === today.getMonth() &&
                    date.getFullYear() === today.getFullYear()
                ) {
                    dayDiv.classList.add("today");
                }

                // Select day on click
                dayDiv.addEventListener("click", () => {
                    const selectedDay = document.querySelector(".selected");
                    if (selectedDay) {
                        selectedDay.classList.remove("selected");
                    }
                    dayDiv.classList.add("selected");
                });

                daysElement.appendChild(dayDiv);
            }
        }

        // Navigate to the previous week
        prevWeekBtn.addEventListener("click", () => {
            startOfWeek.setDate(startOfWeek.getDate() - 7);
            updateCalendar();
        });

        // Navigate to the next week
        nextWeekBtn.addEventListener("click", () => {
            startOfWeek.setDate(startOfWeek.getDate() + 7);
            updateCalendar();
        });

        // Initialize calendar
        updateCalendar();
    </script>

<script>
    // Data dummy transaksi per departemen
    const transactionData = {
        // Data untuk semua departemen
        all: {
            thisMonth: Array.from({ length: 31 }, (_, i) => ({
                date: `${i + 1} ${new Date().toLocaleString('id-ID', { month: 'short' })}`,
                value: Math.floor(Math.random() * (95 - 40) + 40)
            })),
            lastMonth: Array.from({ length: 31 }, (_, i) => ({
                date: `${i + 1} ${new Date(new Date().setMonth(new Date().getMonth() - 1)).toLocaleString('id-ID', { month: 'short' })}`,
                value: Math.floor(Math.random() * (90 - 35) + 35)
            })),
            thisYear: Array.from({ length: 12 }, (_, i) => ({
                date: new Date(2024, i, 1).toLocaleString('id-ID', { month: 'short' }),
                value: Math.floor(Math.random() * (1000 - 600) + 600)
            })),
            lastYear: Array.from({ length: 12 }, (_, i) => ({
                date: new Date(2023, i, 1).toLocaleString('id-ID', { month: 'short' }),
                value: Math.floor(Math.random() * (900 - 500) + 500)
            }))
        },
        // ... [Data departemen lain tetap sama]
    };

    // Fungsi untuk format tanggal
    function formatDate(date) {
        return date.toLocaleString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    }

    // Fungsi untuk mendapatkan data berdasarkan filter
    function getFilteredData(department = 'all', timeRange = 'month', startDate = null, endDate = null) {
        const deptData = transactionData[department] || transactionData.all;
        
        switch(timeRange) {
            case 'year':
                return {
                    labels: deptData.thisYear.map(item => item.date),
                    datasets: [
                        {
                            label: 'Tahun ini',
                            data: deptData.thisYear.map(item => item.value),
                            backgroundColor: 'rgb(102, 199, 50)',
                            borderColor: '#696CFF',
                            barThickness: 20,
                            borderRadius: 4,
                            maxBarThickness: 15
                        },
                        {
                            label: 'Tahun lalu',
                            data: deptData.lastYear.map(item => item.value),
                            backgroundColor: 'rgb(198, 241, 175)',
                            borderColor: '#E7E7FF',
                            barThickness: 20,
                            borderRadius: 4,
                            maxBarThickness: 15
                        }
                    ]
                };
            case 'custom':
                if (startDate && endDate) {
                    // Generate data untuk rentang tanggal custom
                    const days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
                    const customData = Array.from({ length: days }, (_, i) => {
                        const currentDate = new Date(startDate);
                        currentDate.setDate(startDate.getDate() + i);
                        return {
                            date: formatDate(currentDate),
                            value: Math.floor(Math.random() * (95 - 40) + 40)
                        };
                    });

                    return {
                        labels: customData.map(item => item.date),
                        datasets: [
                            {
                                label: `${formatDate(startDate)} - ${formatDate(endDate)}`,
                                data: customData.map(item => item.value),
                                backgroundColor: 'rgb(102, 199, 50)',
                                borderColor: '#696CFF',
                                barThickness: 20,
                                borderRadius: 4,
                                maxBarThickness: 15
                            }
                        ]
                    };
                }
                return null;
            default: // month
                return {
                    labels: deptData.thisMonth.map(item => item.date),
                    datasets: [
                        {
                            label: 'Bulan ini',
                            data: deptData.thisMonth.map(item => item.value),
                            backgroundColor: 'rgb(102, 199, 50)',
                            borderColor: '#696CFF',
                            barThickness: 20,
                            borderRadius: 4,
                            maxBarThickness: 15
                        },
                        {
                            label: 'Bulan lalu',
                            data: deptData.lastMonth.map(item => item.value),
                            backgroundColor: 'rgb(198, 241, 175)',
                            borderColor: '#E7E7FF',
                            barThickness: 20,
                            borderRadius: 4,
                            maxBarThickness: 15
                        }
                    ]
                };
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        // Inisialisasi Datepicker untuk custom range
        const dateRangePicker = document.getElementById('dateRangePickerTransaksi');
        const dateRangeSelect = document.getElementById('dateRangeSelectTransaksi');
        const departmentSelect = document.getElementById('departmentSelect');
        const applyFilterBtn = document.getElementById('applyFilterTransaksi');
        
        // Inisialisasi daterangepicker
        if (dateRangePicker) {
            new DateRangePicker(dateRangePicker, {
                format: 'yyyy-mm-dd',
                language: 'id',
                autoclose: true
            });
        }

        // Toggle tampilan date range picker
        dateRangeSelect.addEventListener('change', function() {
            dateRangePicker.style.display = this.value === 'custom' ? 'block' : 'none';
        });

        // Inisialisasi Chart
        const ctx = document.getElementById('weeklyReportChart');
        
        // Konfigurasi default chart
        const config = {
            type: 'bar',
            data: {
                labels: [],
                datasets: []
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#566a7f',
                        bodyColor: '#566a7f',
                        borderColor: '#d9dee3',
                        borderWidth: 1,
                        padding: 10,
                        usePointStyle: true,
                        displayColors: false,
                        callbacks: {
                            label: function (context) {
                                return `${context.dataset.label}: ${context.parsed.y.toLocaleString('id-ID')}.000`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 20,
                            callback: function (value) {
                                return value.toLocaleString('id-ID') + '.000';
                            },
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            borderDash: [5, 5],
                            drawBorder: false,
                            color: '#ECEEF1'
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#566a7f',
                            font: {
                                size: 11
                            },
                            maxRotation: 45,
                            minRotation: 45
                        },
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        };

        // Inisialisasi chart
        window.weeklyChart = new Chart(ctx, config);

        // Fungsi untuk update chart
        function updateChart(chartData) {
            if (window.weeklyChart && chartData) {
                window.weeklyChart.data.labels = chartData.labels;
                window.weeklyChart.data.datasets = chartData.datasets;
                
                // Update max value di y axis berdasarkan data tertinggi
                const maxValue = Math.max(
                    ...chartData.datasets.flatMap(dataset => dataset.data)
                );
                window.weeklyChart.options.scales.y.max = Math.ceil(maxValue / 100) * 100;
                
                window.weeklyChart.update();
            }
        }

        // Event listener untuk filter
        function applyFilters() {
            const department = departmentSelect.value;
            const timeRange = dateRangeSelect.value;
            let startDate = null;
            let endDate = null;

            if (timeRange === 'custom' && dateRangePicker.value) {
                const [start, end] = dateRangePicker.value.split(' - ');
                startDate = new Date(start);
                endDate = new Date(end);
            }

            const chartData = getFilteredData(department, timeRange, startDate, endDate);
            updateChart(chartData);
        }

        // Event listeners
        departmentSelect.addEventListener('change', applyFilters);
        dateRangeSelect.addEventListener('change', applyFilters);
        applyFilterBtn.addEventListener('click', applyFilters);

        // Load data awal
        const initialData = getFilteredData();
        updateChart(initialData);

        // Resize handler
        window.addEventListener('resize', function () {
            if (window.weeklyChart) {
                window.weeklyChart.resize();
            }
        });
    });
</script>
@endsection

