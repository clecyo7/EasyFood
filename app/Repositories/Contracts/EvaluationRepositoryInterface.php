<?php

namespace App\Repositories\Contracts;

interface EvaluationRepositoryInterface
{
    public function createNewEvaluation(int $idOrder, int $idClient, array $evaluation);
    public function getEvaluationByOrder(int $idOrder);
    public function getEvaluationByClient(int $idClient);
    public function getEvaluationById(int $id);
    public function getEvaluationByClientByOrder(int $idClient, int $idOrder);
}
