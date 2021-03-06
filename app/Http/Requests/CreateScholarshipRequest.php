<?php

namespace App\Http\Requests;

use App\Models\Scholarship\Scholarship;
use App\Models\Scholarship\ScholarshipInterface;
use Illuminate\Foundation\Http\FormRequest;

class CreateScholarshipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', app()->make(ScholarshipInterface::class));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label' => 'required|string',
            'start_date' => 'nullable|date'
        ];
    }
}
