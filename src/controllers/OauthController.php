<?php
namespace App\Http\Controllers;

use App\User;
use App\Traits\ExplicadorOauthV1;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{

    use ExplicadorOauthV1;

    private $defaultPassword;

    public function __construct()
    {
        $this->defaultPassword = '2344-=+dfg453-lkflmd/##@%ˆˆ(rtsg)&**';
    }

    public function redirectToExplicador(){
        
        return $this->handleRedirectForAuth();
    }

    public function handleExplicadorCallback(Request $request)
    {
        $bearer_token = $request->query('bearer_token');

        $user = $this->getUserFromToken($bearer_token);

        if (!$user) {
            // O user não autenticou-se com sucesso
            return redirect()->back();
        }

        return $this->concludeExplicadorAuth($user);

    }

    public function concludeExplicadorAuth($user) {

        $finduser = User::where('explicador_id', $user['id'])->orWhere('email', $user['email'])->first();

        if($finduser){

            //if the user exists, login and show dashboard
            Auth::login($finduser);

            $finduser->explicador_id = $user['id'];
            $finduser->save();

        } else {

            //user is not yet created, so create first
            $newUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'explicador_id'=> $user['id'],
                'email_verified_at'=> $user['is_email_confirmed'] ? now() : null,
                'password' => encrypt($this->defaultPassword)
            ]);

            //login as the new user
            Auth::login($newUser);

            //TODO: Por enviar o link de reposição de senha para que mais tarde o user consiga entrar com email e senha.

        }
        
        // go to the dashboard
        return redirect(config('expauth.redirect_to'));
    }


    public function redirectToGoogle(){

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            //create a user using socialite driver google
            $user = Socialite::driver('google')->stateless()->user();

            // if the user exits, use that user and login
            $finduser = User::where('google_id', $user->id)->orWhere('email', $user->email)->first();

            if($finduser){
                //if the user exists, login and show dashboard

                Auth::login($finduser);

                $finduser->google_id = $user->id;
                $finduser->save();

                return redirect(config('expauth.redirect_to'));

            } else {

                //user is not yet created, so create first
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'email_verified_at'=>now(),
                    'password' => encrypt($this->defaultPassword)
                ]);

                // Sincronizando o user com o outro servidor de autenticação
                $this->syncUserDataWithTheUsersServer($newUser, $this->defaultPassword);

                //login as the new user
                Auth::login($newUser);

                // go to the dashboard
                return redirect(config('expauth.redirect_to'));
            }
            //catch exceptions
        } catch (Exception $e) {

            dd($e->getMessage());

        }
    }

    public function redirectToLinkedin(){
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinledinCallback(){

        $user = Socialite::driver('linkedin')->user();
        
        // if the user exits, use that user and login
        $finduser = User::where('linkedin_id', $user->id)->orWhere('email', $user->email)->first();

        if($finduser){

            Auth::login($finduser);

            $finduser->linkedin_id = $user->id;
            $finduser->save();

            return redirect(config('expauth.redirect_to'));
        } else {
            //user is not yet created, so create first
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'linkedin_id'=> $user->id,
                'email_verified_at'=>now(),
                'password' => encrypt($this->defaultPassword)
            ]);

            Auth::login($newUser);

            // Sincronizando o user com o outro servidor de autenticação
            $this->syncUserDataWithTheUsersServer($newUser, $this->defaultPassword);

            return redirect(config('expauth.redirect_to'));
        }
    }

    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){

        $user = Socialite::driver('facebook')->stateless()->user();
        
        // if the user exits, use that user and login
        $finduser = User::where('facebook_id', $user->id)
                    ->orWhere('email', $user->email)->first();
        if($finduser){

            Auth::login($finduser);

            $finduser->facebook_id = $user->id;
            $finduser->save();

            return redirect(config('expauth.redirect_to'));
        } else {
            //user is not yet created, so create first
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'facebook_id'=> $user->id,
                'email_verified_at'=>now(),
                'password' => encrypt($this->defaultPassword)
            ]);

            Auth::login($newUser);

            // Sincronizando o user com o outro servidor de autenticação
            $this->syncUserDataWithTheUsersServer($newUser, $this->defaultPassword);

            return redirect(config('expauth.redirect_to'));
        }
    }

    public function redirectToGithub(){
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback(){

        $user = Socialite::driver('github')->user();
        
        // if the user exits, use that user and login
        $finduser = User::where('github_id', $user->id)
                    ->orWhere('email', $user->email)->first();
        if($finduser){

            Auth::login($finduser);

            $finduser->github_id = $user->id;
            $finduser->save();

            return redirect(config('expauth.redirect_to'));

        } else {

            //user is not yet created, so create first
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'github_id'=> $user->id,
                'email_verified_at'=>now(),
                'password' => encrypt($this->defaultPassword)
            ]);

            Auth::login($newUser);

            // Sincronizando os dados do user com o outro servidor de autenticação
            $this->syncUserDataWithTheUsersServer($newUser, $this->defaultPassword);

            return redirect(config('expauth.redirect_to'));
        }
    }


}
