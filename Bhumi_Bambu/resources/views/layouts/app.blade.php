<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','Kelola Pesanan')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    :root{ --brand:#2f5b3a; --brand2:#3a7048; --bg:#f4f6f8; }
    body{ background:var(--bg); }
    .app-shell{ min-height:100vh; display:flex; }

    .sidebar{
      width:280px;
      background:#fff;
      border-right:1px solid #e8eaed;
      padding:12px 14px;
    }

    /* ===== LOGO AREA (PUTIH MINIMAL) ===== */
    .brand{
      display:flex;
      justify-content:center;
      align-items:center;
      padding:8px 0 12px;      /* ← DIKECILIN */
      border-bottom:1px solid #f0f1f2;
      margin-bottom:12px;
    }
    .brand .logo{
      display:flex;
      justify-content:center;
      align-items:center;
      width:100%;
    }
    .brand .logo img{
      width:120px;             /* pas, ga kegedean */
      height:auto;
      display:block;
    }

    /* ===== MENU ===== */
    .menu a{
      display:flex;
      align-items:center;
      gap:12px;
      padding:12px 14px;
      border-radius:14px;
      text-decoration:none;
      color:#1f2937;
      font-weight:800;
      margin-bottom:8px;
    }
    .menu a i{ font-size:18px; opacity:.9; }
    .menu a.active{ background:var(--brand); color:#fff; }
    .menu a:hover{ background:#f3f4f6; }
    .menu a.active:hover{ background:var(--brand2); }

    .main{ flex:1; padding:18px 22px; }

    /* ===== TOPBAR ===== */
    .topbar{
      background:var(--brand);
      border-radius:18px;
      padding:14px 18px;
      display:flex;
      align-items:center;
      gap:16px;
      color:#fff;
    }
    .searchbar{
      flex:1;
      background:#fff;
      border-radius:999px;
      padding:10px 14px;
      display:flex;
      align-items:center;
      gap:10px;
    }
    .searchbar i{ color:#9ca3af; }
    .searchbar input{
      border:none;
      outline:none;
      width:100%;
      font-size:14px;
    }

    /* ===== CARD ===== */
    .card-soft{
      background:#fff;
      border:1px solid #eef0f2;
      border-radius:18px;
      box-shadow:0 12px 22px rgba(0,0,0,.08);
    }

    .btn-brand{ background:var(--brand); color:#fff; border:none; }
    .btn-brand:hover{ background:var(--brand2); color:#fff; }

    .table thead th{
      background:#f3f6f7 !important;
      color:#111827;
      border-bottom:0;
    }
    .table td, .table th{ padding:16px 14px; }

    /* ===== STATUS ===== */
    .status-pill{
      border-radius:999px;
      padding:8px 12px;
      font-weight:900;
      font-size:12px;
      display:inline-block;
      color:#fff;
    }
    .status-berhasil{ background:#21b573; }
    .status-menunggu{ background:#f4b400; }
    .status-dibatalkan{ background:#ff6b6b; }

    /* ===== ICON BUTTON ===== */
    .icon-btn{
      width:36px;
      height:36px;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      border-radius:12px;
      border:1px solid #e9ecef;
      background:#fff;
    }
    .icon-btn:hover{ background:#f3f4f6; }
  </style>
</head>
<body>

<div class="app-shell">
  <aside class="sidebar">
    <div class="brand">
      <div class="logo">
        <img src="{{ asset('aset/logo.png') }}" alt="Logo Bhumi Bambu">
      </div>
    </div>

    <div class="menu">
      <a href="#"><i class="bi bi-house-door"></i> Dashboard</a>

      <a class="{{ request()->routeIs('pesanan.*') ? 'active' : '' }}"
         href="{{ route('pesanan.index') }}">
        <i class="bi bi-receipt"></i> Pesanan
      </a>

      <a href="#"><i class="bi bi-credit-card"></i> Pembayaran</a>
      <a href="#"><i class="bi bi-box-seam"></i> Paket</a>
      <a href="#"><i class="bi bi-tags"></i> Promo</a>

      <div class="mt-3 pt-3 border-top">
        <a href="#"><i class="bi bi-gear"></i> Peraturan</a>
        <a href="#"><i class="bi bi-box-arrow-right"></i> Keluar</a>
      </div>
    </div>
  </aside>

  <main class="main">
    <div class="topbar mb-4">
      <div class="searchbar">
        <i class="bi bi-search"></i>
        <input id="searchInput" type="text" placeholder="Cari...">
      </div>

      <i class="bi bi-bell"></i>

      <div class="d-flex align-items-center gap-2">
        <div class="rounded-circle bg-light" style="width:36px;height:36px;"></div>
        <div style="line-height:1;">
          <div style="font-weight:900;">Admin</div>
          <small style="opacity:.85;">Ghefira Meyta</small>
        </div>
      </div>
    </div>

    @yield('content')
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

