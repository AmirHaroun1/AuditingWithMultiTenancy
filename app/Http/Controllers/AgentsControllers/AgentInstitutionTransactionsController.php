<?php

namespace App\Http\Controllers\AgentsControllers;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group  Agent's institutions transactions
 *
 * Return Views To Manage Agent Institutions transactions
 */
class AgentInstitutionTransactionsController extends Controller
{
    //
    /**
     * blade contains all transactions of the agent
     * Return View Blade ---> add your component their --> /Agent/transactions/index.
     *
     *
     * Ziggy route : axios.get(route('agent.institutions.transactions.index'))
     *
     */
    public function index(){
        return view('Agent.transactions.index');
    }
    /**
     * blade contains Adding New Transaction for the agent
     * Return View Blade ---> add your component their --> /Agent/transactions/create.
     *
     *
     * Ziggy route : axios.get(route('agent.institutions.transactions.create'))
     */
    public function create(){
        return view('Agent.transactions.create');

    }
    /**
     * Retrieve Institution's certain Transaction
     * and return View Blade ---> add your component their --> /Agent/transactions/show.
     * <br>
     * The Transactions Object Is Sent to the blade.
     * <br>
     * and pass the Transaction prop <your-component :Transaction="{{$Transaction}}" ></>.
     *
     *
     * Ziggy route : axios.get(route('agent.institutions.transactions.show',transaction.id))
     *
     * @urlParam    transactionID integer required param of the Transaction id.
     *
     */
    public function show($transactionID){
        $Transaction = Transaction::with
        ('institution.MainTradeRegister',
            'institution.BranchedTradeRegister',
            'reviser:id,name,role,signature',
            'auditor:id,name,role,signature',
            'fieldDelegate:id,name,role,signature',
            'revisingManager:id,name,role,signature',
            'partner:id,name,role,signature')
            ->findOrFail($transactionID);
        if($Transaction->institution->agent_id != Auth::id()){
            abort(403,'Access Denied');
        }
        return view('Agent.transactions.show',compact('Transaction'));
    }

}
