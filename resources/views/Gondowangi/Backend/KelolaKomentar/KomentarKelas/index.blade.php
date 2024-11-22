@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <section class="section">
            <div class="card border">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-1">Table Kelola Komentar Kelas</h5>
                    </div>
                    <div class="d-flex">
                        <div class="me-2">
                            <select id="yearFilter" class="form-select" data-allow-clear="true">
                                <option value="bulan_ini" selected>Bulan ini</option>
                                <option value="3_bulan">3 Bulan Sebelumnya</option>
                                <option value="tahun_ini">Tahun Ini</option>
                                <option value="semua">Semuanya</option>
                            </select>
                        </div>
    
                        <form class="d-flex" onsubmit="return false">
                            <input id="searchInput" class="form-control form-control-sm me-2" type="search" placeholder="Cari Judul Kelas atau Nama Karyawan" style="width: 270px;"/>
                        </form>
                    </div>                    
                </div>
                <div class="card-body">                
                    <div class="table-responsive">
                        <table class="table table-hover" id="komentarTable">
                            <tr>
                                <th>Komentar</th>
                                <th>Nama Karyawan</th>
                                <th>Departemen</th>
                                <th class="text-nowrap">Berkomentar pada:</th>
                                <th class="text-nowrap">Kelas yang dikomentari:</th>
                                <th class="text-nowrap">Status</th>
                                <th>Aksi</th>
                            </tr>
        
                            @foreach ($komentar as $item)
                            <tr data-created-at="{{ $item->created_at }}">
                                <td>{{ $item->komentartext }}</td>
                                <td class="text-nowrap">
                                    @if ($item->credentials && $item->credentials->profile)
                                        <img alt="image" class="text-secondary rounded" 
                                            src="{{ asset('image/foto-profile/' . ($item->credentials->profile->fotoProfile ?? '-')) }}" 
                                            width="20">
                                        <div class="d-inline-block ml-1">
                                            {{ $item->credentials->profile->nama ?? '-' }}
                                        </div>
                                    @else
                                        <img alt="image" class="text-secondary" src="{{ asset('image/foto-profile/default.jpg') }}" width="20">
                                        <div class="d-inline-block ml-1">-</div>
                                    @endif
                                </td>
                                <td>{{ $item->credentials->profile->departement->departement ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                <td>{{ $item->kelas->title }}</td>
                                <td>
                                    @if ($item->status === 'Draf')
                                        <span class="badge bg-label-warning me-1 fw-bold">{{ $item->status }}</span>
                                    @else
                                        <span class="badge bg-label-primary me-1 fw-bold">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td style="cursor: pointer;">
                                    <button class="btn" onclick="openStatusModal('{{ $item->id }}', '{{ $item->status }}')" style="border: none; background: none;">
                                        <i class="bx bx-transfer text-primary"></i>
                                    </button>
                                </td> 
                            </tr>
                        @endforeach
                        </table>
                    </div>                    
                </div>
            </div>
        </section>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->

    {{-- Modal untuk mengubah status komentar kelas --}}
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Ubah Status Komentar Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form id="statusForm" method="POST">
                    @csrf
                    <input type="hidden" name="komentar_id" id="komentar_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">Pilih Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Draf">Draf</option>
                                <option value="Disetujui">Disetujui</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>    
@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    {{-- filter periode tanggal untuk komentar kelas --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const yearFilter = document.getElementById('yearFilter');
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('komentarTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
            function filterTable() {
                const filterValue = yearFilter.value;
                const searchText = searchInput.value.toLowerCase();
                
                for (let row of rows) {
                    let showRow = true;
                    const createdAt = new Date(row.getAttribute('data-created-at'));
                    const now = new Date();
                    
                    // Date filter
                    switch(filterValue) {
                        case 'bulan_ini':
                            showRow = createdAt.getMonth() === now.getMonth() && 
                                      createdAt.getFullYear() === now.getFullYear();
                            break;
                        case '3_bulan':
                            const threeMonthsAgo = new Date();
                            threeMonthsAgo.setMonth(now.getMonth() - 3);
                            showRow = createdAt >= threeMonthsAgo;
                            break;
                        case 'tahun_ini':
                            showRow = createdAt.getFullYear() === now.getFullYear();
                            break;
                        case 'semua':
                            showRow = true;
                            break;
                    }
        
                    // Search filter
                    if (showRow && searchText) {
                        const namaKaryawan = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                        const judulKelas = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                        showRow = namaKaryawan.includes(searchText) || judulKelas.includes(searchText);
                    }
        
                    row.style.display = showRow ? '' : 'none';
                }
            }
        
            yearFilter.addEventListener('change', filterTable);
            searchInput.addEventListener('input', filterTable);
        });
    </script>

    <script>
        document.getElementById('status').value = status;
        function openStatusModal(komentarId, status) {
            // Set ID komentar di input hidden
            document.getElementById('komentar_id').value = komentarId;

            // Set status default di select option
            document.getElementById('status').value = status;

            // Set action form berdasarkan ID komentar
            var form = document.getElementById('statusForm');
            form.action = '/komentarkelas/update-status/' + komentarId;

            // Buka modal
            $('#statusModal').modal('show');
        }

    </script>
@endsection