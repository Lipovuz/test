<?php

namespace App\Db\Managers;

use App\Http\Requests\ProfileForm;
use App\Db\Models\User;
use App\Http\Requests\RegisterForm;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Storage;

/**
 * Class UsersManager
 *
 * @package App\Db\Managers
 */
class UsersManager
{

    /**
     * @var User|null
     */
    protected ?User $lastModel;
    /**
     * @var Dispatcher
     */
    protected Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Редактирование пользователя
     *
     * @param RegisterForm $request
     * @return bool
     */
    public function createProfile(RegisterForm $request): bool
    {
        $this->lastModel = new User();
        $data = $request->validated();

        if (isset($data['password']) && $data['password']) {
            $this->lastModel->setPassword($data['password']);
        }

        $this->lastModel->fill($data);

        $this->dispatcher->dispatch(new Registered($this->lastModel));

        return $this->lastModel->save();
    }

    /**
     * Редактирование пользователя
     *
     * @param User $model
     * @param ProfileForm $request
     * @return bool
     */
    public function updateProfile(User $model, ProfileForm $request): bool
    {
        $data = $request->validated();
        $this->lastModel = $model;

        if (isset($data['password']) && $data['password']) {
            $this->lastModel->setPassword($data['password']);
        }

        if ($request->hasFile('local_path')) {
            // загружаем файл получаем название
            $model->image = Storage::url(
                    $request->file('local_path')
                        ->store('file', 'public'));
        }

        $this->lastModel->fill($data);

        return $this->lastModel->save();
    }
}
