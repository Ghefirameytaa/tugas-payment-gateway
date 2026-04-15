<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembayaran - Admin Bhumi Bambu</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
        /* Sidebar - sama seperti index */
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
            color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .top-header h4 {
            margin: 0;
            font-weight: 600;
        }
        
        /* Form Container */
        .form-container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .form-container h5 {
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
        }
        
        .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #2d5f3f;
            box-shadow: 0 0 0 0.2rem rgba(45, 95, 63, 0.25);
        }
        
        .btn-submit {
            background: #2d5f3f;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-submit:hover {
            background: #1f4428;
        }
        
        .btn-cancel {
            background: #6b7280;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-cancel:hover {
            background: #4b5563;
            color: white;
        }
        
        .alert {
            margin-bottom: 20px;
            border-radius: 10px;
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
            
            <a href="{{ route('admin.pembayaran.index') }}" class="menu-item active">
                <i class="fas fa-credit-card"></i>
                <span>Pembayaran</span>
            </a>
            
            <a href="/admin/paket-layanan" class="menu-item">
                <i class="fas fa-box"></i>
                <span>Paket</span>
            </a>
            
            <a href="/admin/promo" class="menu-item">
                <i class="fas fa-tags"></i>
                <span>Promo</span>
            </a>
            
            <hr style="margin: 20px 25px; border-color: #eee;">
            
            <a href="/admin/pengaturan" class="menu-item">
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
            <h4><i class="fas fa-plus me-2"></i> Tambah Pembayaran Manual</h4>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <h5>Input Pembayaran Manual</h5>

            @if($errors->any())
            <div class="alert alert-danger">
                <strong>Error!</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="reservasi_id" class="form-label">Pilih Reservasi <span class="text-danger">*</span></label>
                    <select name="reservasi_id" id="reservasi_id" class="form-select" required>
                        <option value="">-- Pilih Reservasi --</option>
                        @foreach($reservasi as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->kode_booking ?? 'BKG-' . str_pad($item->id, 6, '0', STR_PAD_LEFT) }} - 
                                {{ $item->nama_lengkap }} - 
                                {{ $item->paket->nama_paket ?? '-' }}
                                (Rp {{ number_format(($item->paket->harga ?? 0) * $item->jumlah_orang, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hanya menampilkan reservasi yang belum upload bukti transfer</small>
                </div>

                <div class="mb-3">
                    <label for="bukti_transfer" class="form-label">Upload Bukti Transfer <span class="text-danger">*</span></label>
                    <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" accept="image/*" required>
                    <small class="text-muted">Format: JPG, JPEG, PNG. Max: 2MB</small>
                </div>

                <div class="mb-4">
                    <img id="preview" src="" alt="Preview" style="max-width: 300px; display: none; margin-top: 10px; border-radius: 8px; border: 2px solid #ddd;">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                    <a href="{{ route('admin.pembayaran.index') }}" class="btn-cancel">
                        <i class="fas fa-times me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview image
        document.getElementById('bukti_transfer').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>