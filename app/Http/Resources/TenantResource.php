<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      //  return parent::toArray($request);

        return [
            "name" => $this->name,
            "uuid" => $this->uuid,
            "cnpj" => $this->cnpj,
            "flag"  => $this->url,
            "contact" => $this->email,
            "logo"  => $this->logo ? url("storage/{$this->logo}") : '',
            "active" => $this->active,
            "subscription" => Carbon::parse($this->subscription)->format('d/m/Y'),
            "expires_at" => Carbon::parse($this->expires_at)->format('d/m/Y'),
            "subscription_id" => $this->subscription_id,
            "subscription_active" => $this->subscription_active,
            "subscription_suspended" => $this->subscription_suspended,
            "created_created" => Carbon::parse($this->created_at)->format('d/m/Y'),
            "updated_at" => Carbon::parse($this->updated_at)->format('d/m/Y'),
        ];
    }
}
