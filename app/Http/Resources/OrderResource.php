<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'identify' => $this->identify,
             'total' => $this->total,
             'status' => $this->status,
             'comment' => $this->comment,
          //   'status_label' => $this->statusOptions[$this->status],
             'date' => Carbon::make($this->created_at)->format('Y-m-d'),
             'date_br' => Carbon::make($this->created_at)->format('d/m/Y'),
             'company' => new TenantResource($this->tenant),
             'client' => $this->client_id ? new ClientResource($this->client) : '',
             'table' => $this->table_id ? new TableResource($this->table) : '',
             'products' => ProductResource::collection($this->products),
         //   'evaluations' => EvaluationResource::collection($this->evaluations),
        ];
    }
}
