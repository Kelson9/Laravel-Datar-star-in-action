<?php

namespace App\Http\Controllers\Discover;
use  App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Dancycodes\Hyper\Routing\Attributes\Route;


#[Route(middleware: 'web')]
class AuthController extends Controller
{
    public function loginView()
    {
        return hyper()
        ->forget()
        ->view('login', web:true);
    }

    public function registerView()
    {
       return hyper()->view('register')->web(view('register'));
    }

    #[Route(method: 'post')]
    public function register()
    {
        $validated = signals()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|same:password',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return hyper()
            ->forget()
            ->navigate(route('auth.login-view'))
            ->signals([
                'successMessage' => 'Account created successfully! Please login.',
            ]);
    }

    #[Route(method: ['get', 'post'])]
    public function login()
    {
        $validated = signals()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!\Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return hyper()->signals([
                'errors' => [
                    'email' => ['These credentials do not match our records.']
                ]
            ]);
        }

        request()->session()->regenerate();

        return hyper()
            ->navigate(route('tasks'))
            ->signals([
                'errors' => []
            ]);
    }

    public function logout()
    {
        \Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home');
    }
}
