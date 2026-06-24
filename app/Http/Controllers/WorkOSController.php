<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use WorkOS\WorkOS;

use WorkOS\Resource\UserManagementAuthenticationProvider;

class WorkOSController extends Controller
{
    public function redirect()
    {
        $workos = new WorkOS(
            apiKey: config('services.workos.api_key'),
            clientId: config('services.workos.client_id'),
        );

        $url = $workos->userManagement()->getAuthorizationUrl(
            redirectUri: config('services.workos.redirect_url'),
            provider: UserManagementAuthenticationProvider::Authkit,
        );

        return redirect()->away($url);
    }

    public function callback(Request $request)
    {
        $code = $request->code;

        if (!$code) {
            return redirect('/login')
                ->with('error', 'Authorization code tidak ditemukan');
        }

        try {
            $workos = new WorkOS(
                apiKey: config('services.workos.api_key'),
                clientId: config('services.workos.client_id'),
            );

            $auth = $workos->userManagement()->authenticateWithCode(
                code: $code,
            );

            $email = $auth->user->email;

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name'     => $auth->user->firstName ?? 'WorkOS User',
                    'password' => bcrypt(str()->random(20)),
                ]
            );

            Auth::login($user);

            return redirect('/todo');

        } catch (\Exception $e) {

            return redirect('/login')
                ->with('error', $e->getMessage());
        }
    }
}