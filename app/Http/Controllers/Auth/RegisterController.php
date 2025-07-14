<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_approved' => false,
        ]);

        // Send email verification
        $user->sendEmailVerificationNotification();

        // Send notification to admin (will be implemented later)
        // $this->notifyAdmin($user);

        return redirect()->route('login')
            ->with('success', 'Pendaftaran berhasil! Silakan cek email Anda untuk verifikasi dan tunggu persetujuan admin.');
    }

    private function notifyAdmin(User $user)
    {
        // TODO: Implement admin notification via WhatsApp
        // This will be implemented when we add WhatsApp integration
    }
}
