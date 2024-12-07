<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first(); // Check if the user exists by Google ID

            if (!$user) {
                // Check if the user exists by email
                $existing_user = User::where('email', $google_user->getEmail())->first();

                if (!$existing_user) {
                    // Create a new user if no user with the same email exists
                    $new_user = User::create([
                        'name' => $google_user->getName(),
                        'email' => $google_user->getEmail(),
                        'google_id' => $google_user->getId()
                    ]);
                    Auth::login($new_user);
                    return redirect()->intended('home');
                } else {
                    // If a user with the same email exists, login that user
                    Auth::login($existing_user);
                    return redirect()->intended('home');
                }
            } else {
                Auth::login($user);
                return redirect()->intended('home');
            }
        } catch (\Throwable $th) {
            dd('Something went wrong ' . $th->getMessage());
        }
    }
}
