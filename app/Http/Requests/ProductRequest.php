<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    protected $rules = [
        'product_name'          =>  'required',
        'product_desc'          =>  'required',

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
           'product_name.required'  =>  "The product Name is required",
           'product_desc.required'  =>  "The product description is required",

       ];
    }
}
