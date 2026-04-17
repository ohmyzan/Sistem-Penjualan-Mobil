@extends('frontend.v_layouts.app')
@section('content')
    <style>
        /* Kustomisasi Carousel Layar Penuh */
        .hero-carousel {
            height: calc(100vh - 80px);
            /* Penuh satu layar dikurangi tinggi navbar */
            min-height: 500px;
        }

        .hero-carousel .carousel-inner,
        .hero-carousel .carousel-item {
            height: 100%;
        }

        .hero-carousel img {
            object-fit: cover;
            height: 100%;
            width: 100%;
            filter: brightness(0.85);
            /* Sedikit digelapkan agar tidak menyilaukan */
        }

        /* Filter Tab Katalog */
        .filter-tab {
            color: #001437;
            border: 2px solid #e2e8f0;
            background: white;
            font-weight: 700;
            border-radius: 50px;
            padding: 10px 25px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .filter-tab:hover {
            border-color: #001437;
            color: #001437;
        }

        .filter-tab.active {
            background-color: #EA5555;
            border-color: #EA5555;
            color: white;
            box-shadow: 0 5px 15px rgba(234, 85, 85, 0.3);
        }

        /* Kartu Mobil (Disesuaikan agar lebih clean) */
        .car-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            background: white;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .car-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 20, 55, 0.1);
        }

        .car-image {
            height: 250px;
            width: 100%;
            object-fit: cover;
        }
    </style>

    <div id="mainCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"
                aria-current="true"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="https://images.unsplash.com/photo-1606152421802-db97b9c7a11b?q=80&w=2074" class="d-block w-100"
                    alt="Banner 1">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?q=80&w=2070" class="d-block w-100"
                    alt="Banner 2">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?q=80&w=2070" class="d-block w-100"
                    alt="Banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 3rem; height: 3rem;"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="width: 3rem; height: 3rem;"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section id="katalog" class="py-5 bg-light">
        <div class="container mt-4">

            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: #001437; font-size: 2.5rem;">Temukan Gayamu</h2>
                <p class="text-muted">Pilih unit terbaik untuk kebutuhan Anda hari ini</p>
            </div>

            <div class="d-flex justify-content-center flex-wrap gap-2 mb-5">
                <a href="{{ route('beranda') }}#katalog"
                    class="filter-tab {{ empty(request('kategori')) ? 'active' : '' }}">
                    SEMUA
                </a>

                @foreach ($tipes as $t)
                    <a href="{{ route('beranda', ['kategori' => $t->id]) }}#katalog"
                        class="filter-tab {{ request('kategori') == $t->id ? 'active' : '' }}">
                        {{ strtoupper($t->nama_tipe) }}
                    </a>
                @endforeach
            </div>

            <div class="row g-4">
                @forelse ($mobils as $row)
                    <div class="col-md-6 col-lg-4">
                        <div class="car-card">
                            <div class="position-relative">
                                <img src="{{ $row->gambar_mobil ? asset('storage/img_mobil/' . $row->gambar_mobil) : asset('storage/img_mobil/no-image.jpg') }}"
                                    class="car-image" alt="{{ $row->nama_mobil }}">
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-white shadow-sm px-3 py-2 rounded-pill fw-bold"
                                        style="color: #001437; font-size: 12px;">
                                        {{ $row->tipe->nama_tipe ?? 'Unit' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h4 class="fw-bold mb-1" style="color: #001437;">{{ $row->nama_mobil }}</h4>
                                <p class="text-muted small mb-3">
                                    <i class="bi bi-palette-fill me-1"></i> {{ $row->warna }} &nbsp;|&nbsp;
                                    <i class="bi bi-people-fill me-1"></i> {{ $row->kapasitas }} Kursi
                                </p>
                                <hr class="opacity-10">
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <small class="text-muted d-block fw-bold"
                                            style="font-size: 10px; text-transform: uppercase;">Harga OTR</small>
                                        <span class="fw-bold fs-5" style="color: #EA5555;">Rp
                                            {{ number_format($row->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <a href="{{ route('detail.mobil', $row->id) }}" class="btn rounded-pill px-4"
                                        style="background: #eef2ff; color: #001437; font-weight: bold;">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-car-front d-block mb-3" style="font-size: 4rem; color: #cbd5e1;"></i>
                        <h4 class="fw-bold" style="color: #001437;">Unit Tidak Ditemukan</h4>
                        <p class="text-muted">Kategori yang Anda pilih belum memiliki unit tersedia.</p>
                        <a href="{{ route('beranda') }}#katalog" class="btn btn-danger rounded-pill px-4 mt-2">Lihat Semua
                            Unit</a>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <section id="promosi" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5 pb-3">
                <h2 class="fw-bold" style="color: #001437; font-size: 2.5rem;">Promosi Eksklusif</h2>
                <p class="text-muted">Penawaran terbaik bulan ini khusus untuk Anda</p>
            </div>

            <div class="row align-items-center mb-5 pb-4">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://images.unsplash.com/photo-1609521263047-f8f205293f24?q=80&w=800" alt="Promo 1"
                        class="img-fluid rounded-5 shadow-sm" style="height: 400px; width: 100%; object-fit: cover;">
                </div>
                <div class="col-md-5 offset-md-1">
                    <span class="badge bg-danger mb-3 px-3 py-2 rounded-pill fw-bold" style="letter-spacing: 1px;">BUNGA
                        0%</span>
                    <h3 class="fw-bold mb-3" style="color: #001437; font-size: 2rem;">Kredit Pintar Tanpa Beban</h3>
                    <p class="text-muted lead mb-4" style="font-size: 1.1rem;">Nikmati cicilan super ringan dengan bunga
                        0% hingga 1 tahun penuh untuk pembelian All New Ertiga Hybrid. Bawa pulang kenyamanan ekstra untuk
                        keluarga tanpa ragu.</p>
                    <a href="#" class="btn btn-outline-danger rounded-pill px-4 py-2 fw-bold shadow-sm">Klaim
                        Promo</a>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md-5 mb-4 mb-md-0 order-2 order-md-1">
                    <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill fw-bold"
                        style="letter-spacing: 1px;">CASHBACK JUTAAN</span>
                    <h3 class="fw-bold mb-3" style="color: #001437; font-size: 2rem;">Trade-in Untung Maksimal</h3>
                    <p class="text-muted lead mb-4" style="font-size: 1.1rem;">Tukarkan mobil lama Anda dengan Suzuki XL7
                        terbaru. Dapatkan ekstra *cashback* hingga Rp 5.000.000 serta gratis biaya jasa servis selama 3
                        tahun.</p>
                    <a href="#" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold shadow-sm">Pelajari
                        Lebih Lanjut</a>
                </div>
                <div class="col-md-6 offset-md-1 order-1 order-md-2 mb-4 mb-md-0">
                    <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0be2?q=80&w=800" alt="Promo 2"
                        class="img-fluid rounded-5 shadow-sm" style="height: 400px; width: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <section id="berita" class="py-5 bg-light">
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="fw-bold m-0" style="color: #001437; font-size: 2.5rem;">Berita & Update</h2>
                    <p class="text-muted m-0 mt-2">Informasi terbaru seputar otomotif dan Suzuki Ratan</p>
                </div>
                <a href="#" class="text-danger fw-bold text-decoration-none d-none d-md-block">Lihat Semua <i
                        class="bi bi-arrow-right"></i></a>
            </div>

            <div class="row g-4">

                <div class="col-lg-7">
                    <a href="#" class="text-decoration-none">
                        <div class="position-relative rounded-5 overflow-hidden shadow-sm h-100"
                            style="min-height: 400px;">
                            <img src="https://images.unsplash.com/photo-1503376712351-1f55a1d7c35f?q=80&w=1000"
                                class="w-100 h-100 object-fit-cover position-absolute" alt="Berita 1"
                                style="transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'"
                                onmouseout="this.style.transform='scale(1)'">

                            <div class="position-absolute bottom-0 start-0 w-100 p-4 pt-5"
                                style="background: linear-gradient(to top, rgba(0,20,55,0.9), transparent);">
                                <span class="badge bg-danger mb-2 px-3">Otomotif</span>
                                <h3 class="text-white fw-bold mb-1">Peluncuran Suzuki Jimny 5-Door Mengguncang Pasar
                                    Indonesia</h3>
                                <p class="text-white-50 small mb-0"><i class="bi bi-calendar3 me-1"></i> 16 April 2026</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-5">
                    <div class="d-flex flex-column gap-4 h-100">
                        <a href="#" class="text-decoration-none flex-fill">
                            <div class="position-relative rounded-5 overflow-hidden shadow-sm h-100"
                                style="min-height: 190px;">
                                <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?q=80&w=600"
                                    class="w-100 h-100 object-fit-cover position-absolute" alt="Berita 2"
                                    style="transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'"
                                    onmouseout="this.style.transform='scale(1)'">
                                <div class="position-absolute bottom-0 start-0 w-100 p-3 pt-5"
                                    style="background: linear-gradient(to top, rgba(0,20,55,0.9), transparent);">
                                    <span class="badge bg-primary mb-2 px-3">Tips & Trik</span>
                                    <h5 class="text-white fw-bold mb-1">Cara Merawat Mesin Smart Hybrid</h5>
                                    <p class="text-white-50 small mb-0" style="font-size: 12px;"><i
                                            class="bi bi-calendar3 me-1"></i> 10 April 2026</p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="text-decoration-none flex-fill">
                            <div class="position-relative rounded-5 overflow-hidden shadow-sm h-100"
                                style="min-height: 190px;">
                                <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?q=80&w=600"
                                    class="w-100 h-100 object-fit-cover position-absolute" alt="Berita 3"
                                    style="transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'"
                                    onmouseout="this.style.transform='scale(1)'">
                                <div class="position-absolute bottom-0 start-0 w-100 p-3 pt-5"
                                    style="background: linear-gradient(to top, rgba(0,20,55,0.9), transparent);">
                                    <span class="badge bg-warning text-dark mb-2 px-3">Penghargaan</span>
                                    <h5 class="text-white fw-bold mb-1">Suzuki Sabet Gelar Mobil Teririt Tahun Ini</h5>
                                    <p class="text-white-50 small mb-0" style="font-size: 12px;"><i
                                            class="bi bi-calendar3 me-1"></i> 05 April 2026</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer class="py-4 border-top" style="background: #ffffff;">
        <div class="container text-center">
            <h5 class="fw-bold mb-1" style="color: #001437;">SUZUKI RATAN MOBIL</h5>
            <p class="text-muted small mb-0">&copy; {{ date('Y') }} Hak Cipta Dilindungi.</p>
        </div>
    </footer>
@endsection
