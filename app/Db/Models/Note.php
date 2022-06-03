<?php

namespace App\Db\Models;

/**
 * Class Note
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $text
 * @property string $created_at
 * @property string $updated_at
 *
 * @package App\Db\Models
 */
class Note extends AbstractModel
{

    /* @var string - Имя таблицы */
    protected $table = 'notes';

    /* @var array - Атрибуты, которые можно присвоить массово */
    protected $fillable = [
        'name', 'text', 'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
