<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AuthSSOController extends Controller
{
    public function handleCallback(Request $request)
    {
        $code = $request->get('code');
        $tokenUrl = env('KEYCLOAK_BASE_URL') . '/token';

        $response = Http::asForm()->post($tokenUrl, [
            'grant_type' => 'authorization_code',
            'client_id' => env('KEYCLOAK_CLIENT_ID'),
            'client_secret' => env('KEYCLOAK_CLIENT_SECRET'),
            'redirect_uri' => env('KEYCLOAK_REDIRECT_URI'),
            'code' => $code,
        ]);

        $tokenData = $response->json();
        return response()->json($tokenData);
    }
}

