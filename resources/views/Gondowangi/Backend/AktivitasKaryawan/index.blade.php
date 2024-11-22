@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="card" style="background-color: rgb(247, 251, 255)">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <h6 class="card-title mb-1">Table Aktivitas Karyawan</h6>
                </div>
                <div class="d-flex">
                    <div class="me-2">
                        <select id="yearFilter" class="form-select" data-allow-clear="true">
                            <option value="all" selected>Semua Tahun</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>

                    <form class="d-flex" onsubmit="return false">
                        <input id="smallInput" class="form-control form-control-sm me-2" type="search" placeholder="Cari Nama Karyawan atau Kelas" style="width: 240px;">
                        <button id="export-excel" class="btn btn-primary btn-sm me-2 py-0">
                            <i class='bx bx-cloud-download me-2 bx-sm' ></i> Export 
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>Nama Kelas</th>
                                <th>Progress</th>
                                <th class="text-nowrap">Nama Karyawan</th>
                                <th>Status</th>
                                <th>Tanggal Mulai</th>
                                <th class="text-nowrap">Tanggal Selesai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aktivitas as $item)
                                <tr>
                                    <td class="text-nowrap">{{ $item->kelas->title }}</td>
                    
                                    @php
                                        $totalModul = $item->userprogress->count();  
                                        $completedModul = $item->userprogress->where('status', 'selesai')->count(); 
                                        $progress = $totalModul > 0 ? ($completedModul / $totalModul) * 100 : 0; 
                                    @endphp
                    
                                    <td class="align-middle" style="cursor: pointer;">
                                        <div 
                                            class="progress" 
                                            style="height: 4px;" 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="{{ $progress }}%">
                                            <div 
                                                class="progress-bar bg-success" 
                                                role="progressbar" 
                                                style="width: {{ $progress }}%;" 
                                                aria-valuenow="{{ $progress }}" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->credentials->profile->nama ?? 'N/A' }}</td>
                                    <td>
                                        @if ($progress == 100)
                                        <span class="badge bg-label-success me-1 fw-bold">Selesai</span>
                                        @else
                                        <span class="badge bg-label-warning me-1 fw-bold">Proses</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">{{ \Carbon\Carbon::parse($item->tanggalPembelian)->format('d M Y') }}</td>
                                    <td class="text-nowrap">{{ \Carbon\Carbon::parse($item->masaAktif)->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn d-inline btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalDetail">
                                                Detail
                                            </button>
                                            <button type="button" class="btn d-inline btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                onclick="setUserId('{{ $item->credentials->id }}')">
                                                Kirim Notifikasi
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    {{-- modal aktivitas  --}}
    <div class="modal fade" id="modalDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail Aktivitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-lg-5 col-md-12 col-sm-12 mb-3">
                            <img class="rounded img-responsive" src="https://www.rnp.br/arquivos/2023-07/03_rnp_hdb_bannersitesbseg_ec.jpg?VersionId=je4wEEmkq_hnO9Cj_F9FP5G7wH5mH3BL" alt="" width="100%">
                        </div>
                        <div class="col-lg-7 col-md-12 col-sm-12">
                            <div class="card-body pt-0 px-0">
                                <label for="" class="text-primary"><strong>3 Bagian dan 14 Pelajaran Belum Diselesaikan</strong></label>
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Panel 1 - Belum Selesai
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ul class="list-group list-group-flush">
                                                    <a href="#" class="text-dark nav-link m-0 p-0">
                                                        <i class="fa fa-play-circle text-primary me-3"></i> 
                                                        Pelajaran Pertama
                                                    </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Panel 2
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                consequat.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Panel 3
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                consequat.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </div>
    </div>


    {{-- modal untuk mengirim notifikasi ke user --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Masukan Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="sendNotificationForm" method="POST" action="{{ route('aktivitaskaryawan.sendNotification') }}">
                        @csrf
                        <input type="hidden" id="user_credentials_id" name="user_credentials_id"> <!-- ID pengguna -->
                        <textarea name="message" class="form-control" id="message" rows="10" placeholder="Masukkan notifikasi"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="sendNotificationForm" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </div>
    </div>    
@endsection


@section('script')
<script>
    function setUserId(userId) {
        document.getElementById('user_credentials_id').value = userId;
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

{{-- script export to excel --}}
<script>
    document.getElementById('export-excel').addEventListener('click', function () {
        const headers = [["No", "Nama Kelas", "Progress", "Nama Karyawan", "Status", "Tanggal Mulai", "Tanggal Selesai"]];

        
        // Ambil data dari tabel HTML
        const table = document.getElementById('table-1');
        const tableData = [];
        let counter = 1;
        
        // Mengambil data dari tabel dan menambahkan nomor urut
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const rowData = [
                counter++,
                row.cells[0].textContent,
                row.cells[1].textContent,
                row.cells[2].textContent,
                row.cells[3].textContent,
                row.cells[4].textContent
            ];
            tableData.push(rowData);
        });
    
        // Buat worksheet baru
        const ws = XLSX.utils.aoa_to_sheet([
            ["PEMANTAUAN DATA TRAINING KARYAWAN GONDOWANGI 2024"],
            [],  // Baris kosong
            ...headers,
            ...tableData
        ]);
    
        // Styling untuk judul
        ws['A1'] = { 
            v: "PEMANTAUAN DATA TRAINING KARYAWAN GONDOWANGI 2024",
            s: {
                font: { bold: true, sz: 14 },
                alignment: { horizontal: "center" }
            }
        };
    
        // Merge cells untuk judul
        ws["!merges"] = [
            { s: { r: 0, c: 0 }, e: { r: 0, c: 5 } }  // Merge A1:F1
        ];
    
        // Styling untuk header tabel
        const headerStyle = {
            fill: { 
                fgColor: { rgb: "92D050" },  // Warna hijau
                patternType: "solid" 
            },
            font: { 
                bold: true,
                color: { rgb: "000000" }  // Warna text hitam
            },
            alignment: { 
                horizontal: "center", 
                vertical: "center",
                wrapText: true  // Wrap text jika terlalu panjang
            },
            border: {
                top: { style: "thin", color: { rgb: "000000" } },
                bottom: { style: "thin", color: { rgb: "000000" } },
                left: { style: "thin", color: { rgb: "000000" } },
                right: { style: "thin", color: { rgb: "000000" } }
            }
        };
    
        // Terapkan style ke header
        ["A3", "B3", "C3", "D3", "E3", "F3"].forEach(cell => {
            ws[cell].s = headerStyle;
        });
    
        // Styling untuk data cells
        const dataStyle = {
            border: {
                top: { style: "thin", color: { rgb: "000000" } },
                bottom: { style: "thin", color: { rgb: "000000" } },
                left: { style: "thin", color: { rgb: "000000" } },
                right: { style: "thin", color: { rgb: "000000" } }
            },
            alignment: { 
                vertical: "center",
                wrapText: true
            }
        };
    
        // Terapkan style ke data cells
        tableData.forEach((row, idx) => {
            ["A", "B", "C", "D", "E", "F"].forEach((col, colIdx) => {
                const cellRef = `${col}${idx + 4}`;  // +4 karena data dimulai setelah judul dan header
                if (ws[cellRef]) {
                    ws[cellRef].s = dataStyle;
                }
            });
        });
    
        // Atur lebar kolom
        ws['!cols'] = [
            { wch: 5 },   // No
            { wch: 12 },  // Tanggal/Bln
            { wch: 30 },  // Nama Lengkap
            { wch: 15 },  // Departement
            { wch: 45 },  // Training
            { wch: 15 }   // Pelaksana
        ];
    
        // Tambahkan AutoFilter
        ws['!autofilter'] = { ref: `A3:F${tableData.length + 3}` };
    
        // Buat workbook baru
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Data Training");
    
        // Export ke file Excel
        XLSX.writeFile(wb, 'Data_Training.xlsx');
    });
</script>

<script>
    // Fungsi untuk mencari data dalam tabel
    document.getElementById('smallInput').addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const table = document.getElementById('table-1');
        const rows = table.getElementsByTagName('tr');

        // Loop melalui semua baris tabel, mulai dari index 1 untuk melewati header
        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const cells = row.getElementsByTagName('td');
            let found = false;

            // Cek setiap sel dalam baris (fokus pada nama dan training)
            const namaText = cells[1].textContent.toLowerCase(); // Kolom Nama Lengkap
            const trainingText = cells[3].textContent.toLowerCase(); // Kolom Training

            // Jika nama atau training mengandung text pencarian, tampilkan baris
            if (namaText.includes(searchText) || trainingText.includes(searchText)) {
                found = true;
            }

            // Tampilkan atau sembunyikan baris berdasarkan hasil pencarian
            row.style.display = found ? '' : 'none';
        }
    });

    // Optional: Clear search ketika form di-reset
    document.querySelector('form').addEventListener('reset', function() {
        const table = document.getElementById('table-1');
        const rows = table.getElementsByTagName('tr');
        
        // Tampilkan kembali semua baris
        for (let i = 1; i < rows.length; i++) {
            rows[i].style.display = '';
        }
    });
</script>

<script>
    function extractYear(dateStr) {
        return dateStr.split(' ')[2];
    }

    // Main filtering function
    function filterTable() {
        const yearFilter = document.getElementById('yearFilter').value.toLowerCase();
        const searchText = document.getElementById('smallInput').value.toLowerCase();
        const table = document.getElementById('table-1');
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const namaKaryawan = row.cells[2]?.textContent.toLowerCase(); // Nama Karyawan
            const namaKelas = row.cells[0]?.textContent.toLowerCase(); // Nama Kelas
            const tahun = row.cells[4]?.textContent.split(' ')[2]?.toLowerCase(); // Tanggal Mulai (Kolom 4)

            // Filter logika: tampilkan jika cocok
            const matchSearch = !searchText || namaKaryawan.includes(searchText) || namaKelas.includes(searchText);
            const matchYear = yearFilter === 'all' || tahun === yearFilter;

            // Tampilkan baris jika cocok dengan semua filter
            row.style.display = matchSearch && matchYear ? '' : 'none';
        });
    }

    // Add event listeners
    document.getElementById('smallInput').addEventListener('keyup', filterTable);

    // Event listener untuk select filter tahun
    document.getElementById('yearFilter').addEventListener('change', filterTable);

    // Reset filter jika form disubmit
    document.querySelector('form').addEventListener('reset', () => {
        document.getElementById('smallInput').value = '';
        document.getElementById('yearFilter').value = 'all';
        filterTable(); // Tampilkan kembali semua baris
    });
</script>
@endsection