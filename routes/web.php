<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Main Routes
|--------------------------------------------------------------------------

*/

Route::get('/',function (){

    $role = Auth::user()->role;
    // Check user role
    switch ($role) {
        case ('سوبر'):{
            return redirect()->route('dashboard');
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
        case ('مدير مراجعة'):{
            return redirect()->route('Transactions.index.RevisingManager');
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

        default:
            return '/login';
            break;
    }
})->middleware('auth');
/*
|--------------------------------------------------------------------------
| SuperAdmin Routes
|--------------------------------------------------------------------------
*/
Route::group([ 'prefix'=>'SuperAdmin','middleware'=>['auth','SuperAdmin'] ],function (){
    // dashboard route
    Route::get('/dashboard', 'DashBoardController@index')->name('dashboard');
    //employees route
    Route::get('/ManageEmployees','employeesController@index')->name('employees.index');
    Route::get('/AddEmployee','employeesController@create')->name('employees.create');
    Route::post('/StoreNewEmployee','employeesController@store')->name('employees.store');
    Route::get('/EditEmployee/{employee}','employeesController@edit')->name('employees.edit');
    Route::get('/SearchEmployee/{employeeName}','employeesController@search')->name('employees.search');
    Route::patch('/UpdateEmployee/{employee}','employeesController@update')->name('employees.update');
    Route::delete('/DeleteEmployee/{employee}','employeesController@destroy')->name('employees.destroy');
    //DropDowns SystemSettings

    Route::get('/ManageDropDowns','SystemSettingsController@DropDownIndex')->name('system.DropDowns.index');
    Route::post('/StoreDropDownsOption','SystemSettingsController@StoreDropDownOption')->name('system.DropDowns.store.option');
    Route::delete('/DeleteDropDownsOption/{id}','SystemSettingsController@DeleteDropDownOption')->name('system.DropDowns.delete.option');
    Route::patch('/UpdateDropDownsOption/{id}','SystemSettingsController@UpdateDropDownOption')->name('system.DropDowns.update.option');
    //AccountCharts SystemSettings

    Route::get('/AccountCharts','SystemSettingsController@AccountChartsIndex')->name('system.AccountCharts.index');
    Route::post('/StoreAccountChart','SystemSettingsController@AccountChartsStore')->name('system.AccountCharts.store');
    Route::delete('/DeleteAccountChart/{id}/level/{level}','SystemSettingsController@AccountChartsDelete')->name('system.AccountCharts.delete');
    Route::patch('/UpdateAccountChart','SystemSettingsController@AccountChartsUpdate')->name('system.AccountCharts.update');

    //RevisingGuidRoutes
    Route::get('/ManageRevisingGuid','RevisingGuidController@manage')->name('revisingGuid.manage.admin');
    Route::patch('/UpdateRevisingGuid/{RevisingGuidID}','RevisingGuidController@update')->name('revisingGuid.update.admin');
    Route::post('/StoreNewRevisingGuid','RevisingGuidController@store')->name('revisingGuid.store.admin');
    Route::delete('/DeleteRevisingGuid/{RevisingGuidID}','RevisingGuidController@destroy')->name('revisingGuid.destroy.admin');

    //FinancialGroupRoutes
    Route::get('/ManageFinancialGroups','FinancialGroupsController@manage')->name('FinancialGroups.manage.admin');
    Route::patch('/UpdateFinancialGroup//{FinancialGroupID}','FinancialGroupsController@update')->name('FinancialGroups.update.admin');

    Route::post('/StoreNewFinancialGroup','FinancialGroupsController@store')->name('FinancialGroups.store.admin');
    Route::delete('/DeleteFinancialGroup/{FinancialGroupID}','FinancialGroupsController@destroy')->name('FinancialGroups.destroy.admin');


    //FinancialGroupAccountsRoutes

    Route::post('/LinkAccountToFinancialGroup/{FinancialGroupID}','FinancialGroupsAccountsController@store')->name('FinancialGroupsAccounts.store.admin');
    Route::delete('/UnLinkAccountFromFinancialGroup/{AccountID}','FinancialGroupsAccountsController@destroy')->name('FinancialGroupsAccounts.destroy.admin');

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
    Route::get('/Transactions', 'TransactionsController@index')->name('Transactions.index.Secretary');
    Route::get('/CreateTransaction', 'TransactionsController@create')->name('Transactions.create');
    Route::post('/StoreNewTransaction/institution/{institution}/reviser/{reviser}', 'TransactionsController@store')->name('Transactions.store');
    Route::get('/PrintReceiptVoucher/TransactionYear/{TransactionYear}/CompanyName/{CompanyName}/PaymentType/{PaymentType}/PaymentValue/{PaymentValue}/ReviserCompanyName/{ReviserCompanyName}','TransactionsController@PrintReceiptVoucher')->name('Print.ReceiptVoucher');
    Route::get('/EngagementLetter/institution/{institution}/transaction/{transaction}/','TransactionsController@PrintEngagementLetter')->name('Print.EngagementLetter');
    Route::get('/EditTransaction/{Transaction_id}','TransactionsController@edit')->name('transactions.edit.secretary');
    /*
    |--------------------------------------------------------------------------
    | institution Routes
    |--------------------------------------------------------------------------
    */
    Route::post('/StoreNewInstitution','InstitutionController@store')->name('Institution.store');
    Route::patch('/UpdateInstitution/{institution:id}','InstitutionController@update')->name('Institution.update');
    /*
    |--------------------------------------------------------------------------
    | Agent Routes
    |--------------------------------------------------------------------------
    */
    Route::post('/StoreNewAgentFor/{institution}','AgentController@store')->name('agent.store');

    Route::patch('/UpdateAgent/{agent}','AgentController@update')->name('agent.update');

    /*
    |--------------------------------------------------------------------------
    |  Trade Register Routes
    |--------------------------------------------------------------------------
    */
    Route::post('/SearchNewRegister','TradeRegisterController@search')->name('TradeRegister.search');

    Route::post('/StoreNewRegisterTrade/{institution:id}','TradeRegisterController@store')->name('TradeRegister.store');

    Route::patch('/UpdateRegister/{TradeRegister}','TradeRegisterController@update')->name('TradeRegister.update');


    Route::delete('/DeleteTradeRegister/{TradeRegisterID}','TradeRegisterController@delete')->name('TradeRegister.delete');


});

/*
|--------------------------------------------------------------------------
| Reviser Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'Reviser','middleware'=>['auth','Reviser'] ],function () {

    Route::get('/Transactions', 'TransactionsController@index')->name('Transactions.index.reviser');
    Route::get('/EditTransaction/{Transaction_id}','TransactionsController@edit')->name('transactions.edit.reviser');
});
/*
|--------------------------------------------------------------------------
| Auditor Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'TechnicalAuditor','middleware'=>['auth','auditor'] ],function () {

    Route::get('/Transactions', 'TransactionsController@index')->name('Transactions.index.auditor');
    Route::get('/EditTransaction/{Transaction_id}','TransactionsController@edit')->name('transactions.edit.auditor');

    Route::get('/AccountAvailableForExcelLinking/{TransactionID}','ExcelController@AccountsAvailable')->name('Excel.AvailableAccounts');
    Route::post('/GetUploadedAccountsExcelHeaders','ExcelController@GetExcelHeader')->name('AccountExcel.Header');

    Route::post('/StoreNewBranchedStatementAddedByExcel','ExcelController@store')->name('Excel.BranchedStatement.store');
    Route::delete('/DeleteExistingBranchedStatementAddedByExcel/{BranchedStatementID}/WhoseParent/{ParentID}','ExcelController@destroy')->name('Excel.BranchedStatement.destroy');
});

/*
|--------------------------------------------------------------------------
| get All Transactions JsonFormat
|--------------------------------------------------------------------------
*/
Route::get('/AllTransactions/{OrderByCase?}/{MainRegisterNumber?}','TransactionsController@index')->name('transactions.index');

/*
|--------------------------------------------------------------------------
| Management Partner Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'ManagementPartner','middleware'=>['auth','partner'] ],function () {

    Route::get('/Transactions', 'TransactionsController@index')->name('Transactions.index.partner');
Route::get('/EditTransaction/{Transaction_id}','TransactionsController@edit')->name('transactions.edit.partner');


});
/*
|--------------------------------------------------------------------------
| RevisingManager Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'RevisingManager','middleware'=>['auth','RevisingManager'] ],function () {

    Route::get('/Transactions', 'TransactionsController@index')->name('Transactions.index.RevisingManager');
    Route::get('/EditTransaction/{Transaction_id}','TransactionsController@edit')->name('transactions.edit.RevisingManager');

});
/*
|--------------------------------------------------------------------------
| Secretary Archive Routes
|--------------------------------------------------------------------------
*/
Route::group([ 'prefix'=>'ArchiveSecretary','middleware'=>['auth','ArchiveSecretary'] ],function () {

    Route::get('/Transactions', 'TransactionsController@index')->name('Transactions.index.archive');

    Route::get('/RevisingGuid/Transaction/{TransactionsID}/{WithRelation?}','RevisingGuidController@index')->name('RevisingGuid.index.archive');


    Route::get('/RevisingGuidList/{transactionID}/Guide/{RevisingGuidID}','RevisingGuidTransactionController@index')->name('RevisingGuidTransaction.index');

    Route::patch('/UpdateArchiveRecord/{transactionID}','RevisingGuidTransactionController@update')->name('RevisingGuidTransaction.update');

    Route::post('/StoreArchiveRecord/{transactionID}','RevisingGuidTransactionController@store')->name('RevisingGuidTransaction.store');

});
Route::group(['middleware'=>['auth'] ],function () {

    /*
    |--------------------------------------------------------------------------
    |  OfficeInfo  Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/OfficeInfo','SystemSettingsController@GetOfficeInfo')->name('system.officeInfo');
    Route::post('/StoreOfficeInfo','SystemSettingsController@StoreOfficeInfo')->name('system.officeInfo.store');
    Route::patch('/UpdateOfficeInfo','SystemSettingsController@UpdateOfficeInfo')->name('system.officeInfo.update');
    /*
    |--------------------------------------------------------------------------
    |  update Transaction Routes
    |--------------------------------------------------------------------------
    */
    Route::patch('/UpdateTransaction/{transaction:id}', 'TransactionsController@update')->name('Transactions.update');
    Route::patch('/UpdateTransactionActualTime/{transaction:id}', 'TransactionsController@updateActualTime')->name('Transactions.update.ActualTime');

    /*
    |--------------------------------------------------------------------------
    | Documents Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/Documents/{transactionID?}/document/{documentCode?}','DocumentsController@index')->name('documents.index');
    Route::post('/AddTransactionDocumentFor/{Transaction:id}/document/{document:id}','DocumentsController@AddDocument')->name('TransactionDocuments.AddDocument');
    Route::delete('/RemoveTransactionDocument/{documentID}','DocumentsController@RemoveDocument')->name('TransactionDocuments.removeDocument');
    Route::get('/DownloadDocuments/{documentPath}/name/{documentName}','DocumentsController@DownloadDocument')->name('TransactionDocuments.DownloadDocument');
    Route::patch('/AddDocumentComment','DocumentsController@UpdateDocument')->name('TransactionDocument.Update');
    /*
    |--------------------------------------------------------------------------
    |  dropdown  Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/GetDropDownsOptions','SystemSettingsController@DropDownIndex')->name('system.DropDowns.retrieve.option');

    Route::get('/GetEmployeesType/{employees_type}','employeesController@getEmployeeType')->name('employee.type');
    /*
    |--------------------------------------------------------------------------
    |  AccountCharts Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/AllAccountCharts','SystemSettingsController@RetrieveAllAccountCharts')->name('system.AccountCharts.retrieve');

    Route::get('/NestedAccountCharts','SystemSettingsController@AccountChartsIndex')->name('system.AccountCharts.index');
    /*
    |--------------------------------------------------------------------------
    |  AccountStatements Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/AllTransactionAccountsTreeWithStatements/{TransactionID}','TransactionAccountsStatementsController@AllTransactionAccountsWithStatements')->name('accounts.tree.statements');
    Route::get('/TransactionAccountStatements/{TransactionID}/account/{AccountID}/level/{AccountLevel}/WithoutReadOnlyData/{WithoutReadOnly?}','TransactionAccountsStatementsController@index')->name('accounts.statements.index');

    Route::get('/TransactionAccountsWithSumOfStatements/{TransactionID}','TransactionAccountsStatementsController@SumOfAccountsOfTransaction')->name('accounts.statements.sum');

    Route::post('/StoreNewTransactionAccountStatement/{transactionID}','TransactionAccountsStatementsController@store')->name('accounts.statements.store');

    Route::delete('/DeleteTransactionAccountStatements/{StatementID}','TransactionAccountsStatementsController@delete')->name('accounts.statements.delete');

    Route::patch('/UpdateTransactionAccountStatement/{StatementID}','TransactionAccountsStatementsController@update')->name('accounts.statements.update');

    Route::get('/TransactionAccountStatementsWithBranches/{TransactionID}/account/{AccountID}/level/{AccountLevel}','TransactionAccountsStatementsController@branches')->name('accounts.statements.branches');

    Route::get('/StatementReadOnlyDataForAccount/{TransactionID}/account/{Account_id}/Level/{AccountLevel}','TransactionAccountsStatementsController@GetReadOnlyVueEditorValues')->name('accounts.statements.ReadDataOnly');
    /*
    |--------------------------------------------------------------------------
    |  AccountStatements Branches Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/AccountStatementBranches/{StatementID}','TransactionAccountStatementBranchesController@index')->name('accounts.statements.branches.index');
    Route::patch('/UpdateBranchOfAccountStatement/{BranchedStatementID}','TransactionAccountStatementBranchesController@update')->name('accounts.statements.branches.update');

    Route::post('/StoreNewBranchedStatement','TransactionAccountStatementBranchesController@store')->name('accounts.statements.branches.store');
    /*
    |--------------------------------------------------------------------------
    |  AccountsInKind  Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/InKind/{TransactionID}','AccountsInKindController@index')->name('AccountsInKind.index');
    Route::post('/StoreNewInKind','AccountsInKindController@store')->name('AccountsInKind.store');
    Route::patch('/UpdateInKind/{InKindID}','AccountsInKindController@update')->name('AccountsInKind.update');
    Route::delete('/DeleteInKind/{InKindID}/Parent/{ParentStatementID}','AccountsInKindController@destroy')->name('AccountsInKind.destroy');


});
