<?php

namespace App\Services\Filters;

use App\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class PriceFromFilter implements Filter
{

    public function getFilterName(): string
    {
        return 'price_from';
    }

    public function apply(Builder $builder, array|bool|int|string $value): Builder
    {
        return $builder->where('price', '>=', $value);
    }
}
