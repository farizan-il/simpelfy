@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')

<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card shadow">
        <h5 class="card-header d-flex justify-content-between align-items-center">
            <!-- Button to trigger modal -->
            <a href="#" class="btn btn-primary d-none d-md-inline" data-bs-toggle="modal" data-bs-target="#addWebinarModal">
                <i class="bx bx-plus-circle me-1"></i> Menambahkan Webinar
            </a>
        </h5>
        <div class="table-responsive text-nowrap px-4 mb-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Subjudul</th>
                        <th>Status</th>
                        <th>Tanggal Mulai</th>
                        <th>Jam Mulai</th>
                        <th>Pendaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($webinars as $item)
                    <tr>
                        <td><span class="fw-bold">{{ $item->title }}</span></td>                                    
                        <td>{{ \Illuminate\Support\Str::words($item->subtitle, 4, '...') }}</td>
                        <td>
                            @if ( $item->status == 'pendaftaran' )
                                <div class="p-2 rounded bg-label-warning">{{$item->status}}</div>
                            @elseif( $item->status == 'berlangsung' )
                                <div class="p-2 rounded bg-label-info">{{$item->status}}</div>    
                            @else
                                <div class="p-2 rounded bg-label-secondary">{{$item->status}}</div>
                            @endif
                        </td>
                        <td>{{ $item->tanggalMulai}}</td>
                        <td>{{ $item->jamMulai}}</td>
                        <td>0 <span class="text-secondary">Karyawan</span></td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('kelolawebinar.show', $item->id) }}" class="btn btn-label-primary d-none d-md-inline">
                                    Detail
                                </a>

                                <form action="{{ route('kelolawebinar.destroy', $item->id) }}" method="post" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE') <!-- Menggunakan DELETE untuk menghapus resource -->
                                    <button type="submit" class="btn delete-record">
                                        <i class="bx bx-trash text-danger fs-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>                           
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

<!-- Add Webinar Modal -->
<div class="modal fade" id="addWebinarModal" tabindex="-1" aria-labelledby="addWebinarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWebinarModalLabel">Menambahkan Webinar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kelolawebinar.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" required>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Subtitle</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggalMulai" name="tanggalMulai" required>
                    </div>
                    <div class="mb-3">
                        <label for="jamMulai" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control" id="jamMulai" name="jamMulai" required>
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
    <script>
        document.querySelectorAll('.delete-record').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Webinar ini akan dihapus!",
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
@endsection