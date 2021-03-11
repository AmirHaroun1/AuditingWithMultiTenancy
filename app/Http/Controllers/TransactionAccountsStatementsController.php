<?php

namespace App\Http\Controllers;

use App\account_transaction;
use App\AccountLVL1;
use App\Imports\AccountTransactionImport;
use App\TransactionAccountsStatementsRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Facades\Excel;
class TransactionAccountsStatementsController extends Controller
{
    //


    public function index($AccountID,$transactionID,$AccountLevel,$WithoutReadDataOnly = false){
        $AccountStatements = TransactionAccountsStatementsRepository::GetAccountStatements($transactionID,$AccountID,$AccountLevel,$WithoutReadDataOnly);

        return response()->json(['statements'=>$AccountStatements],200);
    }
    public function AllTransactionAccountsWithStatements($TransactionID){
        $AccountsTreeWithStatements = TransactionAccountsStatementsRepository::AllTransactionAccountsWithStatements($TransactionID);

        return response()->json(['AccountsTreeWithStatements'=>$AccountsTreeWithStatements],200);
    }
    public function branches($AccountID,$transactionID,$AccountLevel){
        $AccountStatements = TransactionAccountsStatementsRepository::GetAccountStatementsWithBranches($transactionID,$AccountID,$AccountLevel);

        return response()->json(['statements'=>$AccountStatements],200);
    }
    public function SumOfAccountsOfTransaction($TransactionsID){

        $NestedAccountsWithSum = TransactionAccountsStatementsRepository::GetSumOfAccountsStatements($TransactionsID)->get();

        return response()->json(['AccountStatementsWithSum'=>$NestedAccountsWithSum],200);
    }
    public function update(Request $request,$StatementID){
        $statement = account_transaction::findOrFail($StatementID)->update($request->all());
        return response()->json($statement,200);
    }
    public function GetReadOnlyVueEditorValues($TransactionID,$AccountID,$AccountLevel){
        $VueEditorValues = TransactionAccountsStatementsRepository::GetReadOnlyVueEditorValues($TransactionID,$AccountID,$AccountLevel);

        return response()->json(['VueEditorValues'=>$VueEditorValues],200);

    }
    public function store(Request $request,$transactionID){
        $AddedAccountID = TransactionAccountsStatementsRepository::StoreNewAccountStatement($request,$transactionID);
        return response()->json($AddedAccountID);

    }
    public function delete($StatementID){
        account_transaction::destroy($StatementID);
        return response()->json('',200);
    }
}
