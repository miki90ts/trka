<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'photo' => $this->photo,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
            'club' => $this->club,
            'shirt_size_id' => $this->shirt_size_id,
            'emergency_phone' => $this->emergency_phone,
            // 'purchased_at' => Carbon::parse($this->purchased_at)->toDateString(),
            // 'expired_at' => Carbon::parse($this->purchased_at)->addMonths($this->warrantyLength->months)->toDateString(),
            // 'expired_at_for_humans' => Carbon::parse($this->purchased_at)->addMonths($this->warrantyLength->months)->diffForHumans(null, ['syntax' => Carbon::DIFF_ABSOLUTE]),
            // 'color' => $this->getColorBasedOnExpiration(),
            // 'percent' => $this->getProcentBasedOnExpiration(),
            // 'photo' => asset('storage/bills/'.$this->photo),
            // 'price' => $this->price,
            // 'store' => StoreResource::make($this->whenLoaded('store')),
            // 'product' => ProductResource::make($this->whenLoaded('product')),
        ];
    }
}
