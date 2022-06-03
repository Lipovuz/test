<?php

namespace App\Http\Controllers;

use App\Db\Criteria\UsersCriteria;
use App\Db\Models\User;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws NotFound
     */
    public function index()
    {
        $id = Auth::id();
        /* @var User $model */
        if (!($model = (new UsersCriteria())->byId((int)$id)->first())) {
            throw new NotFound('User not found');
        }

        return view('home', ['user' => $model]);
    }
}
