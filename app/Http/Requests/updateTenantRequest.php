<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateTenantRequest extends FormRequest
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

            'email' =>[Rule::unique('tenants')->ignore(\request('TenantID')),'email'],

            'name' => ['string', 'max:255', 'min:3'],
            'password' => ['string','min:8','max:255'],

            'number_of_branches' => [''],
            'subscription_price' => [''],

            'subscription_period_in_days'=>[''],
            'subscription_date' => [''],
            'subscription_end_date' => [''],

        ];
    }
    public function messages()
    {
        return [



            'name.min' => 'الأسم يجب أن يكون 3 أحرف على الأقل',
            'name.max' => 'الأسم يجب أن يكون 255 حرف على الأكثر',
            'name.string' => 'الأسم يجب يتكون من أحرف',

            'email.unique' => 'هذا البريد الألكنرونى مسجل بالفعل',

            'password.min'=>'الرقم السري يجب أن يكون أكثر من 8 أحرف',
            'password.max'=>'الرقم السري يجب أن لا يكون أكثر من 255 أحرف',

        ];
    }
}
