@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="main-content">
        <section class="section">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Table Kelola Blog dan Berita</h4>
                </div>
                <div class="card-body">
                    <div class="float-left">
                        <a href="#" class="btn btn-outline-primary btn-icon icon-left d-none d-md-inline" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="bx bx-plus-circle"></i> Menambahkan
                        </a>
                    </div>
                    <div class="float-right">
                        <form method="GET" action="{{ url('/kelolakelas') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                
                    <div class="clearfix mb-3"></div>
                
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th class="text-nowrap">Judul Blog</th>
                                <th class="text-nowrap">Link</th>
                                <th class="text-nowrap">Dibuat pada</th>
                                <th class="text-nowrap">Diupdated pada</th>
                                <th>Aksi</th>
                            </tr>
                
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->title }}
                                        <div class="table-links">
                                            <a href="#">View</a>
                                            <div class="bullet"></div>
                                            <a href="">
                                                Edit
                                            </a>
                                            <div class="bullet"></div>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="{{ $item->link }}" target="_blank">
                                            <i class="fa fa-link"></i> <strong>Lihat Link</strong>
                                        </a>
                                    </td>                                                                        
                                    <td class="text-nowrap">{{ $item->created_at }}</td>
                                    <td class="text-nowrap">{{ $item->updated_at }}</td>
                                    <td>
                                        <button class="btn" onclick="confirmDelete('{{ $item->id }}')" style="border: none; background: none;">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </button>
                                        <!-- Form untuk penghapusan -->
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('blog.destroy', $item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                
                    {{-- <div class="float-right">
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
                    </div>                     --}}
                </div>
            </div>
        </section>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->


    {{-- Modal untuk menambahkan blog atau berita --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambahkan Item Baru</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Masukan Judul" required>
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="url" class="form-control" id="link" name="link" placeholder="Masukan link" required>
                        </div>
                        <div class="form-group">
                            <label for="foto_sampul">Foto Sampul</label>
                            <input type="file" class="form-control" id="foto_sampul" name="foto_sampul" accept="image/*" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

</script>
@endsection