<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email:strict', 'max:255', 'unique:staff'],
            'staff_no' => ['required', 'digits:8', 'unique:staff'],
            'tel' => ['nullable', 'phone:MY'],
            // 'mobile_no' => ['phone:MY,mobile'],
            'mobile_no' => ['nullable', 'digits_between:10,11'],
            //
        ];
    }

    public function messages()
    {
        //if not defined, system will return default message
        return [
            // 'email.email' => 'The email is not valid.',
            // 'staff_no.digits' => 'The staff no. must be 8 digits.',
            'tel.phone' => 'The office phone no. must be a valid phone number.',
            'mobile_no.digits_between' => 'The mobile phone no. must be a valid phone number.',
        ];
    }
}
