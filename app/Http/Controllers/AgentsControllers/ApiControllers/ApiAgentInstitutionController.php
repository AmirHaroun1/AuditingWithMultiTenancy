<?php

namespace App\Http\Controllers\AgentsControllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group  API Agent's institutions
 *
 * API To Manage Agent's institutions
 */
class ApiAgentInstitutionController extends Controller
{
    //
    /**
     * Retrieve Agent's Institutions
     *
     *
     * Ziggy route : axios.get(route('api.agent.institutions.index'))
     *
     * @queryParam  InstitutionName string optional param if there is a search with Institution Name.
     * @queryParam  MainTradeRegisterNumber integer optional param if there is a search with Main Trade Register Number.
     * @queryParam  OrderByCase string optional param ['latest','oldest'].
     *
     *
     */
    public function index(){

        $institutions = institution::where('agent_id',Auth::id())
            ->when(!is_null(\request('InstitutionName')),function ($query){
                $query->where('name','LIKE',\request('InstitutionName'));
            })
            ->when(!is_null(\request('MainTradeRegisterNumber')),function ($query){
                $query->whereHas('MainTradeRegister',function ($WhereHasQuery){
                    $WhereHasQuery->where('number',\request('TradeRegisterNumber'));
                });
            })
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
            ->latest()
            ->paginate(10)->appends([
                'InstitutionName'=> \request('InstitutionName'),
                'MainTradeRegisterNumber'=> \request('MainTradeRegisterNumber'),
                'OrderByCase'=>\request('OrderByCase')
            ]);

        return response()->json(['institutions'=>$institutions],200);
    }
}
