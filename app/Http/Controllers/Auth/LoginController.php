<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        if (!Auth::guard('admin')->check()) {
            session()->invalidate();
            session()->regenerateToken();
        }

        return $this->loggedOut($request) ?: redirect($this->redirectTo);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->active === 0) {
            return redirect(route('logout'));
        }

        $user->update([
            'last_login' => now()
        ]);
    }
}
