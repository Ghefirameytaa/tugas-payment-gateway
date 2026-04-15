<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Paket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: #f5f6fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .app { display: flex; min-height: 100vh; }
        .sidebar {
            width: 200px;
            background: #fff;
            padding: 20px;
            border-right: 1px solid #eee;
        }
        .sidebar .logo img {
            width: 140px;
            display: block;
            margin: 0 auto 30px;
        }
        .menu-title { font-size: 13px; color: #888; margin-bottom: 10px; }
        .menu a {
            display: flex;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 10px;
            color: #333;
            text-decoration: none;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .menu a.active { background: #2C5F2D; color: #fff; }
        .main { flex: 1; display: flex; flex-direction: column; }
        .topbar {
            height: 64px;
            background: #2C5F2D;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 24px;
        }
        .content {
            flex: 1;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .delete-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            max-width: 480px;
            text-align: center;
        }
        .preview-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        .btn-danger {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
<div class="app">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <img src="{{ asset('aset/logo.png') }}" alt="Logo">
        </div>

        <div class="menu-title">Halaman Utama</div>
        <div class="menu">
            <a href="#"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="{{ route('paket-layanan.index') }}" class="active">
                <i class="fa-solid fa-box"></i> Paket
            </a>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">

        <div class="topbar"></div>

        <div class="content">
            <div class="delete-card">

                <h4 class="text-danger mb-3">Hapus Paket</h4>

                @if(!empty($paketLayanan->gambar_venue))
                    <img src="{{ asset($paketLayanan->gambar_venue) }}"
                         class="preview-img"
                         alt="Gambar Paket">
                @endif

                <p>Apakah kamu yakin ingin menghapus paket:</p>
                <h5 class="mb-3">{{ $paketLayanan->nama_paket }}</h5>

                <p class="text-muted">
                    Tindakan ini <strong>tidak bisa dibatalkan</strong>.
                </p>

                <div class="d-flex justify-content-center gap-2 mt-4">
                    <form action="{{ route('paket-layanan.destroy', $paketLayanan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">
                            Ya, Hapus
                        </button>
                    </form>

                    <a href="{{ route('paket-layanan.index') }}" class="btn btn-secondary px-4">
                        Batal
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
