<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'social_security_number' => $this->social_security_number,
            'citizen_number' => $this->citizen_number,
            'leaves' => LeaveResource::collection($this->leaves),
        ];
    }
}
