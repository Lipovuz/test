<?php

namespace App\Http\Controllers\Auth;

use App\Db\Managers\UsersManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /* @var UsersManager */
    protected UsersManager $manager;

    /**
     * Create a new controller instance.
     *
     * @param UsersManager $usersManager
     */
    public function __construct(UsersManager $usersManager)
    {
        $this->manager = $usersManager;

        $this->middleware('guest');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * @param RegisterForm $form
     * @return RedirectResponse
     */
    protected function register(RegisterForm $form): RedirectResponse
    {
        $this->manager->createProfile($form);

        $this->login($form);

        return redirect()->route('home');
    }
}
