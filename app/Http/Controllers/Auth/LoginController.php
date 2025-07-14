<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            /** @var \\App\\Models\\User $user */
            $user = Auth::user();

            // Check if user is approved
            if (!$user->isApproved()) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Akun Anda belum disetujui oleh admin. Silakan tunggu persetujuan.',
                ]);
            }

            // Check if email is verified
            if (!$user->email_verified_at) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Email Anda belum diverifikasi. Silakan cek email Anda.',
                ]);
            }

            $request->session()->regenerate();

            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
