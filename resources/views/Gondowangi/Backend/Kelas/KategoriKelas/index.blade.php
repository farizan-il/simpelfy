@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <section class="section">
            <div class="card border">
                <div class="card-header">
                    <h5 class="mb-0">Tabel Kategori Kelas</h5>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                                <i class="bx bx-plus-circle me-1"></i> Menambahkan Kategori
                            </button>
                        </div>
                        <div class="col-2">
                            <form method="GET" action="{{ url('/kategorikelas') }}" >
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                    <input type="text" name="search" class="form-control" placeholder="Cari..." aria-label="Search..." aria-describedby="basic-addon-search31" value="{{ request('search') }}"/>
                                </div>

                                {{-- <div class="input-group">
                                    <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" />
                                    <input type="text" name="search" class="form-control form-control-sm border-0 col-6 w-50" placeholder="Search" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm"><i class="fas text-primary fa-search"></i></button>
                                    </div>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                
                    <div class="clearfix mb-3"></div>
                
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th>Nama Kategori</th>
                                <th>Subkategori</th>
                                <th class="text-nowrap">Dibuat pada:</th>
                                <th>Aksi</th>
                            </tr>
                
                            @foreach ($kategori as $item)
                                <tr>
                                    <td class="text-nowrap">
                                        <img alt="image" class="text-secondary" src="{{ asset('image/icon-kategori/' . $item->image ) }}" width="20">
                                        <div class="d-inline-block ml-1">{{ $item->namaKategori }}</div>
                                    </td>
                                    <td class="py-3 text-nowrap">
                                        @if($item->subkategori->isEmpty())
                                            <span class="text-muted">Belum ada subkategori</span>
                                        @else
                                            <select class="form-control">
                                                @foreach($item->subkategori as $subkategori)
                                                    <option value="{{ $subkategori->id }}">{{ $subkategori->namaSubkategori }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td style="cursor: pointer;">
                                        <button type="button" class="btn btn-outline-info mr-3 btn-tambah-subkategori" 
                                                data-id="{{ $item->id }}" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#subkategoriModal">
                                            Tambahkan Subkategori {{ $item->namaKategori }}
                                        </button>
                                        <button type="button" class="btn btn-label-danger" onclick="confirmDelete('{{ $item->id }}')" style="cursor: pointer;">
                                            <i class="bx bx-trash "></i>
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


    {{-- Modal menambahkan subkategori --}}
    <div class="modal fade" id="subkategoriModal" tabindex="-1" aria-labelledby="subkategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subkategoriModalLabel">Tambahkan Subkategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/subkategori" method="POST">
                    <div class="modal-body">
                        @csrf
                        <!-- Input untuk menyimpan ID Kategori yang dipilih -->
                        <input type="hidden" name="id_kategori" id="id_kategori" />

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label" for="subkategori">Nama Subkategori</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="subkategori" id="subkategori" required />
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

    {{-- Modal menambahkan kategori --}}
    <div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kategoriModalLabel">Tambahkan Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/kategorikelas" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        {{-- Nama Kategori --}}
                        <div class="mb-4">
                            <label for="kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan nama kategori" />
                        </div>

                        {{-- Icon Kategori --}}
                        <div class="mb-4">
                            <label for="icon" class="form-label">Icon Kategori</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="icon" name="icon" />
                                <label class="input-group-text" for="icon">Upload</label>
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
        function confirmDelete(kategoriId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Kategori ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteKategori(kategoriId);
                }
            });
        }

        function deleteKategori(kategoriId) {
            $.ajax({
                url: '/kategorikelas/' + kategoriId,
                type: 'DELETE',
                data: {
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
                    // Tangani error
                    let errorMessage = xhr.responseJSON ? xhr.responseJSON.error : 'Terjadi kesalahan saat menghapus kategori!';
                    Swal.fire(
                        'Gagal!',
                        errorMessage,
                        'error'
                    );
                }
            });
        }
    </script>

    <script>
        document.querySelectorAll('.btn-tambah-subkategori').forEach(button => {
            button.addEventListener('click', function() {
                const idKategori = this.getAttribute('data-id');
                document.getElementById('id_kategori').value = idKategori;
            });
        });
    </script>
@endsection