<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use Socialite;
use App\Social;
use App\User;
class LoginController extends Controller
{


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    { 
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    { 
        try 
          {
            $socialUser = Socialite::driver($provider)->user();
        } 
        catch (\Exception $e) {
            return redirect('/');
        }

        $socialProvider = Social::where('provider_id',$socialUser->getId())->first();

        if(!$socialProvider){
             
            $user = User::firstOrCreate(
                   // ['avatar'=> $socialUser->getAvatar()],
                    ['name'=> $socialUser->getName()]
                    
                    );
           
            $user->social()->create(
                    ['provider_id' => $socialUser->getId(),'provider' => $provider]
                    );
           
        }
        else{

            $user = $socialProvider->user;
            auth()->login($user);
            return redirect('/home');
        }

    }
}
