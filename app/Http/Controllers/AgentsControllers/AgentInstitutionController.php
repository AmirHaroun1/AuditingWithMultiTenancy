<?php

namespace App\Http\Controllers\AgentsControllers;

use App\Http\Controllers\Controller;
use App\institution;
use Illuminate\Http\Request;
/**
 * @group  Agent's institutions
 *
 * Return Views To Manage Agent Institutions
 */
class AgentInstitutionController extends Controller
{
    //
    /**
     *
     * Returns Blade Agent/institutions/index.blade.php.
     * <br>
     * Add Vue Component Their
     * <br>
     * route : route('agent.institutions.index'),
     *
     *
     * @urlParam  TenantID required param of the Tenant (subscriber ID).
     */
    public function index(){
        return view('Agent.institutions.index');
    }
    /**
     * Retrieve certain  Institution
     * and return View Blade ---> add your component their --> /Agent/institutions/edit.
     * <br>
     * The Transactions Object Is Sent to the blade.
     * <br>
     * and pass the Transaction prop <your-component :Institution="{{$Institution}}" ></>.
     *
     *
     * Ziggy route : axios.get(route('agent.institutions.transactions.show',institution.id))
     *
     * @urlParam    institutionID integer required param of the institution id.
     *
     */
    public function show($institutionID){
        $Institution = institution::with('institution.MainTradeRegister'
            ,'institution.BranchedTradeRegister')->where('id',$institutionID)->firstOrFail();

        return view('Agent.institutions.show',compact('Institution'));

    }
}
