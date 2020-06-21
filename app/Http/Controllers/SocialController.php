<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Socialite;

class SocialController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        $data=User::where('provider_id',$user->getId())->where('email',$user->getEmail())->first();
        if ($data){
            auth()->login($data);
        }else{
           User::create([
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'provider_id'=>$user->getId(),
                'provider_name'=>'github'
            ]);

        }
    return redirect(route('home'));




    }

}
