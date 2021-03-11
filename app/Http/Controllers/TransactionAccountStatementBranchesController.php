<?php

namespace App\Http\Controllers;

use App\account_transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionAccountStatementBranchesController extends Controller
{
    //

    public function index($ParentStatementID){


        $BranchedStatements  = account_transaction::where('parent_id',$ParentStatementID)->get();

        return response()->json(['BranchedStatements'=>$BranchedStatements],200);

    }
    public function update(Request $request, $BranchedStatementID){

        // update BranchedStatement Values
        account_transaction::where('id',$BranchedStatementID)
            ->update([
                         'current_year'=>$request->Branched_FinalCredit,
                         'edited_current_year_debtor' => $request->Branched_edited_current_year_debtor, 'edited_current_year_creditor'=>$request->Branched_edited_current_year_creditor
                    ]);
        // update ParentStatement Values
        account_transaction::where('id',$request->parent_id)
            ->update([
                        'current_year' => $request->Parent_FinalCredit , 'edited_current_year_debtor' => $request->Parent_edited_current_year_debtor, 'edited_current_year_creditor' => $request->Parent_edited_current_year_creditor
                    ]);
        return response()->json('',200);
    }
    public function store(Request $request){

        $insertedBranchedStatement = account_transaction::create($request->all());

        $InsertedBranchedStatementID = DB::table('account_transaction')->where('parent_id',$request->parent_id)->where('code',$request->code)->latest('id')->select('id')->first();

        return response()->json(['BranchedStatementID'=>$InsertedBranchedStatementID],200);

    }
}
