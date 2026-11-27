
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - SIA ATMI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #1746a2;
            --dark: #14213d;
            --background: #f4f7fc;
        }

        body {
            background: var(--background);
            font-family: Arial, sans-serif;
            color: #26334d;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: var(--dark);
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 18px;
            z-index: 1000;
        }

        .sidebar-brand {
            color: white;
            font-size: 23px;
            font-weight: bold;
            text-decoration: none;
            display: block;
            margin-bottom: 40px;
        }

        .sidebar-label {
            color: #91a0bb;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 25px 12px 12px;
        }

        .sidebar a.menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
            padding: 13px 14px;
            border-radius: 10px;
            text-decoration: none;
            margin-bottom: 7px;
            transition: .2s;
        }

        .sidebar a.menu-link:hover,
        .sidebar a.menu-link.active {
            background: var(--primary);
            color: white;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .topbar {
            background: white;
            padding: 17px 24px;
            border-radius: 14px;
            box-shadow: 0 3px 15px rgba(0,0,0,.04);
            margin-bottom: 30px;
        }

        .welcome-card {
            background: linear-gradient(120deg, #1746a2, #3679db);
            color: white;
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 25px;
        }

        .info-card {
            background: white;
            border: none;
            border-radius: 15px;
            padding: 22px;
            height: 100%;
            box-shadow: 0 3px 15px rgba(0,0,0,.04);
        }

        .info-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #eaf1ff;
            color: var(--primary);
            font-size: 21px;
            margin-bottom: 15px;
        }

        .content-card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,.04);
        }

        .profile-photo {
            width: 125px;
            height: 125px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 3px 12px rgba(0,0,0,.15);
        }

        .profile-placeholder {
            width: 125px;
            height: 125px;
            border-radius: 50%;
            background: #1746a2;
            color: white;
            font-size: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .table th {
            color: #64748b;
            font-weight: 600;
            width: 35%;
        }

        .table td {
            color: #26334d;
        }

        .mobile-menu {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .mobile-menu {
                display: inline-block;
            }

            .welcome-card {
                padding: 22px;
            }
        }
    </style>
</head>

<body>

@php
    $user = Auth::user();
@endphp

{{-- SIDEBAR --}}
<aside class="sidebar">

    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <i class="bi bi-mortarboard-fill me-2"></i>
        SIA ATMI
    </a>

    <div class="sidebar-label">MENU UTAMA</div>

    <a href="{{ route('dashboard') }}" class="menu-link active">
        <i class="bi bi-grid-fill"></i>
        Dashboard
    </a>

    <a href="{{ route('profile.edit') }}" class="menu-link">
        <i class="bi bi-person-circle"></i>
        Edit Profil
    </a>

    <div class="sidebar-label">AKUN</div>

    <a href="{{ route('profile.edit') }}" class="menu-link">
        <i class="bi bi-shield-lock"></i>
        Keamanan Akun
    </a>

    <div class="mt-5">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="btn btn-outline-light w-100">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </button>
        </form>
    </div>

</aside>

{{-- MAIN CONTENT --}}
<main class="main-content">

    {{-- TOPBAR --}}
    <div class="topbar d-flex justify-content-between align-items-center">

        <div>
            <button class="btn btn-primary mobile-menu me-2"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar">
                <i class="bi bi-list"></i>
            </button>

            <span class="fw-bold fs-5">Dashboard</span>
            <div class="text-muted small">
                Sistem Informasi Akademik Mahasiswa
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            @if ($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}"
                    width="42"
                    height="42"
                    class="rounded-circle"
                    style="object-fit:cover;"
                    alt="Foto profil">
            @else
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                    style="width:42px;height:42px;">
                    {{ strtoupper(substr($user->full_name, 0, 1)) }}
                </div>
            @endif

            <div class="d-none d-sm-block">
                <div class="fw-semibold">
                    {{ $user->full_name }}
                </div>
                <small class="text-muted">Mahasiswa</small>
            </div>
        </div>

    </div>

    {{-- MOBILE SIDEBAR --}}
    <div class="offcanvas offcanvas-start text-bg-dark"
        tabindex="-1"
        id="mobileSidebar">

        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold">
                <i class="bi bi-mortarboard-fill me-2"></i>
                SIA ATMI
            </h5>

            <button type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body">

            <a href="{{ route('dashboard') }}"
                class="menu-link active">
                <i class="bi bi-grid-fill"></i>
                Dashboard
            </a>

            <a href="{{ route('profile.edit') }}"
                class="menu-link">
                <i class="bi bi-person-circle"></i>
                Edit Profil
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>
            </form>

        </div>
    </div>

    {{-- WELCOME --}}
    <section class="welcome-card">
        <div class="row align-items-center">

            <div class="col-md-8">
                <h3 class="fw-bold mb-2">
                    Selamat Datang, {{ $user->full_name }}!
                </h3>

                <p class="mb-3">
                    Selamat datang di Sistem Informasi Akademik
                    SIA ATMI. Semoga aktivitas akademik Anda berjalan lancar.
                </p>

                <a href="{{ route('profile.edit') }}"
                    class="btn btn-light text-primary fw-semibold">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Profil
                </a>
            </div>

            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <i class="bi bi-mortarboard"
                    style="font-size:100px;opacity:.3;"></i>
            </div>

        </div>
    </section>

    {{-- SUMMARY CARDS --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="info-card">
                <div class="info-icon">
                    <i class="bi bi-person-badge"></i>
                </div>

                <div class="text-muted small">NIM Mahasiswa</div>
                <h5 class="fw-bold mb-0">{{ $user->nim }}</h5>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-card">
                <div class="info-icon">
                    <i class="bi bi-envelope"></i>
                </div>

                <div class="text-muted small">Email</div>
                <h6 class="fw-bold mb-0 text-break">{{ $user->email }}</h6>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-card">
                <div class="info-icon">
                    <i class="bi bi-calendar-event"></i>
                </div>

                <div class="text-muted small">Tanggal Lahir</div>
                <h5 class="fw-bold mb-0">
                    {{ $user->birth_date ? $user->birth_date->format('d-m-Y') : '-' }}
                </h5>
            </div>
        </div>

    </div>

    {{-- STUDENT PROFILE --}}
    <div class="card content-card mb-4">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div>
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-person-lines-fill text-primary me-2"></i>
                        Informasi Data Mahasiswa
                    </h5>

                    <small class="text-muted">
                        Informasi identitas pribadi mahasiswa
                    </small>
                </div>

                <a href="{{ route('profile.edit') }}"
                    class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil-square me-1"></i>
                    Edit Data
                </a>
            </div>

            <div class="row align-items-center">

                {{-- PHOTO --}}
                <div class="col-lg-3 text-center mb-4 mb-lg-0">

                    @if ($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}"
                            class="profile-photo mb-3"
                            alt="Foto Mahasiswa">
                    @else
                        <div class="profile-placeholder mb-3">
                            {{ strtoupper(substr($user->full_name, 0, 1)) }}
                        </div>
                    @endif

                    <h5 class="fw-bold mb-1">
                        {{ $user->full_name }}
                    </h5>

                    <span class="badge bg-primary">
                        Mahasiswa
                    </span>

                </div>

                {{-- BIODATA --}}
                <div class="col-lg-9">

                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">

                            <tr class="border-bottom">
                                <th>NIM</th>
                                <td>{{ $user->nim }}</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>Nama Lengkap</th>
                                <td>{{ $user->full_name }}</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>Tempat Lahir</th>
                                <td>{{ $user->birth_place }}</td>
                            </tr>

                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>
                                    {{ $user->birth_date
                                        ? $user->birth_date->format('d-m-Y')
                                        : '-' }}
                                </td>
                            </tr>

                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <footer class="text-center text-muted small py-3">
        &copy; {{ date('Y') }} SIA ATMI.
        Sistem Informasi Akademik Mahasiswa.
    </footer>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
