<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class WorldDivisionRequest extends FormRequest
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
        $country_id = $this->get('country_id') > 0 ? $this->get('country_id') : "NULL";
        $rules = [
            'name' => 'required|min:2|max:255|unique:world_divisions,name,' .$id 
                        .',id,country_id,' .$country_id,
            'code' => 'required|min:2|unique:world_divisions,code,' .$id 
                        .',id,country_id,' .$country_id,
            'country_id'  => 'required',
            ]; 
/*
        $id = $this->get('id');
        if (empty($id))
            $rules = [
                'name' => 'required|min:2|max:255',
                'code' => 'required|min:2',
            //    'name'   => 'unique:world_divisions,name',
            //    'code'   => 'unique:world_divisions,code',
            ];
        else
            $rules = [
                'name' => 'required|min:2|max:255',
                'code' => 'required|min:2',
            //    'name'   => 'unique:world_divisions,name,' .$id,
            //    'code'   => 'unique:world_divisions,code,' .$id,
        //   'numero_identificacion' => 'unique:personas,numero_identificacion,' . $validar_update . ',id,tipo_identificacion,' . $this->get('tipo_identificacion'), //validando campo unico compuesto

            ]; 
*/
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
            'name' => trans('world.division.name'),
            'code' => trans('world.division.code'),
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
