@extends('gondowangi.frontend.layout.main')

@section('head')
    <title>{{ $title }}</title>
    <style>
        .app-chat {
            margin: auto;
            height: 80vh;
        }
        .chat-history-body {
            height: 60vh;
            overflow-y: auto;
        }
        .chat-message {
            margin-bottom: 1rem;
        }
        .chat-message-right .chat-message-wrapper {
            color: white;
            padding: 10px 15px;
        }
        .chat-message .chat-message-wrapper {
            background-color: #f1f1f1;
            padding: 10px 15px;
        }
        .chat-message .user-avatar img,
        .chat-message-right .user-avatar img {
            width: 30px;
            height: 30px;
            object-fit: cover;
        }
        .message-input {
            border-radius: 20px;
            padding-left: 15px;
        }
        .message-actions i,
        .send-msg-btn i {
            font-size: 1.2em;
        }
        .send-msg-btn {
            border-radius: 50%;
            padding: 8px 12px;
        }
    </style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-chat card overflow-hidden shadow-sm">
        <div class="row g-0">

            <!-- Chat Contacts -->
            <div class="col-md-3 app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
                <div class="sidebar-body py-2 px-4">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#complaintModal">
                        Buat Pengaduan
                    </button>
                    <ul class="list-unstyled chat-contact-list mt-3 mb-0">
                        <li class="mb-2"><strong>Riwayat Pengaduan</strong></li>
                        @foreach($pengaduan as $item)
                            <li class="d-flex align-items-center py-2 chat-item" data-id="{{ $item->id }}">
                                <div class="avatar avatar-sm me-2">
                                    @if ($item->status == 'open')
                                        <span class="avatar-initial rounded-circle bg-label-success">OP</span>
                                    @elseif($item->status == 'in_progress')
                                        <span class="avatar-initial rounded-circle bg-label-warning">PG</span>  
                                    @else
                                        <span class="avatar-initial rounded-circle bg-label-secondary">CL</span> 
                                    @endif
                                </div>
                                <span>{{ $item->title }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>


            <!-- Chat History -->
            <div class="col-md-9 app-chat-history">
                <div class="chat-history-wrapper ">
                    <div class="chat-history-header border-bottom py-2 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-sm me-2">
                                <span class="avatar-initial rounded-circle bg-label-danger">Ad</span>
                            </div>
                            <div>
                                <h6 class="m-0">Admin</h6>
                                {{-- <small class="text-muted">Judul pengaduannya</small> --}}
                            </div>
                        </div>
                    </div>

                    <div class="chat-history-body p-4">
                        <ul class="list-unstyled chat-history">
                            @foreach ($pengaduan as $komplain)
                                @foreach ($komplain->pesanPengaduan->sortBy('sent_at') as $pesan)
                                    
                                @endforeach
                            @endforeach
                        </ul>
                    </div>

                    <!-- Chat message form -->
                    <div class="chat-history-footer p-3 d-flex align-items-center">
                        <input id="messageInput" class="form-control message-input me-3" placeholder="Masukan pesan anda...">
                        <button id="sendMsgBtn" type="button" class="btn btn-primary send-msg-btn">
                            <i class="bx bx-paper-plane"></i>
                        </button>
                    </div>                
                </div>
            </div>
            <!-- /Chat History -->
        </div>
    </div>
</div>

<!-- Modal untuk menampilkan gambar besar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <img src="https://user-images.githubusercontent.com/46939846/263532432-feddb5b8-0e72-4303-ae47-14afe7b34f4d.png" alt="Bukti Error" class="img-fluid">
            </div>
        </div>
    </div>
</div>


<!-- Modal for Pengaduan -->
<div class="modal fade" id="complaintModal" tabindex="-1" aria-labelledby="complaintModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="complaintModalLabel">Buat Pengaduan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="pengaduanForm" action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="proofImage" class="form-label">Unggah Foto Bukti Pengaduan</label>
                        <input type="file" name="proofImage" class="form-control" id="proofImage" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="complaintTitle" class="form-label">Judul Pengaduan</label>
                        <input type="text" name="complaintTitle" class="form-control" id="complaintTitle" placeholder="Masukkan judul pengaduan">
                    </div>
                    <div class="mb-3">
                        <label for="complaintMessage" class="form-label">Pesan Pengaduan</label>
                        <textarea name="complaintMessage" class="form-control" id="complaintMessage" rows="3" placeholder="Masukkan pesan pengaduan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
                </div>
            </form>         
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sendMsgBtn = document.getElementById('sendMsgBtn');
        const messageInput = document.getElementById('messageInput');
        const chatHistoryBody = document.querySelector('.chat-history-body ul.chat-history');
        let currentPengaduanId = null;

        const chatItems = document.querySelectorAll('.chat-item');
        chatItems.forEach(item => {
            item.addEventListener('click', function () {
                currentPengaduanId = this.getAttribute('data-id');
                loadMessages(currentPengaduanId);
            });
        });

        sendMsgBtn.addEventListener('click', function () {
            if (!currentPengaduanId || !messageInput.value.trim()) return;

            const message = messageInput.value.trim();

            fetch(`/pengaduan/${currentPengaduanId}/send-message`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => {
                // Buat elemen list baru untuk pesan yang baru dikirim
                const li = document.createElement('li');
                li.classList.add('chat-message', 'd-flex', 'align-items-end', 'flex-column', 'text-end', 'mb-5');
                li.innerHTML = `
                    <div class="d-flex align-items-top justify-content-end">
                        <div class="chat-message-wrapper bg-light text-dark p-3 rounded-start rounded-bottom" style="max-width: 60%;">
                            <p class="mb-2">${data.message}</p>
                        </div>
                        <div class="user-avatar ms-2">
                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" width="40px">
                        </div>
                    </div>
                    <small class="text-muted mt-1" style="margin-right: 40px;">${formatTimeAMPM(new Date(data.sent_at))}</small>
                `;
                chatHistoryBody.appendChild(li);
                messageInput.value = '';
            })
            .catch(error => console.error('Error sending message:', error));
        });

        function loadMessages(pengaduanId) {
            chatHistoryBody.innerHTML = ''; 

            fetch(`/pengaduan/${pengaduanId}/messages`)
                .then(response => response.json())
                .then(messages => {
                    messages.forEach(message => {
                        const li = document.createElement('li');
                        
                        // Tambahkan kelas yang sesuai berdasarkan sender_type
                        if (message.sender_type === 'user') {
                            li.classList.add('chat-message', 'd-flex', 'align-items-end', 'flex-column', 'text-end', 'mb-5');
                            li.innerHTML = `
                                <div class="d-flex align-items-top justify-content-end">
                                    <div class="chat-message-wrapper bg-light text-dark px-3 py-1 rounded-start rounded-bottom" style="max-width: 80%;">
                                        
                                        <p class="mb-2">${message.message}</p>
                                    </div>
                                    <div class="user-avatar ms-2">
                                        <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" width="40px">
                                    </div>
                                </div>
                                <small class="text-muted mt-1" style="margin-right: 40px;">${formatTimeAMPM(new Date(message.sent_at))}</small>
                            `;
                        } else {
                            li.classList.add('chat-message', 'mb-3');
                            li.innerHTML = `
                                <div class="d-flex">
                                    <div class="user-avatar me-2">
                                        <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" width="40px">
                                    </div>
                                    <div>
                                        <div class="chat-message-wrapper bg-primary text-white p-3 rounded-end rounded-bottom" style="max-width: 70%;">
                                            <p class="mb-0">${message.message}</p>
                                        </div>
                                        <div class="text-end" style="max-width: 380px;">
                                            <small class="text-muted mt-1 d-inline-block">${formatTimeAMPM(new Date(message.sent_at))}</small>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }

                        chatHistoryBody.appendChild(li);
                    });
                })
                .catch(error => console.error('Error fetching messages:', error));
        }

        // Fungsi untuk memformat waktu ke AM-PM
        
    });
</script>

</script>    
    
<script>
    function formatTimeAMPM(dateString) {
        const date = new Date(dateString);
        const options = {
            hour: 'numeric',
            minute: 'numeric',
            hour12: false,
            timeZone: 'Asia/Jakarta'
        };
        return date.toLocaleString('en-US', options);
    }
    chatHistory.scrollTop = chatHistory.scrollHeight;
</script>

@endsection