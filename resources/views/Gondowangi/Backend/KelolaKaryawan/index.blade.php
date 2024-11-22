@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')

<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card shadow">
        <h5 class="card-header d-flex justify-content-between align-items-center">

            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item" style="font-size: 0.8rem">
                    <a class="nav-link active text-primary"  href="/kelolakaryawan" role="tab" >Karyawan Aktif</a>
                </li>
                <li class="nav-item" style="font-size: 0.8rem">
                    <a class="nav-link text-secondary"  href="/karyawanresign" >Karyawan Resign</a>
                </li>
            </ul>


            <a href="/kelolakaryawan/create" class="btn btn-primary d-none d-md-inline" >
                <i class="bx bx-plus-circle me-1"></i> Menambahkan Karyawan
            </a>
        </h5>
        <div class="table-responsive text-nowrap px-4 mb-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Tanggal Masuk</th>
                        <th>Jabatan</th>
                        <th>Golongan</th>
                        <th>Departemen</th>
                        <th>Area</th>
                        <th>Status</th>
                        <th>Gonpay</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($karyawan as $item)
                    <tr>
                        @if ($item->credentials->isActive != 1)
                            <td>
                                <span class="text-secondary fw-bold">Belum Onboarding
                                    <button type="button" class="btn btn-white btn-sm px-1 mb-0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Belum Onboarding artinya karyawan tersebut belum pernah memasuki aplikasi LMS dan belum menyelesaikan tahapan awal aplikasinya</span>">
                                        <i class='bx bxs-help-circle text-warning' ></i>
                                    </button>
                                </span>
                            </td>  
                        @else
                        <td>-</td>
                        @endif
                        <td><span class="fw-bold">{{ $item->nik }}</span></td>                                    
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->credentials->email }}</td>
                        <td>{{ $item->jenisKelamin }}</td>
                        <td>{{ $item->tanggalMasuk }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->golongan->golongan }}</td>
                        <td>{{ $item->departement->departement }}</td>
                        <td>{{ $item->area }}</td>
                        <td>{{ $item->status }}</td>
                        <td class="text-warning"><strong>IDR {{ number_format($item->credentials->gonpay, 0, ',', '.') }}</strong></td>
                        <td>
                            <div class="d-flex">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn " data-bs-toggle="dropdown">
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </a>
                                    <div class="dropdown-menu shadow">
                                        <a href="{{ route('kelolakelas.edit', $item->id) }}" class="dropdown-item has-icon">
                                            <i class="bx text-secondary bx-edit fs-5"></i> Edit
                                        </a>
                                        <a class="dropdown-item has-icon tambah-koin-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#tambahKoinModal{{ $item->id }}" 
                                            style="cursor: pointer;">
                                            <i class="bx text-secondary bx-credit-card-alt"></i> Tambah Koin
                                        </a>
                                    </div>
                                </div>
        
                                <form action="{{ route('kelolakaryawan.updateStatus', $item->id) }}" method="post" class="d-inline delete-form">
                                    @csrf
                                    @method('PATCH') 
                                    <button type="button" class="btn delete-record">
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

{{-- modal untuk menambahkan koin --}}
<div class="modal fade" id="tambahKoinModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="tambahKoinLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('kelolakaryawan.updateKoin', $item->id) }}" method="POST" id="tambahKoinForm">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKoinLabel{{ $item->id }}">Tambahkan Koin Gonpay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_karyawan" value="{{ $item->id }}" readonly />
                    <div class="form-group">
                        <label for="nama">Nama Karyawan</label>
                        <input type="text" class="form-control" name="nama" value="{{ $item->nama }}" readonly />
                    </div>
                    <div class="form-group">
                        <label for="gonpay">Tambahkan Koin Gonpay</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">IDR</span>
                            </div>
                            <input type="number" name="gonpay" class="form-control" placeholder="Masukkan jumlah koin" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambahkan Koin</button>
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


        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('tambahKoinModal');
            const form = document.getElementById('tambahKoinForm');
            const namaInput = document.getElementById('modal-nama-karyawan');
            const gonpayInput = document.getElementById('modal-gonpay-karyawan');
            const idInput = document.getElementById('modal-id-karyawan');

            document.querySelectorAll('.tambah-koin-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    const gonpay = this.getAttribute('data-gonpay');

                    namaInput.value = nama;
                    gonpayInput.value = gonpay;
                    idInput.value = id;

                    // Update form action with the selected ID
                    form.action = `/kelolakaryawan/updateKoin/${id}`;

                    // Show the modal
                    $(modal).modal('show');
                });
            });
        });

    </script>
@endsection