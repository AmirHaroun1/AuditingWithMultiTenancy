<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTradeRegisterRequest;
use App\Http\Requests\UpadteTradeRegisterRequest;
use App\institution;
use App\TradeRegister;
use App\Transaction;
use Illuminate\Http\Request;

class TradeRegisterController extends Controller
{
    public function search(Request $request){
        $rules = [
            'RegisterNumber' => 'required|numeric|min:0|not_in:0',
        ];
        $customMessages = [
            'RegisterNumber.numeric'=>'برجاء ادخل رقم سجل صحيح',
            'RegisterNumber.min'=>'برجاء ادخل رقم سجل صحيح',
            'RegisterNumber.required'=>'برجاء ادخل رقم سجل صحيح',
            'RegisterNumber.not_in'=>'برجاء ادخل رقم سجل صحيح',
        ];
        $this->validate($request, $rules, $customMessages);


        $TradeRegister = TradeRegister::where('number',$request->RegisterNumber)
            ->where('type','رئيسي')
            ->with(
            ['institution',
            'institution.BranchedTradeRegister',
            'institution.agent'
            ]
        )->get();

        return response()->json(['TradeRegister' => $TradeRegister],200);
    }
    //
    public function store(StoreTradeRegisterRequest $request,institution $institution){

        $newTradeRegister = TradeRegister::create($request->all());

        $institution->TradeRegisters()->save($newTradeRegister);
        $institution->refresh();

        return response()->json($newTradeRegister,200);
    }
    public function update(UpadteTradeRegisterRequest $request,TradeRegister $tradeRegister){

        $tradeRegister->update($request->all());

        return response()->json([$tradeRegister],200);
    }
    public function delete($tradeRegisterID){

        $tradeRegister =TradeRegister::findOrFail($tradeRegisterID);

        $tradeRegister->delete();

        return response()->json(['message'=> "Trade Registered Deleted Successfully"],200);
    }
}
