@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')

<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y" >
    <section class="section">
        <div class="card border">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                <a href="#" class="btn btn-primary d-none d-md-inline" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                    <i class="bx bx-plus-circle me-1"></i> Menambahkan Kategori faq
                </a>
            </h5>
            <div class="table-responsive text-nowrap px-4 mb-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Dibuat Pada:</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($faqKategori as $item)
                        <tr>
                            <td><span class="fw-bold">{{ $item->namaKategori }}</span></td>                                    
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn-warning btn mr-4" href="{{ route('kelolakelas.edit', $item->id) }}" >
                                        <i class="fas text-light fa-edit"></i>
                                    </a>
                                    <a class="btn-danger btn"  
                                        data-toggle="modal" 
                                        data-target="#tambahKoinModal{{ $item->id }}" 
                                        style="cursor: pointer;">
                                        <i class="fas text-light fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->


<!-- Add Kategori faq Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1" aria-labelledby="addFaqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-xxl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFaqModalLabel">Menambahkan Kategori Faq</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kategorifaq.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="title" name="namaKategori" required>
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
                    text: "Data ini akan dinonaktifkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, nonaktifkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim form jika OK
                    }
                });
            });
        });

    </script>
@endsection
