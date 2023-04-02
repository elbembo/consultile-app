<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LinkedinController extends Controller
{
    public function linkedinRedirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function linkedinCallback()
    {
        try {

            $user = Socialite::driver('linkedin')->user();

            $linkedinUser = User::where('oauth_id', $user->id)->first();

            if ($linkedinUser) {
                request()->merge([
                    'email' => $linkedinUser->email,
                    'password' => Hash::make($linkedinUser->password)
                ]);
                $attributes = request()->validate([
                    'email' => 'required|email',
                    'password' => 'required'
                ]);
                // Auth::login($linkedinUser);
                if (Auth::login($attributes)) {
                    session()->regenerate();
                    return redirect('campaigns')->with(['success' => 'You are logged in.']);
                } else {
                    return back()->withErrors(['email' => 'Email or password invalid.']);
                }
            } else {
                $user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'oauth_id' => $user->id,
                    'oauth_type' => 'linkedin',
                    'password' => Hash::make('Hav$!)345k&@97!')
                ]);
                request()->merge([
                    'email' => $user->email,
                    'password' => $user->password
                ]);
                $attributes = request()->validate([
                    'email' => 'required|email',
                    'password' => 'required'
                ]);
                // $userid = $user->id;
                // $user->emp->create(['user_id' => $userid, 'image' => $user->getAvatar()]);

                if (Auth::login($attributes)) {
                    session()->regenerate();
                    return redirect('campaigns')->with(['success' => 'You are logged in.']);
                } else {

                    return back()->withErrors(['email' => 'Email or password invalid.']);
                }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
