<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket - Bhumi Bambu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        
        .sidebar-header img {
            width: 120px;
            margin-bottom: 10px;
        }
        
        .menu-item {
            padding: 12px 25px;
            display: flex;
            align-items: center;
            color: #666;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover {
            background: #f8f9fa;
            color: #2d5f3f;
            border-left-color: #2d5f3f;
        }
        
        .menu-item.active {
            background: #2d5f3f;
            color: white;
            border-left-color: #2d5f3f;
        }
        
        .menu-item i {
            width: 25px;
            margin-right: 15px;
            font-size: 18px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }
        
        /* Top Header */
        .top-header {
            background: #2d5f3f;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .top-header h4 {
            color: white;
            margin: 0;
            font-weight: 600;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
        }
        
        .user-profile img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid white;
        }
        
        .user-info h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }
        
        .user-info p {
            margin: 0;
            font-size: 12px;
            opacity: 0.8;
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-header h5 {
            margin: 0;
            color: #333;
            font-weight: 700;
        }

        .btn-back {
            background: #6b7280;
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            background: #4b5563;
            color: white;
            transform: translateY(-2px);
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control, .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 14px;
            transition: all 0.2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #2d5f3f;
            box-shadow: 0 0 0 3px rgba(45, 95, 63, 0.1);
        }

        .preview-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            background: #f9fafb;
        }

        .btn-update {
            background: #10b981;
            color: white;
            padding: 12px 32px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-update:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #374151;
            padding: 12px 32px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #e5e7eb;
            color: #374151;
        }

        /* Alerts */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 12px 20px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
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
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.pesanan.index') }}" class="menu-item">
                <i class="fas fa-list-alt"></i>
                <span>List Pesanan</span>
            </a>
            
            <a href="{{ route('admin.pembayaran.index') }}" class="menu-item">
                <i class="fas fa-credit-card"></i>
                <span>Pembayaran</span>
            </a>
            
            <a href="{{ route('admin.paket-layanan.index') }}" class="menu-item active">
                <i class="fas fa-box"></i>
                <span>Paket</span>
            </a>
            
            <a href="#" class="menu-item">
                <i class="fas fa-tags"></i>
                <span>Promo</span>
            </a>
            
            <hr style="margin: 20px 25px; border-color: #eee;">
            
            <a href="#" class="menu-item">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
            
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="menu-item" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        
        <!-- Top Header -->
        <div class="top-header">
            <h4><i class="fas fa-edit me-2"></i> Edit Paket Layanan</h4>
            
            <div class="user-profile">
                <img src="{{ asset('aset/ghefiraa.jpg') }}" alt="User" onerror="this.src='https://ui-avatars.com/api/?name=Admin&background=2d5f3f&color=fff'">
                <div class="user-info">
                    <h6>{{ Auth::user()->name ?? 'Admin' }}</h6>
                    <p>Administrator</p>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            
            {{-- Alerts --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2" style="padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <strong>Sukses!</strong> {{ session('success') }}
                </div>
            @endif

            {{-- Page Header --}}
            <div class="page-header">
                <h5>Edit Paket: {{ $paketLayanan->nama_paket }}</h5>
                <a href="{{ route('admin.paket-layanan.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            {{-- Form --}}
            <div class="form-card">
                <form action="{{ route('admin.paket-layanan.update', $paketLayanan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nama Paket <span class="text-danger">*</span></label>
                            <input type="text" name="nama_paket" class="form-control" 
                                   value="{{ old('nama_paket', $paketLayanan->nama_paket) }}" 
                                   placeholder="contoh: Paket Premium" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Venue <span class="text-danger">*</span></label>
                            <input type="text" name="venue" class="form-control" 
                                   value="{{ old('venue', $paketLayanan->venue) }}" 
                                   placeholder="contoh: Semua adalah" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Harga <span class="text-danger">*</span></label>
                            <input type="text" name="harga" class="form-control" 
                                   value="{{ old('harga', $paketLayanan->harga) }}" 
                                   placeholder="contoh: 250000" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kapasitas <span class="text-danger">*</span></label>
                            <input type="number" name="kapasitas" class="form-control" 
                                   value="{{ old('kapasitas', $paketLayanan->kapasitas) }}" 
                                   placeholder="contoh: 30" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Fasilitas <span class="text-danger">*</span></label>
                            <textarea name="fasilitas" class="form-control" rows="3" required>{{ old('fasilitas', $paketLayanan->fasilitas) }}</textarea>
                            <small class="text-muted">Gunakan enter untuk memisahkan setiap fasilitas</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi (opsional)</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi lengkap paket layanan">{{ old('deskripsi', $paketLayanan->deskripsi) }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Gambar Venue</label>
                            <input type="file" name="gambar_venue" class="form-control" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar. Format: JPG, JPEG, PNG (Max: 2MB)</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label d-block mb-2">Gambar Saat Ini:</label>
                            @if($paketLayanan->gambar_venue)
                                <img src="{{ asset($paketLayanan->gambar_venue) }}" class="preview-img" alt="Preview">
                            @else
                                <div class="text-muted fst-italic">Belum ada gambar</div>
                            @endif
                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-update">
                            <i class="fas fa-save me-2"></i> Update Paket
                        </button>
                        <a href="{{ route('admin.paket-layanan.index') }}" class="btn-cancel">
                            Batal
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>