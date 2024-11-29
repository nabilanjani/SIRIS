<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        error_log("Sini");
        if($request->user()->usertype === 'pembimbingakademik')
        {
            return redirect('pembimbingakademik/dashboard');
        }
        elseif($request->user()->usertype === 'kaprodi')
        {
            return redirect('kaprodi/dashboard');
        }
        elseif($request->user()->usertype === 'dekan')
        {
            return redirect('dekan/dashboard');
        }
        elseif($request->user()->usertype === 'bagianakademik')
        {
            return redirect('bagianakademik/dashboard');
        }
        elseif($request->user()->usertype === 'mahasiswa')
        {
            return redirect('mahasiswa/dashboard');
        }

        return redirect()->intended(route('login'));
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
