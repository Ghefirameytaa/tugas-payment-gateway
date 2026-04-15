@extends('layout.app')
@section('title','Review Reservasi')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="res-page">
  
  <section class="res-hero">
    <div class="res-container">
      <h1 class="res-hero-title">Review Reservasi</h1>
      <p class="res-hero-sub">Pastikan data yang kamu isi sudah benar sebelum melanjutkan.</p>
    </div>
  </section>

  <section class="res-form-section">
    <div class="res-container">
      
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
        <div class="res-step-line active"></div>
        <div class="res-step active">
          <div class="res-step-circle">2</div>
          <span class="res-step-label">Review</span>
        </div>
        <div class="res-step-line"></div>
        <div class="res-step">
          <div class="res-step-circle">3</div>
          <span class="res-step-label">Pembayaran</span>
        </div>
        <div class="res-step-line"></div>
        <div class="res-step">
          <div class="res-step-circle">4</div>
          <span class="res-step-label">E-ticket</span>
        </div>
      </div>

      {{-- Review Card --}}
      <div class="res-card">
        
        <div class="res-card-header">
          <h2 class="res-card-title">Review Reservasi Anda</h2>
          <p class="res-card-subtitle">Periksa kembali detail reservasi sebelum konfirmasi.</p>
        </div>

        {{-- Data Pribadi --}}
        <div class="review-section">
          <div class="review-section-header">
            <h3 class="review-section-title">Data Pribadi</h3>
            <a href="{{ route('reservasi.create') }}" class="review-edit">Edit</a>
          </div>
          
          <div class="review-grid">
            <div class="review-item">
              <span class="review-label">Nama Lengkap</span>
              <span class="review-value">{{ session('reservasi.nama_lengkap') }}</span>
            </div>
            <div class="review-item">
              <span class="review-label">Nomor Ponsel</span>
              <span class="review-value">+62{{ session('reservasi.nomor_ponsel') }}</span>
            </div>
            <div class="review-item">
              <span class="review-label">Email</span>
              <span class="review-value">{{ session('reservasi.email') }}</span>
            </div>
          </div>
        </div>

        {{-- Detail Reservasi --}}
        <div class="review-section">
          <div class="review-section-header">
            <h3 class="review-section-title">Detail Reservasi</h3>
          </div>
          
          <div class="review-grid">
            <div class="review-item">
              <span class="review-label">Paket</span>
              <span class="review-value">{{ session('reservasi.paket_nama') }}</span>
            </div>
            <div class="review-item">
              <span class="review-label">Tanggal Kunjungan</span>
              <span class="review-value">{{ \Carbon\Carbon::parse(session('reservasi.tanggal_reservasi'))->format('d F Y') }}</span>
            </div>
            <div class="review-item">
              <span class="review-label">Jam Acara</span>
              <span class="review-value">{{ session('reservasi.jam_acara') }}</span>
            </div>
            <div class="review-item">
              <span class="review-label">Jumlah Orang</span>
              <span class="review-value">{{ session('reservasi.jumlah_orang') }} orang</span>
            </div>
            @if(session('reservasi.catatan'))
            <div class="review-item full-width">
              <span class="review-label">Catatan</span>
              <span class="review-value">{{ session('reservasi.catatan') }}</span>
            </div>
            @endif
          </div>
        </div>

        {{-- Ringkasan Harga --}}
        <div class="review-section">
          <div class="review-section-header">
            <h3 class="review-section-title">Ringkasan Pembayaran</h3>
          </div>
          
          <div class="review-price">
            <div class="review-price-row">
              <span>{{ session('reservasi.paket_nama') }} x {{ session('reservasi.jumlah_orang') }} orang</span>
              <span>Rp {{ number_format(session('reservasi.paket_harga') * session('reservasi.jumlah_orang'), 0, ',', '.') }}</span>
            </div>
            <div class="review-price-divider"></div>
            <div class="review-price-row total">
              <span>Total Pembayaran</span>
              <span>Rp {{ number_format(session('reservasi.paket_harga') * session('reservasi.jumlah_orang'), 0, ',', '.') }}</span>
            </div>
          </div>
        </div>

        {{-- Actions --}}
        <form action="{{ route('reservasi.confirm') }}" method="POST">
          @csrf
          <div class="res-actions">
            <a href="{{ route('reservasi.create') }}" class="res-btn res-btn-cancel">Kembali</a>
            <button type="submit" class="res-btn res-btn-submit">Konfirmasi & Lanjut Pembayaran</button>
          </div>
        </form>

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

  .res-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .res-hero {
    background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
    padding: 36px 0 40px;
    border-bottom: 1px solid var(--border);
    margin-bottom: 48px;
  }

  .res-hero-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--text);
    letter-spacing: -0.02em;
    margin-bottom: 8px;
  }

  .res-hero-sub {
    font-size: 1rem;
    color: var(--text-secondary);
    font-weight: 500;
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

  .res-step.completed .res-step-circle {
    background: var(--green);
    border-color: var(--green);
  }

  .res-step.active .res-step-circle {
    background: var(--orange);
    border-color: var(--orange);
    color: white;
    box-shadow: 0 4px 12px rgba(246, 160, 26, 0.3);
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

  .res-step-line.active {
    background: var(--green);
  }

  /* Card */
  .res-card {
    background: var(--white);
    border-radius: 16px;
    padding: 40px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border);
  }

  .res-card-header {
    margin-bottom: 32px;
  }

  .res-card-title {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 8px;
    letter-spacing: -0.01em;
  }

  .res-card-subtitle {
    font-size: 0.95rem;
    color: var(--text-secondary);
    font-weight: 500;
  }

  /* Review Section */
  .review-section {
    margin-bottom: 32px;
    padding-bottom: 32px;
    border-bottom: 1px solid var(--border);
  }

  .review-section:last-of-type {
    border-bottom: none;
    margin-bottom: 24px;
  }

  .review-section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .review-section-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text);
  }

  .review-edit {
    color: var(--orange);
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .review-edit:hover {
    color: var(--green);
  }

  .review-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  .review-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .review-item.full-width {
    grid-column: 1 / -1;
  }

  .review-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }

  .review-value {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text);
  }

  /* Price Summary */
  .review-price {
    background: #f9fafb;
    border-radius: 12px;
    padding: 20px;
  }

  .review-price-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.95rem;
    color: var(--text-secondary);
    font-weight: 500;
    margin-bottom: 12px;
  }

  .review-price-row:last-child {
    margin-bottom: 0;
  }

  .review-price-divider {
    height: 1px;
    background: var(--border);
    margin: 16px 0;
  }

  .review-price-row.total {
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--text);
  }

  .review-price-row.total span:last-child {
    color: var(--green);
  }

  /* Actions */
  .res-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 8px;
  }

  .res-btn {
    padding: 12px 28px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.95rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
  }

  .res-btn-cancel {
    background: var(--white);
    color: var(--text);
    border: 2px solid var(--border);
  }

  .res-btn-cancel:hover {
    background: #f5f5f5;
    border-color: var(--text-muted);
  }

  .res-btn-submit {
    background: var(--green);
    color: white;
    box-shadow: var(--shadow);
  }

  .res-btn-submit:hover {
    background: var(--green-light);
    transform: translateY(-1px);
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

    .res-hero-title {
      font-size: 1.5rem;
    }

    .res-steps {
      overflow-x: auto;
      justify-content: flex-start;
      margin-bottom: 32px;
      padding-bottom: 8px;
    }

    .res-card {
      padding: 24px 20px;
    }

    .review-grid {
      grid-template-columns: 1fr;
      gap: 16px;
    }

    .res-actions {
      flex-direction: column-reverse;
    }

    .res-btn {
      width: 100%;
      text-align: center;
    }
  }
</style>

@endsection