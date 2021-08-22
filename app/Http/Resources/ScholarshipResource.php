<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScholarshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'company_id' => $this->company_id,
            'start_date' => $this->start_date,
            'monthly_slp_target' => $this->monthly_slp_target,
            'scholar_split' => $this->scholar_split,
            'encoded_id' => $this->encoded_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
