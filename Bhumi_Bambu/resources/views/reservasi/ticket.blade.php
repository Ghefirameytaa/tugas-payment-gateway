@extends('layout.app')
@section('title','E-Ticket')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="res-page">
  
  <section class="res-hero {{ strtolower($reservasi->status) === 'lunas' ? 'hero-approved' : '' }}">
    <div class="res-container">
      <h1 class="res-hero-title">
        @if(strtolower($reservasi->status) === 'lunas')
           Reservasi Dikonfirmasi!
        @else
          🎉 Reservasi Berhasil!
        @endif
      </h1>
      <p class="res-hero-sub">
        @if(strtolower($reservasi->status) === 'lunas')
          Reservasi Anda telah dikonfirmasi. Siap untuk pengalaman tak terlupakan di Bhumi Bambu Baturraden!
        @else
          Terima kasih telah melakukan reservasi di Bhumi Bambu Baturraden.
        @endif
      </p>
    </div>
  </section>

  <section class="res-form-section">
    <div class="res-container-small">
      
      {{-- Step Indicator --}}
      <div class="res-steps">
        <div class="res-step completed">
          <div class="res-step-circle">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M3 8L6 11L13 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span class="res-step-label">Isi data diri</span>
        </div>
        <div class="res-step-line completed"></div>
        <div class="res-step completed">
          <div class="res-step-circle">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M3 8L6 11L13 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span class="res-step-label">Review</span>
        </div>
        <div class="res-step-line completed"></div>
        <div class="res-step completed">
          <div class="res-step-circle">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M3 8L6 11L13 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span class="res-step-label">Pembayaran</span>
        </div>
        <div class="res-step-line completed"></div>
        <div class="res-step active">
          <div class="res-step-circle">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M3 8L6 11L13 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span class="res-step-label">E-ticket</span>
        </div>
      </div>

      {{-- Success Message --}}
      <div class="success-badge">
        <div class="success-icon">
          @if(strtolower($reservasi->status) === 'lunas')
            <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
              <circle cx="32" cy="32" r="32" fill="#10b981"/>
              <path d="M20 32L28 40L44 24" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          @else
            <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
              <circle cx="32" cy="32" r="32" fill="#f6a01a"/>
              <path d="M32 20V34M32 42H32.02" stroke="white" stroke-width="4" stroke-linecap="round"/>
            </svg>
          @endif
        </div>
        <h2 class="success-title">
          @if(strtolower($reservasi->status) === 'lunas')
            Pembayaran Terverifikasi
          @else
            Pembayaran Sedang Diverifikasi
          @endif
        </h2>
        <p class="success-text">
          @if(strtolower($reservasi->status) === 'lunas')
            Selamat! Pembayaran Anda telah terverifikasi dan reservasi dikonfirmasi. Tunjukkan e-ticket ini saat check-in di lokasi. Sampai jumpa di Bhumi Bambu Baturraden!
          @else
            Bukti pembayaran Anda telah diterima dan sedang dalam proses verifikasi oleh admin. Anda akan menerima notifikasi setelah reservasi dikonfirmasi.
          @endif
        </p>
      </div>

      {{-- E-Ticket Card --}}
      <div class="ticket-card">
        
        <div class="ticket-header">
          <div class="ticket-logo">
            <img src="{{ asset('aset/logo.png') }}" alt="Bhumi Bambu" style="max-width: 100%; height: auto;">
          </div>
          <div class="ticket-status {{ strtolower($reservasi->status) }}">
            @if(strtolower($reservasi->status) === 'lunas')
              Dikonfirmasi
            @elseif(strtolower($reservasi->status) === 'pending')
              Menunggu Verifikasi
            @else
              {{ ucfirst($reservasi->status) }}
            @endif
          </div>
        </div>

        <div class="ticket-code">
          <div class="code-label">Kode Booking</div>
          <div class="code-value">{{ $reservasi->kode_booking ?? 'BKG-' . str_pad($reservasi->id, 6, '0', STR_PAD_LEFT) }}</div>
        </div>

        <div class="ticket-divider"></div>

        <div class="ticket-details">
          <div class="detail-row">
            <div class="detail-label">Nama</div>
            <div class="detail-value">{{ $reservasi->nama_lengkap }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-label">Email</div>
            <div class="detail-value">{{ $reservasi->email }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-label">Nomor Ponsel</div>
            <div class="detail-value">+62{{ $reservasi->nomor_ponsel }}</div>
          </div>
        </div>

        <div class="ticket-divider"></div>

        <div class="ticket-details">
          <div class="detail-row">
            <div class="detail-label">Paket</div>
            <div class="detail-value highlight">{{ $reservasi->paket->nama_paket }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-label">Tanggal Kunjungan</div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d F Y') }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-label">Jam Acara</div>
            <div class="detail-value">{{ $reservasi->jam_acara }}</div>
          </div>
          <div class="detail-row">
            <div class="detail-label">Jumlah Orang</div>
            <div class="detail-value">{{ $reservasi->jumlah_orang }} orang</div>
          </div>
          @if($reservasi->catatan)
          <div class="detail-row">
            <div class="detail-label">Catatan</div>
            <div class="detail-value">{{ $reservasi->catatan }}</div>
          </div>
          @endif
        </div>

        <div class="ticket-divider"></div>

        <div class="ticket-price">
          <div class="price-label">Total Pembayaran</div>
          <div class="price-value">Rp {{ number_format($reservasi->paket->harga * $reservasi->jumlah_orang, 0, ',', '.') }}</div>
        </div>

        <div class="ticket-qr">
          <div class="qr-placeholder">
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none">
              <rect width="120" height="120" fill="#e5e7eb"/>
              <rect x="10" y="10" width="30" height="30" fill="#1a1a1a"/>
              <rect x="80" y="10" width="30" height="30" fill="#1a1a1a"/>
              <rect x="10" y="80" width="30" height="30" fill="#1a1a1a"/>
              <rect x="50" y="50" width="20" height="20" fill="#1a1a1a"/>
            </svg>
          </div>
          <p class="qr-text">Tunjukkan QR code ini saat check-in</p>
        </div>

      </div>

      {{-- Actions --}}
      <div class="ticket-actions">
        <button onclick="window.print()" class="action-btn print">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M5 7V3H15V7M5 17H15M5 13H3C2.44772 13 2 12.5523 2 12V9C2 8.44772 2.44772 8 3 8H17C17.5523 8 18 8.44772 18 9V12C18 12.5523 17.5523 13 17 13H15M5 13V17M15 13V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Print E-Ticket
        </button>
        <a href="{{ route('beranda') }}" class="action-btn home">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M3 10L10 3L17 10M5 8V17H8V13H12V17H15V8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Kembali ke Beranda
        </a>
        <a href="{{ route('reservasi.saya') }}" class="action-btn list">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M3 6H17M3 10H17M3 14H17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
          Lihat Reservasi Saya
        </a>
      </div>

      <div class="info-card">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
          <circle cx="10" cy="10" r="9" stroke="#f6a01a" stroke-width="2"/>
          <path d="M10 6V10M10 14H10.01" stroke="#f6a01a" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <div>
          <strong>Informasi Penting:</strong>
          <ul>
            <li>Simpan e-ticket ini dengan baik</li>
            <li>Tunjukkan e-ticket saat check-in</li>
            <li>Datang 15 menit sebelum jam acara</li>
            <li>Hubungi kami jika ada perubahan jadwal</li>
          </ul>
        </div>
      </div>

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

  .res-container-small {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .res-hero {
    background: linear-gradient(135deg, #f6a01a 0%, #e89310 100%);
    color: white;
    padding: 48px 0 52px;
    text-align: center;
    margin-bottom: 48px;
    transition: all 0.3s ease;
  }

  .res-hero.hero-approved {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  }

  .res-hero-title {
    font-size: 2rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    margin-bottom: 12px;
  }

  .res-hero-sub {
    font-size: 1.05rem;
    font-weight: 500;
    opacity: 0.95;
  }

  /* Steps */
  .res-steps {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 48px;
    padding: 0 20px;
  }

  .res-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
  }

  .res-step-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--white);
    border: 2px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1rem;
    color: var(--text-muted);
    transition: all 0.3s ease;
  }

  .res-step.completed .res-step-circle,
  .res-step.active .res-step-circle {
    background: var(--green);
    border-color: var(--green);
  }

  .res-step-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--text-muted);
    text-align: center;
    white-space: nowrap;
  }

  .res-step.completed .res-step-label,
  .res-step.active .res-step-label {
    color: var(--text);
  }

  .res-step-line {
    flex: 1;
    height: 2px;
    background: var(--border);
    margin: 0 12px;
    max-width: 80px;
  }

  .res-step-line.completed {
    background: var(--green);
  }

  /* Success Badge */
  .success-badge {
    text-align: center;
    margin-bottom: 40px;
  }

  .success-icon {
    margin-bottom: 20px;
    animation: scaleIn 0.5s ease;
  }

  @keyframes scaleIn {
    from { transform: scale(0); }
    to { transform: scale(1); }
  }

  .success-title {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 12px;
  }

  .success-text {
    font-size: 0.95rem;
    color: var(--text-secondary);
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
  }

  /* Ticket Card */
  .ticket-card {
    background: var(--white);
    border-radius: 16px;
    padding: 40px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border);
    margin-bottom: 24px;
  }

  .ticket-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
  }

  .ticket-logo {
    max-width: 120px;
  }

  .ticket-status {
    padding: 8px 20px;
    border-radius: 999px;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .ticket-status.pending {
    background: rgba(246, 160, 26, 0.15);
    color: #9a5a00;
  }

  .ticket-status.lunas {
    background: rgba(16, 185, 129, 0.15);
    color: #047857;
  }

  .ticket-status.disetujui {
    background: rgba(16, 185, 129, 0.15);
    color: #047857;
  }

  .ticket-status.ditolak {
    background: rgba(239, 68, 68, 0.15);
    color: #991b1b;
  }

  .ticket-code {
    text-align: center;
    margin-bottom: 32px;
  }

  .code-label {
    font-size: 0.85rem;
    color: var(--text-muted);
    font-weight: 600;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .code-value {
    font-size: 2rem;
    font-weight: 800;
    color: var(--green);
    letter-spacing: 0.1em;
    font-family: 'Courier New', monospace;
  }

  .ticket-divider {
    height: 1px;
    background: var(--border);
    margin: 28px 0;
  }

  .ticket-details {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .detail-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
  }

  .detail-label {
    font-size: 0.9rem;
    color: var(--text-muted);
    font-weight: 600;
  }

  .detail-value {
    font-size: 0.95rem;
    color: var(--text);
    font-weight: 600;
    text-align: right;
    max-width: 60%;
  }

  .detail-value.highlight {
    color: var(--green);
    font-weight: 700;
  }

  .ticket-price {
    background: #f9fafb;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 28px;
  }

  .price-label {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text);
  }

  .price-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--green);
  }

  .ticket-qr {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 32px;
    padding-top: 32px;
    border-top: 2px dashed var(--border);
  }

  .qr-placeholder {
    margin-bottom: 16px;
  }

  .qr-text {
    font-size: 0.9rem;
    color: var(--text-muted);
    font-weight: 500;
  }

  /* Actions */
  .ticket-actions {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 24px;
  }

  .action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 20px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.9rem;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .action-btn.print {
    background: var(--green);
    color: white;
  }

  .action-btn.print:hover {
    background: var(--green-light);
    transform: translateY(-2px);
  }

  .action-btn.home {
    background: white;
    color: var(--text);
    border: 2px solid var(--border);
  }

  .action-btn.home:hover {
    border-color: var(--green);
    color: var(--green);
  }

  .action-btn.list {
    background: rgba(246, 160, 26, 0.1);
    color: var(--orange);
    border: 1px solid rgba(246, 160, 26, 0.3);
  }

  .action-btn.list:hover {
    background: var(--orange);
    color: white;
  }

  /* Info Card */
  .info-card {
    background: rgba(246, 160, 26, 0.08);
    border: 1px solid rgba(246, 160, 26, 0.2);
    border-radius: 12px;
    padding: 20px;
    display: flex;
    gap: 16px;
    align-items: flex-start;
  }

  .info-card svg {
    flex-shrink: 0;
    margin-top: 2px;
  }

  .info-card strong {
    display: block;
    color: var(--text);
    margin-bottom: 8px;
  }

  .info-card ul {
    list-style: none;
    padding: 0;
    margin: 0;
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.7;
  }

  .info-card li {
    position: relative;
    padding-left: 20px;
  }

  .info-card li:before {
    content: "•";
    position: absolute;
    left: 0;
    color: var(--orange);
    font-weight: bold;
  }

  /* Print Styles */
  @media print {
    body * {
      visibility: hidden;
    }
    
    .ticket-card, .ticket-card * {
      visibility: visible;
    }
    
    .ticket-card {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
    }
    
    .ticket-actions, .info-card, .res-steps, .success-badge {
      display: none !important;
    }
  }

  /* Responsive */
  @media (max-width: 768px) {
    .res-container-small {
      padding: 0 16px;
    }

    .res-hero {
      padding: 32px 0 36px;
    }

    .res-hero-title {
      font-size: 1.5rem;
    }

    .res-steps {
      overflow-x: auto;
      justify-content: flex-start;
      padding-bottom: 8px;
    }

    .ticket-card {
      padding: 24px 20px;
    }

    .code-value {
      font-size: 1.5rem;
    }

    .detail-row {
      flex-direction: column;
      gap: 4px;
    }

    .detail-value {
      text-align: left;
      max-width: 100%;
    }

    .ticket-actions {
      grid-template-columns: 1fr;
    }
  }
</style>

@endsection