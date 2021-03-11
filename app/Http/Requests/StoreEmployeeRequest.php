<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEmployeeRequest extends FormRequest
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
            'national_id' =>['bail','unique:users'],
            'role'=>['bail','required'],
            'name' => [ 'bail','string', 'max:255', 'min:3'],
            'phone'=>['bail','unique:users'],
            'email' => ['bail','unique:users','email'],
            'password' => ['bail','string','min:8','max:255','confirmed'],

        ];
    }
    public function messages()
    {
        return [

            'national_id.min' => 'رقم الهوية يجب أن يتكون من 10 أرقام',
            'national_id.max' => 'رقم الهوية يجب أن يتكون من 10 أرقام',
            'national_id.required' => 'هذا الحقل مطلوب',
            'national_id.unique' => 'رقم الهوية مسجل بالفعل',

            'role.required' => 'هذا الحقل مطلوب',

            'name.min' => 'الأسم يجب أن يكون 3 أحرف على الأقل',
            'name.max' => 'الأسم يجب أن يكون 255 حرف على الأكثر',

            'name.string' => 'الأسم يجب يتكون من أحرف',


            'phone.unique' => 'رقم الجوال مسجل بالفعل',

            'email.unique' => 'هذا البريد الألكنرونى مسجل بالفعل',

            'password.min'=>'الرقم السري يجب أن يكون أكثر من 8 أحرف',
            'password.max'=>'الرقم السري يجب أن لا يكون أكثر من 255 أحرف',
            'password.confirmed'=>' تأكيد الرقم السرى غير مطابق ',

        ];
    }
}
