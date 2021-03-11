<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstitutionRequest extends FormRequest
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
            //
            'name'=>  'bail|required',
            'number'=>'bail|required|numeric|min:0|not_in:0',
            'address'=>'bail|required',
            'legal_entity'=>'bail|required',
            'date_type' => 'bail|required',
            'angel_interests' => 'bail|required',
            'nature'=>'bail|required',
            'business_activity'=>'bail|required',
            'charity_num'=>'bail|required|numeric|min:0|not_in:0',
            'extra_tax_num'=>'bail|required|numeric|min:0|not_in:0',
            ]
        ;
    }
    public function messages()
    {
        return [
            'name.required' => 'هذا الحقل مطلوب',

            'number.numeric'=>'برجاء ادخل رقم شركة صحيح',
            'number.min'=>'برجاء ادخل رقم شركة صحيح',
            'number.required'=>'برجاء ادخل رقم شركة صحيح',
            'number.not_in'=>'برجاء ادخل رقم شركة صحيح',


            'address.required' => 'هذا الحقل مطلوب',
            'legal_entity.required' => 'هذا الحقل مطلوب',
            'date_type.required' => 'هذا الحقل مطلوب',
            'angel_interests.required' => 'هذا الحقل مطلوب',
            'nature.required' => 'هذا الحقل مطلوب',
            'extra_tax_num.required' => 'هذا الحقل مطلوب',
            'charity_num.required' => 'هذا الحقل مطلوب',
            'business_activity.required' => 'هذا الحقل مطلوب',

            'charity_num.numeric'=>'برجاء ادخل الرقم المميز لدى هيئة الزكاة صحيح',
            'charity_num.min'=>'برجاء ادخل الرقم المميز لدى هيئة الزكاة صحيح',
            'charity_num.required'=>'برجاء ادخل الرقم المميز لدى هيئة الزكاة صحيح',
            'charity_num.not_in'=>'برجاء ادخل الرقم المميز لدى هيئة الزكاة صحيح',

            'extra_tax_num.numeric'=>'برجاء ادخل رقم ضريبة مضافة صحيح',
            'extra_tax_num.min'=>'برجاء ادخل رقم ضريبة مضافة صحيح',
            'extra_tax_num.required'=>'برجاء ادخل رقم ضريبة مضافة صحيح',
            'extra_tax_num.not_in'=>'برجاء ادخل رقم ضريبة مضافة صحيح',
        ];
    }
}
