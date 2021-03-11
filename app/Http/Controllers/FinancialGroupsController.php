<?php

namespace App\Http\Controllers;

use App\AccountLVL1;
use App\FinancialGroups;
use Illuminate\Http\Request;

class FinancialGroupsController extends Controller
{
    //

    public function store(Request $request){

        $NewFinancialGroup  = FinancialGroups::create($request->all());

        return response()->json(['NewFinancialGroup'=>$NewFinancialGroup],200);
    }
    public function update(Request $request,$FinancialGroupID){

        $FinancialGroup =  FinancialGroups::findOrFail($FinancialGroupID);

        $FinancialGroup->update($request->all());

        return response()->json([$FinancialGroup],200);
    }
    public function manage(){

        $FirstLVLAccounts = AccountLVL1::all();

        $FinancialGroups = FinancialGroups::with('accounts')->get();
        return view('FinancialGroups.index',compact('FirstLVLAccounts','FinancialGroups'));
    }
    public function destroy($FinancialGroupID){

        FinancialGroups::destroy($FinancialGroupID);

        return response()->json([],200);
    }
}
