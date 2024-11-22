@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')

<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    @if($errors->has('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ $errors->first('error') }}
            </div>
        </div>
    @endif

    <section class="section">
        <div class="card border">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="bx bx-plus-circle me-1"></i> Menambahkan
                </button>
            </h5>
            <div class="table-responsive text-nowrap px-4 mb-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Departement</th>
                            <th>Golongan</th>
                            <th>Gonpay Standar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($koin as $item)
                        <tr>
                            <td><strong>{{ $item->departement->departement }}</strong></td>
                            <td><strong>{{ $item->golongan->golongan }}</strong></td>
                            <td>Rp. {{ $item->gonpay }}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-outline-warning d-inline me-3" 
                                        onclick="editKoin('{{ $item->departement->id }}', '{{ $item->departement->departement }}', '{{ $item->golongan->golongan }}', '{{ $item->gonpay }}')">
                                        Edit
                                    </button>
                                    
                                    <button type="button" class="btn btn-primary d-inline" 
                                        onclick="kirimKoin('{{ $item->departement->id }}', '{{ $item->gonpay }}', '{{ $item->departement->departement }}', '{{ $item->golongan->id }}', '{{ $item->golongan->golongan }}')">
                                        Kirim Koin
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

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambahkan Koin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambahkan data baru -->
                <form action="{{ route('kelolakoin.store') }}" method="POST">
                    @csrf
                    <!-- Form input lain disini -->
                    <div class="mb-3">
                        <label for="departement" class="form-label">Departement</label>
                        <select class="form-control" name="departement" id="departement" required>
                            <option value="" disabled selected>Pilih Departement</option>
                            @foreach ($departements as $item)
                            <option value="{{ $item->id }}">{{ $item->departement }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="golongan" class="form-label">Golongan</label>
                        <select class="form-control" name="golongan" id="golongan" required>
                            <option value="" disabled selected>Pilih Golongan</option>
                            @foreach ($golongan as $item)
                            <option value="{{ $item->id }}">{{ $item->golongan }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="gonpay" class="form-label">Gonpay</label>
                        <input type="number" class="form-control" id="gonpay" name="gonpay" required>
                    </div>
                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing Gonpay -->
<div class="modal fade" id="editModal"  tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Koin</h5>
                
            </div>
            <div class="modal-body">
                <form id="editKoinForm" method="POST">
                    @csrf
                    @method('PUT') <!-- Menggunakan method PUT untuk update data -->
                    
                    <input type="hidden" id="editDepartementId" name="departement_id">
                    <input type="hidden" id="editDepartementId" name="golongan_id">

                    <div class="mb-3">
                        <label for="editDepartementName" class="form-label">Departement</label>
                        <input type="text" class="form-control" id="editDepartementName" name="departement" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="editGolonganName" class="form-label">Golongan</label>
                        <input type="text" class="form-control" id="editGolonganName" name="Golongan" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="editGonpay" class="form-label">Gonpay Standar</label>
                        <input type="text" class="form-control" id="editGonpay" name="gonpay">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>



  
@endsection

@section('script')
<script>
    function kirimKoin(departementId, gonpay, departementName, golonganId, golonganName) {
        Swal.fire({
            title: 'Konfirmasi Kirim Koin',
            text: `Apakah Anda ingin mengirimkan koin sebesar Rp. ${gonpay} ke departemen ${departementName} dan golongan ${golonganName}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kirim!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/kirim-koin', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        departement_id: departementId,
                        golongan_id: golonganId, // Pastikan golongan_id dikirim
                        gonpay: gonpay
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Terkirim!',
                            `Koin sebesar Rp. ${gonpay} telah dikirim ke departemen ${departementName} dan golongan ${golonganName}.`,
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat mengirim koin.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    // untuk mengganti gonpay
    function editKoin(departementId, departementName, GolonganName, gonpay) {
        // Isi input pada modal dengan data dari table
        document.getElementById('editDepartementId').value = departementId;
        document.getElementById('editDepartementName').value = departementName;
        document.getElementById('editGolonganName').value = GolonganName;
        document.getElementById('editGonpay').value = gonpay;

        // Atur action form sesuai dengan URL update
        document.getElementById('editKoinForm').action = '/kelolakoin/' + departementId;

        // Tampilkan modal
        var editModal = new bootstrap.Modal(document.getElementById('editModal'), {});
        editModal.show();
    }
</script>
@endsection