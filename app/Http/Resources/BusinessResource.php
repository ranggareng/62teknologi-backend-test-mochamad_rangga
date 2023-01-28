<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
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
            'name' => $this->name,
            'alias' => $this->alias,
            'image_url' => env('APP_URL').\Storage::url($this->photos->first()->path),
            'is_closed' => $this->is_closed,
            'url' => env('APP_BASE_URL').'/biz/'.$this->alias,
            'review_count' => '0',
            'categories' => MasterCategoryResource::collection($this->categories),
            'rating' => '0',
            'coordinates' => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude
            ],
            'transactions' => MasterTransactionResource::collection($this->transactions),
            'price' => $this->display_price,
            'phone' => $this->phone_action,
            'display_phone' => $this->phone,
            'distance' => 'xxx'
        ];
    }
}
