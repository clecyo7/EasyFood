<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEvaluationOrder;
use App\Http\Resources\EvaluationResource;
use App\Services\EvaluationService;

class EvaluationApiController extends Controller
{
    private $evaluationService;

    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }


    public function store(StoreEvaluationOrder $request)
    {
        $data = $request->only('stars','comment');
        return new EvaluationResource($this->evaluationService->createNewEvaluation($request->identifyOrder, $data));
    }
}
