@extends('gondowangi.backend.layout.main')

@section('head')
    <title>{{ $title }}</title>
@endsection

@section('content')    
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- table modul kursus --}}
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="align-items-start">
                            <img src="{{ asset('image/kelas-sampul/' . $kelas->foto) }}" alt="{{$kelas->foto}}" class="d-block rounded" height="200" width="300"
                                id="uploadedAvatar" />

                            <div class="row mb-4 mt-4">
                                <label class="col-form-label" for="basic-default-company">Judul Materi</label>
                                <div class="col-sm-12">
                                    <h6>{{ $kelas->title }}</h6>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <a href="/kelolamodul" class="btn btn-md btn-outline-dark" style="width: auto;">
                                        <i class="fa fa-angle-left mr-2"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h5 class="card-header d-flex justify-content-between align-items-center">
                            Table Menambahkan Modul
                            <a href="#" class="btn btn-primary d-none d-md-inline" data-bs-toggle="modal" data-bs-target="#addBusModal{{ $kelas->id }}">
                                <i class='bx bx-plus me-2'></i> Menambahkan Modul
                            </a>
                        </h5>
                        <div class="table-responsive text-nowrap ">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        {{-- <th>ID Materi</th> --}}
                                        {{-- <th>ID modul</th> --}}
                                        <th>Judul Modul</th>
                                        <th>Submodul</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($modulKelas as $modul) 
                                        @if ($modul->id_kelas == $kelas->id)
                                            <tr>
                                                {{-- <td>
                                                    <span class="fw-medium">{{ $modul->id }}</span>
                                                </td> --}}
                                                <td>{{ $modul->judulModul }}</td>
                                                <td class="py-3">
                                                    <select class="form-control">
                                                        @foreach ($modul->detailModul as $detail)
                                                            <option value="">
                                                                {{ $detail->detailSubModul }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="py-3">
                                                    <button type="button" class="btn btn-label-primary d-inline" data-bs-toggle="modal" data-bs-target="#addPreTest{{ $modul->id }}"">
                                                        <i class='fa fa-plus'></i> Mid-test
                                                    </button> 
                                                    <button type="button" class="btn btn-outline-danger d-inline" onclick="confirmDelete('{{ $modul->id }}')">
                                                        <i class="bx bx-trash"></i>
                                                    </button> 
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content wrapper -->

    <!-- Modal untuk mid test -->
    {{-- <div class="modal fade" id="addPreTest{{ $modul->id }}" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Data Kelas dan Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('combinedForm.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Form KelasHasTest -->
                        <h5>Data Kelas</h5>
                        <div class="form-group">
                            <label for="kelas_id">Nama Modul:</label>
                            <input type="text" id="kelas_id" name="kelas_id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <select id="type" name="type" class="form-control" required>
                                <option value="pre-test">Pre-test</option>
                                <option value="mid-test">Mid-test</option>
                                <option value="post-test">Post-test</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration (minutes):</label>
                            <input type="number" id="duration" name="duration" class="form-control" required>
                        </div>

                        <!-- Form TestHasSoal -->
                        <h5 class="mt-4">Data Soal</h5>
                        <div class="form-group">
                            <label for="questionText">Question Text:</label>
                            <textarea id="questionText" name="questionText" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="options">Options (JSON format):</label>
                            <textarea id="options" name="options" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="correctAnswer">Correct Answer:</label>
                            <input type="text" id="correctAnswer" name="correctAnswer" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="explanation">Explanation:</label>
                            <textarea id="explanation" name="explanation" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    {{-- modal menambahkan modul --}}
    <div class="modal fade" id="addBusModal{{ $kelas->id }}" tabindex="-1" aria-labelledby="addBusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBusModalLabel">Tambahkan Submodul</h5>
                    <button type="button" class="btn-close text-primary" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times text-primary"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk menambahkan modul -->
                    <form action="/kelolamodul" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="id_kegiatan" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="id_kegiatan" name="id_kegiatan" value="{{ $kelas->title }}" readonly>
                        </div>
                
                        {{-- Judul modul --}}
                        <div class="mb-3">
                            <label for="judulModul" class="form-label">Judul Modul</label>
                            <input type="text" class="form-control" id="judulModul" name="judulModul" placeholder="Masukkan Judul Modul" autofocus>
                            <hr>
                        </div>
                
                        {{-- Submodul --}}
                        <div class="mb-3">
                            <div id="modul-container">
                                <div class="row submodul-row mt-4">
                                    <div class="col-12">
                                        <label for="File" class="form-label">Upload file atau masukkan link video, salah satu saja!</label>
                                        <div class="row d-flex align-items-bottom">
                                            <div class="col-6">
                                                <input type="file" class="form-control" id="File1" name="File[]" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.mp4">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" id="Link1" name="Link[]" placeholder="Masukkan Link Video">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Detail dan durasi -->
                                    <div class="col-8 mt-3">
                                        <input type="text" class="form-control" id="DetailModul1" name="DetailModul[]" placeholder="Masukkan Keterangan Video">
                                    </div>
                                    <div class="col-3 mt-3">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="text" name="durasi" class="form-control currency" placeholder="Durasi">
                                                <span class="input-group-text rounded-end">Menit</span>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="col-1 mt-3 mr-2" style="margin-top: 28px">
                                        <button type="button" class="btn btn-sm p-2 px-3 btn-danger remove-tanggal"><i class="bx bx-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-2" id="add-tanggal"><i class="bx bx-plus "></i></button>
                        </div>                        
                        <hr>
                        <button type="submit" class="btn btn-primary">Menambahkan</button>
                    </form>
                </div>                
            </div>
        </div>
    </div>
    <!-- /Modal -->
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- script add submodul --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-tanggal').addEventListener('click', function() {
                let modulContainer = document.getElementById('modul-container');
                let newSubmodul = modulContainer.children[0].cloneNode(true);
                newSubmodul.querySelectorAll('input').forEach(input => input.value = ''); // Clear input values
                modulContainer.appendChild(newSubmodul);
            });
        
            document.getElementById('modul-container').addEventListener('click', function(event) {
                if (event.target && event.target.closest('.remove-tanggal')) {
                    let row = event.target.closest('.submodul-row');
                    if (row) {
                        row.remove();
                    }
                }
            });
        });
    </script>

    <script>
        function confirmDelete(modulId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Modul ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
            deleteModul(modulId);
            }
        });
        }
    
        function deleteModul(modulId) {
        $.ajax({
            url: '/kelolamodul/' + modulId,
            type: 'DELETE',
            data: {
            _token: '{{ csrf_token() }}',
            },
            success: function(response) {
            Swal.fire(
                'Berhasil!',
                response.success,
                'success'
            ).then(() => {
                location.reload(); // Reload halaman setelah modul dihapus
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
    </script>
@endsection