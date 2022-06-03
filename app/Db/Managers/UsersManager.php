<?php

namespace App\Db\Managers;

use App\Http\Requests\ProfileForm;
use App\Db\Models\User;
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
