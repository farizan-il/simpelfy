@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="section">
            <div class="card border">
                <div class="card-header">
                    <h4>Kelola Struktur</h4>
                </div>
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-12 col-lg-8">
                            <div class="wizard-steps">
                                <div class="wizard-step wizard-step-active" style="cursor: pointer;" data-target="#wizard-jabatan">
                                    <div class="wizard-step-icon">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div class="wizard-step-label">
                                        Jabatan
                                    </div>
                                </div>
                                <div class="wizard-step" style="cursor: pointer;" data-target="#wizard-golongan">
                                    <div class="wizard-step-icon">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                    <div class="wizard-step-label">
                                        Golongan
                                    </div>
                                </div>
                                <div class="wizard-step" style="cursor: pointer;" data-target="#wizard-departemen">
                                    <div class="wizard-step-icon">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="wizard-step-label">
                                        Departemen
                                    </div>
                                </div>
                                <div class="wizard-step" style="cursor: pointer;" data-target="#wizard-area">
                                    <div class="wizard-step-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="wizard-step-label">
                                        Area
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="wizard-content mt-5">
                        <!-- Wizard pane for Jabatan -->
                        <div class="wizard-pane" id="wizard-jabatan">
                            <section class="section">
                                <div class="card-body">
                                    
                                    <div class="clearfix mb-3"></div>
                                    <button class="btn btn-sm btn-outline-primary d-none d-md-inline-flex align-items-center mb-4" 
                                        data-bs-toggle="modal" data-bs-target="#modalForm" 
                                        onclick="openModal('Jabatan', 'Nama Jabatan', 'Tanggal Pembuatan')">
                                        Tambahkan Jabatan
                                    </button>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Nama Jabatan</th>
                                                <th>Dibuat pada</th>
                                                <th>Aksi</th>
                                            </tr>
                                            @foreach ($jabatans as $item)   
                                            <tr>
                                                <td>{{ $item->jabatan }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-label-danger" onclick="confirmDelete('{{ $item->id }}')" style="cursor: pointer;">
                                                        <i class="bx bx-trash "></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>                    
                                </div>
                            </section>
                        </div>
            
                        <!-- Wizard pane for Golongan -->
                        <div class="wizard-pane" id="wizard-golongan" style="display: none;">
                            <section class="section">
                                <div class="card-body">
                                    
                                    <div class="clearfix mb-3"></div>
                                    <button class="btn btn-sm btn-outline-primary d-none d-md-inline-flex align-items-center mb-4" 
                                        data-bs-toggle="modal" data-bs-target="#modalForm" 
                                        onclick="openModal('Golongan', 'Nama Golongan', 'Tanggal Pembuatan')">
                                        Tambahkan Golongan
                                    </button>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Nama Jabatan</th>
                                                <th>Dibuat pada</th>
                                                <th>Aksi</th>
                                            </tr>
                                            @foreach ($golongans as $item)   
                                            <tr>
                                                <td>{{ $item->golongan }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-label-danger" onclick="confirmDelete('{{ $item->id }}')" style="cursor: pointer;">
                                                        <i class="bx bx-trash "></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>                    
                                </div>
                            </section>
                        </div>
            
                        <!-- Wizard pane for Departemen -->
                        <div class="wizard-pane" id="wizard-departemen" style="display: none;">
                            <section class="section">
                                <div class="card-body">
                                    
                                    <div class="clearfix mb-3"></div>
                                    <button class="btn btn-sm btn-outline-primary d-none d-md-inline-flex align-items-center mb-4" 
                                        data-bs-toggle="modal" data-bs-target="#modalForm" 
                                        onclick="openModal('Departement', 'Nama Departemen', 'Tanggal Pembuatan')">
                                        Tambahkan Departemen
                                    </button>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Nama Jabatan</th>
                                                <th>Dibuat pada</th>
                                                <th>Aksi</th>
                                            </tr>
                                            @foreach ($departements as $item)   
                                            <tr>
                                                <td>{{ $item->departement }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-label-danger" onclick="confirmDelete('{{ $item->id }}')" style="cursor: pointer;">
                                                        <i class="bx bx-trash "></i>
                                                    </button> 
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>                    
                                </div>
                            </section>
                        </div>
            
                        <!-- Wizard pane for Area -->
                        <div class="wizard-pane" id="wizard-area" style="display: none;">
                            <section class="section">
                                <div class="card-body">
                                    
                                    <div class="clearfix mb-3"></div>
                                    <button class="btn btn-sm btn-outline-primary d-none d-md-inline-flex align-items-center mb-4" 
                                        data-bs-toggle="modal" data-bs-target="#modalForm" 
                                        onclick="openModal('Area', 'Nama Area', 'Tanggal Pembuatan')">
                                        Tambahkan Area
                                    </button>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Nama Jabatan</th>
                                                <th>Dibuat pada</th>
                                                <th>Aksi</th>
                                            </tr>
                                            @foreach ($areas as $item)   
                                            <tr>
                                                <td>{{ $item->area }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-label-danger" onclick="confirmDelete('{{ $item->id }}')" style="cursor: pointer;">
                                                        <i class="bx bx-trash "></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>                    
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk menambahkan data --}}
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Form Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="wizardForm">
                        @csrf
                        <!-- Dynamic content will be injected here -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveData">Save</button>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
<script>

    // awal script untuk wizard
    document.querySelectorAll('.wizard-step').forEach(function(step) {
        step.addEventListener('click', function() {
            // Remove active class from all steps
            document.querySelectorAll('.wizard-step').forEach(function(item) {
                item.classList.remove('wizard-step-active');
            });
            // Add active class to clicked step
            step.classList.add('wizard-step-active');

            // Hide all wizard panes
            document.querySelectorAll('.wizard-pane').forEach(function(pane) {
                pane.style.display = 'none';
            });

            // Show the corresponding wizard pane
            const targetPane = step.getAttribute('data-target');
            document.querySelector(targetPane).style.display = 'block';
        });
    });
    // akhir untuk script wizard


    // awal js untuk modal
    function openModal(title, inputLabel1, inputLabel2) {
        // Set the modal title
        document.getElementById('modalLabel').innerText = `Tambah ${title}`;

        // Set the dynamic form content
        const formContent = `
            <div class="form-group">
                <label for="input1">${inputLabel1}</label>
                <input type="text" class="form-control" id="input1" name="input1" placeholder="Masukkan ${inputLabel1}">
            </div>
        `;

        // Inject the form content into the modal body
        document.getElementById('wizardForm').innerHTML = formContent;
    }

    document.getElementById('saveData').addEventListener('click', function() {
        const input1 = document.getElementById('input1').value;
        const type = document.getElementById('modalLabel').innerText.toLowerCase().replace('tambah ', '');

        // AJAX request to send data to the server
        $.ajax({
            url: "{{ route('kelolastruktur.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // CSRF token for security
                input1: input1,
                type: type // Send the type to determine the model
            },
            success: function(response) {
                // Close the modal
                $('#modalForm').modal('hide');

                // SweetAlert for success
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil disimpan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            },
            error: function(xhr) {
                // SweetAlert for error
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
    
</script>
@endsection

