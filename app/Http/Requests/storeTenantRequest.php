<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeTenantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' =>['unique:tenants'],
            'name' => ['string', 'max:255', 'min:3'],
            'email' => ['unique:tenants','email'],
            'password' => ['string','min:8','max:255'],


        ];
    }
    public function messages()
    {
        return [

            'id.unique' => 'الدومين مسجل بالفعل',

            'name.min' => 'الأسم يجب أن يكون 3 أحرف على الأقل',
            'name.max' => 'الأسم يجب أن يكون 255 حرف على الأكثر',
            'name.string' => 'الأسم يجب يتكون من أحرف',

            'email.unique' => 'هذا البريد الألكنرونى مسجل بالفعل',

            'password.min'=>'الرقم السري يجب أن يكون أكثر من 8 أحرف',
            'password.max'=>'الرقم السري يجب أن لا يكون أكثر من 255 أحرف',

        ];
    }
}
