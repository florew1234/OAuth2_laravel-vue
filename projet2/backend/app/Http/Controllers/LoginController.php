<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\User as Authenticatable;   

class LoginController extends Authenticatable
{

    public function redirectToProvider() {
        return Socialite::driver("github")->redirect();
    }

    public function handleProviderCallback(){
        $user = Socialite::driver("github")->user();
        $authUser = User::where('email', $user->id)->first();
        if (is_null($authUser)) {

             User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider' => "github",
                'provider_id' => $user->id,
            ]);
        }
        
        //Auth::login($authUser);
        return redirect('http://localhost:5173/welcome');
    }

    public function redirectToGoogle() {
        return Socialite::driver("google")->redirect();
    }

    public function handleGoogleCallback(){
        $user = Socialite::driver("google")->user();
        $authUser = User::where('email', $user->id)->first();
        if (is_null($authUser)) {

             User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider' => "google",
                'provider_id' => $user->id,
            ]);
        }
        
        //Auth::login($authUser);
        return redirect('http://localhost:5173/welcome');
    }

    public function redirectToFacebook() {
        return Socialite::driver("facebook")->redirect();
    }

    public function handleFacebookCallback(){
        $user = Socialite::driver("facebook")->user();
        $authUser = User::where('email', $user->id)->first();
        if (is_null($authUser)) {

             User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider' => "facebook",
                'provider_id' => $user->id,
            ]);
        }
        
        //Auth::login($authUser);
        return redirect('http://localhost:5173/welcome');
    }

    public function redirectToLinkedIn() {
        return Socialite::driver("linkedIn")->redirect();
    }

    public function handleLinkedInCallback(){
        $user = Socialite::driver("linkedIn")->user();
        $authUser = User::where('email', $user->id)->first();
        if (is_null($authUser)) {

             User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider' => "linkedIn",
                'provider_id' => $user->id,
            ]);
        }
        
        //Auth::login($authUser);
        return redirect('http://localhost:5173/welcome');
    }

    public function redirectToMicrosoft() {
        return Socialite::driver("microsoft")->redirect();
    }

    public function handleMicrosoftCallback(){
        $user = Socialite::driver("microsoft")->user();
        $authUser = User::where('email', $user->id)->first();
        if (is_null($authUser)) {

             User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider' => "microsoft",
                'provider_id' => $user->id,
            ]);
        }
        
        //Auth::login($authUser);
        return redirect('http://localhost:5173/welcome');
    }

}

