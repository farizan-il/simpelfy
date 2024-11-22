@extends('gondowangi.backend.layout.main')

@section('head')
    <title>{{ $title }}</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>
@endsection

@section('content')    
    <!-- Content wrapper -->
    <div class="main-content">
        <section class="section">

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-12">
                    <div class="card mb-4 shadow">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Materi</h5>
                            <small class="text-muted float-end">Default label</small>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">ID Kursus</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="basic-default-name"
                                            value="{{ $dataKelas->id }}" readonly/>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Judul Kursus</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" id="basic-default-company"
                                            value="{{ $dataKelas->title }}" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Dibuat oleh</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="basic-default-email" class="form-control"
                                                value="{{ $dataKelas->instruktur }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-default-message">Deskripsi Kursus</label>
                                    <div class="col-sm-10">
                                        <textarea id="body" name="deskripsi" class="form-control"
                                            aria-describedby="basic-icon-default-message2">{{ old('deskripsi', $dataKelas->deskripsi) }}</textarea>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <label class="col-sm-2 col-form-label" for="inputGroupFile02">Gambar</label>
                                    <div class="col-sm-10">
                                        <div class="input-group ">
                                            <input type="file" class="form-control" id="inputGroupFile02">
                                            <label class="input-group-text" for="inputGroupFile02" >Upload</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Keuntungan Kursus</label>
                                    <div class="col-sm-10">
                                        <textarea  name="deskripsi" class="form-control col-12"
                                                aria-describedby="basic-icon-default-message2">{{ old('keuntungan', $dataKelas->keuntungan) }}</textarea>
                                        <div class="form-text">Jika lebih dari satu, pisahkan menggunakan (koma)</div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Syarat Kursus</label>
                                    <div class="col-sm-10">
                                        <textarea  name="deskripsi" class="form-control col-12"
                                                aria-describedby="basic-icon-default-message2">{{ old('keuntungan', $dataKelas->syarat) }}</textarea>
                                        <div class="form-text">Jika lebih dari satu, pisahkan menggunakan (koma)</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
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
@endsection