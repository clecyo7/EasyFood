<?php

namespace App\Repositories\Contracts;

interface ClientRepositoryInterface
{
    public function createNewClient(array $data);
    public function getAllClients(int $per_page);
    public function getClient(int $id);
}
