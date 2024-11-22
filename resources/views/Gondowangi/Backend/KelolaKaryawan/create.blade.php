@extends('gondowangi.backend.layout.main')

@section('head')
    <title>{{ $title }}</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>@endsection

@section('content')    
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                            <strong>Yaa error bro!</strong> {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        @endforeach
                    </div>
                @endif
                <div class="card mb-4 shadow">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Menambahkan Kelas</h5>
                        <small class="text-muted float-end">
                            <div class="col-sm-10">
                                <a href="/kelolakelas" class="btn btn-sm btn-dark d-none d-md-inline-flex align-items-center">
                                    <i class="bx bx-arrow-back me-1"></i> Kembali
                                </a>
                            </div>
                        </small>
                    </div>
                    <hr>
                    <div class="card-body">
                        <form action="/kelolakaryawan" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Nama Karyawan --}}
                            <div class="container">
                                <div class="row mb-4 justify-content-center">
                                    <div class="col-lg-12 form-group">
                                        <label class="col-form-label" for="nik">NIK Karyawan</label>
                                        <input type="text" class="form-control" name="nik" id="nik" required />
                                    </div>
                                </div>

                                <div class="row mb-4 justify-content-center">
                                    <div class="col-lg-12 form-group">
                                        <label class="col-form-label" for="nama">Nama Karyawan</label>
                                        <input type="text" class="form-control" name="nama" id="nama" required />
                                    </div>
                                </div>

                                <div class="row mb-4 justify-content-center">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="email">Email Karyawan</label>
                                            <input type="email" class="form-control" name="email" id="email" required />
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="katasandi">Default Kata Sandi</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="katasandi" id="katasandi" class="form-control" value="gondowangi-123" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Jenis Kelamin dan tanggal masuk --}}
                            <div class="container">
                                <div class="row mb-4 justify-content-center">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="jabatan">Jabatan</label>
                                            <select class="form-control" name="jabatan" id="jabatan" required>
                                                <option value="" disabled selected>Pilih jabatan</option>
                                                @foreach ($jabatans as $item)
                                                <option value="{{ $item->jabatan }}">{{ $item->jabatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="golongan">Golongan</label>
                                            <select class="form-control" name="golongan" id="golongan" required>
                                                <option value="" disabled selected>Pilih Golongan</option>
                                                @foreach ($golongans as $item)
                                                <option value="{{ $item->id }}">{{ $item->golongan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="departement">Departement</label>
                                            <select class="form-control" name="departement" id="departement" required>
                                                <option value="" disabled selected>Pilih Departement</option>
                                                @foreach ($departements as $item)
                                                <option value="{{ $item->id }}">{{ $item->departement }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                        
                                </div>
                            </div>

                            {{-- Jenis Kelamin dan tanggal masuk --}}
                            <div class="container">
                                <div class="row mb-4 justify-content-center">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="jeniskelamin">Jenis Kelamin</label>
                                            <select class="form-control" name="jeniskelamin" id="jeniskelamin" required>
                                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                <option value="Pria">Pria</option>
                                                <option value="Wanita">Wanita</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="tglmasuk">Tanggal Masuk</label>
                                            <input type="date" class="form-control" name="tglmasuk" id="tglmasuk" required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--  --}}
                            <div class="container">
                                <div class="row mb-4 justify-content-center">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="area">Area</label>
                                            <select class="form-control" name="area" id="area" required>
                                                <option value="" disabled selected>Pilih Area</option>
                                                @foreach ($areas as $item)
                                                <option value="{{ $item->area }}">{{ $item->area }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="status">Status</label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="" disabled selected>Pilih Status</option>
                                                <option value="PKWT">PKWT</option>
                                                <option value="PKWTT">PKWTT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Currency</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    IDR
                                                    </div>
                                                </div>
                                                <input type="text" name="gonpay" class="form-control currency">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row mb-4 justify-content-start">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Menambahkan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection

@section('script')
    
@endsection
