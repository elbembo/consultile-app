<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;
use Socialite;
use App\Models\User;

class LinkedinController extends Controller
{
    public function linkedinRedirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function linkedinCallback()
    {
        try {

            $socialUser = Socialite::driver('linkedin')->user();

            $linkedinUser = User::where('oauth_id', $user->id)->first();

            if ($linkedinUser) {

                Auth::login($linkedinUser);

                return redirect('/dashboard');
            } else {
                $user = User::create([
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'oauth_id' => $socialUser->id,
                    'oauth_type' => 'linkedin',
                    'password' => encrypt('admin12345')
                ]);
                $userid = $user->id;
                $user->emp->create(['user_id' => $userid, 'image' => $user->getAvatar()]);

                Auth::login($user);

                return redirect('/dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
