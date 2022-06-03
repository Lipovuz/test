<?php

namespace App\Db\Criteria;

use App\Db\Models\Note;

/**
 * Class NotesCriteria
 *
 * @package App\Db\Criteria
 */
class NotesCriteria extends AbstractCriteria
{

    /**
     * Метод должен возвращать полное имя класса модели
     * @return string
     */
    protected static function getModelClass(): string
    {
        return Note::class;
    }

    /**
     * @param int $id
     * @return NotesCriteria
     */
    public function byId(int $id): self
    {
        $this->where(['id' => $id]);
        return $this;
    }
}
