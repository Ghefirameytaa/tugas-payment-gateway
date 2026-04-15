<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Bhumi Bambu</title>
    
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
        
        /* Stats Cards */
        .stats-container {
            padding: 30px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #2d5f3f 0%, #3d7f5f 100%);
            border-radius: 15px;
            padding: 25px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(45, 95, 63, 0.3);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 60px;
            opacity: 0.3;
        }
        
        .stat-card h6 {
            font-size: 14px;
            margin-bottom: 10px;
            opacity: 0.9;
        }
        
        .stat-card h2 {
            font-size: 42px;
            font-weight: 700;
            margin: 0;
        }
        
        /* Table Section */
        .table-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin: 0 30px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .table-header {
            margin-bottom: 20px;
        }
        
        .table-header h5 {
            margin: 0;
            color: #333;
            font-weight: 600;
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
        
        /* Status Badges - PERBAIKAN */
        .badge-lunas {
            background: #10b981;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 12px;
        }
        
        .badge-pending {
            background: #f59e0b;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 12px;
        }
        
        .badge-menunggu {
            background: #3b82f6;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 12px;
        }
        
        .badge-ditolak {
            background: #ef4444;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 12px;
        }
        
        .badge-secondary {
            background: #6b7280;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 12px;
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
            
            <a href="{{ route('admin.dashboard') }}" class="menu-item active">
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
            <h4><i class="fas fa-th-large me-2"></i> Dashboard Admin</h4>
            
            <div class="user-profile">
                <img src="{{ asset('aset/ghefiraa.jpg') }}" alt="User" onerror="this.src='https://ui-avatars.com/api/?name=Admin&background=2d5f3f&color=fff'">
                <div class="user-info">
                    <h6>{{ Auth::user()->name ?? 'Admin' }}</h6>
                    <p>Administrator</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-calendar-check stat-card-icon"></i>
                        <h6>Acara Hari Ini</h6>
                        <h2>{{ $acaraBerlangsung }}</h2>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="stat-card" style="background: linear-gradient(135deg, #f59e0b 0%, #f6a01a 100%);">
                        <i class="fas fa-clock stat-card-icon"></i>
                        <h6>Menunggu Konfirmasi</h6>
                        <h2>{{ $menungguKonfirmasi }}</h2>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="stat-card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                        <i class="fas fa-check-circle stat-card-icon"></i>
                        <h6>Acara Selesai</h6>
                        <h2>{{ $acaraSelesai }}</h2>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="stat-card" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                        <i class="fas fa-list-alt stat-card-icon"></i>
                        <h6>Total Reservasi</h6>
                        <h2>{{ $totalReservasi }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-section">
            <div class="table-header">
                <h5>Semua Reservasi</h5>
            </div>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode Booking</th>
                            <th>Paket</th>
                            <th>Pelanggan</th>
                            <th>Tanggal & Jam</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detailPelanggan as $item)
                        <tr>
                            <td><strong style="font-family: monospace;">{{ $item->kode_booking ?? 'BKG-' . str_pad($item->id, 6, '0', STR_PAD_LEFT) }}</strong></td>
                            <td><strong>{{ $item->paket->nama_paket ?? '-' }}</strong></td>
                            <td>
                                <div>{{ $item->nama_lengkap }}</div>
                                <small class="text-muted">{{ $item->email }}</small>
                            </td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($item->tanggal_reservasi)->format('d M Y') }}</div>
                                <small class="text-muted">{{ $item->jam_acara ?? '-' }}</small>
                            </td>
                            <td>{{ $item->jumlah_orang }} orang</td>
                            <td><strong>Rp {{ number_format(($item->paket->harga ?? 0) * $item->jumlah_orang, 0, ',', '.') }}</strong></td>
                            <td>
                                {{-- PERBAIKAN: Gunakan status_pembayaran untuk menampilkan status yang benar --}}
                                @if($item->status_pembayaran == 'lunas')
                                    <span class="badge-lunas"><i class="fas fa-check-circle me-1"></i> Lunas</span>
                                @elseif($item->status_pembayaran == 'menunggu_verifikasi')
                                    <span class="badge-menunggu"><i class="fas fa-clock me-1"></i> Menunggu Verifikasi</span>
                                @elseif($item->status_pembayaran == 'ditolak')
                                    <span class="badge-ditolak"><i class="fas fa-times-circle me-1"></i> Ditolak</span>
                                @elseif($item->status == 'pending')
                                    <span class="badge-pending"><i class="fas fa-hourglass-half me-1"></i> Pending</span>
                                @else
                                    <span class="badge-secondary"><i class="fas fa-upload me-1"></i> Belum Upload</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-inbox text-muted" style="font-size: 48px; opacity: 0.3;"></i>
                                <p class="text-muted mt-3">Belum ada reservasi</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>