<?php

namespace App\Http\Controllers\User;

use App\Db\Criteria\UsersCriteria;
use App\Db\Managers\UsersManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileForm;
use App\Db\Models\User;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws NotFound
     */
    public function view()
    {
        $id = Auth::id();
        /* @var User $model */
        if (!($model = (new UsersCriteria())->byId((int)$id)->first())) {
            throw new NotFound('User not found');
        }
        return view(
            'profile.view',
            [
                'user' => $model,
            ]
        );
    }

    /**
     * Редагування користувача - форма
     * @param ProfileForm $request
     * @param UsersManager $manager
     * @return mixed
     * @throws NotFound
     */
    public function update(ProfileForm $request, UsersManager $manager)
    {
        $id = Auth::id();

        /* @var User $model */
        if (!($model = (new UsersCriteria())->byId((int)$id)->first())) {
            throw new NotFound('Користувача не знайдено');
        }

        $manager->updateProfile($model, $request);

        return redirect()->route('home', app()->getLocale());
    }

    /**
     * Редагування користувача - форма
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws NotFound
     */
    public function updateShow()
    {
        $id = Auth::id();

        /* @var User $model */
        if (!($model = (new UsersCriteria())->byId((int)$id)->first())) {
            throw new NotFound('Користувача не знайдено');
        }

        return view(
            'profile.form',
            ['user' => $model]
        );
    }
}
