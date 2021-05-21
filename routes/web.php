<?php


use App\Events\JoiningRequestApproved;



use App\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerAdminDashboardController;
use App\User;
use App\Mail\WelcomingEmail;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\OwnerTenantsInfoController;



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

Route::get('/',function (){

    $role = Auth::user()->role;
    // Check user role
    switch ($role) {
        case ('owner'):{

            return redirect()->route('owner.dashboard');
            break;
        }
        default:
            return '/login';
            break;
    }
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
*/



Route::group(['prefix'=>'home'] ,function () {
   //
    Route::resource('/subscriptions',TenantSubscription::class,['as'=>'home'])->parameters([
        'subscriptions' => 'TenantID'
    ])->except(['destroy','show']);

});
/*
|--------------------------------------------------------------------------
| SuperAdmin Routes
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix'=>'OwnerAdmin','middleware'=>['auth','Owner']],function () {
    // dashboard route

    Route::get('/dashboard', [OwnerAdminDashboardController::class, 'index'])->name('owner.dashboard');

    Route::resource('/Subscriptions',OwnerTenantsController::class,['as'=>'owner']);
    Route::resource('/subscriber/{TenantID}/OfficeBranches',OwnerTenantsBranchesController::class,['as'=>'owner'])->except(['create','edit']); //owner.OfficeBranches.index
    /*
    |--------------------------------------------------------------------------
    |  OfficeInfo  Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/OfficeInfo/{TenantID}',[OwnerTenantsInfoController::class,'index'])->name('owner.officeInfo.index');
    Route::post('/StoreOfficeInfo/{TenantID}',[OwnerTenantsInfoController::class,'store'])->name('owner.officeInfo.store');
    Route::patch('/UpdateOfficeInfo/{TenantID}',[OwnerTenantsInfoController::class,'update'])->name('owner.officeInfo.update');


    Route::get('/ActivationConfirmed/{TenantID}','TenantSubscription@ActivateSubscription')->name('activate.subscription')->middleware('signed');

});
