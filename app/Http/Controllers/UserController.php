<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    // Start Auth function

    /**
     * Tampilan halaman login
     */
    public function loginView(): View
    {
        return view('');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        if (auth()->attempt($request->all(), $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard') // Ke dashboard atau halaman yang dituju sebelumnya
                             ->with('success', 'Selamat datang kembali, ' . auth()->user()->name);
        }

        return back()->withErrors([
            'username' => 'Username atau password tidak sesuai.',
        ])->onlyInput('username');
    }

    /**
     * Proses logout user
     */
    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                         ->with('success', 'Berhasil keluar sistem.');
    }

    // End Auth function
    
    // Start View function

    /**
     * Tampilan list untuk menampilkan seluruh user
     */
    public function indexUserView(): View
    {
        $users = User::paginate(10);
        
        return view('', compact('users'));
    }

    /**
     * Tampilan untuk membuat user baru
     */
    public function createUserView(): View
    {
        $roles = array_column(UserRole::cases(), 'value');

        return view('', compact('roles'));
    }

    /**
     * Tampilan untuk memperbarui user
     */
    public function editUserView(User $user): View
    {
        return view('', compact('user'));
    }

    // End View function

    /**
     * Logika untuk menyimpan user baru
     */
    public function storeUser(Request $request): RedirectResponse
    {
        try {
            User::create($request->all());

            return redirect()
                    ->route('')
                    ->with('success', 'User baru berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Logika untuk memperbarui user
     */
    public function updateUser(Request $request, User $user): RedirectResponse
    {
        try {
            $user->update($request->all());

            return redirect()
                    ->route('')
                    ->with('success', 'User berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Logika untuk menghapus user
     */
    public function deleteUser(User $user): RedirectResponse
    {
        try {
            $user->delete();

            return redirect()
                    ->back()
                    ->with('success', 'User berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
}
