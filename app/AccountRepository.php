<?php


namespace App;

use App\AccountLVL1;
use App\AccountLVL2;
use App\AccountLVL3;
use App\AccountLVL4;
use Illuminate\Database\Eloquent\Builder;

class AccountRepository
{


    public static function GetAllAccountCharts(){

        $accountLVL1 = AccountLVL1::all();
        $accountLVL2 = AccountLVL2::all();
        $accountLVL3 = AccountLVL3::all();
        $accountLVL4 = AccountLVL4::all();

        $allAccounts = new \Illuminate\Database\Eloquent\Collection;

        $allAccounts = $allAccounts->concat($accountLVL1);
        $allAccounts = $allAccounts->concat($accountLVL2);
        $allAccounts = $allAccounts->concat($accountLVL3);
        $allAccounts = $allAccounts->concat($accountLVL4);

       return $allAccounts ;

    }
    public static function ExcelAccounts($TransactionID){

        $accountLVL1 = AccountLVL1::with(['transactions'=>function($query) use ($TransactionID){
            $query->where('transaction_id',$TransactionID);

        }])->get(['id','name','code']);
        $accountLVL2 =  AccountLVL2::with(['transactions'=>function($query) use ($TransactionID){
            $query->where('transaction_id',$TransactionID);

        }])->get(['id','name','code']);
        $accountLVL3 = AccountLVL3::with(['transactions'=>function($query) use ($TransactionID){
            $query->where('transaction_id',$TransactionID);

        }])->get(['id','name','code']);

        $accountLVL4 = AccountLVL4::all();

        $allAccounts = new \Illuminate\Database\Eloquent\Collection;

        $allAccounts = $allAccounts->concat($accountLVL1);
        $allAccounts = $allAccounts->concat($accountLVL2);
        $allAccounts = $allAccounts->concat($accountLVL3);
        $allAccounts = $allAccounts->concat($accountLVL4);

        return $allAccounts;
    }
    public static function CreateAccountChart($request){
        if ($request->level == 1){
            return AccountLVL1::create($request->except('level'));
        }
        else if ($request->level == 2){
            return  AccountLVL2::create($request->except('level'));
        }
        else if ($request->level == 3){
            return  AccountLVL3::create($request->except('level'));
        }
        else if ($request->level == 4){
            return  AccountLVL4::create($request->except('level'));
        }
    }
    public static function DeleteAccount($id,$level){
        if ($level == 1){
            AccountLVL1::destroy($id);
        }
        else if ($level == 2){
            AccountLVL2::destroy($id);
        }
        else if ($level == 3){
            AccountLVL3::destroy($id);
        }
        else if ($level == 4){
            AccountLVL4::destroy($id);
        }

    }
    public static function UpdateAccountChart($request){
        $account = null;
        if ($request->level == 1){
            $account = AccountLVL1::findOrFail($request->id);
        }
        else if ($request->level == 2){
            $account = AccountLVL2::findOrFail($request->id);
        }
        else if ($request->level == 3){
            $account = AccountLVL3::findOrFail($request->id);
        }
        else if ($request->level == 4){
            $account = AccountLVL4::findOrFail($request->id);
        }
       return $account->update($request->except(['level']));
    }

}

