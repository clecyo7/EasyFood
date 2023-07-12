<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClient;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;

class RegisterController extends Controller
{
    protected $clientService;


    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }


    public function index(Request $request)
    {
       $per_page = (int) $request->get('per_page', 15);

       $clients = $this->clientService->getAllClients($per_page);

       return ClientResource::collection($clients);
    }

    public function store(StoreClient $request)
    {
        $client = $this->clientService->createNewClient($request->all());

        return new ClientResource($client);
    }

    public function show($id)
    {
        if(!$client = $this->clientService->getClient($id)) {
            return response()->json(['message' => 'Client Not Found'], 404);
        }

        return new ClientResource($client);
    }
}
