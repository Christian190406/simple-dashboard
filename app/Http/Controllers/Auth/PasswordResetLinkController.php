<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Cari akun berdasarkan email
        $user = Password::broker()->getUser(
            $request->only('email')
        );

        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Email tidak ditemukan. Periksa kembali email Anda.'
                ]);
        }

        // Buat token reset password tanpa mengirim email
        $token = Password::broker()->createToken($user);

        // Langsung arahkan pengguna ke halaman password baru
        return redirect()->route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ]);
    }
}
