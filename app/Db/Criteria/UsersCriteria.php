<?php

namespace App\Db\Criteria;

use App\Db\Models\User;

/**
 * Class UsersCriteria
 * @package App\Db\Criteria
 */
class UsersCriteria extends AbstractCriteria
{

    /**
     * Метод должен возвращать полное имя класса модели
     * @return string
     */
    protected static function getModelClass(): string
    {
        return User::class;
    }

    /**
     * @param int $id
     * @return UsersCriteria
     */
    public function byId(int $id): self
    {
        $this->where(['id' => $id]);
        return $this;
    }
}
