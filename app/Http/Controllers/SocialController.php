<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Str;

class SocialController
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
        $socialUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'nama' => $socialUser->getNickname() ?? $socialUser->getName() ?? 'User',
                'email' => $socialUser->getEmail(),
                'is_mitra' => 0,
                'google_id' => $socialUser->getId(),
                'password' => Hash::make(Str::random(8)),
            ]
        );

        Auth::login($user);

        return redirect()->route('rumahgue');
    }
}