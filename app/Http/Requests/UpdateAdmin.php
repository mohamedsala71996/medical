<?php

namespace App\Http\Requests;

use App\Rules\UpdatedUniqueAttribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdmin extends FormRequest
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
            'name' => 'required|string',
            'email' =>'required|string|email|max:255',
            'password' => 'nullable|string|max:191',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            /*'admin_type' => 'required',*/
            'phone' => 'required',
        ];
    }
}
