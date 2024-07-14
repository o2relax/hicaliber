<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetEntitiesRequest;
use App\Http\Resources\EntityResource;
use App\Models\Entity;
use App\Services\EntityFilterProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function index(GetEntitiesRequest $request, EntityFilterProcessor $entityFilterProcessor)
    {
        return EntityResource::collection(
                $entityFilterProcessor->apply(Entity::query(), $request)
                    ->paginate($request->input('perPage', 10))
            );
    }
}
