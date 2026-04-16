@extends('layout.app')
@section('title','Pembayaran')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="res-page">

  <section class="res-hero">
    <div class="res-container">
      <h1 class="res-hero-title">Pembayaran</h1>
      <p class="res-hero-sub">Silakan lakukan pembayaran untuk mengkonfirmasi reservasi Anda.</p>
    </div>
  </section>

  <section class="res-form-section">
    <div class="res-container">

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

        <div class="res-step-line active"></div>

        <div class="res-step active">
          <div class="res-step-circle">3</div>
          <span class="res-step-label">Pembayaran</span>
        </div>

        <div class="res-step-line"></div>

        <div class="res-step">
          <div class="res-step-circle">4</div>
          <span class="res-step-label">E-ticket</span>
        </div>
      </div>

      <div class="payment-grid">

        <div class="res-card">
          <div class="res-card-header">
            <h2 class="res-card-title">Metode Pembayaran</h2>
            <p class="res-card-subtitle">Klik tombol di bawah untuk melanjutkan pembayaran</p>
          </div>

          <div class="payment-instructions">
            <h3 class="instruction-title">Cara Pembayaran:</h3>
            <ol class="instruction-list">
              <li>Klik tombol <strong>Bayar Sekarang</strong></li>
              <li>Pilih metode pembayaran yang tersedia</li>
              <li>Selesaikan pembayaran sesuai instruksi</li>
              <li>Setelah berhasil, Anda akan diarahkan ke halaman e-ticket / status reservasi</li>
            </ol>
          </div>

          <div class="payment-box">
            <div class="payment-total-label">Total Pembayaran</div>
            <div class="payment-total-value">
              Rp {{ number_format($reservasi->paket->harga * $reservasi->jumlah_orang, 0, ',', '.') }}
            </div>
          </div>

          <div class="res-actions">
            <a href="{{ route('reservasi.review') }}" class="res-btn res-btn-cancel">Kembali</a>
            <button type="button" id="pay-btn" class="res-btn res-btn-submit" onclick="startPayment()">
              Bayar Sekarang
            </button>
          </div>
        </div>

        <div class="summary-card">
          <h3 class="summary-title">Ringkasan Pesanan</h3>

          <div class="summary-section">
            <div class="summary-label">Kode Booking</div>
            <div class="summary-value booking-code">
              {{ $reservasi->kode_booking ?? 'BKG-' . str_pad($reservasi->id, 6, '0', STR_PAD_LEFT) }}
            </div>
          </div>

          <div class="summary-divider"></div>

          <div class="summary-section">
            <div class="summary-label">Paket</div>
            <div class="summary-value">{{ $reservasi->paket->nama_paket }}</div>
          </div>

          <div class="summary-section">
            <div class="summary-label">Tanggal</div>
            <div class="summary-value">
              {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d F Y') }}
            </div>
          </div>

          <div class="summary-section">
            <div class="summary-label">Jam</div>
            <div class="summary-value">{{ $reservasi->jam_acara }}</div>
          </div>

          <div class="summary-section">
            <div class="summary-label">Jumlah Orang</div>
            <div class="summary-value">{{ $reservasi->jumlah_orang }} orang</div>
          </div>

          <div class="summary-divider"></div>

          <div class="summary-section price">
            <div class="summary-label">Harga per orang</div>
            <div class="summary-value">
              Rp {{ number_format($reservasi->paket->harga, 0, ',', '.') }}
            </div>
          </div>

          <div class="summary-section total">
            <div class="summary-label">Total Pembayaran</div>
            <div class="summary-value">
              Rp {{ number_format($reservasi->paket->harga * $reservasi->jumlah_orang, 0, ',', '.') }}
            </div>
          </div>

          <div class="payment-info">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <circle cx="8" cy="8" r="7" stroke="#f6a01a" stroke-width="2"/>
              <path d="M8 4V8M8 11H8.01" stroke="#f6a01a" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span>Pembayaran diproses dan status reservasi akan diperbarui otomatis.</span>
          </div>
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

  .res-container {
    max-width: 1200px;
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

  .res-step-line.completed,
  .res-step-line.active {
    background: var(--green);
  }

  .payment-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 24px;
  }

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

  .payment-instructions {
    background: #f9fafb;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 24px;
  }

  .instruction-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 16px;
  }

  .instruction-list {
    padding-left: 20px;
    color: var(--text-secondary);
    font-size: 0.95rem;
    line-height: 1.8;
  }

  .instruction-list li {
    margin-bottom: 8px;
  }

  .payment-box {
    background: rgba(45, 85, 48, 0.06);
    border: 1px solid rgba(45, 85, 48, 0.12);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 32px;
  }

  .payment-total-label {
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin-bottom: 8px;
  }

  .payment-total-value {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--green);
  }

  .summary-card {
    background: var(--white);
    border-radius: 16px;
    padding: 32px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border);
    height: fit-content;
    position: sticky;
    top: 24px;
  }

  .summary-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 24px;
  }

  .summary-section {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
  }

  .summary-label {
    font-size: 0.9rem;
    color: var(--text-muted);
    font-weight: 500;
  }

  .summary-value {
    font-size: 0.95rem;
    color: var(--text);
    font-weight: 600;
    text-align: right;
  }

  .booking-code {
    font-size: 1.1rem;
    color: var(--green);
    font-weight: 800;
    letter-spacing: 0.05em;
  }

  .summary-divider {
    height: 1px;
    background: var(--border);
    margin: 20px 0;
  }

  .summary-section.price {
    margin-top: 20px;
  }

  .summary-section.total {
    margin-top: 12px;
    padding-top: 16px;
    border-top: 2px solid var(--border);
  }

  .summary-section.total .summary-label {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text);
  }

  .summary-section.total .summary-value {
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--green);
  }

  .payment-info {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    background: rgba(246, 160, 26, 0.08);
    padding: 16px;
    border-radius: 8px;
    margin-top: 24px;
  }

  .payment-info svg {
    flex-shrink: 0;
    margin-top: 2px;
  }

  .payment-info span {
    font-size: 0.85rem;
    color: var(--text-secondary);
    line-height: 1.5;
  }

  .res-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
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

  .res-btn-submit:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
  }

  @media (max-width: 1024px) {
    .payment-grid {
      grid-template-columns: 1fr;
    }

    .summary-card {
      position: static;
    }
  }

  @media (max-width: 768px) {
    .res-container {
      padding: 0 16px;
    }

    .res-hero {
      padding: 24px 0 28px;
      margin-bottom: 32px;
    }

    .res-steps {
      overflow-x: auto;
      justify-content: flex-start;
      margin-bottom: 32px;
      padding-bottom: 8px;
    }

    .res-card, .summary-card {
      padding: 24px 20px;
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

<script
    src="{{ config('midtrans.is_production')
        ? 'https://app.midtrans.com/snap/snap.js'
        : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
    const TICKET_URL = "{{ route('reservasi.ticket', $reservasi->id) }}";

    function startPayment() {
        const btn = document.getElementById('pay-btn');
        btn.disabled = true;
        btn.textContent = 'Memproses...';

        window.snap.pay("{{ $snapToken }}", {
            onSuccess: function(result) {
                window.location.href = TICKET_URL;
            },
            onPending: function(result) {
                window.location.href = TICKET_URL;
            },
            onError: function(result) {
                alert('Pembayaran gagal. Silakan coba kembali.');
                btn.disabled = false;
                btn.textContent = 'Bayar Sekarang';
            },
            onClose: function() {
                btn.disabled = false;
                btn.textContent = 'Bayar Sekarang';
            }
        });
    }
</script>

@endsection