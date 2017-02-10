<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $rules = [
                'full_name' =>  'required',
                'email'     =>  'required | email',
                'message'   =>  'required'
    ];

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
        return $this->rules;
    }

    public function messages()
    {
        return [
            'full_name.required'    =>      'Please Enter Your Full Name',
            'email.required'        =>      'Please Enter Your Email Address',
            'message.required'      =>      'Please Enter Your Message',
        ];
    }
}
