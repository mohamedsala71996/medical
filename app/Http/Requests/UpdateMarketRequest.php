<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarketRequest extends FormRequest
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
            'national_number'=>'required|string|max:190',
            'password' =>'nullable|string|max:190|min:2',
            'email'=>'required|email|unique:users,email,'.$this->request->get('id').',id',
            'phone'=>'required|digits_between:2,20|unique:users,phone,'.$this->request->get('id').',id',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif',

        ];
    }
}
