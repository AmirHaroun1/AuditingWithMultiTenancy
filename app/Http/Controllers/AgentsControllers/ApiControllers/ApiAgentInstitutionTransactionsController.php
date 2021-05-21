<?php

namespace App\Http\Controllers\AgentsControllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group  API Agent's institutions Transactions
 *
 * API To Manage Agent's institutions Transactions
 */
class ApiAgentInstitutionTransactionsController extends Controller
{
    //
    /**
     * Retrieve Agent's Institutions All Transactions
     *
     *
     * Ziggy route : axios.get(route('api.agent.institutions.transactions.index',institution.id))
     *
     * @urlParam    institutionID integer required param of the institution id.
     * @queryParam  OrderByCase string optional param ['latest','oldest'].
     *
     *
     */
    public function index($institutionID){
        $Transactions = Transaction::where('institution_id',$institutionID)
            ->select('total_value','status','financial_year','start_financial_year','end_financial_year','created_at','institutionID')
            ->when(true , function ($query){
                $OrderByCase = \request('OrderByCase');
                if(is_null($OrderByCase)){
                    $OrderByCase = "latest";
                }
                switch ($OrderByCase)
                {
                    case "latest": return $query->latest();
                    case "oldest": return $query->OrderBy('created_at','ASC');
                }
            })
            ->paginate(10)->appends([
                'OrderByCase'=>\request('OrderByCase')
            ]);
        return response()->json(['Transactions'=>$Transactions],200);

    }


}
