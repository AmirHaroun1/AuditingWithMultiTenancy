<?php

namespace App\Http\Controllers;

use App\RevisingGuid;
use Illuminate\Http\Request;

class RevisingGuidTransactionController extends Controller
{
    //
    public function index($transactionID,$RevisingGuidID)
    {
            $RevisingGuideTransaction = RevisingGuid::where('id',$RevisingGuidID)
                ->with([
                    'children' => function ($query) use ($transactionID) {
                        $query->with(['transactions' => function ($q) use ($transactionID) {
                            $q->where('transaction_id', $transactionID)->select('financial_year', 'transactions.created_at', 'end_financial_year');
                        }]);
                    },
                    'children.children' => function ($query) use ($transactionID) {
                        $query->with(['transactions' => function ($q) use ($transactionID) {
                            $q->where('transaction_id', $transactionID)->select('financial_year', 'transactions.created_at', 'end_financial_year');
                        }]);
                    },
                    'children.children.children' => function ($query) use ($transactionID) {
                        $query->with(['transactions' => function ($q) use ($transactionID) {
                            $q->where('transaction_id', $transactionID)->select('financial_year', 'transactions.created_at', 'end_financial_year');
                        }]);
                    },
                    'children.children.children.children' => function ($query) use ($transactionID) {
                        $query->with(['transactions' => function ($q) use ($transactionID) {
                            $q->where('transaction_id', $transactionID)->select('financial_year', 'transactions.created_at', 'end_financial_year');
                        }]);
                    },
                ])->get();
            return response()->json(['RevisingGuideTransaction' => $RevisingGuideTransaction], 200);
    }
    public function store(Request $request, $transactionID){

        $revisingGuid = RevisingGuid::findOrFail($request->ReviseGuidID);

        $revisingGuid->transactions()->attach($transactionID,['reference'=>$request->reference,'status'=>$request->status,'text'=>$request->text,'first_value'=>$request->first_value,'second_value'=>$request->second_value,'third_value'=>$request->third_value,'fourth_value'=>$request->fourth_value]);

        return response()->json([],200);
    }
    public function update(Request $request,$transactionID){
            $revisingGuid = RevisingGuid::findOrFail($request->ReviseGuidID);

            $revisingGuid->transactions()->updateExistingPivot($transactionID,['status'=>$request->status,'reference'=>$request->reference,'text'=>$request->text,'first_value'=>$request->first_value,'second_value'=>$request->second_value,'third_value'=>$request->third_value,'fourth_value'=>$request->fourth_value]);

            return response()->json([],200);
    }
}
