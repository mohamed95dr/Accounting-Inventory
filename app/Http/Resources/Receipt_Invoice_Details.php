<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Receipt_Invoice_Details extends JsonResource
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
            'receipt_invoices_id'=>$this->receipt_invoices_id,
            'product_id'=>$this->product_id,
            'quantity'=>$this->quantity,
            'unit_price'=>$this->unit_price,
            'unit'=>$this->unit,
            'total_price'=>$this->total_price,
        ];
    }
}
