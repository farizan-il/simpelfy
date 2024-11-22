@extends('gondowangi.frontend.layout.main')

@section('head')
    <title>{{ $title }}</title>
@endsection

@section('content')
@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        });
    </script>
@endif

<div class="container-xxl flex-grow-1 container-p-y">
    <div id="checkout-address" class="content">
        <div class="row">
            <!-- Address left -->
            <div class="col-xl-5 mb-6 mb-xl-0">
                <!-- Select address -->
                <p class="fw-medium text-heading">Data Pembeli Kelas</p>
                <div class="row mb-4 g-6">
                    <div class="col-12">
                        <div class="form-check custom-option custom-option-basic checked">
                            <label class="form-check-label custom-option-content" for="customRadioAddress1">
                                <input name="customRadioTemp" class="form-check-input" type="radio" value="" id="customRadioAddress1" checked="">
                                <span class="custom-option-header mb-2">
                                    <span class="fw-medium text-heading mb-0">{{ Auth::user()->profile->nama }}</span>
                                    <span class="badge bg-label-primary">Default</span>
                                </span>
                                <span class="custom-option-body">
                                    <small> NIK : {{ Auth::user()->profile->nik }} <br> Email : {{ Auth::user()->email }} </small>
                                    <span class="my-3 border-bottom d-block"></span>
                                    <span class="d-flex mb-1_5">
                                        <a class="me-4" href="javascript:void(0)">Edit</a>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Address right -->
            <div class="col-xl-7">
                <div class="border card rounded p-6 mb-4">
                    <div class="row g-4 mb-4">
                        <div class="col-8 col-xxl-8 col-xl-12">
                            <input type="text" class="form-control" id="kodeVoucher" placeholder="Masukan Kode Voucher" aria-label="Masukan Kode Voucher">
                        </div>
                        <div class="col-4 col-xxl-4 col-xl-12">
                            <div class="d-grid">
                                <button type="button" id="applyVoucherBtn" class="btn btn-label-warning">Terapkan</button>
                            </div>
                        </div>
                    </div>
            
                    <hr class="dashed">
                    <h6>Rincian Penagihan</h6>
                    <ul class="list-unstyled">
                        @foreach($keranjang as $item)
                            <li class="d-flex gap-4 align-items-center py-2 mb-4">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('image/kelas-sampul/' . $item->kelas->foto) }}" alt="google home" class="w-px-50 rounded">
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-0"><a class="text-body">{{ $item->kelas->title }}</a></p>
                                    <p class="fw-medium mb-0">IDR {{ number_format($item->kelas->harga, 0, ',', '.') }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <hr class="mx-n6 my-6">
            
                    <h6>Detail Harga</h6>
                    <dl class="row mb-0 text-heading">
                        <dt class="col-6 fw-normal">Harga Total</dt>
                        <dd class="col-6 text-end" id="hargaTotal">IDR {{ number_format($total, 0, ',', '.') }}</dd>
                    
                        <dt class="col-6 fw-normal">Potongan Harga</dt>
                        <dd class="col-6 text-end" id="potonganHarga">
                            <s class="text-muted" id="potonganHargaValue">IDR 0</s> 
                            <span id="kodeVoucherLabel" class="badge bg-label-success ms-2"></span>
                        </dd>
                    </dl>
                    
                    <dl class="row mb-0">
                        <dt class="col-6 text-heading">Total</dt>
                        <dd class="col-6 fw-medium text-end text-heading mb-0">
                            <strong id="hargaDiskon" class="text-warning">IDR {{ number_format($total, 0, ',', '.') }}</strong>
                        </dd>
                    </dl>
                </div>
                <div class="d-grid justify-content-end">
                    <form id="paymentForm" method="POST" action="{{ route('paymentkelas.store') }}">
                        @csrf
                        <button type="button" id="confirmPayment" class="btn btn-primary btn-next">Selesaikan Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.getElementById('applyVoucherBtn').addEventListener('click', function() {
        console.log('Tombol Terapkan diklik');  // Tambahkan log ini

        let kodeVoucher = document.getElementById('kodeVoucher').value;
        let kelasId = {{ $item->kelas->id }};

        fetch("{{ route('apply.voucher') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ kodeVoucher: kodeVoucher, kelasId: kelasId })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Tambahkan log untuk melihat respons dari server
            if (data.success) {
                document.getElementById('potonganHarga').innerHTML = `IDR ${data.potonganHarga.toLocaleString('id-ID')}`;
                document.getElementById('hargaDiskon').innerHTML = `IDR ${data.hargaSetelahDiskon.toLocaleString('id-ID')}`;
                document.getElementById('kodeVoucherLabel').textContent = `#${data.kodeVoucher}`;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat menerapkan voucher.',
            });
        });
    });


</script>


<script>
    document.getElementById('confirmPayment').addEventListener('click', function (e) {
        // Munculkan SweetAlert untuk konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menyelesaikan pembayaran ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#696cff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, selesaikan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna konfirmasi, submit form
                document.getElementById('paymentForm').submit();
            }
        });
    });
</script>
@endsection
