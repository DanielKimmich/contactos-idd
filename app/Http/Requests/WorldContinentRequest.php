<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class WorldContinentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        $id = $this->get('id');
        if (empty($id))
            $rules = [
                'name' => 'required|min:2|max:255|unique:world_continents,name',
                'code' => 'required|min:2|max:2|unique:world_continents,code',
            ];
        else
            $rules = [
                'name' => 'required|min:2|max:255|unique:world_continents,name,' .$id,
                'code' => 'required|min:2|max:2|unique:world_continents,code,' .$id,
            ]; 

        return $rules;  
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
