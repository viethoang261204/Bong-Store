<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'full_name'=> 'required',
            'email' => 'required|unique:customer|max:255',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Name is required',
            'full_name.regex' => 'Name is not correct format',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'phone.required' => 'Phone is required',
            'phone.regex' => 'Phone is not correct format',
            'address.required' => 'Address is required',
        ];
    }
}
