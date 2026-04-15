<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pesanan - Admin Bhumi Bambu</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
        .stats-container { padding: 30px; }
        .stat-card {
            background: white; border-radius: 10px; padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #2d5f3f;
            transition: transform 0.2s; cursor: pointer; text-decoration: none; color: inherit; display: block;
        }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0,0,0,0.15); }
        .stat-card.active { border-left-color: #f6a01a; background: #fff8f0; }
        .stat-value { font-size: 2rem; font-weight: 700; color: #2d5f3f; }
        .stat-label { color: #666; font-size: 0.9rem; font-weight: 500; }
        
        .filter-section {
            background: white; padding: 20px 30px; margin: 0 30px 20px;
            border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .table-section {
            background: white; border-radius: 10px; padding: 25px;
            margin: 0 30px 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .table thead { background: #f8f9fa; }
        .table thead th {
            border: none; color: #666; font-weight: 600; font-size: 13px;
            padding: 15px; text-transform: uppercase;
        }
        .table tbody td { padding: 15px; vertical-align: middle; border-color: #f0f0f0; }
        
        .badge-pending { 
            background: #f59e0b; color: white; padding: 4px 10px; 
            border-radius: 12px; font-size: 11px; font-weight: 600; 
            display: inline-block; white-space: nowrap;
        }
        .badge-warning { 
            background: #f97316; color: white; padding: 4px 10px; 
            border-radius: 12px; font-size: 11px; font-weight: 600; 
            display: inline-block; white-space: nowrap;
        }
        .badge-success { 
            background: #10b981; color: white; padding: 4px 10px; 
            border-radius: 12px; font-size: 11px; font-weight: 600; 
            display: inline-block; white-space: nowrap;
        }
        .badge-danger { 
            background: #ef4444; color: white; padding: 4px 10px; 
            border-radius: 12px; font-size: 11px; font-weight: 600; 
            display: inline-block; white-space: nowrap;
        }
        
        .action-btn {
            padding: 6px 12px; border: none; border-radius: 6px; cursor: pointer;
            font-size: 12px; font-weight: 600; margin: 0 2px; transition: all 0.2s;
            text-decoration: none; display: inline-block; color: white;
        }
        .btn-approve { background: #10b981; }
        .btn-reject { background: #ef4444; }
        .btn-delete { background: #6b7280; }
        .action-btn:hover { opacity: 0.8; transform: translateY(-2px); color: white; }
        
        .alert { margin: 20px 30px; border-radius: 10px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('aset/logo.png') }}" alt="Bhumi Bambu" onerror="this.src='https://via.placeholder.com/120x80/2d5f3f/ffffff?text=BHUMI+BAMBU'">
        </div>
        
        <div class="sidebar-menu">
            <h6 style="padding: 10px 25px; color: #999; font-size: 11px; text-transform: uppercase; font-weight: 600;">Halaman Utama</h6>
            
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <i class="fas fa-th-large"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('admin.pesanan.index') }}" class="menu-item active">
                <i class="fas fa-list-alt"></i><span>List Pesanan</span>
            </a>
            <a href="{{ route('admin.pembayaran.index') }}" class="menu-item">
                <i class="fas fa-credit-card"></i><span>Pembayaran</span>
            </a>
            <a href="{{ route('admin.paket-layanan.index') }}" class="menu-item">
                <i class="fas fa-box"></i><span>Paket</span>
            </a>
            <a href="/admin/promo" class="menu-item">
                <i class="fas fa-tags"></i><span>Promo</span>
            </a>
            
            <hr style="margin: 20px 25px; border-color: #eee;">
            
            <a href="/admin/pengaturan" class="menu-item">
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

    <div class="main-content">
        <div class="top-header">
            <h4><i class="fas fa-list-alt me-2"></i> List Pesanan & Reservasi</h4>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
        @endif

        <div class="stats-container">
            <div class="row g-3">
                <div class="col-md-3">
                    <a href="?status=all" class="stat-card {{ $status == 'all' ? 'active' : '' }}">
                        <div class="stat-value">{{ $stats['total'] }}</div>
                        <div class="stat-label">Total Reservasi</div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="?status=pending" class="stat-card {{ $status == 'pending' ? 'active' : '' }}">
                        <div class="stat-value">{{ $stats['pending'] }}</div>
                        <div class="stat-label">Pending</div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="?status=menunggu_pembayaran" class="stat-card {{ $status == 'menunggu_pembayaran' ? 'active' : '' }}">
                        <div class="stat-value">{{ $stats['menunggu_pembayaran'] }}</div>
                        <div class="stat-label">Menunggu Pembayaran</div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="?status=lunas" class="stat-card {{ $status == 'lunas' ? 'active' : '' }}">
                        <div class="stat-value">{{ $stats['lunas'] }}</div>
                        <div class="stat-label">Lunas</div>
                    </a>
                </div>
            </div>
        </div>

        <div class="filter-section">
            <form method="GET" class="d-flex align-items-center gap-3">
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="flex-grow-1">
                    <input type="text" name="search" placeholder="Cari kode booking, nama, email, paket..." value="{{ $search }}" class="form-control" style="border-radius: 25px;">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search me-2"></i> Cari
                </button>
                @if($search)
                <a href="?status={{ $status }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i> Reset
                </a>
                @endif
            </form>
        </div>

        <div class="table-section">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode Booking</th>
                            <th>Nama Pelanggan</th>
                            <th>Paket</th>
                            <th>Tanggal & Jam</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th style="min-width: 150px;">Status</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allPesanan as $item)
                        <tr>
                            <td><strong style="font-family: monospace;">{{ $item->kode_booking }}</strong></td>
                            <td>
                                <div>{{ $item->nama_lengkap }}</div>
                                <small class="text-muted">{{ $item->email }}</small>
                            </td>
                            <td>{{ $item->paket->nama_paket ?? '-' }}</td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($item->tanggal_reservasi)->format('d M Y') }}</div>
                                <small class="text-muted">{{ $item->jam_acara }}</small>
                            </td>
                            <td>{{ $item->jumlah_orang }} orang</td>
                            <td><strong>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</strong></td>
                            <td>
                                @if($item->status == 'pending')
                                    <span class="badge-pending">Pending</span>
                                @elseif($item->status == 'menunggu_pembayaran')
                                    <span class="badge-warning">Menunggu Pembayaran</span>
                                @elseif($item->status == 'lunas')
                                    <span class="badge-success">Lunas</span>
                                @else
                                    <span class="badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                @if($item->bukti_transfer)
                                    <i class="fas fa-check-circle text-success"></i> Ada
                                @else
                                    <i class="fas fa-times-circle text-danger"></i> Belum
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    @if($item->status == 'pending' && $item->bukti_transfer)
                                    <form action="{{ route('admin.pesanan.approve', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="action-btn btn-approve" title="Approve Reservasi" onclick="return confirm('Approve reservasi ini?')">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.pesanan.reject', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="action-btn btn-reject" title="Tolak" onclick="return confirm('Tolak reservasi ini?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif

                                    <form action="{{ route('admin.pesanan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete" title="Hapus" onclick="return confirm('Yakin hapus reservasi ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="fas fa-inbox text-muted" style="font-size: 48px; opacity: 0.3;"></i>
                                <p class="text-muted mt-3">Tidak ada reservasi ditemukan</p>
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