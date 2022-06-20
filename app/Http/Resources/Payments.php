<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Payments extends JsonResource
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
            'user_id'=>$this->user_id,
            'receipt_debts_id'=>$this->receipt_debts_id,
            'receipt_invoices_id'=>$this->receipt_invoices_id,
            'sale_debts_id'=>$this->sale_debts_id,
            'sale_invoices_id'=>$this->sale_invoices_id,
            'payment_value'=>$this->payment_value,
            'description'=>$this->description,
        ];
    }
}
