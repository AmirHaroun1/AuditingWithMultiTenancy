<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;


class account_transaction extends Pivot
{
    //
    protected $table = 'account_transaction';
    protected $guarded = [];

    public function branchedStatements(){
        return $this->hasMany('App\account_transaction','parent_id');
    }
    public function accountsInKind(){
        return $this->hasMany('App\AccountsInKind','statement_id');
    }
    public function scopeWithBranchesSum($query,$TransactionsID = null){
        $query->addSelect(['AllBranchesCurrentYearSum'=> function($query) use ($TransactionsID){

            $query->selectRaw('sum(account_transaction.current_year)')
                ->from('account_transaction')
                ->whereColumn('account_transaction.parent_id', 'account_transaction.id');

        }]);
        $query->addSelect(['AllBranchesCurrentYearDebtorSum'=> function($query) use ($TransactionsID){

            $query->selectRaw('sum(current_year_debtor)')
                ->from('account_transaction')
                ->whereColumn('account_transaction.parent_id', 'account_transaction.id');
        }]);
        $query->addSelect(['AllBranchesCurrentYearCreditorSum'=> function($query) use ($TransactionsID){

            $query->selectRaw('sum(current_year_creditor)')
                ->from('account_transaction')
                ->whereColumn('account_transaction.parent_id', 'account_transaction.id');
        }]);

        $query->addSelect(['AllBranchesFirstPastYearSum'=> function($query) use ($TransactionsID){

            $query->selectRaw('sum(first_past_year)')
                ->from('account_transaction')
                ->whereColumn('account_transaction.parent_id', 'account_transaction.id');
        }]);
        $query->addSelect(['AllBranchesSecondPastYearSum'=> function($query) use ($TransactionsID){

            $query->selectRaw('sum(second_past_year)')
                ->from('account_transaction')
                ->whereColumn('account_transaction.parent_id', 'account_transaction.id');

        }]);
        $query->addSelect(['AllBranchesThirdPastYearSum'=> function($query) use ($TransactionsID){

            $query->selectRaw('sum(third_past_year)')
                ->from('account_transaction')
                ->whereColumn('account_transaction.parent_id', 'account_transaction.id');
        }]);
        $query->addSelect(['AllBranchesFourthPastYearSum'=> function($query) use ($TransactionsID){

            $query->selectRaw('sum(fourth_past_year)')
                ->from('account_transaction')
                ->whereColumn('account_transaction.parent_id', 'account_transaction.id');
        }]);


    }

}
