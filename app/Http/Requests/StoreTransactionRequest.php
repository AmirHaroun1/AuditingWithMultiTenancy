<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
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
        if(\request()->input('financial_period') == 'فترة قصيرة')
        {
            return [
                'start_financial_year' => 'bail|date',
                'end_financial_year' => 'bail|after:start_financial_year',
                'financial_period' => '',
                'measurement_standard' => '',
                'measurement_standard_determinants'=>'',
                'agreed_contract_value'=>'bail|numeric|min:0|not_in:0',
                'down_payment'=>'bail|numeric|min:0',
                'final_payment'=>'bail|numeric|min:0',
                'zakat_deposit_fees'=>'bail|numeric|min:0',
                'offer_value'=>'bail|numeric|min:0',
                'total_value'=>'bail|numeric|min:0',

            ];
        }else{
            return [
                'start_financial_year' => 'bail|date',
                'end_financial_year' => 'bail|after:start_financial_year',
                'financial_period' => '',
                'measurement_standard' => '',
                'measurement_standard_determinants'=>'',
                'agreed_contract_value'=>'bail|numeric|min:0',
                'down_payment'=>'bail|numeric|min:0',
                'final_payment'=>'bail|numeric|min:0',
                'zakat_deposit_fees'=>'bail|numeric|min:0',
                'offer_value'=>'bail|numeric|min:0',
                'total_value'=>'bail|numeric|min:0',
                'financial_year' => [
                    'min:4',
                    Rule::unique('transactions')->where(function ($query) {
                        return $query->where('MainTradeRegisterNumber', \request()->input('MainTradeRegisterNumber'));
                    })
                    ],
                'MainTradeRegisterNumber' => [
                    Rule::unique('transactions')->where(function ($query) {
                        return $query->where('financial_year', \request()->input('financial_year'));
                    })
                       ],
            ];

        }

    }
    public function messages()
    {
        return
            [

            'financial_year.unique' => 'يوجد معاملة للسجل التجاري مع السنة المالية بالفعل',

            'MainTradeRegisterNumber.unique' => 'يوجد معاملة للسجل التجاري مع السنة المالية بالفعل',

            'financial_year.min' => 'برجاء أدخال سنة مالية صحيحة',


            'start_financial_year.date' => 'برجاء أدخال بداية سنة مالية صحيحة',


            'end_financial_year.date' => 'برجاء أدخال نهاية سنة مالية صحيحة',
            'end_financial_year.after' => 'تاريخ نهاية السنة المالية يجب أن يكون بعد تاريخ بداية السنة المالية',


            'agreed_contract_value.numeric'=>'برجاء أدخال قيمة صحيحة',
            'agreed_contract_value.min'=>'برجاء أدخال قيمة صحيحة',
            'agreed_contract_value.required'=>'برجاء أدخال قيمة صحيحة',


            'down_payment.numeric'=>'برجاء أدخال قيمة صحيحة',
            'down_payment.min'=>'برجاء أدخال قيمة صحيحة',
            'down_payment.required'=>'برجاء أدخال قيمة صحيحة',

            'final_payment.numeric'=>'برجاء أدخال قيمة صحيحة',
            'final_payment.min'=>'برجاء أدخال قيمة صحيحة',

            'zakat_deposit_fees.numeric'=>'برجاء أدخال قيمة صحيحة',
            'zakat_deposit_fees.min'=>'برجاء أدخال قيمة صحيحة',


            'value_added_tax.numeric'=>'برجاء أدخال قيمة صحيحة',
            'value_added_tax.min'=>'برجاء أدخال قيمة صحيحة',

            'offer_value.numeric'=>'برجاء أدخال قيمة صحيحة',
            'offer_value.min'=>'برجاء أدخال قيمة صحيحة',

            'total_value.numeric'=>'برجاء أدخال قيمة صحيحة',
            'total_value.min'=>'برجاء أدخال قيمة صحيحة',


        ];
    }
}
