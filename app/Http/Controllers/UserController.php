<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
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
        return view('auth.login');
    }

    public function authenticate(AuthRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        
        if (auth()->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            if (auth()->user()->role === UserRole::TU) {
                return redirect()->route('tu.dashboard') // Ke dashboard atau halaman yang dituju sebelumnya
                                 ->with('success', 'Selamat datang kembali, ' . auth()->user()->name);
            } else if (auth()->user()->role === UserRole::KEPALA_TU) {
                return redirect()->route('tu.dashboard') // Ke dashboard atau halaman yang dituju sebelumnya
                                 ->with('success', 'Selamat datang kembali, ' . auth()->user()->name);
            } else if (auth()->user()->role === UserRole::WAKA) {
                return redirect()->route('waka.dashboard') // Ke dashboard atau halaman yang dituju sebelumnya
                                 ->with('success', 'Selamat datang kembali, ' . auth()->user()->name);
            } else if (auth()->user()->role === UserRole::KEPALA_SEKOLAH) {
                return redirect()->route('kepsek.dashboardkep.view') // Ke dashboard atau halaman yang dituju sebelumnya
                                 ->with('success', 'Selamat datang kembali, ' . auth()->user()->name);
            } else if (auth()->user()->role === UserRole::ADMIN) {
                return redirect()->route('users.index') // Ke dashboard atau halaman yang dituju sebelumnya
                                 ->with('success', 'Selamat datang kembali, ' . auth()->user()->name);
            }
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
        
        return view('admin.userIndex', compact('users'));
    }

    /**
     * Tampilan untuk membuat user baru
     */
    public function createUserView(): View
    {
        $roles = array_column(UserRole::cases(), 'value');

        return view('admin.create', compact('roles'));
    }

    /**
     * Tampilan untuk memperbarui user
     */
    public function editUserView(User $user): View
    {
        return view('admin.edit', compact('user'));
    }

    // End View function

    /**
     * Logika untuk menyimpan user baru
     */
    public function storeUser(UserRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['password'] = bcrypt($data['password']);

            User::create($data);

            return redirect()
                    ->route('users.index')
                    ->with('success', 'User baru berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->route('users.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Logika untuk memperbarui user
     */
    public function updateUser(UserRequest $request, User $user): RedirectResponse
    {
        try {
            $data = $request->validated();

            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = bcrypt($data['password']);
            }

            $user->update($data);

            return redirect()
                    ->route('users.index')
                    ->with('success', 'User berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->route('users.index')
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
                    ->route('users.index')
                    ->with('success', 'User berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->route('users.index')
                ->with('error', $e->getMessage());
        }
    }
}
