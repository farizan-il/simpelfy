@extends('gondowangi.frontend.layout.main')

@section('head')
  <title>{{ $title }}</title>

  <style>
    /* style untuk slider onboard */
    .tag {
            display: inline-block;
            background-color: #e0e7ff;
            color: #4f46e5;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 5px;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .tag i {
            cursor: pointer;
            margin-left: 5px;
        }

        /* style untuk animasi illustrator */
        .illustration-container {
            display: inline-block;
            perspective: 1000px;
        }

        .illustration {
            transition: transform 0.2s ease, filter 0.2s ease;
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Efek hover */
        .illustration-container:hover .illustration {
            filter: brightness(1.1) saturate(1.1);
        }

        /* CSS untuk responsif */
        .illustration {
            max-width: 100%;
            height: auto;
        }
  </style>
@endsection

@section('hideforoboard1')
    style="display:none;"
@endsection

@section('hideforoboard')
    style="display:none;"
@endsection

@section('content')
  <div class="modal-onboarding modal fade animate__animated" id="onboardingSlideModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content text-center">
        <div id="modalCarouselControls" class="carousel slide pb-6 mb-2" data-bs-interval="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#modalCarouselControls" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#modalCarouselControls" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#modalCarouselControls" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="onboarding-media">
                        <div class="illustration-container mx-2">
                        <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/girl-with-laptop-light.png" alt="girl-with-laptop-light" width="335" class="img-fluid" data-app-dark-img="illustrations/girl-with-laptop-dark.png" data-app-light-img="illustrations/girl-with-laptop-light.png">
                        </div>
                    </div>
                    <div class="onboarding-content">
                        <h4 class="onboarding-title text-body">Haloo {{ Auth::user()->profile->nama }}, <br>kamu biasa dipanggil apa nihh....</h4>
                        <form>
                        <div class="row g-6">
                            <div class="col-sm-12">
                            <div class="mb-4">
                                <label for="nameEx" class="form-label">Nama Panggilan</label>
                                <input class="form-control" placeholder="Masukan nama panggilan kamu..." type="text" value="" tabindex="0" id="nameEx">
                            </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="onboarding-media">
                        <div class="illustration-container mx-2">
                            <img
                                src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/boy-with-laptop-light.png"
                                alt="boy-with-laptop-light"
                                width="300"
                                class="img-fluid illustration"
                                data-app-dark-img="illustrations/boy-with-laptop-dark.png"
                                data-app-light-img="illustrations/boy-with-laptop-light.png"
                            >
                        </div>
                    </div>
                    <div class="onboarding-content">
                        <h4 class="onboarding-title text-body">Tertarik coba hal baru?🤩</h4>
                        <div class="onboarding-info">Btw, selain belajar tentang <span class="bg-label-warning text-warning p-1 rounded">{{ Auth::user()->profile->departement->departement }}</span>, masih banyak kategori seru lainnya yang bisa kamu pelajari, lhoo! <br></div>
                        <form>
                            <div class="row g-6">
                                <div class="col-sm-12">
                                    <div class="mb-4">
                                        <label for="roleEx2" class="form-label">pilih maksimal 5 topik yang paling menarik menurut kamu:</label>
                                        <div class="form-control d-flex flex-wrap border-0 px-0" id="tagsContainer"></div>
                                        <select class="form-select mt-2" id="roleEx2" onchange="addTag()">
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            @foreach ($kategoriList as $item)
                                                <option value="{{ $item->id }}" data-name="{{ $item->namaKategori }}">{{ $item->namaKategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- wizard onborad penutup --}}
                <div class="carousel-item">
                    <div class="onboarding-media">
                        <div class="mx-2 illustration-container">
                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/girl-verify-password-light.png" alt="girl-verify-password-light" width="300" class="img-fluid" data-app-dark-img="illustrations/girl-verify-password-dark.png" data-app-light-img="illustrations/girl-verify-password-light.png">
                        </div>
                    </div>
                    <div class="onboarding-content">
                        <h4 class="onboarding-title text-body">Selamat datang di perjalanan baru! 🚀</h4>
                        <div class="onboarding-info">Mulai petualanganmu dan eksplorasi pengetahuan baru yang pastinya seru dan bermanfaat 💪</div>
                        <form action="{{ route('onboarding.submit') }}" method="POST" onsubmit="submitCategories(event)">
                          @csrf
                          <div id="kategoriContainer"></div> <!-- Input tersembunyi akan diisi di sini -->
                          <div class="row g-6"> 
                              <center>
                                  <button type="submit" class="btn btn-success w-50 mt-3">Mulai Belajar</button>
                              </center>
                          </div>
                      </form>
                    </div>
                </div>
            </div>
            
            <a class="carousel-control-next" href="#modalCarouselControls" role="button" data-bs-slide="next">
                <span>Next</span><i class="bx bx-chevrons-right lh-1"></i>
            </a>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
    <script>
      document.addEventListener("DOMContentLoaded", function() {
          var onboardingModal = new bootstrap.Modal(document.getElementById('onboardingSlideModal'));
          onboardingModal.show();
      });
    </script>

    <script>
        const maxTags = 5;
        const tagsContainer = document.getElementById("tagsContainer");
        const select = document.getElementById("roleEx2");
        let selectedTags = [];

        function addTag() {
            const selectedValue = select.value;
            const selectedText = select.options[select.selectedIndex]?.getAttribute("data-name");

            // Cek jika kategori sudah dipilih atau sudah mencapai batas maksimal
            if (!selectedValue || selectedTags.length >= maxTags || selectedTags.some(tag => tag.id === selectedValue)) {
                select.value = ""; // Reset pilihan select
                return;
            }

            // Tambahkan kategori ke array `selectedTags`
            selectedTags.push({ id: selectedValue, name: selectedText });

            // Render ulang tampilan tag dan opsi select
            renderTags();
            updateSelectOptions();
            
            // Reset pilihan select
            select.value = ""; 
        }

        function removeTag(tagId) {
            // Hapus tag berdasarkan id dari array `selectedTags`
            selectedTags = selectedTags.filter(tag => tag.id !== tagId);

            // Render ulang tampilan tag dan opsi select setelah penghapusan
            renderTags();
            updateSelectOptions();
        }

        function renderTags() {
            // Kosongkan `tagsContainer` sebelum menambahkan tag baru
            tagsContainer.innerHTML = "";

            selectedTags.forEach(tag => {
                const tagElement = document.createElement("span");
                tagElement.classList.add("tag");
                tagElement.innerHTML = `${tag.name} <i onclick="removeTag('${tag.id}')" class="bx bx-x"></i>`;
                tagsContainer.appendChild(tagElement);
            });
        }

        function updateSelectOptions() {
            // Reset semua opsi ke terlihat
            for (let i = 0; i < select.options.length; i++) {
                select.options[i].style.display = "block";
            }

            // Sembunyikan opsi yang sudah dipilih
            selectedTags.forEach(tag => {
                const option = select.querySelector(`option[value="${tag.id}"]`);
                if (option) {
                    option.style.display = "none";
                }
            });
        }

        select.addEventListener("change", addTag); // Memastikan `addTag` dipanggil saat kategori dipilih
    </script>

    {{-- script untuk animasi illustrator --}}
    <script>
      // JavaScript untuk mengikuti gerakan kursor
      document.querySelector('.illustration-container').addEventListener('mousemove', (e) => {
          const illustration = e.currentTarget.querySelector('.illustration');
          const rect = e.currentTarget.getBoundingClientRect();
          const x = (e.clientX - rect.left) / rect.width - 0.9;
          const y = (e.clientY - rect.top) / rect.height - 0.5;
      
          // Adjust illustration's rotation based on cursor position
          illustration.style.transform = `rotateX(${y * 25}deg) rotateY(${x * 15}deg)`;
      });
      
      // Reset posisi saat kursor keluar dari ilustrasi
      document.querySelector('.illustration-container').addEventListener('mouseleave', (e) => {
          const illustration = e.currentTarget.querySelector('.illustration');
          illustration.style.transform = 'rotateX(0) rotateY(0)';
      });
    </script>

    {{-- script untuk menyimpan data --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const onboardingModal = new bootstrap.Modal(document.getElementById('onboardingSlideModal'));
            const nextButton = document.getElementById("nextButton");
            const modalCarousel = document.getElementById("modalCarouselControls");
            const kategoriContainer = document.getElementById("kategoriContainer");

            onboardingModal.show();

            // Event listener untuk menyembunyikan tombol Next di slide terakhir
            modalCarousel.addEventListener("slid.bs.carousel", function() {
                const isLastSlide = document.querySelector('.carousel-inner .carousel-item:last-child').classList.contains("active");
                nextButton.style.display = isLastSlide ? "none" : "inline-flex";
            });
        });
    </script>
@endsection
