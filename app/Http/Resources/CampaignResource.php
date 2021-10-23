<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
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
          'id' => $this->id,
          'campaign' => $this->campaign,
          'group' => new CityGroupResource($this->whenLoaded('group')),
          'products' => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
