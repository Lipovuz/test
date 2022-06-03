<?php

namespace App\Db\Criteria;

use App\Db\Models\AbstractModel;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AbstractCriteria
 * Билдер запроса для конкретной модели (Набор скойпов)
 * Реализация для Laravel шаблона критериев БД
 */
abstract class AbstractCriteria  extends Builder
{
    /**
     * AbstractCriteria constructor.
     */
    public function __construct()
    {
        $modelName = static::getModelClass();

        // повторяем логику создание билдера из модели Model::query()
        // для совместимости со всеми стандартными возможностями

        /* @var AbstractModel $model */
        $model = new $modelName();
        $baseQuery = $model->getConnection()->query();

        parent::__construct($baseQuery);
        $this->setModel($model);
        $this->with($model->getWith());
        $this->withCount($model->getWithCount());

        $model->registerGlobalScopes($this);
    }

    /**
     * Метод должен возвращать полное имя класса модели
     * @return string
     */
    protected abstract static function getModelClass(): string;
}
