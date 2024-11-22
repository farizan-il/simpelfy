@foreach ($dataKelas as $item)
<div class="col-sm-12 col-md-4 col-lg-3 mb-5" style="cursor: pointer;">
    <div class="card h-100 shadow-none border card-hover-shine-effect">
        <div class="rounded-2 text-center mb-0">
            <img class="img-fluid rounded" src="{{ asset('image/kelas-sampul/' . $item->foto) }}" alt="tutor image 1" style="height: 200px; width: 100%; object-fit: cover;"/>
        </div>
        <div class="card-body pb-0 pt-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex">
                    <span class="badge bg-label-info me-3">{{ $item->kategori->namaKategori }}</span>
                </div>
                <p class="d-flex align-items-center justify-content-center fw-medium gap-1 mb-0">
                    {{ $item->totalRating ?? 'N/A' }} 
                    <span class="text-warning"><i class="bx bxs-star me-1 mb-1_5"></i></span>
                    <span class="fw-normal">({{ number_format($item->totalReviews) }})</span>
                </p>                                
            </div>
            <a class="h6 text-dark">{{ $item->title }}</a>
            <p class="mt-1">{{ \Illuminate\Support\Str::words($item->subtitle, 10) }}</p>
        </div>
        <div class="card-footer pb-3 pt-0">
            <p class="d-flex align-items-center text-dark mb-2" style="font-size: 1.1rem;"><strong>IDR {{ number_format($item->harga, 0, ',', '.') }}</strong></p>
            <div class="d-flex gap-4">
                <a class="w-100 btn btn-label-primary btn-sm py-0 d-flex align-items-center" href="/detailkelas/{{ $item->id }}">
                    <span class="me-2" style="font-size: 0.9rem">Detail</span>
                    <i class="bx bx-chevron-right lh-1 scaleX-n1-rtl" style="font-size: 20px"></i>
                </a>
                <form action="{{ route('keranjang.tambah') }}" method="POST">
                    <button type="submit" class="btn btn-label-warning d-flex align-items-center">
                        @csrf
                        <input type="hidden" name="kelas_id" value="{{ $item->id }}">
                        <i class="bx bxs-shopping-bags align-middle" style="font-size: 20px"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
