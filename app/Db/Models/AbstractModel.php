<?php

namespace App\Db\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractModel
 * Класс нужен для реализации AbstractCriteria
 */
abstract class AbstractModel extends Model
{
    /**
     * @return array
     */
    public function getWith(): array
    {
        return $this->with;
    }

    /**
     * @return array
     */
    public function getWithCount(): array
    {
        return $this->withCount;
    }
}
