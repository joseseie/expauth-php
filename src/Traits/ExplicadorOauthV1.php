<?php
/**
 * Created by PhpStorm.
 * User: joseseie
 * Date: 3/12/21
 * Time: 1:47 AM
 */

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Http;

trait ExplicadorOauthV1
{

    public function handleRedirectForAuth() {

        // TODO: Compor uma URL
        $serverUrl = env('EXPLICADOR_SERVER_ENDPOINT', '');
        $authServerEndpoint = $serverUrl . '/oauth/v1?';

        $appName = 'app_name=' . env('APP_NAME', 'eVCourses');
        $appImage = '&image_url=https://online.explicador.co.mz/assets/img/logo-ev.png';

        // TODO: 1. Com Client_id no path;
        $client_id = '&client_id=' . env('EXPLICADOR_CLIENT_ID', null);

        // TODO: 2. Com client_secret no path;
        $client_secret = '&client_secret=' . env('EXPLICADOR_CLIENT_SECRET', null);

        // TODO: 3. Com callback_url (apenas domínio sem http)
        $client_redirect = '&client_redirect=' .  env('EXPLICADOR_CLIENT_REDIRECT', null);

        $url = $authServerEndpoint . $appName . $appImage . $client_id . $client_secret . $client_redirect;

        echo '<a id="linkA" href="'.$url.'"></a>';
        echo '<script type="text/javascript">',
        'document.getElementById("linkA").click()',
        '</script>';

        return true;

    }

    public function getUserFromToken ($bearerToken) {

        $serverUrl = env('EXPLICADOR_SERVER_ENDPOINT', '');
        $endPoint = $serverUrl . '/api/user';

        $response = Http::withHeaders([
            'Authorization' => $bearerToken,
            'Content-Type'  => 'application/x-www-form-urlencoded',
            'X-Requested-With'  => 'XMLHttpRequest',
        ])->get($endPoint);

        if ($response->failed()) {
            return false;
        }
        if ($response->successful()) {
            return $response->json();
        }

    }

    public function syncUserDataWithTheUsersServer ($userSigningUp, $dPassword) {

        // Buscando as credenciais do servidor
        $serverEndpoint = env('SYNC_USERS_SERVER_ENDPOINT', '');
        $serverToken = env('SYNC_USERS_SERVER_TOKEN', '');

        // A sincronização é feita somente se existirem as credenciais do servidor
        if ($serverEndpoint && $serverToken) {

            $response = Http::withHeaders([
                'Authorization'     => $serverToken,
                'Content-Type'      => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ])->post($serverEndpoint, [
                'name'  => $userSigningUp->name,
                'email' => $userSigningUp->email,
                'username' => explode("@", $userSigningUp->email)[0],
                'password' => encrypt($dPassword),
                'fromAppName' => env('APP_NAME', ''),
            ]);

            if ($response->failed()) {

                dd('$serverEndpoint, Erro de sincronização', $serverEndpoint, $response->body());
                return false;
            }
            if ($response->successful()) {

                $user = User::where('email', $userSigningUp->email)->first();
                $user->syned_at = now();
                $user->save();

                return $response->json();
            }

        } else {

            dd('Infelzimente não entrou por causa de chaves...', $serverEndpoint, $serverToken);

        }

        return false;

    }

}