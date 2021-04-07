<?php

namespace App\Http\Controllers;

use App\account_transaction;
use App\AccountsInKind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class AccountsInKindController extends Controller
{
    //

    public function index($TransactionID){
        if(\request()->expectsJson()){
           $AccountsStatements =   account_transaction::select('id', 'fourth_level_account_id', 'transaction_id', 'name', 'code', 'current_year', 'first_past_year','aggregated_debit','aggregated_credit', 'is_related_party', 'related_party_type', 'related_party_branch', 'parent_id')
               ->where('transaction_id', $TransactionID)
               ->whereNotNull('fourth_level_account_id')
               ->orWhere(function ($query) use ($TransactionID){
                    $query->where('transaction_id',$TransactionID)->whereNull('parent_id')->whereNull('fourth_level_account_id');
                })->with('branchedStatements')
                ->where('ReadDataOnly', 0)
                ->paginate(10);
            return response()->json($AccountsStatements,200);
        }
    }
    public function AccountStatementInKind($AccountStatementID){
        $AccountStatementInKind = AccountsInKind::where('statement_id',$AccountStatementID)->get();
        return response()->json(['AccountStatementInKind'=>$AccountStatementInKind],200);
    }

    public function store(Request $request){

           DB::beginTransaction();
        try{
            $parentStatement = account_transaction::select('id','aggregated_debit','aggregated_credit')->findOrFail($request->corresponding_statement_id);
            $AddedAccountInKind = AccountsInKind::create($request->all());
            $parentStatement->aggregated_debit += $request->detailed_debit;
            $parentStatement->aggregated_credit += $request->detailed_credit;
            $parentStatement->save();
            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();

            return response()->json('',500);
        }


        return response()->json($AddedAccountInKind);
    }
    public function update(Request $request,$InKindID){

        DB::beginTransaction();
        try{
            $EditedAccountInKind = AccountsInKind::findOrFail($InKindID);

            $OldParentStatement = account_transaction::select('id','aggregated_debit','aggregated_credit')->findOrFail($EditedAccountInKind->corresponding_statement_id);
            $OldParentStatement->aggregated_debit -= $EditedAccountInKind->detailed_debit;
            $OldParentStatement->aggregated_credit -= $EditedAccountInKind->detailed_credit;

            $EditedAccountInKind->update($request->all());

            $NewParentStatement = account_transaction::select('id','aggregated_debit','aggregated_credit')->findOrFail($EditedAccountInKind->corresponding_statement_id);
            $NewParentStatement->aggregated_debit += $EditedAccountInKind->detailed_debit;
            $NewParentStatement->aggregated_credit += $EditedAccountInKind->detailed_credit;

            $OldParentStatement->save();
            $NewParentStatement->save();
            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
            return response()->json([],500);
        }




        return response()->json($EditedAccountInKind);

    }
    public function destroy($InKindID,$ParentStatementID){

        $parentStatement = account_transaction::select('id','aggregated_debit','aggregated_credit')->findOrFail($ParentStatementID);
        $DestroyedAccountInKind = AccountsInKind::findOrFail($InKindID)->select('id','detailed_debit','detailed_credit');

        $Final_aggregated_debit = $parentStatement->aggregated_debit - $DestroyedAccountInKind->detailed_debit;
        $Final_aggregated_credit = $parentStatement->aggregated_credit - $DestroyedAccountInKind->detailed_credit;

        DB::transaction(function () use($InKindID,$ParentStatementID,$Final_aggregated_debit,$Final_aggregated_credit) {
            DB::table('accounts_in_kinds')->where('id',$InKindID)->delete();

            DB::table('account_transaction')->where('id',$ParentStatementID)
                ->update(['aggregated_debit'=>$Final_aggregated_debit,'aggregated_credit'=>$Final_aggregated_credit]);
        }, 5);


        return response()->json('',200);

    }
}
