<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Products extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'category_id'=>$this->category_id,
            'Purchasing_price'=>$this->Purchasing_price,
            'Wholesale_price'=>$this->Wholesale_price,
            'retail_price'=>$this->retail_price,
            'quantity'=>$this->quantity,
            'supply_date'=>$this->supply_date,
            'Expiry_date'=>$this->Expiry_date,
            'description'=>$this->description,
        ];
    }
}
