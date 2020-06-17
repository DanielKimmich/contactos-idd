<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class WorldCountryRequest extends FormRequest
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
                'name'          => 'required|min:2|max:255|unique:world_countries,name',
                'code'          => 'required|min:2|max:2|unique:world_countries,code',
                'code_alpha3'   => 'required|min:3|max:3|unique:world_countries,code_alpha3',
            ];
        else
            $rules = [
                'name'          => 'required|min:2|max:255|unique:world_countries,name,' .$id,
                'code'          => 'required|min:2|max:2|unique:world_countries,code,' .$id,
                'code_alpha3'   => 'required|min:3|max:3|unique:world_countries,code_alpha3,' .$id,
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
            'name'          => trans('world.country.name'),
            'code'          => trans('world.country.code'),
            'code_alpha3'   => trans('world.country.code_alpha3'),
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
