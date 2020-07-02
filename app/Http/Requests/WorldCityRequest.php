<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class WorldCityRequest extends FormRequest
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
    // Validando un indice campo compuesto con 2 columnas
        $id = $this->get('id') > 0 ? $this->get('id') : "NULL";
        $division_id = $this->get('division_id') > 0 ? $this->get('division_id') : "NULL";
        $rules = [
            'name'  => 'required|min:2|max:255|unique:world_cities,name,' .$id 
                        .',id,division_id,' .$division_id,
            'code'  => 'required|min:2',
            'country_id'    => 'required',
            'division_id'   => 'required',
            ]; 

/*        return [
            'name' => 'required|min:2|max:255',
            'code' => 'required|min:2',
        ];  */
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
            'name' => trans('world.city.name'),
            'code' => trans('world.city.code'),
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
