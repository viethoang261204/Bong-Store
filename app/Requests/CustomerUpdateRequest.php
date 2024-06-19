<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name' => 'required',
            'email' =>
                'required|max:255|unique:customer,email,' . preg_replace('/[^0-9]/', '', request()->path()),
            // lay id tren thanh url de bo qua unique cho email cua guest dang edit
//            'password' => 'required|min:6',
            'phone' => 'required|max:20',
        ];
    }
}
