<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.signin');
    }
    public function create_admin()
    {
        return view('auth.signin-admin');
    }
    public function store(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $rememberMe = $request->rememberMe ? true : false;

        if (Auth::attempt($credentials, $rememberMe)) {
            $user = Auth::user();
            if ($user->id_posisi == 2 || $user->id_posisi == 3) {
                $request->session()->regenerate();
                return redirect()->intended('/anggota/dashboard-anggota');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'message' => 'Anda tidak memiliki akses untuk masuk ke sistem ini.',
                ]);
            }
        }

        return back()->withErrors([
            'message' => 'Username, password tidak sesuai.',
        ])->withInput($request->only('username'));
    }

    public function store_admin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $credentials['id_posisi'] = 1;
        $rememberMe = $request->rememberMe ? true : false;

        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'message' => 'Username, password tidak sesuai.',
        ])->withInput($request->only('username'));
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/sign-in');
    }
    public function destroy_admin(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }
}
