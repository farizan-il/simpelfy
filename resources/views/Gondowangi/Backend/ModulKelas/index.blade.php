@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')

<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header d-flex justify-content-between align-items-center">
            Table Kelola Modul
            <div class="float-right">
                <form method="GET" action="{{ url('/kelolamodul') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </h5>
        <div class="table-responsive text-nowrap px-4 mb-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID Kelas</th>
                        <th>Judul Materi</th>
                        <th>Total Modul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($kelas as $item)
                        @php
                            // Menghitung jumlah modul dan detail modul untuk setiap kelas
                            $jumlahModul = \App\Models\ModulKelas::where('id_kelas', $item->id)->count();
                            $modulIds = \App\Models\ModulKelas::where('id_kelas', $item->id)->pluck('id');
                            $jumlahDetailModul = \App\Models\DetailModul::whereIn('id_modul', $modulIds)->count();
                        @endphp
                        <tr>
                            <td>
                                <span class="fw-medium">{{ Str::before($item->id, '-') }}</span>
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <span class="text-primary"><strong>{{ $jumlahModul }} Bagian</strong></span>
                                <div class="bullet"></div>
                                <span class="text-dark"><strong>{{ $jumlahDetailModul }} Pelajaran</strong></span>
                            </td>
                            <td class="py-3">
                                <a href="{{ route('kelolamodul.edit', $item->id) }}" class="btn btn-outline-primary" >
                                    <i class="bx bx-plus-circle me-1"></i> Menambahkan Modul
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>                
        </div>

        <div class="float-right">
            <nav>
                <ul class="pagination">
                    <!-- Previous Page Link -->
                    @if ($kelas->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $kelas->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                    @endif
        
                    <!-- Pagination Elements -->
                    @foreach ($kelas->getUrlRange(1, $kelas->lastPage()) as $page => $url)
                        @if ($page == $kelas->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
        
                    <!-- Next Page Link -->
                    @if ($kelas->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $kelas->nextPageUrl() }}" aria-label="Next">
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
        </div>  
        
    </div>
</div>
<!-- Content wrapper -->



@endsection