<?php

namespace App\Services;

use App\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class AbstractFilterProcessor
{
    protected array $filters;

    public function __construct(Filter ...$filters)
    {
        $this->filters = $filters;
    }

    public function apply(Builder $builder, Request $request): Builder
    {
        foreach ($this->filters as $filter) {
            if(empty($request->input($filter->getFilterName()))) {
                continue;
            }

            $builder = $filter->apply($builder, $request->get($filter->getFilterName()));
        }

        return $builder;
    }
}
