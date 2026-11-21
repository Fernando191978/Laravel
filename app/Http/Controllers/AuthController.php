<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar el formulario de login (la vista)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el intento de login
    public function login(Request $request)
    {
        // Validar que los campos no vengan vacíos
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Intentar autenticar al usuario con el campo 'username'
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Si el login es correcto, regeneramos la sesión (seguridad)
            $request->session()->regenerate();

            // Redirigir a la página principal o dashboard (lo crearemos luego)
            return redirect()->intended('/'); 
        }

        // Si falla, volver atrás con un mensaje de error
        return back()->withErrors([
            'username' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('username');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}