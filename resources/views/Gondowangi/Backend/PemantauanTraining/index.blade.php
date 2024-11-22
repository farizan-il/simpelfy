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
                    <h6 class="card-title mb-1">Table Pemantauan Data Training</h6>
                    <p class="card-subtitle">Ringkasan Karyawan Yang Sudah Mengikuti</p>
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
                    
                    <div class="me-2">
                        <select id="departmentFilter" class="form-select" data-allow-clear="true">
                            <option value="all" selected>Semua Departemen</option>
                            <option value="HCD">HCD</option>
                            <option value="Warehouse">Warehouse</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Logistik">Logistik</option>
                            <option value="Sales Mizzu">Sales Mizzu</option>
                            <option value="QAC">QAC</option>
                            <option value="PPIC">PPIC</option>
                            <option value="BD RND">BD RND</option>
                            <option value="GA">GA</option>
                        </select>
                    </div>

                    <form class="d-flex" onsubmit="return false">
                        <input id="smallInput" class="form-control form-control-sm me-2" type="search" placeholder="Cari Judul atau Nama"/>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table-1">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th class="text-nowrap">Nama Lengkap</th>
                                <th>Departemen</th>
                                <th>Training</th>
                                <th>Pelaksana</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>08 Maret 2024</td>
                                <td>Ai Opiasari Lusiana Rahmawati</td>
                                <td>Warehouse</td>
                                <td>Managing Stress At Work: Stress Less, Achieve More</td>
                                <td>Eksternal UBM</td>
                            </tr>
                            <tr>
                                <td>08 Maret 2024</td>
                                <td>Abu Bakar Nata Prawira</td>
                                <td>Warehouse</td>
                                <td>Managing Stress At Work: Stress Less, Achieve More</td>
                                <td>Eksternal UBM</td>
                            </tr>
                            <tr>
                                <td>08 Maret 2024</td>
                                <td>Hendra Kurniawan</td>
                                <td>Sales</td>
                                <td>Managing Stress At Work: Stress Less, Achieve More</td>
                                <td>Eksternal UBM</td>
                            </tr>
                            <tr>
                                <td>08 Maret 2024</td>
                                <td>Lidwina Diah Paranita</td>
                                <td>HCD</td>
                                <td>Managing Stress At Work: Stress Less, Achieve More</td>
                                <td>Eksternal UBM</td>
                            </tr>
                            <tr>
                                <td>08 Maret 2024</td>
                                <td>Putri Intan Nadira</td>
                                <td>QAC</td>
                                <td>Managing Stress At Work: Stress Less, Achieve More</td>
                                <td>Eksternal UBM</td>
                            </tr>
                            <tr>
                                <td>08 Maret 2024</td>
                                <td>Nurul Anisa</td>
                                <td>Sales Mizzu</td>
                                <td>Managing Stress At Work: Stress Less, Achieve More</td>
                                <td>Eksternal UBM</td>
                            </tr>
                            <tr>
                                <td>08 Maret 2024</td>
                                <td>Fallya Pratiyi H</td>
                                <td>Marketing</td>
                                <td>Managing Stress At Work: Stress Less, Achieve More</td>
                                <td>Eksternal UBM</td>
                            </tr>
                            <tr>
                                <td>08 Maret 2024</td>
                                <td>Ai Opiasari Lusiana Rahmawati</td>
                                <td>Warehouse</td>
                                <td>Managing Stress At Work: Stress Less, Achieve More</td>
                                <td>Internal</td>
                            </tr>
                            <tr>
                                <td>11 Juni 2024</td>
                                <td>Elyza</td>
                                <td>PPIC</td>
                                <td>Kompetensi Administrasi Perkantoran</td>
                                <td>Eksternal UNJ</td>
                            </tr>
                            <tr>
                                <td>11 Juni 2024</td>
                                <td>Ai Opiasari</td>
                                <td>LOGISTIK</td>
                                <td>Kompetensi Administrasi Perkantoran</td>
                                <td>Eksternal UNJ</td>
                            </tr>
                            <tr>
                                <td>11 Juni 2024</td>
                                <td>Abu Bakar Nata Prawira</td>
                                <td>LOGISTIK</td>
                                <td>Kompetensi Administrasi Perkantoran</td>
                                <td>Eksternal UNJ</td>
                            </tr>
                            <tr>
                                <td>11 Juni 2024</td>
                                <td>DITA ANANDA PUTRI</td>
                                <td>LOGISTIK</td>
                                <td>Kompetensi Administrasi Perkantoran</td>
                                <td>Eksternal UNJ</td>
                            </tr>
                            <tr>
                                <td>11 Juni 2024</td>
                                <td>Lidwina</td>
                                <td>HUMAN CAPITAL</td>
                                <td>Kompetensi Administrasi Perkantoran</td>
                                <td>Eksternal UNJ</td>
                            </tr>
                            <tr>
                                <td>11 Juni 2024</td>
                                <td>Eka septiana</td>
                                <td>SALES</td>
                                <td>Kompetensi Administrasi Perkantoran</td>
                                <td>Eksternal UNJ</td>
                            </tr>
                            <tr>
                                <td>11 Juni 2024</td>
                                <td>Nurul Anisa</td>
                                <td>SALES</td>
                                <td>Kompetensi Administrasi Perkantoran</td>
                                <td>Eksternal UNJ</td>
                            </tr>
                            <tr>
                                <td>11 Juni 2024</td>
                                <td>Sri Lestari</td>
                                <td>GA</td>
                                <td>Kompetensi Administrasi Perkantoran</td>
                                <td>Eksternal UNJ</td>
                            </tr>
                            <tr>
                                <td>11 Juni 2024</td>
                                <td>Ida Marsela</td>
                                <td>GA</td>
                                <td>Kompetensi Administrasi Perkantoran</td>
                                <td>Eksternal UNJ</td>
                            </tr>
                            <tr>
                                <td>12 Juni 2024</td>
                                <td>ADITYAR INDRA PANGESTU</td>
                                <td>IT</td>
                                <td>Good Documentation Practice</td>
                                <td>Internal</td>
                            </tr>
                            <tr>
                                <td>12 Juni 2024</td>
                                <td>Bayu Andi Saputra</td>
                                <td>BD RND</td>
                                <td>Good Documentation Practice</td>
                                <td>Internal</td>
                            </tr>
                            <tr>
                                <td>12 Juni 2024</td>
                                <td>Mita</td>
                                <td>BD RND</td>
                                <td>Good Documentation Practice</td>
                                <td>Internal</td>
                            </tr>
                            <tr>
                                <td>12 Juni 2024</td>
                                <td>Achmad Fatah</td>
                                <td>LOGISTIK</td>
                                <td>Good Documentation Practice</td>
                                <td>Internal</td>
                            </tr>
                            <tr>
                                <td>12 Juni 2024</td>
                                <td>DITA ANANDA PUTRI</td>
                                <td>LOGISTIK</td>
                                <td>Good Documentation Practice</td>
                                <td>Internal</td>
                            </tr>
                            <tr>
                                <td>12 Juni 2024</td>
                                <td>Widra Kristian</td>
                                <td>BD RND</td>
                                <td>Good Documentation Practice</td>
                                <td>Internal</td>
                            </tr>
                            <tr>
                                <td>12 Juni 2024</td>
                                <td>Putri Intan Nadira</td>
                                <td>QAC</td>
                                <td>Good Documentation Practice</td>
                                <td>Internal</td>
                            </tr>
                            <tr>
                                <td>12 Juni 2024</td>
                                <td>Lidwina</td>
                                <td>HUMAN CAPITAL</td>
                                <td>Good Documentation Practice</td>
                                <td>Internal</td>
                            </tr>
                            <tr>
                                <td>12 Juni 2024</td>
                                <td>Nurul Fadilah</td>
                                <td>QAC</td>
                                <td>Good Documentation Practice</td>
                                <td>Internal</td>
                            </tr>
                            <tr>
                                <td>12 Juni 2024</td>
                                <td>Adam Hakal Yakin</td>
                                <td>HUMAN CAPITAL</td>
                                <td>Good Documentation Practice</td>
                                <td>Internal</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
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
            // Data untuk header tambahan
            const headers = [
                ["No", "Tanggal/Bln", "Nama Lengkap", "Departement", "Training", "Pelaksana"]
            ];
            
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
            const yearSelect = document.getElementById('yearFilter');
            const departmentSelect = document.getElementById('departmentFilter');
            const searchInput = document.getElementById('smallInput');
            
            const selectedYear = yearSelect.value;
            const selectedDepartment = departmentSelect.value;
            const searchText = searchInput.value.toLowerCase();
            
            const table = document.getElementById('table-1');
            const rows = table.getElementsByTagName('tr');

            // Loop through all rows (skip header row)
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                
                // Skip if row doesn't have enough cells
                if (cells.length < 5) continue;
                
                // Get values from cells
                const dateText = cells[0].textContent;
                const year = extractYear(dateText);
                const nameText = cells[1].textContent.toLowerCase();
                const departmentText = cells[2].textContent;
                const trainingText = cells[3].textContent.toLowerCase();
                
                // Check if row matches all active filters
                const matchesYear = selectedYear === 'all' || year === selectedYear;
                const matchesDepartment = selectedDepartment === 'all' || departmentText === selectedDepartment;
                const matchesSearch = searchText === '' || 
                                    nameText.includes(searchText) || 
                                    trainingText.includes(searchText);
                
                // Show/hide row based on filter results
                row.style.display = (matchesYear && matchesDepartment && matchesSearch) ? '' : 'none';
            }
        }

        // Add event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const yearSelect = document.getElementById('yearFilter');
            const departmentSelect = document.getElementById('departmentFilter');
            const searchInput = document.getElementById('smallInput');
            
            // Add change event listeners to all filters
            yearSelect.addEventListener('change', filterTable);
            departmentSelect.addEventListener('change', filterTable);
            searchInput.addEventListener('keyup', filterTable);
            
            // Optional: Clear filters when form is reset
            document.querySelector('form').addEventListener('reset', function() {
                yearSelect.value = 'all';
                departmentSelect.value = 'all';
                searchInput.value = '';
                filterTable();
            });
        });
    </script>

@endsection