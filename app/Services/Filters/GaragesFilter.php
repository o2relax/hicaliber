<?php

namespace App\Services\Filters;

use App\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class GaragesFilter implements Filter
{

    public function getFilterName(): string
    {
        return 'garages';
    }

    public function apply(Builder $builder, array|bool|int|string $value): Builder
    {
        return $builder->where('garages', $value);
    }
}
