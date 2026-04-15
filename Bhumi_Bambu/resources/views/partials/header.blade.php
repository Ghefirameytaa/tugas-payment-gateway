<header class="site-header">
  <div class="container header-inner">
    <a href="{{ url('/') }}" class="logo">
      <img src="{{ asset('aset/logo.png') }}" alt="Logo Bhumi Bambu Baturraden">
      <strong>Bhumi Bambu Baturraden</strong>
    </a>

    <nav class="menu">
      <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a>
      <a href="{{ url('/tentang') }}" class="{{ Request::is('tentang') ? 'active' : '' }}">Tentang</a>
      <a href="{{ url('/bantuan') }}" class="{{ Request::is('bantuan') ? 'active' : '' }}">Bantuan</a>
    </nav>

    <div class="auth">
      @auth
        {{-- User sudah login - tampilkan profile dropdown --}}
        <div class="profile-dropdown">
          <button class="profile-btn" type="button">
            <i class="fas fa-user-circle"></i>
            <span>{{ Str::limit(auth()->user()->nama_user ?? auth()->user()->name ?? 'User', 15) }}</span>
            <i class="fas fa-chevron-down"></i>
          </button>
          <div class="profile-menu">
            <a href="{{ route('reservasi.saya') }}">
              <i class="fas fa-calendar-check"></i> Reservasi Saya
            </a>
            <a class="dropdown-item" href="{{ route('profil') }}"> 
              <i class="fas fa-cog"></i> Pengaturan </a>
            <hr style="margin: 4px 0; border: none; border-top: 1px solid #e5e5e5;">
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
              @csrf
              <button type="submit" style="width: 100%; text-align: left; color: #e74c3c;">
                <i class="fas fa-sign-out-alt"></i> Keluar
              </button>
            </form>
          </div>
        </div>
      @else
        {{-- User belum login - tampilkan button masuk & daftar --}}
        <a href="{{ route('login') }}" class="btn-login">Masuk</a>
        <a href="{{ url('/daftar') }}" class="btn-daftar">Daftar</a>
      @endauth
    </div>
  </div>
</header>