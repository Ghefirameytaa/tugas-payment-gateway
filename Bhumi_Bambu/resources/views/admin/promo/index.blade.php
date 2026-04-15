<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo - Admin Bhumi Bambu</title>
    
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); display: flex;
            justify-content: space-between; align-items: center;
        }
        .top-header h4 { margin: 0; font-weight: 600; }
        .user-profile { display: flex; align-items: center; gap: 15px; color: white; }
        .user-profile img { width: 45px; height: 45px; border-radius: 50%; border: 2px solid white; }
        
        .content-area { padding: 30px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .page-header h5 { margin: 0; color: #333; font-weight: 700; }
        
        .btn-add {
            background: #2d5f3f; color: white; padding: 10px 24px; border-radius: 10px;
            border: none; font-weight: 600; cursor: pointer; transition: all 0.2s;
            text-decoration: none; display: inline-block;
        }
        .btn-add:hover { background: #3d7f5f; transform: translateY(-2px); color: white; }
        
        .stats-container { margin-bottom: 24px; }
        .stat-card {
            background: white; border-radius: 12px; padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .stat-value { font-size: 2rem; font-weight: 700; color: #2d5f3f; }
        .stat-label { color: #666; font-size: 0.9rem; font-weight: 500; }
        
        .table-card {
            background: white; border-radius: 15px; padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .table thead { background: #f8f9fa; }
        .table thead th {
            border: none; color: #666; font-weight: 600; font-size: 13px;
            padding: 15px; text-transform: uppercase;
        }
        .table tbody td { padding: 15px; vertical-align: middle; border-color: #f0f0f0; }
        
        .badge-aktif { background: #d1fae5; color: #065f46; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-kadaluarsa { background: #fee2e2; color: #991b1b; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        
        .aksi-btn {
            background: none; border: none; font-size: 18px; cursor: pointer;
            margin: 0 4px; transition: transform 0.2s;
        }
        .aksi-btn:hover { transform: scale(1.2); }
        
        .alert {
            border-radius: 10px; border: none; padding: 12px 20px; margin-bottom: 20px;
        }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        .alert-danger { background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; }
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
            <h4><i class="fas fa-tags me-2"></i> Promo</h4>
            <div class="user-profile">
                <img src="{{ asset('aset/ghefiraa.jpg') }}" alt="User" onerror="this.src='https://ui-avatars.com/api/?name=Admin&background=2d5f3f&color=fff'">
                <div class="user-info">
                    <h6>{{ Auth::user()->name ?? 'Admin' }}</h6>
                    <p style="margin: 0; font-size: 12px; opacity: 0.8;">Administrator</p>
                </div>
            </div>
        </div>

        <div class="content-area">
            @if(session('success'))
            <div class="alert alert-success">
                <strong>Sukses!</strong> {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <strong>Error!</strong> {{ session('error') }}
            </div>
            @endif

            <div class="page-header">
                <h5>Daftar Promo</h5>
                <a href="{{ route('admin.promo.create') }}" class="btn-add">
                    <i class="fas fa-plus me-2"></i> Tambah Promo
                </a>
            </div>

            <div class="stats-container">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-value">{{ $stats['total'] }}</div>
                            <div class="stat-label">Total Promo</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-value text-success">{{ $stats['aktif'] }}</div>
                            <div class="stat-label">Promo Aktif</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-value text-danger">{{ $stats['kadaluarsa'] }}</div>
                            <div class="stat-label">Kadaluarsa</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Promo</th>
                                <th>Diskon</th>
                                <th>Periode</th>
                                <th>Status</th>
                                <th>Dibuat Oleh</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($promos as $promo)
                            <tr>
                                <td>
                                    <strong>{{ $promo->nama_promo }}</strong><br>
                                    <small class="text-muted">{{ Str::limit($promo->deskripsi, 50) }}</small>
                                </td>
                                <td>
                                    <strong style="color: #2d5f3f; font-size: 18px;">{{ $promo->diskon }}%</strong>
                                </td>
                                <td>
                                    <small>
                                        {{ \Carbon\Carbon::parse($promo->tanggal_mulai)->format('d M Y') }}<br>
                                        s/d {{ \Carbon\Carbon::parse($promo->tanggal_selesai)->format('d M Y') }}
                                    </small>
                                </td>
                                <td>
                                    @if($promo->tanggal_selesai >= now())
                                        <span class="badge-aktif">Aktif</span>
                                    @else
                                        <span class="badge-kadaluarsa">Kadaluarsa</span>
                                    @endif
                                </td>
                                <td>
                                    <small>{{ $promo->admin->name ?? 'Admin' }}</small>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.promo.edit', $promo->id) }}" class="aksi-btn" title="Edit">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>
                                    <form action="{{ route('admin.promo.destroy', $promo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="aksi-btn" onclick="return confirm('Yakin hapus promo {{ $promo->nama_promo }}?')" title="Hapus">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-tags text-muted" style="font-size: 48px; opacity: 0.3;"></i>
                                    <p class="text-muted mt-3">Belum ada promo</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>