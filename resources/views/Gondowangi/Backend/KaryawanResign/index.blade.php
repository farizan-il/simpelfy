@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')

<!-- Content wrapper -->
<div class="main-content">
    <section class="section">
        <div class="card shadow">
            <h5 class="card-header d-flex justify-content-between align-items-center">

                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    <li class="nav-item" style="font-size: 0.8rem">
                        <a class="nav-link text-secondary" href="/kelolakaryawan" >Karyawan Aktif</a>
                    </li>
                    <li class="nav-item" style="font-size: 0.8rem">
                        <a class="nav-link active text-primary" href="/karyawanresign">Karyawan Resign</a>
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
                            <th>ID Karyawan</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Gonpay</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($karyawan as $item)
                            @if ($item->credentials->isActive == 0)
                                <tr>
                                    <td>
                                        <span class="fw-medium">{{ Str::before($item->id, '-') }}</span>
                                    </td>
                                    <td>{{ $item->credentials->username }}</td>                                    
                                    <td>{{ $item->credentials->username }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jenisKelamin }}</td>
                                    <td class="text-warning"><strong>IDR {{ number_format($item->credentials->gonpay, 0, ',', '.') }}</strong></td>
                                </tr>
                            @endif
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



@endsection