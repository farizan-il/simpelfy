@extends('gondowangi.backend.layout.main')

@section('head')
    <title>{{ $title }}</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>@endsection

@section('content')    
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-12">
            <div class="card mb-4 border">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Menambahkan Kelas</h5>
                    <small class="text-muted float-end">
                        <div class="col-sm-10">
                            <a href="/kelolakelas" class="btn btn-sm btn-primary d-none d-md-inline-flex align-items-center">
                                <i class="bx bx-arrow-back me-1"></i> Kembali
                            </a>
                        </div>
                    </small>
                </div>
                <hr>
                <div class="card-body">
                    <form action="/kelolakelas" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- judul Kelas --}}
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">Judul Kelas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="judul" id="basic-default-company"/>
                            </div>
                        </div>

                        {{-- subtitle Kelas --}}
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">Subjudul Kelas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subtitle" id="basic-default-company"/>
                            </div>
                        </div>

                        {{-- kategori Kelas --}}
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label" for="basic-default-subtitle">kategori Kelas</label>
                            <div class="form-group col-10">
                                <select class="form-control" name="kategori" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->namaKategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- deskripsi Kelas --}}
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Deskripsi Kelas</label>
                            <div class="col-sm-10">
                                <textarea id="body" name="deskripsi" class="form-control"
                                    aria-describedby="basic-icon-default-message2"></textarea>
                            </div>
                        </div>

                        {{-- gambar Kelas --}}
                        <div class="row mt-3 mb-3">
                            <label class="col-sm-2 col-form-label" for="inputGroupFile02">Sampul Kelas</label>
                            <div class="col-sm-10">
                                <div class="input-group ">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="gambar">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>
                            </div>
                        </div>

                        {{-- Keuntungan Kelas --}}
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Keuntungan Kelas</label>
                            <div class="col-sm-10">
                                <textarea  name="keuntungan" class="form-control col-12" aria-describedby="basic-icon-default-message2"></textarea>
                                <div class="form-text">Jika lebih dari satu, pisahkan menggunakan slash(/)
                                    <button type="button" class="btn btn-white p-0 btn-sm" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Contoh: <br> Keuntungan A/Keuntungan B/Keuntungan C/..</span>">
                                        <i class='bx bxs-info-circle' ></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- syarat Kelas --}}
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Syarat Kelas</label>
                            <div class="col-sm-10">
                                <textarea  name="syarat" class="form-control col-12"
                                        aria-describedby="basic-icon-default-message2"></textarea>
                                <div class="form-text">Jika lebih dari satu, pisahkan menggunakan slash(/)</div>
                            </div>
                        </div>

                        {{-- golongan --}}
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Departemen</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kelasSelectDepartement" name="departement">
                                    <option value="" disabled selected>Pilih Departement</option>
                                    <option value="all">Semua Departement</option>
                                    @foreach ($departemen as $item)
                                        <option value="{{ $item->id }}">{{ $item->departement }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- golongan --}}
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Golongan</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kelasSelectGolongan" name="golongan">
                                    <option value="" disabled selected>Pilih Golongan</option>
                                    <option value="all">Semua Golongan</option>
                                    @foreach ($golongan as $item)
                                        <option value="{{ $item->id }}">{{ $item->golongan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- instruktur --}}
                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Dibuat oleh</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    {{-- <input type="text" name="instruktur" id="basic-default-email" class="form-control" value="{{Auth::user()->profile->nama}}" readonly/> --}}
                                    <input type="text" name="instruktur" id="basic-default-email" class="form-control" value="Farizan" readonly/>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Apakah kelas ini wajib?</label>
                            <div class="col-sm-10">
                                <!-- Radio Button 'Iya' -->
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="kelasWajib" class="custom-control-input" value="iya">
                                    <label class="custom-control-label" for="customRadioInline1">Iya</label>
                                </div>
                                <!-- Radio Button 'Tidak' -->
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="kelasWajib" class="custom-control-input" value="tidak">
                                    <label class="custom-control-label" for="customRadioInline2">Tidak</label>
                                </div>
                            
                                <!-- Form Select (Initially Hidden) -->
                                <div id="selectForm" class="mt-4" style="display: none;">
                                    <div>
                                        <label for="kelasSelectDepartement">Untuk Departement?</label>
                                        <select class="form-control" id="kelasSelectDepartement" name="departement">
                                            <option value="" disabled selected>Pilih Departement</option>
                                            <option value="all">Semua Departement</option>
                                            @foreach ($departemen as $item)
                                                <option value="{{ $item->id }}">{{ $item->departement }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-4">
                                        <label for="kelasSelectGolongan">Untuk Golongan?</label>
                                        <select class="form-control" id="kelasSelectGolongan" name="golongan">
                                            <option value="" disabled selected>Pilih Golongan</option>
                                            <option value="all">Semua Golongan</option>
                                            @foreach ($golongan as $item)
                                                <option value="{{ $item->id }}">{{ $item->golongan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>                                        
                            </div>
                        </div>

                        {{-- kode form lainnya --}}
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>
    <script>
        // This sample still does not showcase all CKEditor&nbsp;5 features (!)
        // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
        CKEDITOR.ClassicEditor.create(document.getElementById("body"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
                    '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: '...',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                        '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                'MathType',
                // The following features are part of the Productivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced'
            ]
        });
    </script>

    {{-- script untuk menampilkan form selected jika admin pilih checkbox iya di modal kelas wajib --}}
    <script>
        const radioYes = document.getElementById('customRadioInline1');
        const radioNo = document.getElementById('customRadioInline2');
        const selectForm = document.getElementById('selectForm');
        const saveButton = document.getElementById('saveData');
        const kelasWajibHidden = document.getElementById('kelasWajibHidden');
        const departementHidden = document.getElementById('departementHidden');
        const golonganHidden = document.getElementById('golonganHidden');

        // Tampilkan form departemen jika pilih "Iya"
        radioYes.addEventListener('change', function() {
            if (radioYes.checked) {
                selectForm.style.display = 'block';
            }
        });

        // Sembunyikan form departemen jika pilih "Tidak"
        radioNo.addEventListener('change', function() {
            if (radioNo.checked) {
                selectForm.style.display = 'none';
            }
        });

        // Event listener tombol save modal
        saveButton.addEventListener('click', function() {
            const kelasWajib = document.querySelector('input[name="kelasWajib"]:checked').value;
            const departement = document.querySelector('select[name="departement"]').value;
            const golongan = document.querySelector('select[name="golongan"]').value;

            if (kelasWajib === 'iya' && (departement === "" || golongan === "")) {
                alert("Harap pilih departemen dan golongan untuk kelas wajib.");
                return;
            }

            // Set hidden input values
            kelasWajibHidden.value = kelasWajib;
            departementHidden.value = departement;
            golongantHidden.value = golongan;

            // Close modal
            $('#modalForm').modal('hide');
        });
    </script>
@endsection