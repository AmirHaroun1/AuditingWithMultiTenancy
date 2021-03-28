<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Block\Element\Document;

class DashBoardController extends Controller
{
    //

    public function index()
    {

        $TransactionsStatus = Transaction::currentStatistics();

         $Team = DB::table('transactions')
            ->join('users',function($join){
                $join->on('users.id', '=', 'transactions.reviser_id')
                      ->where('transactions.status','reviser');
                $join->orOn('users.id', '=', 'transactions.auditor_id')
                      ->Where('transactions.status','auditor');
                $join->orOn('users.id', '=', 'transactions.revisingManager_id')
                      ->Where('transactions.status','revising_manager');
                $join->orOn('users.id', '=', 'transactions.partner_id')
                       ->Where('transactions.status','managing_partner');
            })
            ->select('users.name','users.role',DB::raw('COUNT(*) AS ActiveTransactions'))
             ->groupBy(['users.name','users.role'])
            ->get();

        return view('SuperAdmin.dashboard.index',compact('TransactionsStatus','Team'));
    }
}
