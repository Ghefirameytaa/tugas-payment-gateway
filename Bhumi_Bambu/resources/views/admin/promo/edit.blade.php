<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Promo - Admin Bhumi Bambu</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        
        .sidebar {
            position: fixed; top: 0; left: 0; width: 250px; height: 100vh;
            background: white; box-shadow: 2px 0 10px rgba(0,0,0,0.1); z-index: 1000;
        }
        .sidebar-header { padding: 20px; text-align: center; border-bottom: 1px solid #eee; }
        .sidebar-header img { width: 120px; margin-bottom: 10px; }
        .menu-item {
            padding: 12px 25px; display: flex; align-items: center; color: #666;
            text-decoration: none; transition: all 0.3s; border-left: 3px solid transparent;
        }
        .menu-item:hover { background: #f8f9fa; color: #2d5f3f; border-left-color: #2d5f3f; }
        .menu-item.active { background: #2d5f3f; color: white; border-left-color: #2d5f3f; }
        .menu-item i { width: 25px; margin-right: 15px; font-size: 18px; }
        
        .main-content { margin-left: 250px; min-height: 100vh; }
        .top-header {
            background: #2d5f3f; padding: 15px 30px; color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .top-header h4 { margin: 0; font-weight: 600; }
        
        .content-area { padding: 30px; max-width: 800px; }
        .form-card {
            background: white; border-radius: 15px; padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .form-label { font-weight: 600; color: #333; margin-bottom: 8px; font-size: 14px; }
        .form-control, .form-select {
            border: 2px solid #e5e7eb; border-radius: 8px; padding: 10px 14px; transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2d5f3f; box-shadow: 0 0 0 3px rgba(45, 95, 63, 0.1);
        }
        
        .btn-submit {
            background: #2d5f3f; color: white; padding: 12px 30px; border-radius: 10px;
            border: none; font-weight: 600; cursor: pointer; transition: all 0.2s;
        }
        .btn-submit:hover { background: #3d7f5f; transform: translateY(-2px); }
        
        .btn-cancel {
            background: #6b7280; color: white; padding: 12px 30px; border-radius: 10px;
            border: none; font-weight: 600; cursor: pointer; transition: all 0.2s;
            text-decoration: none; display: inline-block;
        }
        .btn-cancel:hover { background: #4b5563; color: white; }
        
        .alert-danger {
            background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444;
            border-radius: 10px; padding: 12px 20px; margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('aset/logo.png') }}" alt="Bhumi Bambu" onerror="this.src='https://via.placeholder.com/120x80/2d5f3f/ffffff?text=BHUMI+BAMBU'">
        </div>
        
        <div class="sidebar-menu">
            <h6 style="padding: 10px 25px; color: #999; font-size: 11px; text-transform: uppercase; font-weight: 600;">Halaman Utama</h6>
            
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <i class="fas fa-th-large"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('admin.pesanan.index') }}" class="menu-item">
                <i class="fas fa-list-alt"></i><span>List Pesanan</span>
            </a>
            <a href="{{ route('admin.pembayaran.index') }}" class="menu-item">
                <i class="fas fa-credit-card"></i><span>Pembayaran</span>
            </a>
            <a href="{{ route('admin.paket-layanan.index') }}" class="menu-item">
                <i class="fas fa-box"></i><span>Paket</span>
            </a>
            <a href="{{ route('admin.promo.index') }}" class="menu-item active">
                <i class="fas fa-tags"></i><span>Promo</span>
            </a>
            
            <hr style="margin: 20px 25px; border-color: #eee;">
            
            <a href="#" class="menu-item">
                <i class="fas fa-cog"></i><span>Pengaturan</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="menu-item" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i><span>Keluar</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-header">
            <h4><i class="fas fa-edit me-2"></i> Edit Promo</h4>
        </div>

        <div class="content-area">
            @if($errors->any())
            <div class="alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2" style="padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-card">
                <form action="{{ route('admin.promo.update', $promo->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Promo <span class="text-danger">*</span></label>
                        <input type="text" name="nama_promo" class="form-control" placeholder="contoh: Diskon Akhir Tahun" value="{{ old('nama_promo', $promo->nama_promo) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi promo..." required>{{ old('deskripsi', $promo->deskripsi) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $promo->tanggal_mulai) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $promo->tanggal_selesai) }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Diskon (%) <span class="text-danger">*</span></label>
                        <input type="number" name="diskon" class="form-control" placeholder="contoh: 20" min="1" max="100" value="{{ old('diskon', $promo->diskon) }}" required>
                        <small class="text-muted">Masukkan angka 1-100 (dalam persen)</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-2"></i> Update Promo
                        </button>
                        <a href="{{ route('admin.promo.index') }}" class="btn-cancel">
                            <i class="fas fa-times me-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>