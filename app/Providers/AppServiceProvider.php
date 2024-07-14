<?php

namespace App\Providers;

use App\Contracts\Filter;
use App\Services\EntityFilterProcessor;
use App\Services\Filters\BathroomsFilter;
use App\Services\Filters\BedroomsFilter;
use App\Services\Filters\GaragesFilter;
use App\Services\Filters\PriceFromFilter;
use App\Services\Filters\PriceToFilter;
use App\Services\Filters\SearchFilter;
use App\Services\Filters\StoreysFilter;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(EntityFilterProcessor::class)
            ->needs(Filter::class)
            ->give([
                BathroomsFilter::class,
                BedroomsFilter::class,
                GaragesFilter::class,
                PriceFromFilter::class,
                PriceToFilter::class,
                SearchFilter::class,
                StoreysFilter::class,
            ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
