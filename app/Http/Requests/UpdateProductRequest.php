<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'ar_title' =>'required|string|max:191',
            'en_title' =>'required|string|max:191',
            'ar_desc' =>'required|string|max:191',
            'en_desc' =>'required|string|max:191',
            'price' =>'required|numeric|min:0',
            'model_title' =>'nullable|string|min:1|max:191',
            'main_image' =>'nullable|image|mimes:jpeg,jpg,png,gif',
            'market_id' =>'required|integer',
            'cat_id' =>'required|integer',
            'brand_id' =>'required|integer',
            //more images
            'more_images' =>'nullable',
        ];
    }

    public function messages()
    {
        return[
            'ar_title.required' => 'اسم المنتج بالعربية مطلوب.',
            'en_title.required' => 'اسم المنتج بالانجليزية مطلوب.',
            'ar_desc.required' => 'تفاصيل المنتج بالعربية مطلوب.',
            'en_desc.required' => 'تفاصيل المنتج بالانجليزية مطلوب.',
            'model_title.required' => 'اسم الموديل مطلوب.',
            'price.required'   => 'السعر مطلوب',
            'main_image.image'     => 'أيقونة المنتج يجب أن تكون صورة صالحة.',
            'main_image.mimes'     => 'أيقونة التصنيف يجب أن تكون ملف بأحد الإمتدادات الآتية jpeg,png,jpg,gif,svg',
            'main_image.max'       => 'أقصى مساحة لأيقونة التصنيف مسموح بها هي 2048 كيلوبايت.',
            'market_id.required'  => 'اختر متجر من فضلك',
            'category_id.required'  => 'اختر التصنيف من فضلك',
            'brand_id.required'  => 'اختر الماركة من فضلك',
        ];
    }
}
