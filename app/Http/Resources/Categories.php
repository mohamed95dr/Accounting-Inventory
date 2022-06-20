<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Categories extends JsonResource
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
            'company_id'=>$this->company_id,
            'supplier_id'=>$this->supplier_id,
            'description'=>$this->description
        ];

    }
}
