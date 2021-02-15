<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Distance;
use App\Services\DistanceSumService;
use App\Services\DistanceSumServiceInterface;
use App\Services\DistanceTransformService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class DistanceController extends Controller
{
    private DistanceSumServiceInterface $sumService;

    public function __construct(DistanceSumServiceInterface $sumService)
    {
        $this->sumService = $sumService;
    }

    public function sum(Request $request): JsonResponse
    {
        $object = json_decode($request->input('data'), false, 512, JSON_THROW_ON_ERROR);

        $distances = array_map(function ($distanceJsonString) {
            return Distance::createFromJsonObject($distanceJsonString);
        }, $object->distances);

        $resultDistance = $this->sumService->sum($distances, $object->resultUnit);

        return response()->json($resultDistance, 200);
    }
}
