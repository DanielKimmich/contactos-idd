<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
           'display_name'  => 'required|min:2|max:255|unique:contacts,display_name',
            'status'        => 'required',
            'sex_id'        => 'required',
            ];
        else
            $rules = [
                'display_name'  => 'required|min:2|max:255|unique:contacts,display_name,' .$id,
                'status'        => 'required',
                'sex_id'        => 'required',
            ]; 

        return $rules;  
        //    'names[name_first]'  => 'required|min:2|max:255',
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
           'display_name'  => trans('contact.person.display_name'),
            'status'       => trans('contact.person.status'),
            'sex_id'       => trans('contact.person.sex'),
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
