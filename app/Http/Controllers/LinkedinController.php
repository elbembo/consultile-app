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
                $email = $linkedinUser->email;
                $password = 'Hav$!)345k&@97!';
                // dd(['email' => $email, 'password' => $password]);
                Auth::loginUsingId($linkedinUser->id);
                $emp = $linkedinUser->emp()->updateOrCreate(['image' =>$user->getAvatar()]);
                $emp->image  = $user->getAvatar() ;
                $emp->save();
                session()->regenerate();
                return redirect('activities')->with(['success' => 'You are logged in.']);
            } else {
                $user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'oauth_id' => $user->id,
                    'oauth_type' => 'linkedin',
                    'password' => Hash::make('Hav$!)345k&@97!')
                ]);
                $user->syncRoles(['employer']);
                $email = $user->email;
                $password = 'Hav$!)345k&@97!';
                // dd(['email' => $email, 'password' => $password]);
                Auth::loginUsingId($user->id);
                session()->regenerate();
                return redirect('activities')->with(['success' => 'You are logged in.']);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
