<nav class="main-navbar">
    
    {{-- KIRI: Judul Halaman --}}
    <div class="d-flex align-items-center">
        <h5 class="m-0 fw-bold text-white">{{ $judul ?? 'Dashboard' }}</h5>
    </div>

    {{-- KANAN: Profil User --}}
    <div class="d-flex align-items-center gap-3">

        <span class="text-white">
            {{ Auth::user()->nama }}
        </span>

        <div class="dropdown">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->nama }}&background=7898FB&color=fff"
                 width="38"
                 height="38"
                 class="rounded-circle dropdown-toggle"
                 data-bs-toggle="dropdown"
                 style="cursor: pointer;">

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person me-2"></i> Profil
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item text-danger" href="{{ route('backend.logout') }}">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>
