<?php

namespace Modules\Auth\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\Dashboard\LoginRequest;
use Modules\Auth\Repositories\Dashboard\LoginRepository;

class LoginController extends Controller
{
    private $login_repo;
    public function __construct(LoginRepository $login_repo)
    {
        $this->login_repo = $login_repo;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function showLogin()
    {
        return view('auth::dashboard.login');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function postLogin(LoginRequest $request)
    {
        $errors =  $this->login_repo->login($request);

        if ($errors)
            return redirect()->back()->withErrors($errors)->withInput($request->except('password'));

        return redirect()->route('dashboard.home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        auth('admin')->logout();
        return redirect()->route('dashboard.home');
    }

}
