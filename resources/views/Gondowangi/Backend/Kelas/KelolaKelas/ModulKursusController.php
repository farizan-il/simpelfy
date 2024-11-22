

              @extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="main-content" style="background-color: rgb(247, 251, 255)">
        <section class="section">
            <div class="card border">
                <div class="card-body">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link {{ $filter === 'semua' ? 'active' : '' }}" href="{{ url('/kelolakelas?filter=semua') }}">
                                Semua <span class="badge badge-white">{{ $totalKelas }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $filter === 'kelaswajib' ? 'active' : '' }}" href="{{ url('/kelolakelas?filter=kelaswajib') }}">
                                Kelas Wajib <span class="badge badge-white">{{ $totalKelasWajib }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $filter === 'draf' ? 'active' : '' }}" href="{{ url('/kelolakelas?filter=draf') }}">
                                Kelas Draf <span class="badge badge-white">{{ $totalKelasDraf }}</span>
                            </a>
                        </li>
                    </ul>                 
                </div>
            </div>
        </section>
        <section class="section">
            <div class="card border">
                <div class="card-header">
                    <h4>Semua Kelas</h4>
                </div>
                <div class="card-body">
                    <div class="float-left">
                        <a href="/kelolakelas/create" class="btn btn-outline-primary d-none d-md-inline">
                            <i class="bx bx-plus-circle me-1"></i> Menambahkan Kelas
                        </a>
                    </div>
                    
                    <div class="float-right d-flex align-items-center">
                        <div class="float-right dropdown">
                            <a href="#" data-toggle="dropdown">
                                <i class="fa fa-filter text-primary mr-3" aria-hidden="true" style="cursor: pointer;"></i>
                            </a>
                            <div class="dropdown-menu border" style="background-color: rgb(247, 251, 255)">
                                <div class="dropdown-title">Filter By:</div>
                                <a href="{{ url('/kelolakelas?filter=semua') }}" class="dropdown-item has-icon">Semua</a>
                                @foreach ($departement as $item)
                                <a href="{{ url('/kelolakelas?filter=departement&id=' . $item->id) }}" class="dropdown-item has-icon">{{ $item->departement }}</a>
                                @endforeach

                            </div>
                            
                        </div>
                        <form class="border rounded" method="GET" action="{{ url('/kelolakelas') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-control-sm border-0" placeholder="Search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-sm"><i class="fas text-primary fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                
                    <div class="clearfix mb-3"></div>
                
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th class="text-center pt-2">
                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                            class="custom-control-input" id="checkbox-all">
                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>Judul Kelas</th>
                                <th class="text-nowrap">Kategori</th>
                                <th class="text-nowrap">Khusus</th>
                                <th class="text-nowrap">Dibuat oleh</th>
                                <th class="text-nowrap">Dibuat pada</th>
                                <th class="text-nowrap">Status</th>
                                <th>Aksi</th>
                            </tr>
                
                            @foreach ($dataKelas as $item)
                                <tr>
                                    <td>
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                id="checkbox-{{ $item->id }}">
                                            <label for="checkbox-{{ $item->id }}" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>{{ $item->title }}
                                        <div class="table-links">
                                            <a href="#">View</a>
                                            <div class="bullet"></div>
                                            <a href="{{ route('kelolakelas.edit', $item->id) }}">
                                                Edit
                                            </a>
                                            <div class="bullet"></div>
                                            <button type="button" class="btn-delete" onclick="confirmDelete('{{ $item->id }}')" style="border: none; background: none; cursor: pointer;">
                                                <span class="text-danger">Hapus</span>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">{{ $item->kategori->namaKategori }}</td>
                                    @if ($item->kelaswajib->isNotEmpty())
                                        <td class="text-nowrap text-uppercase text-info"><strong>{{ $item->kelaswajib->first()->departement->departement }}</strong></td>
                                    @else
                                        <td class="text-nowrap text-secondary"><strong>UMUM</strong></td>
                                    @endif

                                    <td class="text-nowrap">
                                        <img alt="image" src="{{ asset('style-backend/img/avatar/avatar-5.png') }}" class="rounded-circle" width="20">
                                        <div class="d-inline-block ml-1">{{ $item->instruktur }}</div>
                                    </td>
                                    <td class="text-nowrap">{{ $item->created_at }}</td>
                                    <td>
                                        @if ($item->status === 'draf')
                                            <div class="badge badge-warning">{{ $item->status }}</div>
                                        @elseif($item->status === 'publish')
                                            <div class="badge badge-primary">{{ $item->status }}</div>
                                        @else
                                            <div class="badge badge-dark">{{ $item->status }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn" onclick="openStatusModal('{{ $item->id }}', '{{ $item->status }}')" style="border: none; background: none;">
                                            <i class="fa-solid fa-right-left text-primary"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                
                    <div class="float-right">
                        <nav>
                            <ul class="pagination">
                                <!-- Previous Page Link -->
                                @if ($dataKelas->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $dataKelas->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                    
                                <!-- Pagination Elements -->
                                @foreach ($dataKelas->getUrlRange(1, $dataKelas->lastPage()) as $page => $url)
                                    @if ($page == $dataKelas->currentPage())
                                        <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                    
                                <!-- Next Page Link -->
                                @if ($dataKelas->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $dataKelas->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>                    
                </div>
            </div>
        </section>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->


    {{-- Modal untuk mengubah status kelas --}}
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Ubah Status Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="statusForm" method="POST" action="{{ route('kelolakelas.updateStatus', '') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="kelas_id" id="kelas_id">
                        <div class="form-group">
                            <label for="status">Pilih Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="publish">Publish</option>
                                <option value="draf">Draf</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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