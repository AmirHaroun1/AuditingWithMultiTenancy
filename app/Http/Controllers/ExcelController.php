<?php

namespace App\Http\Controllers;

use App\account_transaction;
use App\AccountRepository;
use App\Imports\AccountTransactionImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class ExcelController extends Controller
{
    //
    public function GetExcelHeader(Request $request){

        $headers = (new HeadingRowImport)->toArray($request['AccountExcelFile']);

        $rows = Excel::ToCollection( new AccountTransactionImport,$request['AccountExcelFile']);


        return response()->json(['headers'=>$headers,'rows'=>$rows[0]],200);
    }
    public function AccountsAvailable($TransactionID)
    {

        $accounts = AccountRepository::ExcelAccounts($TransactionID);

        return response()->json($accounts,200);
    }
    public function store(Request $request){


        $insertedBranchedStatement = account_transaction::create($request->all());

        $InsertedBranchedStatementID = DB::table('account_transaction')->where('parent_id',$request->parent_id)->where('code',$request->code)->latest('id')->select('id')->first();


        $BranchStatement = account_transaction::findOrFail($request->parent_id);
        $BranchStatement->current_year += $request->current_year;
        $BranchStatement->current_year_creditor += $request->current_year_creditor;
        $BranchStatement->current_year_debtor += $request->current_year_debtor;

        $BranchStatement->first_past_year += $request->first_past_year;
        $BranchStatement->second_past_year += $request->second_past_year;
        $BranchStatement->third_past_year += $request->third_past_year;
        $BranchStatement->fourth_past_year += $request->fourth_past_year;

        $BranchStatement->save();


        return response()->json(['BranchedStatementID'=>$InsertedBranchedStatementID],200);

    }
    public function destroy($BranchID,$ParentID){

        $parentStatement = account_transaction::findOrFail($ParentID);

        $BranchStatement = account_transaction::findOrFail($BranchID);

        $parentStatement->current_year -= $BranchStatement->current_year;
        $parentStatement->current_year_creditor -= $BranchStatement->current_year_creditor;
        $parentStatement->current_year_debtor -= $BranchStatement->current_year_debtor;
        $parentStatement->first_past_year -= $BranchStatement->first_past_year;
        $parentStatement->second_past_year -= $BranchStatement->second_past_year;
        $parentStatement->third_past_year -= $BranchStatement->third_past_year;
        $parentStatement->fourth_past_year -= $BranchStatement->fourth_past_year;

        $parentStatement->save();

        $BranchStatement->delete();

        return response()->json([],200);
    }
}
