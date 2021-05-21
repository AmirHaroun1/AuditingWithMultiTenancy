<?php

namespace App\Http\Controllers;

use App\RevisingGuid;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class RevisingGuidController extends Controller
{
    //
    public function index( $TransactionID , $withRelation = null){

        if(\request()->expectsJson()){

            if($withRelation){

                $AvailableRevisingGuides = RevisingGuid::whereNull('parent_id')->with('children.children.children.children')->orderBy('order_in_list')->get();
            }
            else{

                $AvailableRevisingGuides = RevisingGuid::orderBy('order_in_list')->all();
            }
            return response()->json(['AllRevisingGuides'=> $AvailableRevisingGuides],200);

        }
        else{
             $Transaction = Transaction::with
            ('institution.MainTradeRegister',
                'institution.BranchedTradeRegister',
                'institution.agent',
                'reviser:id,name,code,signature,role',
                'auditor:id,name,code,signature,role',
                'fieldDelegate:id,name,code,signature,role',
                'partner:id,name,code,signature,role'
               )
                ->findOrFail($TransactionID);

            return view('RevisingGuid.index',compact('Transaction'));
        }
    }
    public function manage(){

            $AllRevisingGuides = RevisingGuid::orderBy('order_in_list')->whereNull('parent_id')->with('children.children.children.children')->get();

        return view('RevisingGuid.index',compact('AllRevisingGuides'));
    }
    public function store(Request $request){

        $revisingGuid = RevisingGuid::create($request->all());

        return response()->json([$revisingGuid],200);


    }
    public function update(Request $request,$RevisingGuidID){

       $revisingGuid =  RevisingGuid::findOrFail($RevisingGuidID);

       $revisingGuid->update($request->all());

        return response()->json([$revisingGuid],200);
    }
    public function PatchUpdateIndex(Request $request){
        $data = json_decode($request['data'],true);
        $ParentArray = array();
        for ($i = 0 ; $i < (integer) $request->data_length ; $i++) {
            array_push($ParentArray,
                array(
                   'id' => $data[$i]['id'],
                   'order_in_list' => $data[$i]['order_in_list'],
                )
            );
        }

        RevisingGuid::custom_batch_update('id',$ParentArray);


    }
    public function destroy($RevisingGuidID){

        RevisingGuid::destroy($RevisingGuidID);

        return response()->json([],200);

    }
}
