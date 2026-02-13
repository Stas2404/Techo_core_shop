<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:customers,Email', 
            'password' => 'required|min:6',
            'name' => 'required',
            'phone' => 'required'
        ]);

        $customer = new Customer();
        $customer->FullName = $request->name; 
        $customer->Email = $request->email; 
        $customer->Phone = $request->phone;  
        $customer->Address = $request->address ?? 'Не вказано';
        $customer->Password = Hash::make($request->password); 
        $customer->RegDate = now();
        
        $customer->save();

        Auth::login($customer);

        return redirect('/')->with('success', 'Вітаємо! Ви успішно зареєструвалися.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['Email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'З поверненням!');
        }

        return back()->withErrors([
            'email' => 'Невірний логін або пароль.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}