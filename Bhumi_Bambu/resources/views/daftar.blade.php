<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - Bhumi Bambu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        .logo {
            justify-content: center;
            display: flex;
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f3f6f4;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-box {
            background: #fff;
            width: 100%;
            max-width: 500px;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
        }

        .register-box h2 {
            text-align: center;
            margin-bottom: 5px;
            color: #1d6436;
        }

        .register-box p {
            text-align: center;
            font-size: 13px;
            color: #777;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 16px;
            margin-right: 20px;
        }

        label {
            font-size: 13px;
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 13px;
        }

        input:focus {
            outline: none;
            border-color: #1d6436;
        }

        .error {
            font-size: 12px;
            color: #e63946;
            margin-top: 4px;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #1d6436;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #248847;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
        }

        .login-link a {
            color: #1d6436;
            font-weight: 500;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="register-box">
    <div class="logo">
    <img src="{{ asset('aset/logo.png') }}" alt="Bhumi Bambu">
    </div>
    <h2>Daftar Akun</h2>
    <p>Buat akun untuk melakukan reservasi</p>
    @if ($errors->any())
    <div style="background:#ffe5e5; border:1px solid #ffb3b3; padding:10px; border-radius:10px; margin-bottom:14px; font-size:13px;">
        <b>Gagal daftar:</b>
        <ul style="margin:6px 0 0 18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div style="background:#ffe5e5; border:1px solid #ffb3b3; padding:10px; border-radius:10px; margin-bottom:14px; font-size:13px;">
        {{ session('error') }}
    </div>
@endif

    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        {{-- Nama --}}
        <div class="form-group">
            <label>Nama Lengkap *</label>
            <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" placeholder="Nama lengkap" required>
            @error('nama_pelanggan') <div class="error">{{ $message }}</div> @enderror
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label>Password *</label>
            <input type="password" name="password" placeholder="Minimal 8 karakter" required>
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div class="form-group">
            <label>Konfirmasi Password *</label>
            <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
        </div>

        {{-- No HP --}}
        <div class="form-group">
            <label>No. HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx">
            @error('no_hp') <div class="error">{{ $message }}</div> @enderror
        </div>

        {{-- Alamat --}}
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat tempat tinggal">
            @error('alamat') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn-submit">Daftar</button>
    </form>

    <div class="login-link">
        Sudah punya akun?
        <a href="{{ route('login') }}">Masuk</a>
    </div>
</div>

</body>
</html>
