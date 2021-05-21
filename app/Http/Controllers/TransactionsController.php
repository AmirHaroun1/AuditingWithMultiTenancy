<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\institution;
use App\reviser;
use App\SystemSettings;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * @group  Manage Transactions
 *
 * APIs To Manage Transactions
 */
class TransactionsController extends Controller
{
    /**
     * in case of json response Retrieve The Transactions of the current user in this branch.
     * <br>
     * if the Auth User is 'مدير مراجعة ' and his office_branch.is_main all transactions would be retrieved
     * <br>
     * and based on the above condition you should show taps of available branches load them through the following end point.
     * ,route('OfficeBranches.index'), on clicking on any name of the branches send it as query param 'BranchOfficeID'
     * <br>
     * in case of non json response Returns Blade Transactions/index.blade.php.
     * <br>
     *
     *
     *
     * @urlParam  OrderByCase optional param of the OrderBy [Latest,oldest].
     * @urlParam  MainRegisterNumber optional param of the Search TreadRegister.
     * @queryParam BranchOfficeID optional param if the Auth User.role is 'مدير مراجعة' and his User.office_branch.is_main
     */
    public function index($OrderByCase="latest",$MainRegisterNumber=null)
    {

        if(\request()->expectsJson()){
            $transactions = Transaction::
            when(true, function($query){
                switch (auth()->user()->role)
                {
                    case "مراجع فني": return $query->where('reviser_id',auth()->user()->id);
                    case "مدقق": return $query->where('auditor_id',auth()->user()->id);
                    case "شريك اداري": return $query->where('partner_id',auth()->user()->id);
                }
            })
                ->when(!is_null($MainRegisterNumber),function($query) use ($MainRegisterNumber){
                    return $query->where('MainTradeRegisterNumber','=',$MainRegisterNumber);
                })
                ->when(!is_null($OrderByCase), function($query) use ($OrderByCase){
                    switch ($OrderByCase)
                    {
                        case "latest": return $query->latest();
                        case "oldest": return $query->OrderBy('created_at','ASC');
                    }
                })
                ->when( true  , function($query){
                    $CurrentAuth = Auth::user();
                    if($CurrentAuth->OfficeBranch->is_main && Auth::user()->role == 'مدير مراجعة'){
                        if(!is_null(\request('BranchOfficeID'))){
                            $query->where('branch_office_id',\request('BranchOfficeID'));
                        }
                    }else {
                        $query->where('branch_office_id',Auth::user()->branch_office_id);
                    }
                })
                ->paginate(10)
                ->appends(['OrderByCase'=> \request('OrderByCase'),
                    'MainRegisterNumber'=> \request('MainRegisterNumber'),
                    'BranchOfficeID'=>\request('BranchOfficeID')]);
            $transactions->append(['actual_start_date','hijri_actual_start_date','actual_end_date','hijri_actual_end_date','engagement_letter_date','hijri_engagement_letter_Date'])->toArray();
            return response()->json(['transactions'=>$transactions],200);
        }
        return view('Transactions.index');
    }
    public function create()
    {
        return view('Transactions.create');
    }

    public function store(StoreTransactionRequest $request, $institution_id ,$reviser_id){

        $NewTransaction = Transaction::create($request->all());
        $NewTransaction = Transaction::findOrFail($NewTransaction->id);
        $NewTransaction->institution_id = $institution_id;
        $NewTransaction->reviser_id = $reviser_id;
        $NewTransaction->MainTradeRegisterNumber = $request->MainTradeRegisterNumber;
        $NewTransaction->save();

        return response()->json([$NewTransaction],200);
    }

    public function edit($transaction_id){
        $Transaction = Transaction::with
        ('institution.MainTradeRegister',
            'institution.BranchedTradeRegister',
            'institution.agent',
            'reviser:id,name,role,signature',
            'auditor:id,name,role,signature',
            'fieldDelegate:id,name,role,signature',
            'revisingManager:id,name,role,signature',
            'partner:id,name,role,signature')
        ->findOrFail($transaction_id);
        $Transaction->append(['actual_start_date','hijri_actual_start_date','actual_end_date','hijri_actual_end_date','engagement_letter_date','hijri_engagement_letter_Date'])->toArray();
        return view('Transactions.edit',compact('Transaction'));
    }
    public function update(UpdateTransactionRequest $request, Transaction $transaction){
        if( ($transaction->auditor_id != null) && ($request->auditor_id != $transaction->auditor_id ) ){
            $request['auditor_is_changed'] = 1;
        }
        $transaction->update($request->all());

        return response()->json([$transaction],200);

    }
    public function updateActualTime(Transaction $transaction, Request $request){

        if($request->ActualTimeType == "secretary_actualTime"){

            $transaction->secretary_actualTime += $request->secretary_actualTime;

        }else if($request->ActualTimeType =="reviser_actualTime"){

            $transaction->reviser_actualTime += $request->reviser_actualTime;

        }else if($request->ActualTimeType == "revisingManager_actualTime"){

            $transaction->revisingManager_actualTime += $request->revisingManager_actualTime;

        }else if($request->ActualTimeType == "auditor_actualTime"){

            $transaction->auditor_actualTime += $request->auditor_actualTime;

        }else{
            $transaction->Managing_partner_actualTime += $request->Managing_partner_actualTime;
        }

        if( ($transaction->secretary_time < $transaction->secretary_actualTime ) || ($transaction->reviser_time < $transaction->reviser_actualTime ) || ($transaction->revisingManager_time < $transaction->revisingManager_actualTime ) || ($transaction->auditor_time < $transaction->auditor_actualTime ) || ($transaction->Managing_partner_time < $transaction->Managing_partner_time )){
            $transaction->time_status = "unacceptable";
        }
        $transaction->save();

        return response()->json([],200);
    }

    public function PrintReceiptVoucher($TransactionYear,$InistitutionName,$PaymentType,$PaymentValue,$ReviserCompanyName){
        return view('Transactions.ReceiptVoucher',compact('TransactionYear','InistitutionName','PaymentType','PaymentValue','ReviserCompanyName'));
    }

    public function PrintEngagementLetter(institution $Institution,Transaction $Transaction)
    {

        $Transaction->load(['partner:id,name,signature']);
        $OfficeInfo = SystemSettings::where('type','LIKE','بيانات المكتب')->first();
        if(!$OfficeInfo){
            return abort(403,'Please Set Office Info Data');
        }
          $Institution->load(['agent']);
        $Transaction->append(['actual_start_date','hijri_actual_start_date','actual_end_date','hijri_actual_end_date','engagement_letter_date','hijri_engagement_letter_Date'])->toArray();

        return view('Transactions.EngagementLetter',compact('Institution','Transaction','OfficeInfo'));
    }
}
