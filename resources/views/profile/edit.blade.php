
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil - SIA ATMI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f4f6fb;
        }

        .profile-card {
            border: none;
            border-radius: 18px;
        }

        .form-control {
            padding: 11px 14px;
            border-radius: 9px;
        }

        .btn {
            border-radius: 9px;
        }

        .profile-photo {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border: 4px solid white;
        }

        .section-title {
            font-weight: 700;
            color: #24324a;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            <i class="bi bi-mortarboard-fill me-2"></i>
            SIA ATMI
        </a>

        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke Dashboard
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="mb-4">
                <h2 class="fw-bold">Pengaturan Akun</h2>
                <p class="text-muted">
                    Kelola informasi pribadi dan keamanan akun Anda.
                </p>
            </div>

            {{-- PESAN ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM EDIT PROFIL --}}
            <div class="card profile-card shadow-sm mb-4">
                <div class="card-body p-4 p-md-5">

                    <h4 class="section-title mb-2">
                        <i class="bi bi-person-circle me-2 text-primary"></i>
                        Informasi Profil
                    </h4>

                    <p class="text-muted mb-4">
                        Perbarui data pribadi dan foto profil Anda.
                    </p>

                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success">
                            Profil berhasil diperbarui!
                        </div>
                    @endif

                    <form method="POST"
                        action="{{ route('profile.update') }}"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')

                        {{-- FOTO PROFIL --}}
                        <div class="text-center mb-4">

                            @if ($user->photo)
                                <img src="{{ asset('storage/' . $user->photo) }}"
                                    class="rounded-circle shadow-sm profile-photo mb-3"
                                    alt="Foto Profil">
                            @else
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm"
                                    style="width:130px;height:130px;font-size:45px;">
                                    {{ strtoupper(substr($user->full_name ?: $user->name, 0, 1)) }}
                                </div>
                            @endif

                            <h5 class="fw-bold mb-1">
                                {{ $user->full_name }}
                            </h5>

                            <span class="text-muted small">Foto Profil</span>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Ganti Foto Profil
                            </label>

                            <input type="file"
                                name="photo"
                                class="form-control"
                                accept=".jpg,.jpeg,.png">

                            <small class="text-muted">
                                Format JPG, JPEG, PNG. Maksimal 2 MB.
                            </small>
                        </div>

                        <hr class="my-4">

                        {{-- DATA MAHASISWA --}}
                        <h5 class="section-title mb-3">
                            Data Mahasiswa
                        </h5>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">NIM</label>
                            <input type="text"
                                name="nim"
                                class="form-control"
                                value="{{ old('nim', $user->nim) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text"
                                name="full_name"
                                class="form-control"
                                value="{{ old('full_name', $user->full_name) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $user->email) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text"
                                name="birth_place"
                                class="form-control"
                                value="{{ old('birth_place', $user->birth_place) }}"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date"
                                name="birth_date"
                                class="form-control"
                                value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '') }}"
                                required>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-1"></i>
                                Simpan Perubahan
                            </button>

                            <a href="{{ route('dashboard') }}"
                                class="btn btn-outline-secondary px-4">
                                Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>

            {{-- FORM GANTI PASSWORD --}}
            <div class="card profile-card shadow-sm">
                <div class="card-body p-4 p-md-5">

                    <h4 class="section-title mb-2">
                        <i class="bi bi-shield-lock me-2 text-primary"></i>
                        Keamanan Akun
                    </h4>

                    <p class="text-muted mb-4">
                        Ganti password secara berkala untuk menjaga keamanan akun.
                    </p>

                    @if (session('status') === 'password-updated')
                        <div class="alert alert-success">
                            Password berhasil diperbarui!
                        </div>
                    @endif

                    @if ($errors->updatePassword->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->updatePassword->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        {{-- PASSWORD LAMA --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Password Lama
                            </label>

                            <div class="input-group">
                                <input type="password"
                                    name="current_password"
                                    class="form-control"
                                    id="current_password"
                                    autocomplete="current-password"
                                    required>

                                <button class="btn btn-outline-secondary"
                                    type="button"
                                    onclick="togglePassword('current_password', this)"
                                    aria-label="Lihat password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        {{-- PASSWORD BARU --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Password Baru
                            </label>

                            <div class="input-group">
                                <input type="password"
                                    name="password"
                                    class="form-control"
                                    id="new_password"
                                    autocomplete="new-password"
                                    required>

                                <button class="btn btn-outline-secondary"
                                    type="button"
                                    onclick="togglePassword('new_password', this)"
                                    aria-label="Lihat password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Konfirmasi Password Baru
                            </label>

                            <div class="input-group">
                                <input type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    id="password_confirmation"
                                    autocomplete="new-password"
                                    required>

                                <button class="btn btn-outline-secondary"
                                    type="button"
                                    onclick="togglePassword('password_confirmation', this)"
                                    aria-label="Lihat password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-key me-1"></i>
                            Ganti Password
                        </button>

                    </form>
                </div>
            </div>

            <p class="text-center text-muted mt-4 small">
                &copy; {{ date('Y') }} SIA ATMI
            </p>

        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
            button.setAttribute('aria-label', 'Sembunyikan password');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
            button.setAttribute('aria-label', 'Lihat password');
        }
    }
</script>

</body>
</html>
