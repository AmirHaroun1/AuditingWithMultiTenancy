<?php

namespace App\Http\Controllers;

use App\AccountLVL1;
use App\FinancialGroups;
use Illuminate\Http\Request;

class FinancialGroupsAccountsController extends Controller
{
    //


    public function store(Request $request,$FinancialGroupID){

        $FinancialGroup = FinancialGroups::findOrFail($FinancialGroupID);

        $FinancialGroup->LinkNewAccount($request);

        return response()->json('',200);
    }
    public function destroy($AccountID){

        $account = AccountLVL1::findOrFail($AccountID);
        $account->Financial_group_id = null;
        $account->save();
    }
}
