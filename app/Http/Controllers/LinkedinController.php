<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;
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

            $user = Socialite::driver('linkedin')->user();

            $linkedinUser = User::where('oauth_id', $user->id)->first();

            if ($linkedinUser) {

                // Auth::login($linkedinUser);
                Auth::attempt(['email' => $linkedinUser->email, 'oauth_id' => $linkedinUser->oauth_id]);
                return redirect('/dashboard');
            } else {
                $user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'oauth_id' => $user->id,
                    'oauth_type' => 'linkedin',
                    'password' => encrypt('admin12345')
                ]);
                // $userid = $user->id;
                // $user->emp->create(['user_id' => $userid, 'image' => $user->getAvatar()]);

                Auth::attempt(['email' => $user->email, 'oauth_id' => $user->oauth_id]);

                return redirect('/dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
