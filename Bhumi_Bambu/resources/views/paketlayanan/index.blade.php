<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Layanan - Bhumi Bambu</title>

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

        .btn-add {
            background: #2d5f3f;
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-add:hover {
            background: #3d7f5f;
            transform: translateY(-2px);
        }

        /* Table Card */
        .table-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: #f8f9fa;
        }
        
        .table thead th {
            border: none;
            color: #666;
            font-weight: 600;
            font-size: 13px;
            padding: 15px;
            text-transform: uppercase;
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: #f0f0f0;
        }

        .paket-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .paket-info img {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
        }

        .paket-info strong {
            color: #333;
            font-weight: 600;
        }

        .aksi-btn {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            margin: 0 4px;
            transition: transform 0.2s;
        }

        .aksi-btn:hover {
            transform: scale(1.2);
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

        /* Modal Styling */
        .modal-content {
            border-radius: 16px;
            border: none;
        }

        .modal-header {
            background: #2d5f3f;
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 20px 24px;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body {
            padding: 24px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 14px;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #2d5f3f;
            box-shadow: 0 0 0 3px rgba(45, 95, 63, 0.1);
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #e5e7eb;
        }

        .btn-success {
            background: #10b981;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-light {
            background: #f3f4f6;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            color: #374151;
        }

        .btn-light:hover {
            background: #e5e7eb;
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
            <h4><i class="fas fa-box me-2"></i> Paket Layanan</h4>
            
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
                <h5>Daftar Paket Layanan</h5>
                <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambahPaket">
                    <i class="fas fa-plus me-2"></i> Tambah Paket
                </button>
            </div>

            {{-- Table --}}
            <div class="table-card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Paket</th>
                                <th>Venue</th>
                                <th>Harga</th>
                                <th>Fasilitas</th>
                                <th>Kapasitas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($paket as $item)
                            <tr>
                                <td>
                                    <div class="paket-info">
                                        @if($item->gambar_venue)
                                            <img src="{{ asset($item->gambar_venue) }}" alt="{{ $item->nama_paket }}">
                                        @else
                                            <img src="https://via.placeholder.com/60x60/2d5f3f/ffffff?text=No+Image" alt="No Image">
                                        @endif
                                        <strong>{{ $item->nama_paket }}</strong>
                                    </div>
                                </td>
                                <td>{{ $item->venue ?? '-' }}</td>
                                <td><strong>Rp {{ number_format($item->harga, 0, ',', '.') }}</strong></td>
                                <td style="white-space: pre-line; max-width: 250px;">{{ $item->fasilitas }}</td>
                                <td>{{ $item->kapasitas }} Orang</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.paket-layanan.edit', $item->id) }}" class="aksi-btn" title="Edit">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>

                                    <form action="{{ route('admin.paket-layanan.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="aksi-btn" onclick="return confirm('Yakin hapus paket {{ $item->nama_paket }}?')" title="Hapus">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-inbox text-muted" style="font-size: 48px; opacity: 0.3;"></i>
                                    <p class="text-muted mt-3">Belum ada data paket layanan</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- Modal Tambah Paket --}}
    <div class="modal fade" id="modalTambahPaket" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i> Tambah Paket Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.paket-layanan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nama Paket <span class="text-danger">*</span></label>
                                <input type="text" name="nama_paket" class="form-control" placeholder="contoh: Paket Premium" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Venue <span class="text-danger">*</span></label>
                                <input type="text" name="venue" class="form-control" placeholder="contoh: Semua adalah" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Harga <span class="text-danger">*</span></label>
                                <input type="text" name="harga" class="form-control" placeholder="contoh: 250000" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kapasitas <span class="text-danger">*</span></label>
                                <input type="number" name="kapasitas" class="form-control" placeholder="contoh: 30" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Fasilitas <span class="text-danger">*</span></label>
                                <textarea name="fasilitas" class="form-control" rows="3" placeholder="contoh:&#10;- Area parkir luas&#10;- Gazebo outdoor&#10;- Fasilitas BBQ" required></textarea>
                                <small class="text-muted">Gunakan enter untuk memisahkan setiap fasilitas</small>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Deskripsi (opsional)</label>
                                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi lengkap paket layanan"></textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Gambar Venue</label>
                                <input type="file" name="gambar_venue" class="form-control" accept="image/*">
                                <small class="text-muted">Format: JPG, JPEG, PNG (Max: 2MB)</small>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i> Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>