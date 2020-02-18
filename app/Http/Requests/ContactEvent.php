<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactEvent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

public function toArray($request)
    {
        return [
            'id' => $this->id,
            'event_date' => $this->data1,
            'event_type' => $this->data2,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
