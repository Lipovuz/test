<?php

namespace App\Db\Managers;

use App\Db\Models\Note;
use App\Http\Requests\NoteForm;
use Illuminate\Support\Facades\Auth;

/**
 * Class NotesManager
 *
 * @package App\Db\Managers
 */
class NotesManager
{

    /**
     * @var Note|null
     */
    protected ?Note $lastModel;

    /**
     * Створення нотатки
     *
     * @param NoteForm $noteForm
     * @return bool
     */
    public function create(NoteForm $noteForm): bool
    {
        $model = new Note();

        $model->user_id = Auth::id();

        return $this->update($model, $noteForm);
    }

    /**
     * Редагування нотатки
     *
     * @param $model
     * @param NoteForm $noteForm
     * @return bool
     */
    public function update(Note $model, NoteForm $noteForm): bool
    {
        if ($model->user_id != Auth::id()) {
            abort(403, 'Нема доступу до данного елемента');
        }
        $data = $noteForm->validated();
        $this->lastModel = $model;
        $this->lastModel->fill($data);
        return $this->lastModel->save();
    }

    /**
     * Удаление нотатки
     *
     * @param Note $model
     * @return bool|null
     */
    public function delete(Note $model): ?bool
    {
        if ($model->user_id != Auth::id()) {
            abort(403, 'Нема доступу до данного елемента');
        }

        return $model->delete();
    }
}
