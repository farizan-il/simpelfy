@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 mb-6">
            <div class="card">
                <div class="d-flex row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-5">Tambahkan Kelas</h5>
                            {{-- <p class="mb-1">Tambahkan kelas baru hari ini!</p> --}}
                
                            <a class="btn btn-primary btn-sm p-1" href="/kelolakelas/create" style="margin-top: 11px;">
                                buat kelas baru <i class='bx bx-right-arrow-alt'></i>  
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="text-heading mb-1">Total Kelas</p>
                            <div class="d-flex align-items-center mb-1">
                                <h4 class="card-title mb-0 me-2">{{ $totalKelas }}</h4>
                                <a class="nav-link {{ $filter === 'semua' ? 'active' : '' }}" href="{{ url('/kelolakelas?filter=semua') }}">
                                    <span class="bg-label-info rounded p-1">detail</span>
                                </a>
                            </div>
                            <span>total keseluruhan</span>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-info rounded p-2">
                                <i class='bx bx-trending-up bx-sm'></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="text-heading mb-1">Kelas Dipublish</p>
                            <div class="d-flex align-items-center mb-1">
                                <h4 class="card-title mb-0 me-2">{{ $totalKelasPublish }}</h4>
                                <a class="nav-link {{ $filter === 'publish' ? 'active' : '' }}" href="{{ url('/kelolakelas?filter=publish') }}">
                                <span class="bg-label-success p-1 rounded">detail</span>
                                </a>
                            </div>
                            <span>total keseluruhan</span>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-success rounded p-2">
                                <i class='bx bx-time-five bx-sm'></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="text-heading mb-1">Kelas Draf</p>
                            <div class="d-flex align-items-center mb-1">
                                <h4 class="card-title mb-0 me-2">{{ $totalKelasDraf }}</h4>
                                <a class="nav-link {{ $filter === 'draf' ? 'active' : '' }}" href="{{ url('/kelolakelas?filter=draf') }}">
                                    <span class="bg-label-warning p-1 rounded">detail</span>
                                </a>
                            </div>
                            <span>total keseluruhan</span>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-warning rounded p-2">
                                <i class='bx bx-pie-chart-alt bx-sm'></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">Table Kelola Kelas</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Judul Kelas</th>
                        <th class="text-nowrap">Kategori</th>
                        <th class="text-nowrap">Khusus</th>
                        <th class="text-nowrap">Dibuat oleh</th>
                        <th class="text-nowrap">Dibuat pada</th>
                        <th class="text-nowrap">Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($dataKelas as $item)
                        <tr>
                            <td><img src="{{ asset('image/kelas-sampul/' . $item->foto) }}" width="50" height="30" alt="" class="rounded"> <span>{{ $item->title }}</span></td>
                            <td>{{ $item->kategori->namaKategori }}</td>
                            <td>-</td>
                            <td>
                                {{ $item->instruktur }}
                            </td>
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                @if ($item->status === 'draf')
                                    <span class="badge bg-label-warning me-1">{{ ucfirst($item->status) }}</span>
                                @elseif($item->status === 'publish')
                                    <span class="badge bg-label-success me-1"><strong>{{ ucfirst($item->status) }}</strong></span>
                                @else
                                    <span class="badge bg-label-secondary me-1">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn p-0" onclick="openStatusModal('{{ $item->id }}', '{{ $item->status }}')" style="border: none; background: none;">
                                    <i class="bx bx-transfer-alt text-primary bx-sm"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="demo-inline-spacing">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-rounded justify-content-center">
                        <!-- First Page Link -->
                        @if (!$dataKelas->onFirstPage())
                            <li class="page-item">
                                <a class="page-link" href="{{ $dataKelas->url(1) }}">
                                    <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="javascript:void(0);">
                                    <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                                </a>
                            </li>
                        @endif
            
                        <!-- Pagination Elements -->
                        @foreach ($dataKelas->getUrlRange(1, $dataKelas->lastPage()) as $page => $url)
                            @if ($page == $dataKelas->currentPage())
                                <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0);">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
            
                        <!-- Last Page Link -->
                        @if ($dataKelas->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $dataKelas->url($dataKelas->lastPage()) }}">
                                    <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="javascript:void(0);">
                                    <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>            
        </div>
    </div>
</div>

<div class="modal fade animate__animated animate__bounce" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="statusModalLabel">Ubah Status Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusForm" method="POST" action="{{ route('kelolakelas.updateStatus', '') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="kelas_id" id="kelas_id">
                    <div class="mb-3">
                        <label for="status" class="form-label">Pilih Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="publish">Publish</option>
                            <option value="draf">Draf</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>                
        </div>
    </div>
</div>
@endsection


@section('script')
    <script>

        // sweet alert untuk hapus kelas
        function confirmDelete(kelasId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Kelas ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteModul(kelasId);
                }
            });
        }

        function deleteModul(kelasId) {
            $.ajax({
                url: '/kelolakelas/' + kelasId,
                type: 'POST', 
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Berhasil!',
                        response.success,
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire(
                        'Gagal!',
                        xhr.responseJSON.error,
                        'error'
                    );
                }
            });
        }
        // akhir sweet alert untuk hapus kelas

        function openStatusModal(kelasId, status) {
            // Set ID kelas di input hidden
            document.getElementById('kelas_id').value = kelasId;

            // Set status default di select option
            document.getElementById('status').value = status;

            // Set action form berdasarkan ID kelas
            var form = document.getElementById('statusForm');
            form.action = '/kelolakelas/update-status/' + kelasId;

            // Buka modal
            $('#statusModal').modal('show');
        }
    </script>
@endsection