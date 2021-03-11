<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountLVL3 extends Model
{
    //
    protected $guarded = [];
    protected $table ='accounts_lvl_3';
    protected $primaryKey = 'id';
    protected $appends = ['level'];

    public function getLevelAttribute(){
        return 3;
    }
    public function FourthLevelAccounts(){
        return $this->hasMany(AccountLVL4::class,'parent_id');
    }
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'account_transaction', 'third_level_account_id', 'transaction_id')
            ->using(account_transaction::class)
            ->withPivot([
                'id',
                'name',
                'code',
                'account_level',

                'current_year',
                'current_year_creditor',
                'current_year_debtor',

                'edited_current_year_creditor',
                'edited_current_year_debtor',

                'policy',
                'considerations',
                'study',
                'second_study',

                'first_past_year',

                'second_past_year',

                'third_past_year',

                'fourth_past_year',


            ]);
    }
    public function scopeWithStatements($query,$TransactionID){
        return $query->with(['transactions'=>function ($query) use ($TransactionID){
            $query->where('transaction_id',$TransactionID);
        }]);
    }
    public function scopeWithAccountStatementsSum($query,$TransactionsID){

        $query->addSelect(['CurrentYearSum' => function ($query) use ($TransactionsID) {

            $query->selectRaw('sum(current_year)')
                ->where('transaction_id', $TransactionsID)
                ->from('account_transaction')
                ->whereColumn('third_level_account_id', 'accounts_lvl_3.id');
        }]);
        $query->addSelect(['CurrentYearCreditorSum'=> function($query) use ($TransactionsID){

            $query->selectRaw('sum(current_year_creditor)')
                ->where('transaction_id',$TransactionsID)
                ->from('account_transaction')
                ->whereColumn('third_level_account_id', 'accounts_lvl_3.id');
        }]);
        $query->addSelect(['CurrentYearDebtorSum'=> function($query) use ($TransactionsID){

            $query->selectRaw('sum(current_year_debtor)')
                ->where('transaction_id',$TransactionsID)
                ->from('account_transaction')
                ->whereColumn('third_level_account_id', 'accounts_lvl_3.id');
        }]);
        $query->addSelect(['edited_CurrentYearDebtorSum'=> function($query) use ($TransactionsID){

            $query->selectRaw('sum(edited_current_year_debtor)')
                ->where('transaction_id',$TransactionsID)
                ->from('account_transaction')
                ->whereColumn('third_level_account_id', 'accounts_lvl_3.id');
        }]);
        $query->addSelect(['edited_CurrentYearCreditorSum'=> function($query) use ($TransactionsID){

            $query->selectRaw('sum(edited_current_year_creditor)')
                ->where('transaction_id',$TransactionsID)
                ->from('account_transaction')
                ->whereColumn('third_level_account_id', 'accounts_lvl_3.id');
        }]);
        $query->addSelect(['FirstPastYearSum' => function ($query) use ($TransactionsID) {

            $query->selectRaw('sum(first_past_year)')
                ->where('transaction_id', $TransactionsID)
                ->from('account_transaction')
                ->whereColumn('third_level_account_id', 'accounts_lvl_3.id');
        }]);
        $query->addSelect(['SecondPastYearSum' => function ($query) use ($TransactionsID) {

            $query->selectRaw('sum(second_past_year)')
                ->where('transaction_id', $TransactionsID)
                ->from('account_transaction')
                ->whereColumn('third_level_account_id', 'accounts_lvl_3.id');
        }]);
        $query->addSelect(['ThirdPastYearSum' => function ($query) use ($TransactionsID) {

            $query->selectRaw('sum(	third_past_year)')
                ->where('transaction_id', $TransactionsID)
                ->from('account_transaction')
                ->whereColumn('third_level_account_id', 'accounts_lvl_3.id');
        }]);
        $query->addSelect(['FourthPastYearSum' => function ($query) use ($TransactionsID) {

            $query->selectRaw('sum(	fourth_past_year)')
                ->where('transaction_id', $TransactionsID)
                ->from('account_transaction')
                ->whereColumn('third_level_account_id', 'accounts_lvl_3.id');
        }]);
    }

}
