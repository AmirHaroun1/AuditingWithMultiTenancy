<?php

namespace App\Http\Controllers;


use App\Http\Requests\storeTenantRequest;
use App\Http\Requests\updateTenantRequest;
use App\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @group  Tenants users to Manage subscribing
 *
 * views and APIs To view & store & update Subscriptions
 */
class TenantSubscription extends Controller
{
    //
    /**
     * return view that shows the subscribing Main page ,
     *  route : route('home.subscriptions.index'),
     *  the index blade /resources/views/FrontPreviews/Subscriptions/index.blade.php --> add your component their
     *
     */
    public function index(){
        // return view
        return view('FrontPreview.Subscriptions.index');
    }
    /**
     *  return view that shows the current tenant subscription details page.<br>
     *  route : route('home.subscriptions.edit',{'TenantID':TenantID}). <br>
     *  the edit blade /resources/views/FrontPreviews/Subscriptions/edit.blade.php --> add your component their.
     *  <br>
     *  <your-component-name :Subscriper="{{$Subscriber}}"></your-component-name>
     *  @urlParam  TenantID required param of the Tenant (subscriber ID).
     */
    public function edit($TenantID){
        $Subscriber = Tenant::where('id','LIKE',$TenantID)->firstOrFail();

        return view('FrontPreview.Subscriptions.edit',compact('Subscriber'));
    }
    /**
     * return view that shows the create new subscription page.
     * <br>
     *  route : route('home.subscriptions.create'),
     *  the index blade /resources/views/FrontPreviews/Subscriptions/create.blade.php --> add your component their
     */
    public function create(){
        return view('FrontPreview.Subscriptions.create');
    }
    /**
     *  Store New subscription.
     * <br>
     *  route : route('home.subscriptions.store'),
     *  @bodyParam  id string required The Domain of the subscriber example KhalilOffice Note the full Office Url Will be KhalilOffice.Almudaqiq.com..
     *  @bodyParam  domain string required The Domain of the subscriber example KhalilOffice Note the full Office Url Will be KhalilOffice.Almudaqiq.com..
     *  @bodyParam  name string required The Name of the subscriber.
     *  @bodyParam  email string required The Password of the subscriber.
     *  @bodyParam  password string required The Password of the subscriber.
     */
    public function store(StoreTenantRequest $request){

        $OwnerTenantsController = new OwnerTenantsController();
        $request['status'] = 'pending';
        $response = $OwnerTenantsController->store($request);
        return $response;
    }
    /**
     *  update New subscription.
     *
     * route : route('home.subscriptions.update'),
     * @urlParam   TenantID required param of the Tenant (subscriber ID),
     * @bodyParam  name string required The Name of the subscriber.
     * @bodyParam  email string required The Email of the subscriber.
     * @bodyParam  password string required The Password of the subscriber.
     */
    public function update($TenantID,updateTenantRequest $request){

        $OwnerTenantsController = new OwnerTenantsController();
        $request['status'] = 'pending';
        $response = $OwnerTenantsController->update($TenantID,$request);
        return $response;
    }

    public function ActivateSubscription($TenantID){
        $Tenant = Tenant::where('id','LIKE',$TenantID)->firstOrFail();
        if($Tenant->status == 'active'){
            abort(403,'unauthorized action');
        }
        $Tenant->status = 'active';
        $Tenant->subscription_date = now();
        $Tenant->subscription_end_date = Carbon::now()->addDays($Tenant->subscription_period_in_days);
        $Tenant->save();
    }
}
