<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        
        $findCustomer = Customer::where('google_id', $googleUser->id)->first();

        if ($findCustomer) {
            Auth::login($findCustomer);
            return redirect('/')->with('success', 'З поверненням!');
        } else {
            $customer = Customer::where('Email', $googleUser->email)->first();

            if ($customer) {
                $customer->update(['google_id' => $googleUser->id]);
                Auth::login($customer);
                return redirect('/')->with('success', 'Акаунт об\'єднано!');
            } else {
                $newCustomer = Customer::create([
                    'FullName' => $googleUser->name,
                    'Email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'Password' => Hash::make(Str::random(16)), 
                    'Phone' => 'Не вказано',
                    'Address' => 'Не вказано',
                    'RegDate' => now(),
                    'is_admin' => 0
                ]);

                Auth::login($newCustomer);
                return redirect('/')->with('success', 'Реєстрація успішна!');
            }
        }
    }
}