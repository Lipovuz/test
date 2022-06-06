<?php

namespace App\Http\Controllers\Note;

use App\Db\Criteria\NotesCriteria;
use App\Db\Managers\NotesManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteForm;
use Facade\FlareClient\Http\Exceptions\NotFound;

/**
 * Class NoteController
 * @package App\Http\Controllers\Note
 */
class NoteController extends Controller
{

    /* @var NotesManager */
    protected NotesManager $manager;

    /**
     * NotesManager constructor.
     * @param NotesManager $manager
     */
    public function __construct(NotesManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Создание нотатки - форма
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createShow()
    {
        return view('notes.create', ['note' => null]);
    }

    /**
     * Создание нотатки - обработка
     * @param NoteForm $request
     * @return mixed
     */
    public function create(NoteForm $request)
    {
        $this->manager->create($request);

        return redirect()->route('home');
    }

    /**
     * Редагування нотатки - форма
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws NotFound
     */
    public function updateShow(int $id)
    {
        if (!($model = (new NotesCriteria())->byId((int)$id)->first())) {
            throw new NotFound('Нотатку не знайдено');
        }

        return view('notes.update', ['note' => $model]);
    }

    /**
     * Редагування нотатки - обработка
     *
     * @param int $id
     * @param NoteForm $request
     * @return mixed
     * @throws NotFound
     */
    public function update(int $id, NoteForm $request)
    {
        if (!($model = (new NotesCriteria())->byId((int)$id)->first())) {
            throw new NotFound('Нотатку не знайдено');
        }

        $this->manager->update($model, $request);

        return redirect()->route('home');
    }

    /**
     * Удаление нотатки
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function remove($id)
    {
        if (!($model = (new NotesCriteria())->byId((int)$id)->first())) {
            throw new NotFound('Нотатку не знайдено');
        }
        $model->delete();

        return redirect()->route('home');
    }
}
