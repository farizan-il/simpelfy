@extends('gondowangi.frontend.layout.main')

@section('head')
    <title>{{ $title }}</title>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <section class="section-py bg-body first-section-pt">
        <div class="container">
            <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example">
                <div class="bs-stepper-content">
                    <form id="checkout-form" action="{{ route('paymentkelas.index') }}" method="GET">
                        <div id="checkout-cart" class="content">
                            <div class="row">
                                @csrf
                                <div class="col-xl-8 mb-6 mb-xl-0">
                                    <h5>Keranjang Anda ({{ $jumlahKeranjang }})</h5>
                                    
                                    @if($keranjang->isEmpty())
                                        <div class="list-group">
                                            <a href="/explore" class="list-group-item text-primary border-primary d-flex justify-content-between">
                                                <span class="fw-medium">Keranjang kamu kosong nih..... Gas beli kelas!! </span>
                                                <i class="bx bx-sm bx-right-arrow-alt scaleX-n1-rtl mt-50"></i>
                                            </a>
                                        </div>
                                    @else
                                        <ul class="list-group mb-4">
                                            @foreach ($keranjang as $item)
                                            <li class="list-group-item p-3">
                                                <div class="d-flex gap-3 flex-sm-row align-items-center">
                                                    <input class="form-check-input item-checkbox" id="defaultCheck1{{ $item->id }}" type="checkbox" name="items[]" value="{{ $item->id }}" data-harga="{{ $item->kelas->harga }}" data-nama="{{ $item->kelas->title }}" style="cursor: pointer;" />
                                                    <label class="form-check-label col-11 d-flex gap-4 flex-sm-row flex-column align-items-center" for="defaultCheck1{{ $item->id }}">
                                                        <div class="flex-shrink-0 d-flex align-items-center">
                                                            <img src="{{ asset('image/kelas-sampul/' . $item->kelas->foto) }}" alt="google home" class="w-px-100 rounded">
                                                        </div>
                                                        <div class="flex-grow-1 p-0">
                                                            <div class="row text-center text-sm-start">
                                                                <div class="col-md-8 mt-3">
                                                                    <p class="me-3 mb-2">
                                                                        <span class="text-heading">{{ $item->kelas->title }}</span>
                                                                    </p>
                                                                    <div class="text-muted mb-2 d-flex flex-wrap justify-content-center justify-content-sm-start">
                                                                        <span class="me-1">Kategori:</span> 
                                                                        <span class="badge bg-label-warning">{{ $item->kelas->kategori->namaKategori }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="text-md-end">
                                                                        <form id="delete-form-{{ $item->id }}" action="{{ route('keranjang.destroy', $item->id) }}" method="POST" style="display: none;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>
                                                                        <button type="button" class="btn-delete" data-id="{{ $item->id }}" style="border: none; background: none;">
                                                                            <i class='bx bxs-trash text-danger'></i>
                                                                        </button>
                                                                        <div class="d-flex d-md-block align-items-center mb-2 gap-2 justify-content-center justify-content-sm-start">
                                                                            <div class="my-2 mt-md-8 mb-md-4">
                                                                                <strong class="text-primary">IDR {{ number_format($item->kelas->harga, 0, ',', '.') }}</strong>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                        </ul>
                                    @endif
                                </div>
                                
                                <div class="col-xl-4">
                                    <div class="border card rounded p-6 mb-4">
                                        <h6>Detail Keranjang</h6>
                                        <ul>
                                            <li><span id="jumlahKelas">Tidak ada kelas yang dipilih</span></li>
                                        </ul>
                                        <hr class="mx-n6 my-6">
                                        <dl class="row mb-0">
                                            <dt class="col-6 text-heading">Total</dt>
                                            <dd class="col-6 fw-medium text-end text-heading mb-0" id="totalHarga">IDR 0</dd>
                                        </dl>
                                    </div>
                                    <div class="d-grid">
                                        <button id="checkoutButton" type="submit" class="btn btn-primary btn-next">Lanjutkan Pembelian</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        });
    </script>
@endif
@endsection

@section('script')

    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
        document.onkeydown = function(e) {
            if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J'))) {
                return false;
            }
        };
    </script>

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                var itemId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Item akan dihapus dari keranjang!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + itemId).submit();
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const totalHargaElement = document.getElementById('totalHarga');
            const jumlahKelasElement = document.getElementById('jumlahKelas');
            const checkoutButton = document.getElementById('checkoutButton');
            const gonpayUser = {{ $gonpayUser }}; // Gonpay user value from controller
            
            let totalHarga = 0;
            let selectedItems = [];

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const harga = parseInt(this.getAttribute('data-harga'));
                    const nama = this.getAttribute('data-nama');

                    if (this.checked) {
                        totalHarga += harga;
                        selectedItems.push(nama);
                    } else {
                        totalHarga -= harga;
                        const index = selectedItems.indexOf(nama);
                        if (index > -1) {
                            selectedItems.splice(index, 1);
                        }
                    }

                    totalHargaElement.textContent = 'IDR ' + totalHarga.toLocaleString('id-ID');
                    jumlahKelasElement.textContent = selectedItems.length > 0 ? selectedItems.join(', ') : 'Tidak ada kelas yang dipilih';

                    // Cek apakah total harga melebihi Gonpay
                    if (totalHarga > gonpayUser) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Saldo Gonpay tidak cukup',
                            text: 'Jumlah total keranjang melebihi saldo Gonpay Anda.',
                            confirmButtonText: 'OK'
                        });
                        checkoutButton.disabled = true;
                    } else {
                        checkoutButton.disabled = false;
                    }
                });
            });
        });
    </script>
@endsection