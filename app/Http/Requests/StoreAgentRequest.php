<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAgentRequest extends FormRequest
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
            'national_id' =>['bail','max:10','min:10'],
            'role'=>['bail','required'],
            'name' => [ 'bail','string', 'max:255', 'min:3'],
            'phone'=>['bail'],
            'email' => ['bail','email'],
            'password' => ['bail','string','min:8','max:255'],

        ];
    }
    public function messages()
    {
        return [

            'national_id.min' => 'رقم الهوية يجب أن يتكون من 10 أرقام',
            'national_id.max' => 'رقم الهوية يجب أن يتكون من 10 أرقام',
            'national_id.required' => 'هذا الحقل مطلوب',

            'role.required' => 'هذا الحقل مطلوب',

            'name.min' => 'الأسم يجب أن يكون 3 أحرف على الأقل',
            'name.max' => 'الأسم يجب أن يكون 255 حرف على الأكثر',

            'name.string' => 'الأسم يجب يتكون من أحرف',

            'password.min'=>'الرقم السري يجب أن يكون أكثر من 8 أحرف',
            'password.max'=>'الرقم السري يجب أن لا يكون أكثر من 255 أحرف',
            'password.confirmed'=>' تأكيد الرقم السرى غير مطابق ',

        ];
    }
}
