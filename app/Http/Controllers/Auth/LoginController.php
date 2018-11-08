<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser = new User;
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->avatar = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();

            auth()->login($newUser, true);
        }

        return redirect()->to('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->to('/');
    }
}
