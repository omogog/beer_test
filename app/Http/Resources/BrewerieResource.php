<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrewerieResource extends JsonResource
{
    private const ADRESS_STRING_FORMAT = "%s - %s, %s %s - %s (%s)";
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'address' => sprintf(
                self::ADRESS_STRING_FORMAT,
                $this->country,
                $this->state,
                $this->postal_code,
                $this->city,
                $this->street,
                $this->name
            )
        ];
    }
}
