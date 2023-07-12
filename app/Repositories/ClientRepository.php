<?php

namespace App\Repositories;

use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{
    protected $entity;
    protected $table;

    public function __construct(Client $client)
    {
        $this->entity = $client;
        //   $this->table = 'products';
    }

    public function createNewClient(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->entity->create($data);
    }

    public function getAllClients(int $per_page)
    {
        return $this->entity->paginate($per_page);
    }


    public function getClient(int $idClient)
    {
        return $this->entity->find($idClient);
    }
}
