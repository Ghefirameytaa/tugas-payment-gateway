<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Paket</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
  <h4 class="mb-3">Tambah Paket</h4>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('paket-layanan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label class="form-label">Nama Paket</label>
      <input type="text" name="nama_paket" class="form-control" value="{{ old('nama_paket') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Fasilitas</label>
      <input type="text" name="fasilitas" class="form-control" value="{{ old('fasilitas') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Venue</label>
      <input type="text" name="venue" class="form-control" value="{{ old('venue') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="text" name="harga" class="form-control" value="{{ old('harga') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Kapasitas</label>
      <input type="text" name="kapasitas" class="form-control" value="{{ old('kapasitas') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Gambar</label>
      <input type="file" name="gambar_venue" class="form-control" accept="image/*">
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('paket-layanan.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>

</body>
</html>
