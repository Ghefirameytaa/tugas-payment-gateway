@extends('layout.app')
@section('title','Buat Reservasi')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="res-page">

  <section class="res-hero">
    <div class="res-container">
      <h1 class="res-hero-title">Buat Reservasi</h1>
      <p class="res-hero-sub">Isi data reservasi kamu. Nanti admin akan verifikasi.</p>
    </div>
  </section>

  <section class="res-form-section">
    <div class="res-container">

      <div class="res-steps">
        <div class="res-step active">
          <div class="res-step-circle">1</div>
          <span class="res-step-label">Isi data diri</span>
        </div>
        <div class="res-step-line"></div>
        <div class="res-step">
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

      {{-- Error & Success Messages --}}
      @if(session('error'))
        <div class="alert alert-error">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <circle cx="10" cy="10" r="9" stroke="currentColor" stroke-width="2"/>
            <path d="M10 6V10M10 14H10.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      @if(session('success'))
        <div class="alert alert-success">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <circle cx="10" cy="10" r="9" stroke="currentColor" stroke-width="2"/>
            <path d="M6 10L9 13L14 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-error">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <circle cx="10" cy="10" r="9" stroke="currentColor" stroke-width="2"/>
            <path d="M10 6V10M10 14H10.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <div>
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin: 8px 0 0 0; padding-left: 20px;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      <div class="res-card">
        <div class="res-card-header">
          <h2 class="res-card-title">Reservasi Anda</h2>
          <p class="res-card-subtitle">Isi rincian anda dan tinjau reservasi Anda.</p>
        </div>

        <div class="res-section-title">Detail Kontak (untuk E-tiket/Voucher)</div>

        <form action="{{ route('reservasi.store') }}" method="POST">
          @csrf

          <div class="res-form-grid">

            {{-- Nama Lengkap --}}
            <div class="res-form-group full-width">
              <label class="res-label">Nama Lengkap <span class="required">*</span></label>

              <div class="res-input-wrapper">
                <svg class="res-input-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <path d="M10 10C12.7614 10 15 7.76142 15 5C15 2.23858 12.7614 0 10 0C7.23858 0 5 2.23858 5 5C5 7.76142 7.23858 10 10 10Z" fill="#718096"/>
                  <path d="M10 12C5.58172 12 2 14.6863 2 18C2 19.1046 2.89543 20 4 20H16C17.1046 20 18 19.1046 18 18C18 14.6863 14.4183 12 10 12Z" fill="#718096"/>
                </svg>

                <input
                  type="text"
                  name="nama_lengkap"
                  class="res-input with-icon @error('nama_lengkap') error @enderror"
                  value="{{ old('nama_lengkap', auth()->user()->pelanggan->nama_pelanggan ?? auth()->user()->nama_user) }}"
                  placeholder="Seperti pada paspor/SIM/kartu"
                  required
                >
              </div>

              @error('nama_lengkap')
                <span class="error-text">{{ $message }}</span>
              @enderror
              <small class="res-hint">Seperti pada paspor/SIM/tanpa gelar atau karakter khusus</small>
            </div>

            {{-- Nomor Ponsel --}}
            <div class="res-form-group full-width">
              <label class="res-label">Nomor Ponsel <span class="required">*</span></label>

              <div class="res-phone-wrapper">
                <div class="res-phone-prefix">
                  <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3Cpath fill='%23dc2626' d='M0 0h3v1H0z'/%3E%3Cpath fill='%23fff' d='M0 1h3v1H0z'/%3E%3C/svg%3E" alt="ID" class="res-flag">
                  <span>+62</span>
                </div>

                <input
                  type="text"
                  name="nomor_ponsel"
                  class="res-input with-prefix @error('nomor_ponsel') error @enderror"
                  value="{{ old('nomor_ponsel', auth()->user()->pelanggan->no_hp ?? auth()->user()->no_hp) }}"
                  placeholder="8123456789"
                  required
                >
              </div>

              @error('nomor_ponsel')
                <span class="error-text">{{ $message }}</span>
              @enderror
              <small class="res-hint">misalnya +628564313460, untuk Kode Negara (+62) dan No Ponsel 08564313460</small>
            </div>

            {{-- Email --}}
            <div class="res-form-group full-width">
              <label class="res-label">Email <span class="required">*</span></label>

              <input
                type="email"
                name="email"
                class="res-input @error('email') error @enderror"
                value="{{ old('email', auth()->user()->email) }}"
                placeholder="misalnya email@contoh.com"
                readonly
                required
              >

              @error('email')
                <span class="error-text">{{ $message }}</span>
              @enderror
            </div>

            {{-- Jumlah Orang --}}
            <div class="res-form-group">
              <label class="res-label">Jumlah Orang <span class="required">*</span></label>
              <input
                type="number"
                name="jumlah_orang"
                class="res-input @error('jumlah_orang') error @enderror"
                min="1"
                value="{{ old('jumlah_orang', 1) }}"
                placeholder="untuk perjalanan"
                required
              >
              @error('jumlah_orang')
                <span class="error-text">{{ $message }}</span>
              @enderror
              <small class="res-hint">untuk perjalanan</small>
            </div>

            {{-- Jam Acara --}}
            <div class="res-form-group">
              <label class="res-label">Jam Acara <span class="required">*</span></label>
              <div class="res-input-wrapper">
                <svg class="res-input-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <circle cx="10" cy="10" r="9" stroke="#718096" stroke-width="2"/>
                  <path d="M10 5V10L13 13" stroke="#718096" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <input
                  type="time"
                  name="jam_acara"
                  class="res-input with-icon @error('jam_acara') error @enderror"
                  value="{{ old('jam_acara') }}"
                  required
                >
              </div>
              @error('jam_acara')
                <span class="error-text">{{ $message }}</span>
              @enderror
            </div>

            {{-- Tanggal Kunjungan --}}
            <div class="res-form-group full-width">
              <label class="res-label">Tanggal Kunjungan <span class="required">*</span></label>
              <input
                type="date"
                name="tanggal_reservasi"
                class="res-input @error('tanggal_reservasi') error @enderror"
                value="{{ old('tanggal_reservasi') }}"
                min="{{ date('Y-m-d') }}"
                required
              >
              @error('tanggal_reservasi')
                <span class="error-text">{{ $message }}</span>
              @enderror
            </div>

            {{-- Paket --}}
            <div class="res-form-group full-width">
              <label class="res-label">Paket <span class="required">*</span></label>
              <select name="paket_id" class="res-input @error('paket_id') error @enderror" required>
                <option value="">-- Pilih Paket --</option>
                @foreach($pakets ?? [] as $paket)
                  <option value="{{ $paket->id }}" {{ old('paket_id', request('paket')) == $paket->id ? 'selected' : '' }}>
                    {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}
                  </option>
                @endforeach
              </select>
              @error('paket_id')
                <span class="error-text">{{ $message }}</span>
              @enderror
            </div>

            {{-- Catatan --}}
            <div class="res-form-group full-width">
              <label class="res-label">Catatan Tambahan (opsional)</label>
              <textarea
                name="catatan"
                class="res-textarea @error('catatan') error @enderror"
                rows="4"
                placeholder="Contoh: minta lokasi dekat toilet / permintaan khusus lainnya"
              >{{ old('catatan') }}</textarea>
              @error('catatan')
                <span class="error-text">{{ $message }}</span>
              @enderror
            </div>

          </div>

          <div class="res-actions">
            <a href="{{ route('beranda') }}" class="res-btn res-btn-cancel">Kembali</a>
            <button type="submit" class="res-btn res-btn-submit">Selanjutnya</button>
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
    --red: #ef4444;
    --red-light: #fee2e2;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  .res-page {
    font-family: "Poppins", system-ui, -apple-system, sans-serif;
    background: var(--cream);
    min-height: 100vh;
    padding-bottom: 60px;
  }

  .res-container { max-width: 900px; margin: 0 auto; padding: 0 24px; }

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

  .res-hero-sub { font-size: 1rem; color: var(--text-secondary); font-weight: 500; }

  .alert {
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 0.95rem;
    font-weight: 500;
    border: 2px solid;
    animation: slideDown 0.3s ease;
  }

  @keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .alert svg { flex-shrink: 0; margin-top: 2px; }
  .alert-error { background: var(--red-light); color: #991b1b; border-color: var(--red); }
  .alert-success { background: #d1fae5; color: #065f46; border-color: #10b981; }

  .res-steps { display: flex; align-items: center; justify-content: center; margin-bottom: 48px; padding: 0 20px; }
  .res-step { display: flex; flex-direction: column; align-items: center; gap: 10px; }
  .res-step-circle {
    width: 44px; height: 44px; border-radius: 50%;
    background: var(--white); border: 2px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 1rem; color: var(--text-muted);
    transition: all 0.3s ease;
  }
  .res-step.active .res-step-circle { background: var(--orange); border-color: var(--orange); color: white; box-shadow: 0 4px 12px rgba(246, 160, 26, 0.3); }
  .res-step-label { font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-align: center; white-space: nowrap; }
  .res-step.active .res-step-label { color: var(--text); }
  .res-step-line { flex: 1; height: 2px; background: var(--border); margin: 0 12px; max-width: 80px; }

  .res-card { background: var(--white); border-radius: 16px; padding: 40px; box-shadow: var(--shadow-lg); border: 1px solid var(--border); }
  .res-card-header { margin-bottom: 32px; }
  .res-card-title { font-size: 1.5rem; font-weight: 800; color: var(--text); margin-bottom: 8px; letter-spacing: -0.01em; }
  .res-card-subtitle { font-size: 0.95rem; color: var(--text-secondary); font-weight: 500; }

  .res-section-title { font-size: 1.1rem; font-weight: 700; color: var(--text); margin-bottom: 24px; padding-bottom: 12px; border-bottom: 2px solid var(--border); }

  .res-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px; }
  .res-form-group { display: flex; flex-direction: column; gap: 8px; }
  .res-form-group.full-width { grid-column: 1 / -1; }

  .res-label { font-size: 0.9rem; font-weight: 600; color: var(--text); letter-spacing: -0.01em; }
  .required { color: var(--red); margin-left: 2px; }

  .res-input-wrapper { position: relative; }
  .res-input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); pointer-events: none; }

  .res-input, .res-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--border);
    border-radius: 10px;
    font-family: "Poppins", sans-serif;
    font-size: 0.95rem;
    color: var(--text);
    background: var(--white);
    transition: all 0.2s ease;
    outline: none;
  }

  .res-input.with-icon { padding-left: 44px; }
  .res-input:focus, .res-textarea:focus { border-color: var(--orange); box-shadow: 0 0 0 3px rgba(246, 160, 26, 0.1); }

  .res-input.error, .res-textarea.error { border-color: var(--red); }
  .res-input.error:focus, .res-textarea.error:focus { border-color: var(--red); box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1); }

  .error-text { color: var(--red); font-size: 0.8rem; font-weight: 600; margin-top: -4px; }

  .res-textarea { resize: vertical; min-height: 100px; }

  select.res-input {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='%234a5568' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 40px;
  }

  .res-phone-wrapper { display: flex; gap: 8px; }
  .res-phone-prefix {
    display: flex; align-items: center; gap: 8px;
    padding: 12px 16px;
    border: 2px solid var(--border);
    border-radius: 10px;
    background: #f9fafb;
    white-space: nowrap;
    font-weight: 600;
    color: var(--text);
  }
  .res-flag { width: 24px; height: 16px; border-radius: 2px; object-fit: cover; }
  .res-input.with-prefix { flex: 1; }

  .res-hint { font-size: 0.8rem; color: var(--text-muted); font-weight: 500; margin-top: -2px; }

  .res-actions { display: flex; justify-content: flex-end; gap: 12px; padding-top: 8px; }

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

  .res-btn-cancel { background: #ef4444; color: white; box-shadow: var(--shadow); }
  .res-btn-cancel:hover { background: #dc2626; transform: translateY(-1px); }

  .res-btn-submit { background: #10b981; color: white; box-shadow: var(--shadow); }
  .res-btn-submit:hover { background: #059669; transform: translateY(-1px); }

  @media (max-width: 768px) {
    .res-container { padding: 0 16px; }
    .res-hero { padding: 24px 0 28px; margin-bottom: 32px; }
    .res-hero-title { font-size: 1.5rem; }
    .res-steps { overflow-x: auto; justify-content: flex-start; margin-bottom: 32px; padding-bottom: 8px; }
    .res-card { padding: 24px 20px; }
    .res-form-grid { grid-template-columns: 1fr; gap: 20px; }
    .res-phone-wrapper { flex-direction: column; }
    .res-actions { flex-direction: column-reverse; }
    .res-btn { width: 100%; text-align: center; }
  }
</style>

@endsection
