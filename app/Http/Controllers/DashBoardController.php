<?php

namespace App\Http\Controllers;

use App\OfficeBranch;

use Illuminate\Support\Facades\DB;
use League\CommonMark\Block\Element\Document;

class DashBoardController extends Controller
{
    //
    /**
     * @group  dashboard
     *
     * Retrieve Dash Board Data
     */
    public function index()
    {

        /**
         * By Default in case of no QueryParam 'OfficeBranchNumber' it retrieves the first branch office data.
         * <br>
         * @queryParam OfficeBranchNumber optional integer determine the returned office
         *
         * @response{
         *
         * }
         */
        $RequestOfficeNumber  = request('OfficeBranchNumber');
        $OfficeBranch = OfficeBranch::WithOfficeTransactionsStats()
            ->when(!is_null($RequestOfficeNumber),function ($query) use ($RequestOfficeNumber){
                $query->where('id',$RequestOfficeNumber);
            })
            ->first();
        // $TransactionsStatus = Transaction::currentStatistics();
        $Team = DB::table('transactions')
            ->where('transactions.branch_office_id',$OfficeBranch->id)
            ->join('users',function($join){
                $join->on('users.id', '=', 'transactions.reviser_id')
                    ->where('transactions.status','reviser');
                $join->orOn('users.id', '=', 'transactions.auditor_id')
                    ->where('transactions.status','auditor');
                $join->orOn('users.id', '=', 'transactions.revisingManager_id')
                    ->where('transactions.status','revising_manager');
                $join->orOn('users.id', '=', 'transactions.partner_id')
                    ->where('transactions.status','managing_partner');
            })
            ->where('users.branch_office_id',$OfficeBranch->id)
            ->select('users.name','users.role',DB::raw('COUNT(*) AS ActiveTransactions'))
            ->groupBy(['users.name','users.role'])
            ->get();

        return view('SuperAdmin.dashboard.index',compact('OfficeBranch','Team'));
    }
}
