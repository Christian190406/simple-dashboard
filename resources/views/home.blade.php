
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - SIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            SIA
        </a>

        <div>
            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-light text-primary">
                Registrasi
            </a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center text-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm p-5">
                <h1 class="display-5 fw-bold text-primary">
                    Selamat Datang!
                </h1>

                <p class="lead mt-3">
                     SIA
                </p>

                <p class="text-muted">
                    Sistem informasi sederhana untuk mengelola data mahasiswa.
                    Silakan login jika sudah memiliki akun atau lakukan registrasi
                    untuk membuat akun baru.
                </p>

                <div class="mt-3">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center text-muted py-3">
    &copy; {{ date('Y') }} Simple Dashboard Mahasiswa
</footer>

</body>
</html>
