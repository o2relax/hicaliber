<?php

namespace App\Services\Filters;

use App\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class SearchFilter implements Filter
{

    public function getFilterName(): string
    {
        return 'q';
    }

    public function apply(Builder $builder, array|bool|int|string $value): Builder
    {
        return $builder->where('name', 'like', '%' . $value . '%');
    }
}
