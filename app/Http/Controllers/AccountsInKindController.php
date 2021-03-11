<?php

namespace App\Http\Controllers;

use App\account_transaction;
use App\AccountsInKind;
use Illuminate\Http\Request;

class AccountsInKindController extends Controller
{
    //

    public function index($TransactionID){

        if(\request()->expectsJson()){
           $AccountsStatements =   account_transaction::select('id', 'fourth_level_account_id', 'transaction_id', 'name', 'code', 'current_year', 'first_past_year','aggregated_debit','aggregated_credit', 'is_related_party', 'related_party_type', 'related_party_branch', 'parent_id')

                ->with(['branchedStatements' => function ($query) use ($TransactionID) {
                    $query->select('id', 'name', 'code', 'current_year', 'first_past_year','aggregated_debit','aggregated_credit', 'is_related_party', 'related_party_type', 'related_party_branch', 'parent_id')
                         ->with('accountsInKind');
                },'accountsInKind'])
                ->where('transaction_id', $TransactionID)
                ->whereNotNull('fourth_level_account_id')
                ->orWhere(function ($query) {
                    $query->whereNull('parent_id');
                })
                ->where('ReadDataOnly', 0)
                ->paginate(10);
            return response()->json($AccountsStatements,200);
        }
    }
    public function store(Request $request){

        $AddedAccountInKind = AccountsInKind::create($request->all());

        $parentStatement = account_transaction::select('id','aggregated_debit','aggregated_credit')->findOrFail($request->corresponding_statement_id);
        $parentStatement->aggregated_debit += $request->detailed_debit;
        $parentStatement->aggregated_credit += $request->detailed_credit;
        $parentStatement->save();


        return response()->json($AddedAccountInKind);
    }
    public function update(Request $request,$InKindID){
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



        return response()->json($EditedAccountInKind);

    }
    public function destroy($InKindID,$ParentStatementID){

        $parentStatement = account_transaction::select('id','aggregated_debit','aggregated_credit')->findOrFail($ParentStatementID);
        $DestroyedAccountInKind = AccountsInKind::findOrFail($InKindID);

        $parentStatement->aggregated_debit -= $DestroyedAccountInKind->detailed_debit;
        $parentStatement->aggregated_credit -= $DestroyedAccountInKind->detailed_credit;

        $parentStatement->save();

        $DestroyedAccountInKind->delete();

        return response()->json('',200);

    }
}
