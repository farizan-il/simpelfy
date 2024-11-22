@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h6 class="card-title mb-1">Table Data Informasi</h6>
            </div>
            <div class="d-flex align-items-center">
                <a href="#" class="btn btn-primary btn-sm me-2 d-none d-md-inline" data-bs-toggle="modal" data-bs-target="#addinformasiModal" style="height: 36px;">
                    <i class="bx bx-plus-circle p-0 m-0"></i> Menambahkan informasi
                </a>

                <div class="me-2">
                    <select id="sortFilter" class="form-select form-select-sm" style="width: 180px;">
                        <option value="">Pilih Pengurutan</option>
                        <option value="terbaru">Terbaru</option>
                        <option value="terlama">Terlama</option>
                        <option value="terpopuler">Terpopuler</option>
                        <option value="tidakPopuler">Tidak Populer</option>
                    </select>
                </div>

                <div>
                    <input id="searchInput" class="form-control form-control-sm" type="search" placeholder="Cari Judul" style="width: 240px;"/>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap px-4 mb-3">
            <table class="table table-hover" id="informasiTable">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>SubJudul</th>
                        <th>Konten</th>
                        <th>Durasi</th>
                        <th>Penulis</th>
                        <th>Disukai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="informasiTableBody">
                    @foreach ($informasi as $item)
                    <tr data-title="{{ strtolower($item->title) }}" 
                        data-created-at="{{ $item->created_at }}"
                        data-Disukai="{{ $item->Disukai ?? 0 }}"
                        data-penulis="{{ strtolower($item->penulis) }}">
                        <td><span class="fw-bold">{{ $item->title }}</span></td>                                    
                        <td>{!! \Illuminate\Support\Str::words($item->SubJudul, 4, '...') !!}</td>
                        <td>{!! \Illuminate\Support\Str::words($item->content, 4, '...') !!}</td>
                        <td>
                            <div class="p-2 rounded bg-label-info">{{$item->durasi}}</div> 
                        </td>
                        <td>{{ $item->penulis}}</td>
                        <td>{{ $item->Disukai ?? 0 }} <span class="text-secondary">Karyawan</span></td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('kelolainformasi.show', $item->id) }}" class="btn btn-sm btn-label-primary me-1">
                                    Detail
                                </a>
                                <form action="{{ route('kelolainformasi.destroy', $item->id) }}" method="post" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-record">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>                           
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div id="noDataMessage" class="alert alert-info text-center d-none" role="alert">
                Tidak ada data yang ditemukan.
            </div>
        </div>
    </div>
</div>
<!-- Content wrapper -->

<!-- Add informasi Modal -->
<div class="modal fade" id="addinformasiModal" tabindex="-1" aria-labelledby="addinformasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addinformasiModalLabel">
                    <i class="bx bx-plus-circle me-2"></i>Tambah Informasi Baru
                </h5>
                <button type="button" class="btn-close btn-close-secondary" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kelolainformasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   placeholder="Masukkan judul informasi" required maxlength="100">
                            <small class="form-text text-muted">Maks. 100 karakter</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="subtitle" class="form-label">Subjudul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" 
                                   placeholder="Masukkan subjudul" required maxlength="150">
                            <small class="form-text text-muted">Maks. 150 karakter</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="durasi" class="form-label">Durasi <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="durasi" class="form-control currency" placeholder="Masukan Durasi" required>
                                <span class="input-group-text rounded-end">Menit</span>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="penulis" class="form-label">Penulis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukan Nama Penulis" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Sampul informasi <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="foto" name="foto" 
                               accept="image/png, image/jpeg, image/jpg" required>
                        <small class="form-text text-muted">Ukuran maks. 2MB, format: PNG, JPG</small>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Konten</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" 
                                  rows="3" placeholder="Berikan deskripsi singkat tentang informasi"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script') 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        document.querySelectorAll('.delete-record').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "informasi ini akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); 
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('informasiTable');
            const tableBody = document.getElementById('informasiTableBody');
            const searchInput = document.getElementById('searchInput');
            const sortFilter = document.getElementById('sortFilter');
            const noDataMessage = document.getElementById('noDataMessage');
            const originalRows = Array.from(tableBody.querySelectorAll('tr'));
        
            // Fungsi untuk menampilkan atau menyembunyikan pesan tidak ada data
            function toggleNoDataMessage(rowsCount) {
                noDataMessage.classList.toggle('d-none', rowsCount > 0);
            }
        
            // Fungsi untuk mereset filter
            function resetFilter() {
                searchInput.value = '';
                sortFilter.value = '';
                showAllRows();
            }
        
            // Fungsi untuk menampilkan semua baris
            function showAllRows() {
                originalRows.forEach(row => {
                    row.style.display = '';
                });
                toggleNoDataMessage(originalRows.length);
            }
        
            // Pencarian dan filtering
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const sortOption = sortFilter.value;
        
                // Kloning baris asli untuk difilter
                let filteredRows = originalRows.filter(row => {
                    const title = row.dataset.title;
                    const penulis = row.dataset.penulis;
                    
                    // Cek apakah baris sesuai dengan pencarian
                    return (searchTerm === '' || 
                            title.includes(searchTerm) || 
                            penulis.includes(searchTerm));
                });
        
                // Sorting
                if (sortOption) {
                    filteredRows.sort((a, b) => {
                        switch(sortOption) {
                            case 'terbaru':
                                return new Date(b.dataset.createdAt) - new Date(a.dataset.createdAt);
                            case 'terlama':
                                return new Date(a.dataset.createdAt) - new Date(b.dataset.createdAt);
                            case 'terpopuler':
                                return parseInt(b.dataset.Disukai) - parseInt(a.dataset.Disukai);
                            case 'tidakPopuler':
                                return parseInt(a.dataset.Disukai) - parseInt(b.dataset.Disukai);
                            default:
                                return 0;
                        }
                    });
                }
        
                // Sembunyikan semua baris
                originalRows.forEach(row => {
                    row.style.display = 'none';
                });
        
                // Tampilkan baris yang difilter
                filteredRows.forEach(row => {
                    row.style.display = '';
                });
        
                // Toggle pesan tidak ada data
                toggleNoDataMessage(filteredRows.length);
            }
        
            // Event listener untuk pencarian
            searchInput.addEventListener('input', filterTable);
        
            // Event listener untuk sorting
            sortFilter.addEventListener('change', filterTable);
        
            // Optional: Tambahkan tombol reset
        
            // Sisipkan tombol reset di samping input pencarian
            searchInput.parentNode.insertBefore(resetButton, searchInput.nextSibling);
        
            // Optional: Delete confirmation
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus informasi ini?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>  
@endsection