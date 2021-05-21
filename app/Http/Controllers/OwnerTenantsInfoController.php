<?php

namespace App\Http\Controllers;

use App\SystemSettings;
use App\Tenant;
use Illuminate\Http\Request;
/**
 * @group  Manage Subscriber (Tenant) Office Info
 *
 * APIs To Manage Subscriber (Tenant) Office Info
 */
class OwnerTenantsInfoController extends Controller
{
    //
    /**
     * Get Office Info
     * Ziggy route : axios.get(route('owner.officeInfo.index')).
     *
     * @response {
            "OfficeInfo": {
            "id": 1,
            "type": "بيانات المكتب",
            "name": "مكتب خليل التهامي",
            "name_english": null,
            "value": null,
            "logo": null,
            "bank_name": null,
            "bank_name_english": null,
            "bank_account_number": null,
            "created_at": null,
            "updated_at": null
            }
     * }
     * @urlParam  TenantID required param of the Tenant (subscriber ID).
     */
    public function index($TenantID){
        $Tenant = Tenant::where('id',$TenantID)->firstOrFail();

        $Tenant->run(function() use ($Tenant){
            $Tenant->OfficeInfo = SystemSettings::where('type','Like','بيانات المكتب')->first();
        });

        return response()->json(['OfficeInfo'=>$Tenant->OfficeInfo],200);
    }
    /**
     * store Office Info
     * Ziggy route : axios.post(route('owner.officeInfo.store'),formData).
     * @urlParam  TenantID required param of the Tenant (subscriber ID).
     * @bodyParam  name string required The Office Name in arabic.
     * @bodyParam  name_english string required The Office Name in english.
     * @bodyParam  bank_name string required The Office Bank Name in arabic.
     * @bodyParam  bank_name_english string required The Office Bank Name in arabic.
     * @bodyParam  bank_account_number string required The Office Bank number.
     * @bodyParam  logo required The Office Logo.
     */
    public function store($TenantID,Request $request){
        $Tenant = Tenant::where('id',$TenantID)->firstOrFail();
        $Tenant->run(function() use($request){
            if($request->has('logo')){
                $logoPath = $request['logo']->store('OfficeLogo');
                SystemSettings::create( array_merge($request->except('logo'),['type'=>'بيانات المكتب','logo'=>$logoPath]) );
            }else{
                SystemSettings::create( array_merge($request->all(),['type'=>'بيانات المكتب']) );
            }
        });
        return response()->json('',200);
    }
    /**
     * update Office Info
     * Ziggy route : axios.post(route('owner.officeInfo.update'),formData).
     * <br>
     * formData.append('_method',"PATCH").
     * @urlParam  TenantID required param of the Tenant (subscriber ID).
     * @bodyParam  name string required The Office Name in arabic.
     * @bodyParam  name_english string required The Office Name in english.
     * @bodyParam  bank_name string required The Office Bank Name in arabic.
     * @bodyParam  bank_name_english string required The Office Bank Name in arabic.
     * @bodyParam  bank_account_number string required The Office Bank number.
     * @bodyParam  logo required The Office Logo.
     */
    public function update($TenantID,Request $request){
        $Tenant = Tenant::where('id',$TenantID)->firstOrFail();
        $Tenant->run(function() use($request){
            $OfficeInfo = SystemSettings::where('type','Like','بيانات المكتب')->get();
            if($request->has('logo')){
                unlink('/storage/OfficeLogo/'.$OfficeInfo->logo);

                $logoPath = $request['logo']->store('OfficeLogo');

                $OfficeInfo->update($request->except('logo'),['logo'=>$logoPath]);
            }else{
                $OfficeInfo->update($request->all());
            }
            return response()->json('',200);
        });
    }
}
