
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            SIA 
        </a>

        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                {{ Auth::user()->full_name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="mb-4">
        <h2 class="fw-bold">Dashboard Mahasiswa</h2>
        <p class="text-muted">Selamat datang di halaman dashboard Anda.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">Informasi Data Mahasiswa</h5>
        </div>

        <div class="card-body p-4">
            <div class="row align-items-center">

                <div class="col-md-3 text-center mb-4 mb-md-0">
                    @if (Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                            alt="Foto Profil"
                            class="img-thumbnail rounded-circle mb-3"
                            style="width: 180px; height: 180px; object-fit: cover;">
                    @else
                        <div class="bg-light border rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 180px; height: 180px;">
                            <span class="text-muted">Belum ada foto</span>
                        </div>
                    @endif

                    <h5 class="fw-bold">{{ Auth::user()->full_name }}</h5>
                    <span class="badge bg-primary">Mahasiswa</span>
                </div>

                <div class="col-md-9">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 35%;">NIM</th>
                            <td>{{ Auth::user()->nim }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ Auth::user()->full_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td>{{ Auth::user()->birth_place }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>
                                {{ Auth::user()->birth_date
                                    ? Auth::user()->birth_date->format('d-m-Y')
                                    : '-' }}
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="text-center text-muted mt-4">
        &copy; {{ date('Y') }} Simple Dashboard Mahasiswa
    </div>
</div>

</body>
</html>
