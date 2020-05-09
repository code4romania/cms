<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Builder;

class BaseModel extends Model
{
    public function scopeOrderByIds(Builder $query, array $ids): Builder
    {
        return $query->orderByRaw('FIELD(id,' . implode(',', $ids) . ')');
    }
}
