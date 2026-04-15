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
        
        {{-- Left: Payment Info --}}
        <div class="res-card">
          <div class="res-card-header">
            <h2 class="res-card-title">Informasi Pembayaran</h2>
            <p class="res-card-subtitle">Transfer ke rekening berikut:</p>
          </div>

          {{-- Bank Options --}}
          <div class="bank-options">
            
            <div class="bank-card active" onclick="selectBank(this, 'bca')">
              <div class="bank-info">
                <div class="bank-logo bca">BCA</div>
                <div class="bank-details">
                  <div class="bank-name">Bank BCA</div>
                  <div class="bank-number">1234567890</div>
                  <div class="bank-holder">a.n. Bhumi Bambu Baturraden</div>
                </div>
              </div>
              <div class="bank-radio">
                <div class="radio-dot"></div>
              </div>
            </div>

            <div class="bank-card" onclick="selectBank(this, 'mandiri')">
              <div class="bank-info">
                <div class="bank-logo mandiri">Mandiri</div>
                <div class="bank-details">
                  <div class="bank-name">Bank Mandiri</div>
                  <div class="bank-number">9876543210</div>
                  <div class="bank-holder">a.n. Bhumi Bambu Baturraden</div>
                </div>
              </div>
              <div class="bank-radio">
                <div class="radio-dot"></div>
              </div>
            </div>

            <div class="bank-card" onclick="selectBank(this, 'bni')">
              <div class="bank-info">
                <div class="bank-logo bni">BNI</div>
                <div class="bank-details">
                  <div class="bank-name">Bank BNI</div>
                  <div class="bank-number">5555666677</div>
                  <div class="bank-holder">a.n. Bhumi Bambu Baturraden</div>
                </div>
              </div>
              <div class="bank-radio">
                <div class="radio-dot"></div>
              </div>
            </div>

          </div>

          {{-- Payment Instructions --}}
          <div class="payment-instructions">
            <h3 class="instruction-title">Cara Pembayaran:</h3>
            <ol class="instruction-list">
              <li>Transfer sejumlah <strong>Rp {{ number_format($reservasi->paket->harga * $reservasi->jumlah_orang, 0, ',', '.') }}</strong></li>
              <li>Simpan bukti transfer Anda</li>
              <li>Upload bukti transfer di bawah ini</li>
              <li>Tunggu konfirmasi dari admin (maks 1x24 jam)</li>
            </ol>
          </div>

          {{-- Upload Bukti Transfer --}}
          <form action="{{ route('reservasi.upload-payment') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="reservasi_id" value="{{ $reservasi->id }}">
            
            <div class="upload-section">
              <label class="upload-label">Upload Bukti Transfer</label>
              <div class="upload-area" id="uploadArea">
                <input type="file" name="bukti_transfer" id="fileInput" accept="image/*" required onchange="previewImage(this)">
                <div class="upload-placeholder" id="uploadPlaceholder">
                  <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <path d="M24 16V32M16 24H32" stroke="#718096" stroke-width="3" stroke-linecap="round"/>
                    <rect x="6" y="6" width="36" height="36" rx="4" stroke="#718096" stroke-width="3"/>
                  </svg>
                  <p>Klik untuk upload atau drag & drop</p>
                  <span>PNG, JPG, JPEG (Max 2MB)</span>
                </div>
                <img id="imagePreview" class="image-preview" style="display:none;">
              </div>
            </div>

            <div class="res-actions">
              <a href="{{ route('reservasi.review') }}" class="res-btn res-btn-cancel">Kembali</a>
              <button type="submit" class="res-btn res-btn-submit">Konfirmasi Pembayaran</button>
            </div>
          </form>

        </div>

        {{-- Right: Order Summary --}}
        <div class="summary-card">
          <h3 class="summary-title">Ringkasan Pesanan</h3>
          
          <div class="summary-section">
            <div class="summary-label">Kode Booking</div>
            <div class="summary-value booking-code">{{ $reservasi->kode_booking ?? 'BKG-' . str_pad($reservasi->id, 6, '0', STR_PAD_LEFT) }}</div>
          </div>

          <div class="summary-divider"></div>

          <div class="summary-section">
            <div class="summary-label">Paket</div>
            <div class="summary-value">{{ $reservasi->paket->nama_paket }}</div>
          </div>

          <div class="summary-section">
            <div class="summary-label">Tanggal</div>
            <div class="summary-value">{{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d F Y') }}</div>
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
            <div class="summary-value">Rp {{ number_format($reservasi->paket->harga, 0, ',', '.') }}</div>
          </div>

          <div class="summary-section total">
            <div class="summary-label">Total Pembayaran</div>
            <div class="summary-value">Rp {{ number_format($reservasi->paket->harga * $reservasi->jumlah_orang, 0, ',', '.') }}</div>
          </div>

          <div class="payment-info">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <circle cx="8" cy="8" r="7" stroke="#f6a01a" stroke-width="2"/>
              <path d="M8 4V8M8 11H8.01" stroke="#f6a01a" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span>Reservasi akan dikonfirmasi setelah pembayaran terverifikasi</span>
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

  .res-step-line.completed,
  .res-step-line.active {
    background: var(--green);
  }

  /* Payment Grid */
  .payment-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 24px;
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

  /* Bank Options */
  .bank-options {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 32px;
  }

  .bank-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border: 2px solid var(--border);
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .bank-card:hover {
    border-color: var(--orange);
    background: rgba(246, 160, 26, 0.02);
  }

  .bank-card.active {
    border-color: var(--orange);
    background: rgba(246, 160, 26, 0.05);
  }

  .bank-info {
    display: flex;
    gap: 16px;
    align-items: center;
  }

  .bank-logo {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 0.9rem;
    color: white;
  }

  .bank-logo.bca { background: #003d79; }
  .bank-logo.mandiri { background: #fdb913; color: #003d79; }
  .bank-logo.bni { background: #ed8b00; }

  .bank-details {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .bank-name {
    font-weight: 700;
    font-size: 1rem;
    color: var(--text);
  }

  .bank-number {
    font-weight: 600;
    font-size: 1.1rem;
    color: var(--green);
    letter-spacing: 0.05em;
  }

  .bank-holder {
    font-size: 0.85rem;
    color: var(--text-muted);
  }

  .bank-radio {
    width: 24px;
    height: 24px;
    border: 2px solid var(--border);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
  }

  .bank-card.active .bank-radio {
    border-color: var(--orange);
  }

  .radio-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: transparent;
    transition: all 0.2s ease;
  }

  .bank-card.active .radio-dot {
    background: var(--orange);
  }

  /* Instructions */
  .payment-instructions {
    background: #f9fafb;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 32px;
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

  /* Upload Section */
  .upload-section {
    margin-bottom: 32px;
  }

  .upload-label {
    display: block;
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 12px;
  }

  .upload-area {
    position: relative;
    border: 2px dashed var(--border);
    border-radius: 12px;
    padding: 40px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
    background: #fafafa;
  }

  .upload-area:hover {
    border-color: var(--orange);
    background: rgba(246, 160, 26, 0.02);
  }

  .upload-area input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
  }

  .upload-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
  }

  .upload-placeholder p {
    font-weight: 600;
    color: var(--text-secondary);
    margin: 0;
  }

  .upload-placeholder span {
    font-size: 0.85rem;
    color: var(--text-muted);
  }

  .image-preview {
    max-width: 100%;
    max-height: 300px;
    border-radius: 8px;
    object-fit: contain;
  }

  /* Summary Card */
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

  /* Actions */
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

  /* Responsive */
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

    .bank-info {
      gap: 12px;
    }

    .bank-logo {
      width: 50px;
      height: 50px;
      font-size: 0.8rem;
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

<script>
function selectBank(element, bank) {
  document.querySelectorAll('.bank-card').forEach(card => {
    card.classList.remove('active');
  });
  element.classList.add('active');
}

function previewImage(input) {
  const preview = document.getElementById('imagePreview');
  const placeholder = document.getElementById('uploadPlaceholder');
  
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    
    reader.onload = function(e) {
      preview.src = e.target.result;
      preview.style.display = 'block';
      placeholder.style.display = 'none';
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

@endsection