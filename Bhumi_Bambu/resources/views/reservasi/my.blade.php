@extends('layout.app')
@section('title','Reservasi Saya')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="res-page">
  
  <section class="res-hero">
    <div class="res-container">
      <div class="hero-flex">
        <div>
          <h1 class="res-hero-title">Reservasi Saya</h1>
          <p class="res-hero-sub">Kelola semua reservasi Anda di sini</p>
        </div>
        <a href="{{ route('reservasi.create') }}" class="res-hero-cta">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M10 4V16M4 10H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
          Buat Reservasi
        </a>
      </div>
    </div>
  </section>

  <section class="res-list-section">
    <div class="res-container">
      
      @if($reservasis->isEmpty())
        <div class="empty-state">
          <svg width="120" height="120" viewBox="0 0 120 120" fill="none">
            <circle cx="60" cy="60" r="50" fill="#f3f4f6"/>
            <path d="M45 55C45 52.2386 47.2386 50 50 50H70C72.7614 50 75 52.2386 75 55V75C75 77.7614 72.7614 80 70 80H50C47.2386 80 45 77.7614 45 75V55Z" stroke="#9ca3af" stroke-width="3"/>
            <path d="M55 50V45C55 42.2386 57.2386 40 60 40C62.7614 40 65 42.2386 65 45V50" stroke="#9ca3af" stroke-width="3"/>
          </svg>
          <h3>Belum Ada Reservasi</h3>
          <p>Anda belum memiliki reservasi. Mulai buat reservasi pertama Anda!</p>
          <a href="{{ route('reservasi.create') }}" class="empty-btn">Buat Reservasi Baru</a>
        </div>
      @else
        <div class="reservasi-grid">
          @foreach($reservasis as $reservasi)
          <div class="reservasi-card">
            
            {{-- Card Header dengan Status yang BENAR --}}
            <div class="card-header">
              <div class="card-booking-code">
                {{ $reservasi->kode_booking ?? 'BKG-' . str_pad($reservasi->id, 6, '0', STR_PAD_LEFT) }}
              </div>
              
              {{-- PERBAIKAN: Gunakan status_pembayaran untuk menampilkan status yang benar --}}
              @if($reservasi->status_pembayaran == 'lunas')
                <span class="card-status lunas">
                  <i class="fas fa-check-circle"></i> Lunas
                </span>
              @elseif($reservasi->status_pembayaran == 'menunggu_verifikasi')
                <span class="card-status menunggu">
                  <i class="fas fa-clock"></i> Menunggu Verifikasi
                </span>
              @elseif($reservasi->status_pembayaran == 'ditolak')
                <span class="card-status ditolak">
                  <i class="fas fa-times-circle"></i> Ditolak
                </span>
              @elseif($reservasi->status == 'pending')
                <span class="card-status pending">
                  <i class="fas fa-hourglass-half"></i> Pending
                </span>
              @else
                <span class="card-status belum-upload">
                  <i class="fas fa-upload"></i> Belum Upload
                </span>
              @endif
            </div>

            {{-- Card Image --}}
            <div class="card-image">
              @if($reservasi->paket && $reservasi->paket->gambar_venue)
                <img src="{{ asset($reservasi->paket->gambar_venue) }}" alt="{{ $reservasi->paket->nama_paket }}">
              @else
                <img src="https://via.placeholder.com/400x200/2d5530/ffffff?text=Bhumi+Bambu" alt="Venue">
              @endif
              <div class="card-overlay"></div>
            </div>

            <div class="card-body">
              <h3 class="card-title">{{ $reservasi->paket->nama_paket ?? 'Paket Tidak Tersedia' }}</h3>
              
              <div class="card-details">
                <div class="detail-item">
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <rect x="2" y="3" width="12" height="11" rx="2" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M5 1V5M11 1V5M2 6H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                  </svg>
                  <span>{{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d M Y') }}</span>
                </div>
                
                <div class="detail-item">
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M8 4V8L10.5 10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                  </svg>
                  <span>{{ $reservasi->jam_acara }}</span>
                </div>

                <div class="detail-item">
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 8C9.65685 8 11 6.65685 11 5C11 3.34315 9.65685 2 8 2C6.34315 2 5 3.34315 5 5C5 6.65685 6.34315 8 8 8Z" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M13 14C13 11.2386 10.7614 9 8 9C5.23858 9 3 11.2386 3 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                  </svg>
                  <span>{{ $reservasi->jumlah_orang }} orang</span>
                </div>
              </div>

              <div class="card-price">
                <span class="price-label">Total:</span>
                <span class="price-value">Rp {{ number_format(($reservasi->paket->harga ?? 0) * $reservasi->jumlah_orang, 0, ',', '.') }}</span>
              </div>

              {{-- PERBAIKAN: Tombol aksi berdasarkan status_pembayaran --}}
              <div class="card-actions">
                @if($reservasi->status_pembayaran == 'lunas')
                  {{-- Jika sudah lunas, tampilkan tombol lihat e-ticket --}}
                  <a href="{{ route('reservasi.ticket', $reservasi->id) }}" class="card-btn primary">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                      <path d="M2 8L6 12L14 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Lihat E-Ticket
                  </a>
                @elseif($reservasi->status_pembayaran == 'menunggu_verifikasi')
                  {{-- Jika menunggu verifikasi, tampilkan status menunggu --}}
                  <a href="{{ route('reservasi.ticket', $reservasi->id) }}" class="card-btn info">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                      <circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/>
                      <path d="M8 4V8L10.5 10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    Lihat E-Ticket
                  </a>
                @elseif($reservasi->status_pembayaran == 'ditolak')
                  {{-- Jika ditolak, bisa upload ulang --}}
                  <a href="{{ route('reservasi.payment', $reservasi->id) }}" class="card-btn warning">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                      <path d="M8 4V8M8 10V11" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                      <circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/>
                    </svg>
                    Upload Ulang Bukti
                  </a>
                @elseif($reservasi->status == 'pending')
                  {{-- Jika pending (belum upload bukti) --}}
                  <a href="{{ route('reservasi.payment', $reservasi->id) }}" class="card-btn secondary">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                      <rect x="2" y="4" width="12" height="9" rx="2" stroke="currentColor" stroke-width="1.5"/>
                      <path d="M2 7H14M5 10H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    Upload Pembayaran
                  </a>
                @endif
              </div>
            </div>

          </div>
          @endforeach
        </div>
      @endif

    </div>
  </section>

</div>

<style>
  :root {
    --green: #2d5530;
    --green-light: #3d6a40;
    --cream: #f8f6f1;
    --white: #ffffff;
    --text: #1a1a1a;
    --text-secondary: #4a5568;
    --text-muted: #718096;
    --border: rgba(0,0,0,.08);
    --orange: #f6a01a;
    --shadow: 0 2px 8px rgba(0,0,0,.06);
    --shadow-lg: 0 8px 24px rgba(0,0,0,.08);
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  .res-page {
    font-family: "Poppins", system-ui, -apple-system, sans-serif;
    background: var(--cream);
    min-height: 100vh;
    padding-bottom: 60px;
  }

  .res-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  /* Hero */
  .res-hero {
    background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
    padding: 36px 0 40px;
    border-bottom: 1px solid var(--border);
    margin-bottom: 48px;
  }

  .hero-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
  }

  .res-hero-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--text);
    letter-spacing: -0.02em;
    margin-bottom: 8px;
  }

  .res-hero-sub {
    font-size: 0.95rem;
    color: var(--text-secondary);
    font-weight: 500;
  }

  .res-hero-cta {
    background: var(--green);
    color: white;
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .res-hero-cta:hover {
    background: var(--green-light);
    transform: translateY(-2px);
  }

  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 80px 20px;
  }

  .empty-state svg {
    margin-bottom: 24px;
  }

  .empty-state h3 {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 12px;
  }

  .empty-state p {
    font-size: 1rem;
    color: var(--text-secondary);
    margin-bottom: 32px;
  }

  .empty-btn {
    display: inline-block;
    background: var(--green);
    color: white;
    padding: 14px 32px;
    border-radius: 10px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .empty-btn:hover {
    background: var(--green-light);
    transform: translateY(-2px);
  }

  /* Reservasi Grid */
  .reservasi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 24px;
  }

  .reservasi-card {
    background: var(--white);
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    transition: all 0.2s ease;
  }

  .reservasi-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
  }

  /* Card Header */
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 20px;
    background: #f9fafb;
    border-bottom: 1px solid var(--border);
  }

  .card-booking-code {
    font-size: 0.9rem;
    font-weight: 800;
    color: var(--green);
    letter-spacing: 0.05em;
    font-family: 'Courier New', monospace;
  }

  .card-status {
    padding: 6px 14px;
    border-radius: 999px;
    font-weight: 700;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  /* PERBAIKAN: Status badge yang lebih jelas */
  .card-status.lunas {
    background: rgba(16, 185, 129, 0.15);
    color: #047857;
  }

  .card-status.menunggu {
    background: rgba(59, 130, 246, 0.15);
    color: #1e40af;
  }

  .card-status.ditolak {
    background: rgba(239, 68, 68, 0.15);
    color: #991b1b;
  }

  .card-status.pending {
    background: rgba(246, 160, 26, 0.15);
    color: #9a5a00;
  }

  .card-status.belum-upload {
    background: rgba(107, 114, 128, 0.15);
    color: #374151;
  }

  .card-status i {
    font-size: 0.75rem;
  }

  /* Card Image */
  .card-image {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: #e5e7eb;
  }

  .card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .reservasi-card:hover .card-image img {
    transform: scale(1.05);
  }

  .card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%);
  }

  /* Card Body */
  .card-body {
    padding: 20px;
  }

  .card-title {
    font-size: 1.1rem;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 16px;
    line-height: 1.3;
  }

  .card-details {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 16px;
  }

  .detail-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
    color: var(--text-secondary);
    font-weight: 500;
  }

  .detail-item svg {
    flex-shrink: 0;
    color: var(--text-muted);
  }

  .card-price {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    background: #f9fafb;
    border-radius: 10px;
    margin-bottom: 16px;
  }

  .price-label {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-muted);
  }

  .price-value {
    font-size: 1.1rem;
    font-weight: 800;
    color: var(--green);
  }

  /* Card Actions */
  .card-actions {
    display: flex;
    gap: 8px;
  }

  .card-btn {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 12px 16px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.2s ease;
    border: none;
  }

  .card-btn.primary {
    background: var(--green);
    color: white;
  }

  .card-btn.primary:hover {
    background: var(--green-light);
    transform: translateY(-2px);
  }

  .card-btn.secondary {
    background: rgba(246, 160, 26, 0.1);
    color: var(--orange);
    border: 1px solid rgba(246, 160, 26, 0.3);
  }

  .card-btn.secondary:hover {
    background: var(--orange);
    color: white;
  }

  .card-btn.info {
    background: rgba(59, 130, 246, 0.1);
    color: #1e40af;
    border: 1px solid rgba(59, 130, 246, 0.3);
  }

  .card-btn.info:hover {
    background: #3b82f6;
    color: white;
  }

  .card-btn.warning {
    background: rgba(239, 68, 68, 0.1);
    color: #991b1b;
    border: 1px solid rgba(239, 68, 68, 0.3);
  }

  .card-btn.warning:hover {
    background: #ef4444;
    color: white;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .res-container {
      padding: 0 16px;
    }

    .res-hero {
      padding: 24px 0 28px;
      margin-bottom: 32px;
    }

    .hero-flex {
      flex-direction: column;
      align-items: flex-start;
    }

    .res-hero-cta {
      width: 100%;
      justify-content: center;
    }

    .reservasi-grid {
      grid-template-columns: 1fr;
    }

    .card-actions {
      flex-direction: column;
    }
  }
</style>

@endsection