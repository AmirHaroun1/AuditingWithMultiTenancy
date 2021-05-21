<?php

namespace App\Http\Controllers;

use App\OfficeBranch;
use App\User;
use App\Tenant;
use Illuminate\Http\Request;
/**
 * @group  Manage subscribed office branches
 *
 * APIs To Manage subscribed office branches
 */
class OwnerTenantsBranchesController extends Controller
{
    /**
     *
     * Retrieve subscriber (Tenant) All Office Branches,
     * return response json.
     * <br>
     * Ziggy route : axios.get(route('owner.officeInfo.index')).
     * <br>
     * reponse {
     *  "OfficeBranches": [
     * <br>
        {
        "id": 1,
        "name": "الرياض",
        "address": "عنوان - الرياض",
        "is_main":1
        "created_at": "2021-04-14T22:43:23.000000Z",
        "updated_at": null
        },
     * <br>
        {
        "id": 2,
        "name": "الدمام",
        "address": "عنوان - الخبر",
         "is_main":0
        "created_at": "2021-04-28T22:43:26.000000Z",
        "updated_at": null
        }
     * <br>
        ]
     * }
     *
     *
     *
     *
     * @urlParam TenantID required The Id of the subscriber (Tenant).
     */
    public function index($TenantID){
        $Tenant = Tenant::where('id',$TenantID)->firstOrFail();
        $Tenant->run(function () use($Tenant){
            $Tenant->officeBranches = OfficeBranch::get();
        });
        return response()->json(['OfficeBranches'=>$Tenant->officeBranches],200);

    }
    /**
     * store new Branch | Return The NewOfficeBranch.
     * Ziggy route : axios.post(route('owner.OfficeBranches.store'),formData).
     * @urlParam TenantID required The Id of the subscriber (Tenant).
     * @bodyParam  name string required The Office Name.
     * @bodyParam  address string required The Office address.
     * @bodyParam  is_main boolean required tell if the branch is main branch.
     */
    public function store($TenantID,Request $request){
        $Tenant = Tenant::where('id',$TenantID)->firstOrFail();
        $Tenant->run(function () use($Tenant,$request){
            $Tenant->NewCreatedOfficeBranch = OfficeBranch::create(array_merge($request->all()));
        });
        return response()->json(['NewOfficeBranch'=>$Tenant->NewCreatedOfficeBranch],200);
    }
    /**
     * update Office Branch | Return The UpdatedOfficeBranch.
     *
     * Ziggy route : axios.post(route('owner.OfficeBranches.update'),formData).
     * <br>
     * formData.append('_method',"PATCH").
     * <br>
     * @urlParam TenantID required The Id of the subscriber (Tenant).
     * @bodyParam  name string required The Office Name.
     * @bodyParam  address string required The Office address.
     * @bodyParam  is_main boolean required tell if the branch is main branch.
     *
     */
    public function update($TenantID,$OfficeBranchID,Request $request){
        $Tenant = Tenant::where('id',$TenantID)->firstOrFail();
        $Tenant->run(function () use($Tenant,$OfficeBranchID,$request){
            $Tenant->UpdatedOfficeBranch = OfficeBranch::where('id',$OfficeBranchID)
                ->update($request->all());
        });
        return response()->json(['UpdatedOfficeBranch'=>$Tenant->UpdatedOfficeBranch],200);
    }
    /**
     * delete Office Branch
     *
     * Ziggy route : axios.delete(route('owner.OfficeBranches.destroy',TenantID)).
     * <br>
     * formData.append('_method',"delete").
     * <br>
     * @urlParam TenantID required The Id of the subscriber (Tenant).
     * @urlParam OfficeBranchID required The Id of the Branch that will be deleted .
     *
     */
    public function destroy($TenantID,$OfficeBranchID){
        $Tenant = Tenant::where('id',$TenantID)->firstOrFail();
        $Tenant->run(function () use($Tenant,$OfficeBranchID){
            $Tenant->DeletedOffice = OfficeBranch::where('id',$OfficeBranchID)
                ->delete();
        });
        return response()->json(['DeletedOffice'=>$Tenant->DeletedOffice],200);
    }
}
