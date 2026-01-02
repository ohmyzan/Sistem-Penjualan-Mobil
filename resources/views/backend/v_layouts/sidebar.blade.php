<div class="sidebar">

       {{-- HEADER LOGO + NAMA (MENTOK KE ATAS) --}}
    <div style="display: flex; align-items: center; padding: 10px 15px 15px 15px; margin-top: 0;">
        <img src="{{ asset('img/android-chrome-192x192.png') }}" 
             style="width: 55px; height:45px; border-radius: 5px; margin-right: 12px;">
        
        <h4 style="color: #d9e1ffff; margin: 0; font-weight: 700;">Car Ratan</h4>
    </div>

    {{-- GARIS PEMBATAS --}}
    <hr style="border-color: rgba(255, 255, 255, 0.2); margin: 0 12px 10px 12px;">

    {{-- Dashboard --}}
    <a href="{{ route('backend.beranda') }}"
       class="{{ request()->is('backend/beranda') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>

    {{-- Data Mobil --}}
    <a href="{{ route('backend.mobil.index') }}"
       class="{{ request()->is('backend/v_mobil*') ? 'active' : '' }}">
        <i class="bi bi-car-front-fill me-2"></i> Data Mobil
    </a>

    {{-- Data Merk --}}
    <a href="{{ route('backend.merk.index') }}"
       class="{{ request()->is('backend/v_merk*') ? 'active' : '' }}">
        <i class="bi bi-tags-fill me-2"></i> Data Merk
    </a>

    {{-- Data User --}}
    <a href="{{ route('backend.user.index') }}"
       class="{{ request()->is('backend/user*') ? 'active' : '' }}">
        <i class="bi bi-people-fill me-2"></i> Data User
    </a>

    {{-- Logout --}}
    <a href="{{ route('backend.logout') }}" class="text-danger">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
    </a>

</div>
