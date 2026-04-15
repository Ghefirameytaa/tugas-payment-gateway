@extends('layout.app')
@section('title','Beranda Pelanggan')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="bb-page">

  {{-- HERO USER --}}
  <section class="bb-hero">
    <div class="bb-container bb-hero-inner">
      <div class="bb-hero-left">
        <span class="bb-hero-label">Beranda Pelanggan</span>
        <h1 class="bb-hero-title">Halo, {{ auth()->user()->nama_user }} 👋</h1>
        <p class="bb-hero-sub">Pilih paket yang kamu butuhkan, lalu lanjutkan reservasi dengan mudah.</p>
      </div>

      <a href="{{ route('reservasi.create') }}" class="bb-hero-cta">
        <span>Buat Reservasi</span>
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
          <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
  </section>


  {{-- PAKET --}}
  <section class="bb-paket">
    <div class="bb-container">

      <div class="bb-paket-head">
        <div>
          <h2 class="bb-paket-title">Paket Layanan</h2>
          <p class="bb-paket-sub">Paket yang paling sering dipilih pengunjung Bhumi Bambu</p>
        </div>
        <a class="bb-paket-more" href="#">
          Lihat semua
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>

      <div class="bb-grid">

        {{-- Card 1 --}}
        <article class="bb-card">
          <div class="bb-card-media">
            <img src="aset/gambarPaket/camping1.jpg" alt="Paket Camp Chill">
            <div class="bb-card-overlay"></div>
            <span class="bb-price">Rp 450.000</span>
          </div>

          <div class="bb-card-body">
            <h3 class="bb-card-title">Paket Camp Chill</h3>
            <ul class="bb-list">
              <li>Venue Bambu Area (Tenda 3 Orang)</li>
              <li>Sarapan, Snack, Teh, Kopi, Air isi ulang</li>
              <li>Bantal dan Matras</li>
              <li>Free Ticket Wisata</li>
            </ul>

            <div class="bb-card-foot">
              <a href="#" class="bb-detail">Detail Paket</a>
            </div>
          </div>
        </article>

        {{-- Card 2 --}}
        <article class="bb-card">
          <div class="bb-card-media">
            <img src="aset/gambarPaket/edukasi.jpeg" alt="Paket Edukasi Bambu">
            <div class="bb-card-overlay"></div>
            <span class="bb-price">Rp 60.000</span>
          </div>

          <div class="bb-card-body">
            <h3 class="bb-card-title">Paket Edukasi Bambu</h3>
            <ul class="bb-list">
              <li>Kunjungan ke area bambu</li>
              <li>Pengenalan jenis-jenis bambu</li>
              <li>Pendamping lokal dari Bhumi Bambu</li>
              <li>Snack & minuman</li>
            </ul>

            <div class="bb-card-foot">
              <a href="#" class="bb-detail">Detail Paket</a>
            </div>
          </div>
        </article>

        {{-- Card 3 --}}
        <article class="bb-card">
          <div class="bb-card-media">
            <img src="aset/gambarPaket/outbound.jpg" alt="Paket Outbound Basic">
            <div class="bb-card-overlay"></div>
            <span class="bb-price">Rp 250.000</span>
          </div>

          <div class="bb-card-body">
            <h3 class="bb-card-title">Paket Outbound Basic</h3>
            <ul class="bb-list">
              <li>Area outbound</li>
              <li>Peralatan outbound</li>
              <li>Makan siang + air mineral</li>
              <li>Minimal peserta: 20 orang</li>
            </ul>

            <div class="bb-card-foot">
              <a href="#" class="bb-detail">Detail Paket</a>
            </div>
          </div>
        </article>

        {{-- Card 4 --}}
        <article class="bb-card">
          <div class="bb-card-media">
            <img src="aset/gambarPaket/gambar.jpg" alt="Paket Camp Explore">
            <div class="bb-card-overlay"></div>
            <span class="bb-price">Rp 350.000</span>
          </div>

          <div class="bb-card-body">
            <h3 class="bb-card-title">Paket Camp Explore</h3>
            <ul class="bb-list">
              <li>Tenda Dome (2 orang/tenda)</li>
              <li>Matras + bantal</li>
              <li>Free ticket wisata</li>
              <li>Mini BBQ Set (per tenda)</li>
            </ul>

            <div class="bb-card-foot">
              <a href="#" class="bb-detail">Detail Paket</a>
            </div>
          </div>
        </article>

      </div>

    </div>
  </section>

</div>


<style>
  :root{
    --green: #2d5530;
    --green-light: #3d6a40;
    --cream: #f8f6f1;
    --card: #ffffff;

    --text: #1a1a1a;
    --text-secondary: #4a5568;
    --muted: #718096;
    --line: rgba(0,0,0,.06);

    --orange: #f6a01a;
    --orange-dark: #e89410;
    --orangeText: #8b4d00;

    --shadow-sm: 0 2px 8px rgba(0,0,0,.04);
    --shadow: 0 4px 16px rgba(0,0,0,.06);
    --shadow-lg: 0 8px 24px rgba(0,0,0,.08);
    --shadow-xl: 0 12px 32px rgba(0,0,0,.12);
    
    --radius: 14px;
    --radius-sm: 10px;
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  .bb-page{
    font-family: "Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    background: var(--cream);
    min-height: 100vh;
  }

  .bb-container{
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 20px;
  }

  /* ===== HERO ===== */
  .bb-hero{
    background: linear-gradient(--cream, #ffffff 0%, #fafafa 100%);
    color: var(--text);
    padding: 36px 0 40px;
    border-bottom: 1px solid var(--line);
    margin-bottom: 48px;
  }

  .bb-hero-inner{
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 32px;
  }

  .bb-hero-label{
    display: inline-block;
    background: rgba(45, 85, 48, 0.08);
    border: 1px solid rgba(45, 85, 48, 0.12);
    color: var(--green);
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: 14px;
    letter-spacing: 0.02em;
  }

  .bb-hero-title{
    margin: 0 0 12px;
    font-size: 1.45rem;
    font-weight: 700;
    letter-spacing: -0.01em;
    color: var(--text);
    line-height: 1.2;
  }

  .bb-hero-sub{
    margin: 0;
    color: var(--text-secondary);
    font-size: 0.92rem;
    font-weight: 500;
    line-height: 1.7;
    max-width: 520px;
  }

  .bb-hero-cta{
    background: var(--green);
    color: #fff;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.95rem;
    padding: 0.7rem 1.1rem;
    border-radius: 10px;
    box-shadow: var(--shadow-lg);
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
  }

  .bb-hero-cta:hover{
    background: var(--green-light);
    box-shadow: var(--shadow-xl);
    transform: translateY(-2px);
  }

  .bb-hero-cta:active{
    transform: translateY(0);
  }

  /* ===== PAKET ===== */
  .bb-paket{
    background: var(--cream);
    padding: 0 0 52px;
  }

  .bb-paket-head{
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 16px;
    margin-bottom: 16px;
  }

  .bb-paket-title{
    margin: 0 0 6px;
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--text);
    letter-spacing: -0.01em;
  }

  .bb-paket-sub{
    margin: 0;
    color: var(--muted);
    font-weight: 500;
    font-size: 0.9rem;
    line-height: 1.5;
  }

  .bb-paket-more{
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 999px;
    padding: 0.55rem 0.9rem;
    color: var(--text);
    text-decoration: none;
    font-weight: 700;
    font-size: 0.9rem;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
    box-shadow: var(--shadow-sm);
  }

  .bb-paket-more:hover{
    background: var(--green);
    color: #fff;
    border-color: var(--green);
    box-shadow: var(--shadow);
  }

  /* ===== GRID ===== */
  .bb-grid{
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
  }

  .bb-card{
    background: var(--card);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--line);
    box-shadow: var(--shadow);
    display: flex;
    flex-direction: column;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .bb-card:hover{
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
    border-color: rgba(45, 85, 48, 0.15);
  }

  .bb-card-media{
    position: relative;
    height: 145px;
    overflow: hidden;
    background: linear-gradient(135deg, #e9e5dc 0%, #d4cfc4 100%);
  }

  .bb-card-media img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .bb-card:hover .bb-card-media img{
    transform: scale(1.08);
  }

  .bb-card-overlay{
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
  }

  .bb-card:hover .bb-card-overlay{
    opacity: 1;
  }

  .bb-price{
    position: absolute;
    left: 10px;
    bottom: 10px;
    background: linear-gradient(135deg, var(--orange) 0%, var(--orange-dark) 100%);
    color: #fff;
    font-weight: 800;
    font-size: 0.82rem;
    padding: 0.28rem 0.6rem;
    border-radius: 999px;
    box-shadow: 0 4px 12px rgba(246, 160, 26, 0.4);
    letter-spacing: -0.01em;
  }

  .bb-card-body{
    padding: 12px 12px 14px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .bb-card-title{
    margin: 2px 0 8px;
    font-size: 1rem;
    font-weight: 800;
    color: var(--text);
    letter-spacing: -0.01em;
    line-height: 1.3;
  }

  .bb-list{
    margin: 0;
    padding-left: 16px;
    color: var(--text-secondary);
    font-weight: 500;
    font-size: 0.82rem;
    line-height: 1.5;
    flex: 1;
  }

  .bb-list li{ 
    margin: 2px 0;
  }

  .bb-list li::marker{
    color: var(--orange);
  }

  .bb-card-foot{
    margin-top: auto;
    display: flex;
    justify-content: flex-end;
    padding-top: 12px;
    border-top: 1px solid rgba(0,0,0,0.05);
  }

  .bb-detail{
    background: linear-gradient(135deg, rgba(246,160,26,0.12) 0%, rgba(246,160,26,0.08) 100%);
    color: var(--orangeText);
    text-decoration: none;
    font-weight: 700;
    font-size: 0.78rem;
    padding: 0.42rem 0.78rem;
    border-radius: 999px;
    border: 1px solid rgba(246,160,26,0.2);
    transition: all 0.2s ease;
    display: inline-block;
  }

  .bb-detail:hover{
    background: var(--orange);
    color: #fff;
    border-color: var(--orange);
    box-shadow: 0 4px 12px rgba(246, 160, 26, 0.3);
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px){
    .bb-grid{ 
      grid-template-columns: repeat(2, minmax(0, 1fr)); 
      gap: 16px;
    }
    
    .bb-paket-title{ font-size: 1.35rem; }
    .bb-hero-title{ font-size: 1.45rem; }
  }

  @media (max-width: 768px){
    .bb-container{ padding: 0 16px; }
    
    .bb-hero{ 
      padding: 20px 0 22px; 
      margin-bottom: 28px;
    }
    
    .bb-hero-inner{ 
      flex-direction: column; 
      align-items: flex-start; 
    }
    
    .bb-hero-cta{ 
      width: 100%; 
      justify-content: center;
      margin-top: 8px; 
    }
    
    .bb-hero-title{ font-size: 1.45rem; }
    .bb-hero-sub{ font-size: 0.92rem; }

    .bb-paket{ padding: 0 0 52px; }
    
    .bb-paket-head{
      flex-direction: column;
      align-items: flex-start;
      margin-bottom: 16px;
    }
    
    .bb-paket-title{ font-size: 1.35rem; }

    .bb-grid{
      grid-template-columns: unset;
      grid-auto-flow: column;
      grid-auto-columns: 86%;
      overflow-x: auto;
      gap: 14px;
      padding-bottom: 8px;
      scroll-snap-type: x mandatory;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
    }
    
    .bb-grid::-webkit-scrollbar{
      display: none;
    }
    
    .bb-card{ 
      scroll-snap-align: start;
      min-width: 280px;
    }
    
    .bb-card-media{ height: 145px; }
  }
</style>

@endsection