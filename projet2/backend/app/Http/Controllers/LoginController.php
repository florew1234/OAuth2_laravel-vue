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

}

