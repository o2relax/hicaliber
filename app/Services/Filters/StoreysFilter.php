<?php

namespace App\Services\Filters;

use App\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class StoreysFilter implements Filter
{

    public function getFilterName(): string
    {
        return 'storeys';
    }

    public function apply(Builder $builder, array|bool|int|string $value): Builder
    {
        return $builder->where('storeys', $value);
    }
}
