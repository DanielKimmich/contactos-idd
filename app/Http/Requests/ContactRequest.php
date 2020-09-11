<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

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
    //Validando con un campo unico
        $id = $this->get('id') > 0 ? $this->get('id') : "NULL";

        $rules = [
            'display_name'  => 'required|min:2|max:255|unique:contacts,display_name,' .$id,
            'status'        => 'required',
            'sex_id'        => 'required',
            'relation_phone'      => function ($attribute, $value, $fail) {
         //   'relation_phone'      => function ($this->attributes_phone(), $value, $fail) {
                $fieldGroups = json_decode($value);
//dump($attribute, $value);
                // do not allow repeatable field to be empty
                //if (count($fieldGroups) == 0) {
                //    return $fail('The simple field group must have at least one item.');
                //}

                // ALTERNATIVE:
                // allow repeatable field to be empty
                if (count($fieldGroups) == 0) {
                   return true;
                }

                // SECOND-LEVEL REPEATABLE VALIDATION
                // run through each field group inside the repeatable field
                // and run a custom validation for it
                foreach ($fieldGroups as $key => $group) {
                    $fieldGroupValidator = Validator::make((array) $group, [
                        'data1'  => 'required',
                        'data2'  => 'required',
                    ]);

                    if ($fieldGroupValidator->fails()) {
                        // return $fail('One of the entries in the '.$attribute.' group is invalid.');
                        // alternatively, you could just output the first error
                        return $fail($fieldGroupValidator->errors()->first());
                        // or you could use this to debug the errors
                            // dd($fieldGroupValidator->errors());
                    }
                }
            },
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
            'display_name' => trans('contact.person.display_name'),
            'status'       => trans('contact.person.status'),
            'sex_id'       => trans('contact.person.sex'),
          /*  'relation_phone'  => [
                'data1'       => trans('contact.phone.number'),
                'data2'       => trans('contact.phone.type'),
            ],   */
           // 'relation_phone'  => 'faltan datos',
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
