<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'employeeNumber'     => 'required',
            'password'         => 'required',
        ]);
       
 
        if (Auth::attempt(['employeeNumber' =>  $credentials['employeeNumber'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
    
            // Cek akses pengguna ke dashboard setelah login berhasil
            if ($this->userCanAccessDashboard()) {
                return redirect()->intended('/dashboard');
            } else {
                // Jika tidak memiliki akses, logout dan kirim pesan error
                Auth::logout();
                return back()->with([
                    'loginError' => 'Access denied to the dashboard.',
                ]);
            }
        }

        return back()->with([
            'loginError' => 'Login field!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Pengecekan sederhana untuk mengidentifikasi apakah pengguna terautentikasi
     * memiliki akses ke dashboard. Anda perlu mengimplementasikan logika sesuai 
     * kebijakan akses aplikasi Anda.
     *
     * @return bool
     */
    protected function userCanAccessDashboard()
    {
        $jsonData = auth()->user()->permission;
        $menuData = json_decode($jsonData, true);

        return $menuData['dashboardIndex']['index'];
    }

}


