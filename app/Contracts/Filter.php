<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{

    public function getFilterName(): string;
    public function apply(Builder $builder, int|string|array|bool $value): Builder;
}
