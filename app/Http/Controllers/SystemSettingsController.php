<?php

namespace App\Http\Controllers;

use App\AccountLVL1;
use App\AccountLVL2;
use App\AccountLVL3;
use App\AccountLVL4;
use App\AccountRepository;
use App\SystemSettings;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    //
    public function GetOfficeInfo(){

        $OfficeInfo = SystemSettings::where('type','Like','بيانات المكتب')->first();

        return view('SuperAdmin.OfficeInfo.index',compact('OfficeInfo'));
    }
    public function StoreOfficeInfo(Request $request){
        if($request->has('logo')){
            $logoPath = $request['logo']->store('OfficeLogo');
            SystemSettings::create( array_merge($request->except('logo'),['type'=>'بيانات المكتب','logo'=>$logoPath]) );
        }else{
            SystemSettings::create( array_merge($request->all(),['type'=>'بيانات المكتب']) );
        }
        return response()->json('',200);
    }
    public function UpdateOfficeInfo(Request $request){
        $OfficeInfo = SystemSettings::where('type','Like','بيانات المكتب')->get();
        if($request->has('logo')){
            unlink('/storage/OfficeLogo/'.$OfficeInfo->logo);

            $logoPath = $request['logo']->store('OfficeLogo');

            $OfficeInfo->update($request->except('logo'),['logo'=>$logoPath]);
        }else{
            $OfficeInfo->update($request->all());
        }
        return response()->json('',200);
    }
    public function DropDownIndex(){

        if(\request()->expectsJson()){
            $DropDownsOptions = SystemSettings::where('type','LIKE','قائمة منسدلة')->get();

            return response()->json(['DropDownsOptions'=>$DropDownsOptions],200);
        }
        return view('SuperAdmin.DropDowns.index');
    }
    public function StoreDropDownOption(Request $request){

        $DropDownOption = SystemSettings::create($request->all());

        return response()->json([$DropDownOption],200);
    }
    public function DeleteDropDownOption($dropdownID,Request $request){

        SystemSettings::destroy($dropdownID);

        return response()->json([],200);
    }

    public function UpdateDropDownOption($dropdownID,Request $request){

        $systemDropDown = SystemSettings::findOrFail($dropdownID);
        $systemDropDown->update($request->all());
        return response()->json([],200);
    }
    public function AccountChartsIndex(){

        if(\request()->expectsJson()){

            $AccountCharts = AccountLVL1::WithAllChildren()->paginate(10);
            return response()->json(['AccountChartsWithChildren'=>$AccountCharts],200);
        }

         return view('SuperAdmin.AccountCharts.index');
    }
    public function RetrieveAllAccountCharts(){

        $allAccounts = AccountRepository::GetAllAccountCharts();

        return response()->json($allAccounts);
    }

    public function AccountChartsStore(Request $request){

        $account = AccountRepository::CreateAccountChart($request);

        return response()->json($account);
    }
    public function AccountChartsDelete($id,$level){

        AccountRepository::DeleteAccount($id,$level);

        return response()->json();
    }
    public function AccountChartsUpdate(Request $request){

        $account =  AccountRepository::UpdateAccountChart($request);

        return response()->json($account);
    }

}
