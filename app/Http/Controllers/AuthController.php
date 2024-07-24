<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
session_id('travel-iqbal');
session_start();


class AuthController extends Controller
{
    public function index() {
        return view('layouts.user-dashboard');
    }
    public function view_login()
    {
        return view('login');
    }

    public function view_register()
    {
        return view('register');
    }

    public function register(Request $req)
    {
        $params = $req->all();
        if ($params['password'] != $params['confirm_password']) {
            return view('register')->with($params);
        }
        $status = User::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => bcrypt($params['password']),
            'type' => 'user',
        ]);
        if ($status) {
            return redirect()->to('login')->with('success', 'Registrasi Berhasil');
        }
    }

    public function login(Request $req)
    {
        $params = $req->all();

        $status = Auth::attempt(['email' => $params['email'], 'password' => $params['password']], $remember = true);

        if ($status) {
            $user = Auth::user();

            if ($user->type == 'admin') {
                Session::put('login_admin', true);
                return redirect()->to('admin-dashboard');
            } else if ($user->type == 'supir') {
                Session::put('login_supir', true);
                return redirect()->to('supir-dashboard');
            } else if ($user->type == 'user') {
                Session::put('login_user', true);
                return redirect()->to('user-dashboard');
            }
        } else {
            return redirect()->to('login')->with('error', 'Email atau password salah.');
        }


        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->to('login');
    }

    public function ubah_password()
    {
        return view('pages.ubah-password-user');
    }
    public function update_password(Request $request, $id)
    {
        $cek = User::findOrFail($id);

        if($cek)
        {
            // cek password lama
            if(Hash::check($request->password_lama, $cek->password))
            {
                if($request->password_baru == $request->konfirmasi_password_baru)
                {
                    $cek->update([
                        'password' => bcrypt($request->password_baru)
                    ]);

                    return redirect()->to('ubah-password-user')->with('success', 'Password berhasil diubah');
                } else {
                    return redirect()->to('ubah-password-user')->with('error', 'Konfirmasi password tidak sesuai.');
                }
            } else {
                return redirect()->to('ubah-password-user')->with('error', 'Password lama tidak sesuai.');
            }
        } else {
            return redirect()->to('ubah-password-user')->with('error', 'Data tidak ditemukan');
        }
    }

    public function forgotpw()
    {
        return view('forgotpw');
    }
}
