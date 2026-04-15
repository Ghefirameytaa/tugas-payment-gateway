<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pelanggan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Profil Pelanggan</h5>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($pelanggan)
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Nama</th>
                                    <td>: {{ $pelanggan->nama_pelanggan }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: {{ $pelanggan->email }}</td>
                                </tr>
                                <tr>
                                    <th>No. HP</th>
                                    <td>: {{ $pelanggan->no_hp }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>: {{ $pelanggan->alamat ?? '-' }}</td>
                                </tr>
                            </table>

                            <div class="text-end">
                                <a href="{{ route('profil.edit') }}" class="btn btn-warning">
                                    Edit Profil
                                </a>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                Data profil belum tersedia.
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
