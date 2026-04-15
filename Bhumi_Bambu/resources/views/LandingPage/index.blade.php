@extends('layout.app')

@section('title', 'Beranda - Bhumi Bambu Baturraden')

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Rasakan Harmoni Alam di Bhumi Bambu</h1>
            <p>Eksplorasi bambu terbesar di Baturraden dengan pengalaman wisata, edukasi, dan petualangan alam yang menyatu dengan lingkungan.</p>
            <div class="hero-buttons">
                <a href="#promo" class="btn-cta">Pesan Sekarang →</a>
                <a href="#services" class="btn-outline-hero">Jelajahi Layanan</a>
            </div>
        </div>
        <div class="hero-image-wrap">
            <img src="{{ asset('aset/gambarPaket/gambar.jpg') }}" alt="Bhumi Bambu Baturraden">
        </div>
    </div>
</section>

<!-- Page Background Start -->
<div class="page-bg">
    <div class="container">
        
        <!-- Gallery 3 Images -->
        <div class="gallery-3">
            <img src="{{ asset('aset/gambar1.jpeg') }}" alt="Jalan Bambu">
            <img src="{{ asset('aset/gambar2.jpeg') }}" alt="Pemandangan Taman">
            <img src="{{ asset('aset/gambar3.jpeg') }}" alt="Kolam Air">
        </div>

        <!-- Split Section: Services + CTA -->
        <div class="split">
            <!-- Left: Services List -->
            <div class="card">
                <h3>Pengalaman yang Bisa Kamu Nikmati</h3>
                <ul class="checklist">
                    <li>Berkemah</li>
                    <li>Edukasi Bambu</li>
                    <li>Outbound dan Gathering</li>
                    <li>Wisata Alam</li>
                    <li>Silver Roof Cafe dan Kedai Bambu</li>
                    <li>Pondok Kayu</li>
                </ul>
            </div>

            <!-- Right: CTA Bubble -->
            <div class="right-col">
                <div class="bubble">
                    Setiap sudut di Bhumi Bambu punya cerita. Yuk intip lebih banyak dan rasakan sendiri suasana alamnya!
                </div>
                <a href="#promo" class="btn-mini">Jelajahi</a>
            </div>
        </div>

        <!-- Promo Section -->
        <p class="lead">
            Ada penawaran seru buat kamu yang berencana liburan ke Bhumi Bambu. Temukan promo terbaik yang bisa bikin perjalananmu semakin berkesan!
        </p>

        <div class="promo-grid">
            <!-- Promo Card 1 -->
            <div class="promo-card">
                <div class="promo-title">
                    Diskon Khusus Pengguna Baru! Hemat Hingga 10%!
                </div>
                <div class="promo-bottom">
                    <div class="promo-code">
                        <i class="fas fa-ticket-alt"></i>
                        <span id="code-1">BAMBUSTART</span>
                    </div>
                    <button class="promo-copy" onclick="copyPromoCode('code-1', this)">SALIN</button>
                </div>
            </div>

            <!-- Promo Card 2 -->
            <div class="promo-card">
                <div class="promo-title">
                    Flash Sale! Harga Spesial Untuk Libur NATARU
                </div>
                <div class="promo-bottom">
                    <div class="promo-code">
                        <i class="fas fa-ticket-alt"></i>
                        <span id="code-2">BAMBUSHOCK</span>
                    </div>
                    <button class="promo-copy" onclick="copyPromoCode('code-2', this)">SALIN</button>
                </div>
            </div>

            <!-- Promo Card 3 -->
            <div class="promo-card">
                <div class="promo-title">
                    Promo Akhir Tahun
                </div>
                <div class="promo-bottom">
                    <div class="promo-code">
                        <i class="fas fa-ticket-alt"></i>
                        <span id="code-3">BAMBUFEST</span>
                    </div>
                    <button class="promo-copy" onclick="copyPromoCode('code-3', this)">SALIN</button>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <h2 class="title-center">Apa Kata Mereka Tentang Kami</h2>

        <div class="testi-grid">
            <!-- Testimonial 1 -->
            <div class="testi-card">
                <p>"Tempatnya asri banget, hutan bambunya adem dan nyaman buat healing"</p>
                <div class="stars">★★★★☆</div>
            </div>

            <!-- Testimonial 2 -->
            <div class="testi-card">
                <p>"Camping di sini menyenangkan, suasananya tenang dan fasilitasnya cukup lengkap"</p>
                <div class="stars">★★★★☆</div>
            </div>

            <!-- Testimonial 3 -->
            <div class="testi-card">
                <p>"Outbound sama teman-teman kantor jadi makin kompak. Recommended banget!"</p>
                <div class="stars">★★★★☆</div>
            </div>
        </div>

    </div>
</div>
<!-- Page Background End -->

@endsection

@if(session('success'))
  <div style="padding:10px; background:#d1fae5; border:1px solid #10b981; margin:10px 0; border-radius:8px;">
    {{ session('success') }}
  </div>
@endif

@push('scripts')
<script>
function copyPromoCode(elementId, button) {
    const codeElement = document.getElementById(elementId);
    const textToCopy = codeElement.textContent;
    
    navigator.clipboard.writeText(textToCopy).then(() => {
        const originalText = button.textContent;
        
        button.textContent = '✓ TERSALIN';
        button.style.background = '#28a745';
        
        setTimeout(() => {
            button.textContent = originalText;
            button.style.background = '';
        }, 2000);
    }).catch(err => {
        console.error('Gagal menyalin:', err);
        alert('Gagal menyalin kode promo');
    });
}
</script>
@endpush