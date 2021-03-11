<?php

namespace App\Http\Requests;

use App\TradeRegister;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpadteTradeRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        $tradeRegister = $this->route('TradeRegister');
        return [
            'number' =>[Rule::unique('trade_registers')->ignore($tradeRegister),'numeric','min:0','not_in:0'],
            'EndDate'=> 'after:date',
        ];
    }
    public function messages(){
        return[
            'number.unique'=>
                'السجل رقم'.

                request()->input('number')
                .
                'مسجل بالفعل'
            ,
            'number.numeric' => 'برجاء ادخال رقم سجل صحيح',
            'number.min' => 'برجاء ادخال رقم سجل صحيح',
            'number.not_in' => 'برجاء ادخال رقم سجل صحيح',
            'EndDate.after'=>'تاريخ الانتهاء يجب ان يكون بعد تاريخ الاصدار'
            ];
    }
}
