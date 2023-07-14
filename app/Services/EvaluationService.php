<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;


class EvaluationService
{
    private $evaluationRepository, $orderRepository;

    public function __construct(
        EvaluationRepositoryInterface $evaluation,
        OrderRepositoryInterface $order
        )
    {
        $this->evaluationRepository = $evaluation;
        $this->orderRepository = $order;
    }

  
    public function createNewEvaluation(string $identifyOrder, array $evaluation)
    {
      //  dd($identifyOrder, $evaluation);
        $clientId = $this->getIdClient();
        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

    //    dd($order->identify);
        return $this->evaluationRepository->createNewEvaluation($order->id, $clientId, $evaluation);
    }

    private function getIdClient()
    { 
        return auth()->user()->id;
    }


    public function getEvaluationByOrder(int $idOrder)
    {
        return $this->evaluationRepository->getEvaluationByOrder($idOrder);
    }


    public function getEvaluationByClient(int $idClient)
    {
        return $this->evaluationRepository->getEvaluationByClient($idClient);
    }

    public function getEvaluationById(int $id)
    {
        return $this->evaluationRepository->getEvaluationById($id);
    }

}
