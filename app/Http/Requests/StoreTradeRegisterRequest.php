<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTradeRegisterRequest extends FormRequest
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
            'number'=> 'unique:trade_registers|numeric|min:0|not_in:0',
            'EndDate'=> 'after:date',
        ];
    }
    public function messages()
    {
        return [
            //
            'number.unique' =>
                'رقم السجل'
                .request()->input('number').
                'مسجل بالفعل',
            'number.numeric' => 'برجاء ادخال رقم سجل صحيح',
            'number.min' => 'برجاء ادخال رقم سجل صحيح',
            'number.not_in' => 'برجاء ادخال رقم سجل صحيح',
            'EndDate.after'=>'تاريخ الانتهاء يجب ان يكون بعد تاريخ الاصدار'
        ];
    }
}
