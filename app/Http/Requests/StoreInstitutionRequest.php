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
            'name'=>  'bail',
            'number'=>'bail|numeric|min:0|not_in:0',
            'address'=>'bail',
            'legal_entity'=>'bail',
            'date_type' => 'bail',
            'angel_interests' => 'bail',
            'nature'=>'bail',
            'business_activity'=>'bail',
            'charity_num'=>'bail|numeric|min:0|not_in:0',
            'extra_tax_num'=>'bail|numeric|min:0|not_in:0',
            ]
        ;
    }
    public function messages()
    {
        return [
            'name' => 'هذا الحقل مطلوب',

            'number.numeric'=>'برجاء ادخل رقم شركة صحيح',
            'number.min'=>'برجاء ادخل رقم شركة صحيح',
            'number'=>'برجاء ادخل رقم شركة صحيح',
            'number.not_in'=>'برجاء ادخل رقم شركة صحيح',


            'address' => 'هذا الحقل مطلوب',
            'legal_entity' => 'هذا الحقل مطلوب',
            'date_type' => 'هذا الحقل مطلوب',
            'angel_interests' => 'هذا الحقل مطلوب',
            'nature' => 'هذا الحقل مطلوب',
            'extra_tax_num' => 'هذا الحقل مطلوب',
            'charity_num' => 'هذا الحقل مطلوب',
            'business_activity' => 'هذا الحقل مطلوب',

            'charity_num.numeric'=>'برجاء ادخل الرقم المميز لدى هيئة الزكاة صحيح',
            'charity_num.min'=>'برجاء ادخل الرقم المميز لدى هيئة الزكاة صحيح',
            'charity_num'=>'برجاء ادخل الرقم المميز لدى هيئة الزكاة صحيح',
            'charity_num.not_in'=>'برجاء ادخل الرقم المميز لدى هيئة الزكاة صحيح',

            'extra_tax_num.numeric'=>'برجاء ادخل رقم ضريبة مضافة صحيح',
            'extra_tax_num.min'=>'برجاء ادخل رقم ضريبة مضافة صحيح',
            'extra_tax_num'=>'برجاء ادخل رقم ضريبة مضافة صحيح',
            'extra_tax_num.not_in'=>'برجاء ادخل رقم ضريبة مضافة صحيح',
        ];
    }
}
