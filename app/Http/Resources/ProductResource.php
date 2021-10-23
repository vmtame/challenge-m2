<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      // return parent::toArray($request);
      return [
        'id' => $this->id,
        'product' => $this->product,
        'price' => $this->price,
        'discount' => $this->whenPivotLoaded('campaign_product', function(){
          return $this->pivot->discount;
        })
      ];
    }
}
