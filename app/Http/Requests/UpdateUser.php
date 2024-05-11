<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'name'=>'nullable|string|max:190',
            'password' =>'nullable|string|max:190|min:2',
            'phone' => 'required|numeric|digits_between:1,20',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'email' => 'required|email|string|max:190',
            'phone_code' => 'required',
        ];
    }
}
