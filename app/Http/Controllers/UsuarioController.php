<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $request = $request->validated();
        $request['password'] = Hash::make($request['password']);
        Usuario::create($request);

        return redirect()->route('auth.loginPage')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function login(LoginRequest $request)
{
    $credentials = $request->validated(); //
    if (Auth::attempt($credentials)) { 
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }
    return back()->withErrors([
        'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
    ])->onlyInput('email');
}
}
