<?php

namespace App\Http\Controllers;

use App\document;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentsController extends Controller
{
    //
    public function index($transactionID = null,$documentID=null){

      /*  $documents = document::query()
            ->when(!is_null($documentID),function ($query) use ($documentID){
                $query->where('code','LIKE',$documentID);
            })
            ->when(!is_null($transactionID),function ($query)use($transactionID){
            $query->with(['transactions'=>function($EagerLoadingQuery) use ($transactionID){
                $EagerLoadingQuery->where('transaction_id',$transactionID)->select('financial_year','end_financial_year','transactions.created_at');
            }]);
        })->get();
      */

        $documents = new document();

        if( !is_null($documentID) && is_null($transactionID) ){
            $documents = document::where('code','LIKE',$documentID)->get();
        }
        else if( !is_null($transactionID) && is_null($documentID) )
        {
            $documents = document::WithTransactionDocuments($transactionID)->get();
        }
        else{
            $documents =  document::where('code','LIKE',$documentID)->WithTransactionDocuments($transactionID)->get();
        }

        return response()->json(['RequiredDocuments' => $documents],200);
    }
    public function AddDocument(Request $request , $transaction_id, $document_id){

        $transaction = Transaction::findOrFail($transaction_id);
        $document = document::findOrFail($document_id);
        $DocumentPath = $request['file']->store('InstitutionsDocuments');
        $originalName = $request['file']->getClientOriginalName();
        $transaction->documentations()->attach($document,['DocumentPath' => $DocumentPath,'original_name'=>$originalName]);
        $attachedDocumentID =  $transaction->documentations()->latest()->first()->pivot->id;


        return response()->json(['FileID'=>$attachedDocumentID,'FilePath'=>$DocumentPath,'FileName'=>$originalName],200);

    }
    public function RemoveDocument($documentID,Request $request)
    {
        DB::table('document_transaction')->where('DocumentPath','LIKE',$request['FilePath'])->delete();
        unlink('storage/'.$request['FilePath']);
        return response()->json([],200);
    }
    public function DownloadDocument($DocumentPath,$DocumentName){

         $path = storage_path().'/'.'app'.'/public/'.'InstitutionsDocuments/'.$DocumentPath;
            if (file_exists($path)) {
            return response()->download($path,$DocumentName);
            }
    }
    public function UpdateDocument(Request $request){
         $transaction = Transaction::findOrFail($request->TransactionId);

        $transaction->documentations()->updateExistingPivot($request->DocumentId,['comment'=>$request['comment']]);

        return response()->json();
    }

}
