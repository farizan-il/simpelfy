@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')

<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <section class="section">
        <div class="card border">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                <a href="#" class="btn btn-primary d-none d-md-inline" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                    <i class="bx bx-plus-circle me-1"></i> Menambahkan faq
                </a>
            </h5>
            <div class="table-responsive text-nowrap px-4 mb-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($faq as $item)
                        <tr>
                            <td><span class="fw-bold">{{ $item->faqkategori->namaKategori }}</span></td>                                    
                            <td>{{ $item->pertanyaan }}</td>
                            <td>{{ $item->jawaban }}</td>
                            <td>{{ $item->nilai }}</td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn-warning btn mr-3" href="{{ route('kelolafaq.edit', $item->id) }}" >
                                        <i class="fas text-light fa-edit"></i>
                                    </a>

                                    <button type="button" class="btn btn-danger delete-btn" 
                                            data-id="{{ $item->id }}" 
                                            data-pertanyaan="{{ $item->pertanyaan }}">
                                        <i class="fas text-light fa-trash"></i>
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
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

<!-- Add Kategori faq Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1" aria-labelledby="addFaqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-xxl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFaqModalLabel">Menambahkan Faq</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kelolafaq.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <select class="form-control" name="kategori_id" required>
                                <option selected disabled>Pilih Kategori</option>
                                @foreach ($faqKategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->namaKategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="pertanyaan" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="jawaban" class="form-label">Jawaban</label>
                            <input type="text" class="form-control" id="jawaban" name="jawaban" required>
                        </div>
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
        // Untuk delete dengan SweetAlert
        document.addEventListener('DOMContentLoaded', function() {
            // Menangani klik tombol delete
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const pertanyaan = this.dataset.pertanyaan;
                    
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: `Akan menghapus FAQ: ${pertanyaan}`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Buat form untuk delete
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `{{ route('kelolafaq.destroy', '') }}/${id}`;
                            
                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = '{{ csrf_token() }}';
                            
                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            
                            form.appendChild(csrfToken);
                            form.appendChild(methodField);
                            document.body.appendChild(form);
                            
                            form.submit();
                        }
                    });
                });
            });
        });

    </script>
@endsection