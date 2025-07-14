<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function approve(User $user)
    {
        $user->update([
            'is_approved' => true
        ]);

        // TODO: Send WhatsApp notification to user
        // $this->notifyUserApproved($user);

        return redirect()->back()
            ->with('success', 'User berhasil disetujui!');
    }

    public function reject(User $user)
    {
        $user->delete();

        // TODO: Send WhatsApp notification to user
        // $this->notifyUserRejected($user);

        return redirect()->back()
            ->with('success', 'User berhasil ditolak dan dihapus!');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    private function notifyUserApproved(User $user)
    {
        // TODO: Implement WhatsApp notification via Quods.id API
        $message = "Halo {$user->name}! Akun Anda telah disetujui oleh admin. Silakan login di aplikasi Pohon Keluarga.";

        // Send WhatsApp notification
        // WhatsAppService::send($user->phone, $message);
    }

    private function notifyUserRejected(User $user)
    {
        // TODO: Implement WhatsApp notification via Quods.id API
        $message = "Halo {$user->name}! Maaf, pendaftaran Anda tidak disetujui. Silakan hubungi admin untuk informasi lebih lanjut.";

        // Send WhatsApp notification
        // WhatsAppService::send($user->phone, $message);
    }
}
