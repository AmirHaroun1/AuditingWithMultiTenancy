<?php

namespace App\Http\Controllers;

use App\OfficeBranch;
use Illuminate\Http\Request;
/**
 * @group  Manage OfficeBranches
 *
 * APIs To Manage OfficeBranches
 */
class OfficeBranchesController extends Controller
{
    /**
     *
     * In case of response expects json it retrieves all office_branches
     * <br>
     * In case of normal response it return the blade SuperAdmin/OfficeBranches/index.php
     * , your component is their <office-branches></office-branches> , load all branches through the same endpoint
     * route(' OfficeBranches.index ')
     *
     */
    public function index()
    {
        //
        if(\request()->expectsJson()){
            $OfficeBranches =  OfficeBranch::all();
            return response()->json(['OfficeBranches' => $OfficeBranches]);
        }
        return view('SuperAdmin.OfficeBranches.index');
    }

    /**
     * Store a newly created Office in storage.
     *
     * @bodyParam name required string the name of the office_branch
     * @bodyParam address required string the address of the office_branch
     * @bodyParam is_main required boolean if the branch is main checkbox returns 1 or 0
     */
    public function store(Request $request)
    {
        OfficeBranch::create($request->all());

        return response()->json([],200);
    }

    /**
     * Update the specified office_branch in storage.
     *
     * @urlParam OfficeBranch required int the id of the updated office
     * @bodyParam name required string the name of the office_branch
     * @bodyParam address required string the address of the office_branch
     * @bodyParam is_main required boolean if the branch is main checkbox returns 1 or 0
     */
    public function update(Request $request, $id)
    {
        //
        $UpdatedOffice = OfficeBranch::where('id',$id)->update($request->all());

        return response()->json(['UpdatedOfficeBranch' => $UpdatedOffice],200);

    }

    /**
     * Remove the specified office_branch from storage.
     *
     * @urlParam OfficeBranch required int the id of the updated office
     *
     */
    public function destroy($id)
    {
        //
        OfficeBranch::where('id',$id)->delete();
    }
}
