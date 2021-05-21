<?php

declare(strict_types=1);

use App\Http\Controllers\AgentsControllers\AgentInstitutionTransactionsController;
use App\Http\Controllers\AgentsControllers\AgentInstitutionController;
use App\Http\Controllers\AgentsControllers\ApiControllers\ApiAgentInstitutionController;
use App\Http\Controllers\AgentsControllers\ApiControllers\ApiAgentInstitutionTransactionsController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\employeesController;
use App\Http\Controllers\FinancialGroupsAccountsController;
use App\Http\Controllers\FinancialGroupsController;
use App\Http\Controllers\SystemSettingsController;
use App\Http\Controllers\RevisingGuidController;
use App\Http\Controllers\RevisingGuidTransactionController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\TradeRegisterController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\TransactionAccountStatementBranchesController;
use App\Http\Controllers\AccountsInKindController;
use App\Http\Controllers\TransactionAccountsStatementsController;

use App\Tenant;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/


Route::middleware([
    'web',
    TenantAccessValidation::class,
    Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Auth::routes();
    Route::get('/',function (){

        $role = Auth::user()->role;
        // Check user role
        switch ($role) {
            case ('سوبر'):{
                return redirect()->route('dashboard.admin');
                break;
            }
            case ('مدير مراجعة'):{

                return redirect()->route('dashboard.RevisingManager');
                break;
            }
            case ('سكرتير'):{
                return redirect()->route('Transactions.index.Secretary');
                break;
            }
            case ('مراجع فني'):{
                return redirect()->route('Transactions.index.reviser');
                break;
            }
            case ('مدقق'):{
                return redirect()->route('Transactions.index.auditor');
                break;
            }

            case ('شريك اداري'):{
                return redirect()->route('Transactions.index.partner');
                break;
            }
            case ('سكرتير تنفيذي'):{
                return redirect()->route('Transactions.index.archive');
                break;
            }
            case ('مندوب شركة'):{
                return redirect()->route('agent.institutions.index');
                break;
            }

            default:
                return '/login';
                break;
        }
    })->middleware('auth');
    /*
    |--------------------------------------------------------------------------
    | Agent Routes
    |--------------------------------------------------------------------------
    */
    Route::group([ 'prefix'=>'Client','middleware'=>['auth'] ],function (){
     //   Route::resource('/Transactions',AgentTransactionsController::class,['as'=>'client']);
    });
    /*
    |--------------------------------------------------------------------------
    | SuperAdmin Routes
    |--------------------------------------------------------------------------
    */
    Route::group([ 'prefix'=>'SuperAdmin','middleware'=>['auth','SuperAdmin'] ],function (){
        // dashboard route
        Route::get('/dashboard', [DashBoardController::class,'index'])->name('dashboard.admin');
        //employees route
        Route::get('/ManageEmployees',[employeesController::class,'index'])->name('employees.index');
        Route::get('/AddEmployee',[employeesController::class,'create'])->name('employees.create');
        Route::post('/StoreNewEmployee',[employeesController::class,'store'])->name('employees.store');
        Route::get('/EditEmployee/{employee}',[employeesController::class,'edit'])->name('employees.edit');
        Route::get('/SearchEmployee/{employeeName}',[employeesController::class,'search'])->name('employees.search');
        Route::patch('/UpdateEmployee/{employee}',[employeesController::class,'update'])->name('employees.update');
        Route::delete('/DeleteEmployee/{employee}',[employeesController::class,'destroy'])->name('employees.destroy');
        //DropDowns SystemSettings

        Route::get('/ManageDropDowns',[SystemSettingsController::class,'DropDownIndex'])->name('system.DropDowns.index');
        Route::post('/StoreDropDownsOption',[SystemSettingsController::class,'StoreDropDownOption'])->name('system.DropDowns.store.option');
        Route::delete('/DeleteDropDownsOption/{id}',[SystemSettingsController::class,'DeleteDropDownOption'])->name('system.DropDowns.delete.option');
        Route::patch('/UpdateDropDownsOption/{id}',[SystemSettingsController::class,'UpdateDropDownOption'])->name('system.DropDowns.update.option');
        //AccountCharts SystemSettings

        Route::get('/AccountCharts',[SystemSettingsController::class,'AccountChartsIndex'])->name('system.AccountCharts.index');
        Route::post('/StoreAccountChart',[SystemSettingsController::class,'AccountChartsStore'])->name('system.AccountCharts.store');
        Route::delete('/DeleteAccountChart/{id}/level/{level}',[SystemSettingsController::class,'AccountChartsDelete'])->name('system.AccountCharts.delete');
        Route::patch('/UpdateAccountChart',[SystemSettingsController::class,'AccountChartsUpdate'])->name('system.AccountCharts.update');

        //RevisingGuidRoutes
        Route::get('/ManageRevisingGuid',[RevisingGuidController::class,'manage'])->name('revisingGuid.manage.admin');
        Route::patch('/UpdateRevisingGuid/{RevisingGuidID}',[RevisingGuidController::class,'update'])->name('revisingGuid.update.admin');
        Route::post('/StoreNewRevisingGuid',[RevisingGuidController::class,'store'])->name('revisingGuid.store.admin');
        Route::delete('/DeleteRevisingGuid/{RevisingGuidID}',[RevisingGuidController::class,'destroy'])->name('revisingGuid.destroy.admin');

        //FinancialGroupRoutes
        Route::get('/ManageFinancialGroups',[FinancialGroupsController::class,'manage'])->name('FinancialGroups.manage.admin');
        Route::patch('/UpdateFinancialGroup//{FinancialGroupID}',[FinancialGroupsController::class,'update'])->name('FinancialGroups.update.admin');

        Route::post('/StoreNewFinancialGroup',[FinancialGroupsController::class,'store'])->name('FinancialGroups.store.admin');
        Route::delete('/DeleteFinancialGroup/{FinancialGroupID}',[FinancialGroupsController::class,'destroy'])->name('FinancialGroups.destroy.admin');


        //FinancialGroupAccountsRoutes

        Route::post('/LinkAccountToFinancialGroup/{FinancialGroupID}',[FinancialGroupsAccountsController::class,'store'])->name('FinancialGroupsAccounts.store.admin');
        Route::delete('/UnLinkAccountFromFinancialGroup/{AccountID}',[FinancialGroupsAccountsController::class,'destroy'])->name('FinancialGroupsAccounts.destroy.admin');

    });

    /*
    |--------------------------------------------------------------------------
    | Secretary And Agent Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware'=>['auth','SecretaryAndAgent'] ],function () {
        Route::post('/StoreNewInstitution',[InstitutionController::class,'store'])->name('Institution.store');
        Route::post('/StoreNewRegisterTrade/{institution:id}',[TradeRegisterController::class,'store'])->name('TradeRegister.store');
        Route::post('/StoreNewTransaction', [TransactionsController::class,'store'])->name('Transactions.store');
    });
    /*
    |--------------------------------------------------------------------------
    | Secretary Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix'=>'Secretary','middleware'=>['auth','Secretary'] ],function (){
        /*
        |--------------------------------------------------------------------------
        | Transactions Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/Transactions', [TransactionsController::class,'index'])->name('Transactions.index.Secretary');
        Route::get('/CreateTransaction', [TransactionsController::class,'create'])->name('Transactions.create');
        Route::get('/PrintReceiptVoucher/TransactionYear/{TransactionYear}/CompanyName/{CompanyName}/PaymentType/{PaymentType}/PaymentValue/{PaymentValue}/ReviserCompanyName/{ReviserCompanyName}', [TransactionsController::class,'PrintReceiptVoucher'])->name('Print.ReceiptVoucher');
        Route::get('/EngagementLetter/institution/{institution}/transaction/{transaction}/',[TransactionsController::class,'PrintEngagementLetter'])->name('Print.EngagementLetter');
        Route::get('/EditTransaction/{Transaction_id}',[TransactionsController::class,'edit'])->name('transactions.edit.secretary')->middleware('CheckEmployeeHasAccess');
        /*
        |--------------------------------------------------------------------------
        | institution Routes
        |--------------------------------------------------------------------------
        */
        Route::patch('/UpdateInstitution/{institution:id}',[InstitutionController::class,'update'])->name('Institution.update');
        /*
        |--------------------------------------------------------------------------
        | Agent Routes
        |--------------------------------------------------------------------------
        */
        Route::post('/StoreNewAgentFor/{institution}',[AgentController::class,'store'])->name('agent.store');

        Route::patch('/UpdateAgent/{agent}',[AgentController::class,'update'])->name('agent.update');

        /*
        |--------------------------------------------------------------------------
        |  Trade Register Routes
        |--------------------------------------------------------------------------
        */
        Route::post('/SearchNewRegister',[TradeRegisterController::class,'search'])->name('TradeRegister.search');
        Route::patch('/UpdateRegister/{TradeRegister}',[TradeRegisterController::class,'update'])->name('TradeRegister.update');
        Route::delete('/DeleteTradeRegister/{TradeRegisterID}',[TradeRegisterController::class,'delete'])->name('TradeRegister.delete');


    });

    /*
    |--------------------------------------------------------------------------
    | Reviser Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix'=>'Reviser','middleware'=>['auth','Reviser'] ],function () {

        Route::get('/Transactions', [TransactionsController::class,'index'])->name('Transactions.index.reviser');
        Route::get('/EditTransaction/{Transaction_id}',[TransactionsController::class,'edit'])->name('transactions.edit.reviser')->middleware('CheckEmployeeHasAccess');
    });
    /*
    |--------------------------------------------------------------------------
    | Auditor Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix'=>'TechnicalAuditor','middleware'=>['auth','auditor'] ],function () {

        Route::get('/Transactions', [TransactionsController::class,'index'])->name('Transactions.index.auditor');
        Route::get('/EditTransaction/{Transaction_id}',[TransactionsController::class,'edit'])->name('transactions.edit.auditor')->middleware('CheckEmployeeHasAccess');

        Route::get('/AccountAvailableForExcelLinking/{TransactionID}',[ExcelController::class,'AccountsAvailable'])->name('Excel.AvailableAccounts');
        Route::post('/GetUploadedAccountsExcelHeaders',[ExcelController::class,'GetExcelHeader'])->name('AccountExcel.Header');

        Route::post('/StoreNewBranchedStatementAddedByExcel',[ExcelController::class,'store'])->name('Excel.BranchedStatement.store');
        Route::delete('/DeleteExistingBranchedStatementAddedByExcel/{BranchedStatementID}/WhoseParent/{ParentID}',[ExcelController::class,'destroy'])->name('Excel.BranchedStatement.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | get All Transactions JsonFormat
    |--------------------------------------------------------------------------
    */
    Route::get('/AllTransactions/{OrderByCase?}/{MainRegisterNumber?}',[TransactionsController::class,'index'])->name('transactions.index');

    /*
    |--------------------------------------------------------------------------
    | Management Partner Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix'=>'ManagementPartner','middleware'=>['auth','partner'] ],function () {

        Route::get('/Transactions', [TransactionsController::class,'index'])->name('Transactions.index.partner');
        Route::get('/EditTransaction/{Transaction_id}',[TransactionsController::class,'edit'])->name('transactions.edit.partner')->middleware('CheckEmployeeHasAccess');


    });
    /*
    |--------------------------------------------------------------------------
    | RevisingManager Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix'=>'RevisingManager','middleware'=>['auth','RevisingManager'] ],function () {
        // dashboard route
        Route::get('/dashboard', [DashBoardController::class,'index'])->name('dashboard.RevisingManager');
        Route::get('/Transactions', [TransactionsController::class,'index'])->name('Transactions.index.RevisingManager');
        Route::get('/EditTransaction/{Transaction_id}',[TransactionsController::class,'edit'])->name('transactions.edit.RevisingManager')->middleware('CheckEmployeeHasAccess');

    });
    /*
    |--------------------------------------------------------------------------
    | Secretary Archive Routes
    |--------------------------------------------------------------------------
    */
    Route::group([ 'prefix'=>'ArchiveSecretary','middleware'=>['auth','ArchiveSecretary'] ],function () {

        Route::get('/Transactions', [TransactionsController::class,'index'])->name('Transactions.index.archive');

        Route::get('/RevisingGuid/Transaction/{TransactionsID}/{WithRelation?}',[RevisingGuidController::class,'index'])->name('RevisingGuid.index.archive');


        Route::get('/RevisingGuidList/{transactionID}/Guide/{RevisingGuidID}',[RevisingGuidTransactionController::class,'index'])->name('RevisingGuidTransaction.index');

        Route::patch('/UpdateArchiveRecord/{transactionID}',[RevisingGuidTransactionController::class,'update'])->name('RevisingGuidTransaction.update');

        Route::post('/StoreArchiveRecord/{transactionID}',[RevisingGuidTransactionController::class,'store'])->name('RevisingGuidTransaction.store');

    });
    Route::group(['middleware'=>['auth'] ],function () {

        /*
        |--------------------------------------------------------------------------
        |  OfficeInfo  Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/OfficeInfo',[SystemSettingsController::class,'GetOfficeInfo'])->name('system.officeInfo');
        Route::post('/StoreOfficeInfo',[SystemSettingsController::class,'StoreOfficeInfo'])->name('system.officeInfo.store');
        Route::patch('/UpdateOfficeInfo',[SystemSettingsController::class,'UpdateOfficeInfo'])->name('system.officeInfo.update');
        /*
        |--------------------------------------------------------------------------
        |  update Transaction Routes
        |--------------------------------------------------------------------------
        */
        Route::patch('/UpdateTransaction/{transaction:id}', [TransactionsController::class,'update'])->name('Transactions.update');
        Route::patch('/UpdateTransactionActualTime/{transaction:id}', [TransactionsController::class,'updateActualTime'])->name('Transactions.update.ActualTime');

        /*
        |--------------------------------------------------------------------------
        | Documents Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/Documents/{transactionID?}/document/{documentCode?}',[DocumentsController::class,'index'])->name('documents.index');
        Route::post('/AddTransactionDocumentFor/{Transaction:id}/document/{document:id}',[DocumentsController::class,'AddDocument'])->name('TransactionDocuments.AddDocument');
        Route::delete('/RemoveTransactionDocument/{documentID}',[DocumentsController::class,'RemoveDocument'])->name('TransactionDocuments.removeDocument');
        Route::get('/DownloadDocuments/{documentPath}/name/{documentName}',[DocumentsController::class,'DownloadDocument'])->name('TransactionDocuments.DownloadDocument');
        Route::patch('/AddDocumentComment',[DocumentsController::class,'UpdateDocument'])->name('TransactionDocument.Update');
        /*
        |--------------------------------------------------------------------------
        |  dropdown  Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/GetDropDownsOptions',[SystemSettingsController::class,'DropDownIndex'])->name('system.DropDowns.retrieve.option');

        Route::get('/GetEmployeesType/{employees_type}',[employeesController::class,'getEmployeeType'])->name('employee.type');
        /*
        |--------------------------------------------------------------------------
        |  AccountCharts Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/AllAccountCharts',[SystemSettingsController::class,'RetrieveAllAccountCharts'])->name('system.AccountCharts.retrieve');

        Route::get('/NestedAccountCharts',[SystemSettingsController::class,'AccountChartsIndex'])->name('system.AccountCharts.index');
        /*
        |--------------------------------------------------------------------------
        |  AccountStatements Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/AllTransactionAccountsTreeWithStatements/{TransactionID}',[TransactionAccountsStatementsController::class,'AllTransactionAccountsWithStatements'])->name('accounts.tree.statements');
        Route::get('/TransactionAccountStatements/{TransactionID}/account/{AccountID}/level/{AccountLevel}/WithoutReadOnlyData/{WithoutReadOnly?}',[TransactionAccountsStatementsController::class,'index'])->name('accounts.statements.index');

        Route::get('/TransactionAccountsWithSumOfStatements/{TransactionID}',[TransactionAccountsStatementsController::class,'SumOfAccountsOfTransaction'])->name('accounts.statements.sum');

        Route::post('/StoreNewTransactionAccountStatement/{transactionID}',[TransactionAccountsStatementsController::class,'store'])->name('accounts.statements.store');

        Route::delete('/DeleteTransactionAccountStatements/{StatementID}',[TransactionAccountsStatementsController::class,'delete'])->name('accounts.statements.delete');

        Route::patch('/UpdateTransactionAccountStatement/{StatementID}',[TransactionAccountsStatementsController::class,'update'])->name('accounts.statements.update');

        Route::get('/TransactionAccountStatementsWithBranches/{TransactionID}/account/{AccountID}/level/{AccountLevel}',[TransactionAccountsStatementsController::class,'branches'])->name('accounts.statements.branches');

        Route::get('/StatementReadOnlyDataForAccount/{TransactionID}/account/{Account_id}/Level/{AccountLevel}',[TransactionAccountsStatementsController::class,'GetReadOnlyVueEditorValues'])->name('accounts.statements.ReadDataOnly');
        /*
        |--------------------------------------------------------------------------
        |  AccountStatements Branches Routes
        |--------------------------------------------------------------------------
        */

        Route::get('/AccountStatementBranches/{StatementID}',[TransactionAccountStatementBranchesController::class,'index'])->name('accounts.statements.branches.index');
        Route::patch('/UpdateBranchOfAccountStatement/{BranchedStatementID}',[TransactionAccountStatementBranchesController::class,'update'])->name('accounts.statements.branches.update');

        Route::post('/StoreNewBranchedStatement',[TransactionAccountStatementBranchesController::class,'store'])->name('accounts.statements.branches.store');
        /*
        |--------------------------------------------------------------------------
        |  AccountsInKind  Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/AccountsHasInKind/{TransactionID}',[AccountsInKindController::class,'index'])->name('AccountsStatementsHaveInKind.index');
        Route::get('/InKind/{AccountStatementID}',[AccountsInKindController::class,'AccountStatementInKind'])->name('AccountStatementInKind');

        Route::post('/StoreNewInKind',[AccountsInKindController::class,'store'])->name('AccountsInKind.store');
        Route::patch('/UpdateInKind/{InKindID}',[AccountsInKindController::class,'update'])->name('AccountsInKind.update');
        Route::delete('/DeleteInKind/{InKindID}/Parent/{ParentStatementID}',[AccountsInKindController::class,'destroy'])->name('AccountsInKind.destroy');

        /*
        |--------------------------------------------------------------------------
        |  Agent(client) AgentsInstitutions  Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/client/institutions',[AgentInstitutionController::class,'index'])->name('agent.institutions.index');
        Route::get('/client/institutions/{institutionID}',[AgentInstitutionController::class,'show'])->name('agent.institutions.show');

        /*
        |--------------------------------------------------------------------------
        |  Agent(client) AgentsInstitutions Transactions Routes
        |--------------------------------------------------------------------------
        */
        Route::get('/client/institutions/transactions',[AgentInstitutionTransactionsController::class,'index'])->name('agent.institutions.transactions.index');
        Route::get('/client/institution/transaction/{transactionID}',[AgentInstitutionTransactionsController::class,'show'])->name('agent.institutions.transactions.show');
        Route::get('/client/transaction/create',[AgentInstitutionTransactionsController::class,'create'])->name('agent.institutions.transactions.create');

    });
});

// Api routes
Route::middleware(['api',
    TenantAccessValidation::class,
    Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('api')->group(function () {
    /*
    |--------------------------------------------------------------------------
    |  (client) AgentsInstitutions  Routes
    |--------------------------------------------------------------------------
    */
  Route::get('/client/institutions',[ApiAgentInstitutionController::class,'index'])->name('api.agent.institutions.index');
  /*
  |--------------------------------------------------------------------------
  |  (client) AgentsInstitutions Transactions Routes
  |--------------------------------------------------------------------------
  */
  Route::get('/client/institution/{institutionID}/Transactions',[ApiAgentInstitutionTransactionsController::class,'index'])->name('api.agent.institutions.transactions.index');

});
