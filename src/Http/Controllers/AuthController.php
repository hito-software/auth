<?php

namespace Hito\Auth\Http\Controllers;

use Hito\Platform\Http\Controllers\Controller;
use Hito\Platform\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param UserService $userService
     */
    public function __construct(private UserService $userService)
    {
    }

    /**
     * @return View
     */
    public function show(): View
    {
        return view('hito-auth::login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function check(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'boolean'
        ]);

        if (auth()->attempt(request()->only(['email', 'password']))) {
            return redirect()->intended();
        }

        return redirect()->back()->withErrors([
            'email' => 'There is no user with the provided credentials.'
        ]);
    }

    /**
     * @return View
     */
    public function showResetPasswordViaEmail(): View
    {
        return view('hito-auth::reset-password-via-email');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function triggerResetPassword(Request $request): RedirectResponse
    {
        $credentials = $this->validate($request, ['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return redirect()->route('auth.login')
            ->with('success', 'A reset link  was sent to your email address.');
    }

    /**
     * @param string $token
     * @return View|RedirectResponse
     */
    public function showResetPassword(string $token): View|RedirectResponse
    {
        $email = request('email');

        if (empty($email)) {
            return redirect('/');
        }

        $user = $this->userService->getByEmail($email);

        if (!Password::tokenExists($user, $token)) {
            return redirect('/');
        }

        return view('hito-auth::reset-password');
    }

    /**
     * @param Request $request
     * @param string $token
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function resetPassword(Request $request, string $token): RedirectResponse
    {
        $this->validate($request, ['password' => 'required|min:6|confirmed']);

        $credentials = $request->only(['email', 'password']);
        $credentials['token'] = $token;

        Password::reset($credentials, fn ($user, $password) => $this->userService->update($user->id, compact('password')));

        return redirect()->route('auth.login')
            ->with('success', 'Your password was reset successfully!');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
