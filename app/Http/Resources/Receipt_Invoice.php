<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Receipt_Invoice extends JsonResource
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
            'date'=>$this->date,
            'supplier_id'=>$this->supplier_id,
            'receiptDebt_id'=>$this->receiptDebt_id,
            'total_price'=>$this->total_price,
            'amount_paid'=>$this->amount_paid,
            'remainder_debt'=>$this->remainder_debt
        ];
    }
}
