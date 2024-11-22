@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>

    <style>
        body {
          background-color: #f8f9fa;
        }
    
        .chat-list {
          max-height: 80vh;
          overflow-y: auto;
        }
    
        .chat-item {
          padding: 10px 15px;
          border-radius: 10px;
          margin-bottom: 10px;
        }
    
        .chat-item.active {
          background-color: #4f46e5;
          color: #fff;
        }
    
        .chat-item.active .time {
          color: #fff;
        }
    
        .time {
          font-size: 12px;
          color: #6c757d;
        }
    
        .chat-area {
          background-color: #fff;
          border-radius: 10px;
          padding: 20px;
          max-height: 80vh;
          overflow-y: auto;
        }
    
        .message-input {
          border: none;
          border-top: 1px solid #dee2e6;
          padding: 10px;
        }

        /* Custom scrollbar styling */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px; /* Ubah lebar scrollbar */
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #6f71ec; /* Warna scrollbar */
            border-radius: 10px; /* Membuat sudut scrollbar melingkar */
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #7c7eea; /* Warna scrollbar saat dihover */
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background-color: #f1f1f1; /* Warna track scrollbar */
        }
      </style>
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="row">
              <!-- Sidebar: Daftar Pengaduan -->
              <div class="col-md-4 border-end custom-scrollbar" style="height: 80vh; overflow-y: auto;">
                <div class="p-3">
                    <h6 class="text-primary">Pengaduan Antrian</h6>
                    <div class="chat-list">
                        @foreach ($pengaduanAntrian as $pengaduan)
                            <div class="chat-item" data-bs-auto-close="true" data-id="{{ $pengaduan->id }}">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('image/foto-profile/' . ($pengaduan->credentials->profile->fotoProfile ?? 'https://via.placeholder.com/40')) }}" 
                                    class="rounded-circle me-3" alt="User" width="40">
                                    <div>
                                        <strong>{{ $pengaduan->credentials->profile->nama ?? 'Anonymous' }}</strong>
                                        <p class="mb-0 text-muted small">{{ Str::limit($pengaduan->pesanPengaduan->last()->message ?? 'No messages yet', 20, '...') }}</p>
                                    </div>
                                    <span class="ms-auto text-muted small">{{ $pengaduan->pesanPengaduan->last()?->sent_at->diffForHumans() ?? '-' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
            
                    <h6 class="text-primary mt-4">Pengaduan Selesai</h6>
                    <div class="chat-list">
                        @foreach ($pengaduanSelesai as $pengaduan)
                            <div class="chat-item" data-bs-auto-close="true" data-id="{{ $pengaduan->id }}">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('image/foto-profile/' . ($pengaduan->credentials->profile->fotoProfile ?? 'https://via.placeholder.com/40')) }}" 
                                          class="rounded-circle me-3" alt="User" width="40">
                                    <div>
                                        <strong>{{ $pengaduan->credentials->profile->nama ?? 'Anonymous' }}</strong>
                                        <p class="mb-0 text-muted small">{{ $pengaduan->pesanPengaduan->last()->message ?? 'No messages yet' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                  </div>
                </div>
                          

                <!-- Area Detail Pengaduan -->
                <div class="col-md-8 custom-scrollbar" id="chat-details" style="height: 80vh; overflow-y: auto;">
                  <div class="p-3">
              
                      <!-- Sticky Header -->
                      <div class="d-flex align-items-center mb-3" style="position: sticky; top: 0; background: white; z-index: 10; padding: 0.5rem 0;">
                          <img src="{{ asset('image/foto-profile/' . ($pengaduan->credentials->profile->fotoProfile ?? 'https://via.placeholder.com/40')) }}" width="30" class="rounded-circle me-3" alt="User">
                          <div>
                              <strong>{{ $pengaduan->credentials->profile->nama ?? 'Anonymous' }}</strong>
                              <p class="mb-0 text-muted small">{{ $pengaduan->credentials->profile->departement->departement ?? 'Anonymous' }}</p>
                          </div>
                      </div>
                      <hr>
              
                      <!-- Chat Messages -->
                      <div id="chat-messages">
                          <!-- Pesan chat akan dimuat di sini -->
                      </div>
              
                      <!-- Sticky Input -->
                      <div class="input-group mt-3" style="position: sticky; bottom: 0; background: white; z-index: 10; padding: 0.5rem 0;">
                          <input type="text" class="form-control" placeholder="Type your message here...">
                          <button class="btn btn-primary" type="button">Send</button>
                      </div>
                  </div>
              </div>              
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection


@section('script')
  <script>
    // Menangani klik pada pengaduan di sidebar
    document.querySelectorAll('.chat-item').forEach(item => {
        item.addEventListener('click', function() {
            const pengaduanId = this.getAttribute('data-id');

            // Memuat detail chat untuk pengaduan yang dipilih
            fetch(`/pengaduankaryawan/${pengaduanId}/detail`)
                .then(response => response.json())
                .then(data => {
                    // Menampilkan pesan chat pada area detail
                    const chatMessagesContainer = document.getElementById('chat-messages');
                    chatMessagesContainer.innerHTML = '';

                    data.messages.forEach(message => {
                        const messageElement = document.createElement('div');
                        messageElement.classList.add('d-flex', 'align-items-center', 'mb-3');
                        messageElement.innerHTML = `
                            <p class="bg-light rounded p-3">${message.text}</p>
                        `;
                        chatMessagesContainer.appendChild(messageElement);
                    });

                    // Memperbarui header dengan info pengaduan yang dipilih
                    const chatHeader = document.querySelector('#chat-details .d-flex');
                    chatHeader.querySelector('strong').textContent = data.user.name;
                    chatHeader.querySelector('p').textContent = data.user.role;
                })
                .catch(error => console.error('Error loading chat details:', error));
        });
    });
  </script>
@endsection
