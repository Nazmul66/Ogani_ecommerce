<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('frontend.pages.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if( Auth::user()->role == 1 ){
            
            $notifications = [
                "message"    => "Login successfully",
                'alert-type' => "success"
            ];

            return redirect()->intended(RouteServiceProvider::HOME)->with($notifications);
        }
        else if( Auth::user()->role == 2 ){
                        
            $notifications = [
                "message"    => "Login successfully",
                'alert-type' => "success"
            ];

            return redirect()->intended(RouteServiceProvider::CUSTOMER_HOME)->with($notifications);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
