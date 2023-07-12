<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientService
{
    protected $clientRepository;


    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getAllClients(int $per_page)
    {
        return $this->clientRepository->getAllClients($per_page);
    }

    public function createNewClient(array $data)
    {
        return $this->clientRepository->createNewClient($data);
    }

    public function getClient(int $idClient)
    {
        return $this->clientRepository->getClient($idClient);
    }


}
