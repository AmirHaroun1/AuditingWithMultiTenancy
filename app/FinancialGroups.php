<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FinancialGroups extends Model
{
    //

    protected  $guarded =   [];
    public $timestamps = false;

    public function accounts(){

        return $this->hasMany('App\AccountLVL1','Financial_group_id');

    }
    public function LinkNewAccount(Request $request){

        $account =  AccountLVL1::findOrFail($request->account_id);
        $this->accounts()->save(   $account  );
    }
}
