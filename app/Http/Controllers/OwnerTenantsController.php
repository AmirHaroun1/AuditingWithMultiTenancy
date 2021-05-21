<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeTenantRequest;
use App\Http\Requests\updateTenantRequest;
use App\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * @group  Manage Subscriptions (Tenants)
 *
 * APIs To Manage Subscriptions
 */
class OwnerTenantsController extends Controller
{


    /**
     * Retrieve subscribers (Tenants) paginated
     * Note : Return views/Tenants/index.blade.php add your component their ----------
     * Note : return response if request expects json ----------
     * [id , name, email, status (pending,active,expired), subscription_price,subscription_date (TimeStamps),subscription_end_date,created_at,tenancy_db_name,domains[] ]
     *
     * Ziggy route : axios.get(route('owner.subscriptions.index'))
     *
     * --------------------------------- EXAMPLE OF data[0] in response ---------------------------------
     *
     *  "id": "KhalilOffice",<br>
     *  "name": "khalil ahmed",<br>
     *  "email": "",<br>
     *  "status": "pending",<br>
     *  "number_of_branches": 0,<br>
     *   "subscription_price": 3000,<br>
     *  "subscription_date": null,<br>
     *  "subscription_end_date": null,<br>
     *  "created_at": "2021-04-24T00:16:22.000000Z",<br>
     *  "updated_at": "2021-04-22T20:12:05.000000Z",<br>
     *  "tenancy_db_name": "tenantKhalilOffice",<br>
     *   <br>
     *  "domains": [
     * <br>
     *      {
     *      "id": 7,
     *      "domain": "khaliloffice",
     *      "tenant_id": "KhalilOffice",
     *      "created_at": "2021-04-22T20:12:09.000000Z",
     *      "updated_at": "2021-04-22T20:12:09.000000Z"
     *      }
     * <br>
     *         ]
     *
     *
     *
     * @queryParam  SearchTenantName string optional param if there is a search with Name.
     * @queryParam  CreationDate datetime optional param if there is a search with creation date.
     */
     public function index(){
        if(!\request()->expectsJson()){
            $TenantsWithDomains = Tenant::with('domains')
                ->when(!is_null(\request('SearchTenantName')),function ($query){
                    $query->where('name','LIKE','%'.\request('SearchTenantName').'%');
                })->when(!is_null(\request('CreationDate')),function($query){
                    $query->whereRaw('created_at = ?',[\request('CreationDate')]);
                })->paginate(20)->appends(['SearchTenantName'=>\request('SearchTenantName'),'CreationDate'=>\request('CreationDate')]);
            return response()->json(['TenantsWithDomains'=>$TenantsWithDomains],200);
        }
        return view('Owner.Tenants.index');
     }
    /**
     * create new subscriber blade,
     *  route : route('owner.subscriptions.create'),
     *  the create blade /resources/views/Owner/Tenants/create.blade.php --> add your component their
     *
     */
    public function create(){
        return view('Owner.Tenants.create');
    }
    /**
     * store new subscriber | Return NewSubscriber.
     * Ziggy route : axios.post(route('owner.subscriptions.store'),formData).
     * @bodyParam  id string required The Domain of the subscriber example KhalilOffice Note the full Office Url Will be KhalilOffice.Almudaqiq.com..
     * @bodyParam  domain string required The Domain of the subscriber example KhalilOffice Note the full Office Url Will be KhalilOffice.Almudaqiq.com..
     * @bodyParam  name string required The Name of the subscriber.
     * @bodyParam  email string required The Password of the subscriber.
     * @bodyParam  password string required The Password of the subscriber.
     * @bodyParam  status string required one of (pending,active) it will be the current status of the subscriber.
     * @bodyParam  number_of_branches int required The Number Of Branches of the subscriber.
     * @bodyParam  subscription_price double required The subscription_price.
     * @bodyParam  subscription_period_in_days int required The subscription period in days.
     * @bodyParam  CANCELLEDDONTADDsubscription_date string required The Password of the subscriber.
     * @bodyParam  CANCELLEDDONTADDsubscription_end_date string required The Password of the subscriber.
     */
    public function store(StoreTenantRequest $request){
        DB::beginTransaction();
        try {
            $createdTenant = Tenant::create([
                'id'=> $request->id ,
                'name' => $request->name,
                'email' => $request->email,
                'password' =>   Hash::make($request['password']),
                'status' => $request->status,
                'number_of_branches' => $request->number_of_branches,
                'subscription_price' => $request->subscription_price,
                'subscription_period_in_days' => $request->subscription_period_in_days,
                //'subscription_date' => $request->subscription_date,
                //'subscription_end_date' => $request->subscription_end_date,
            ]);
            $createdTenant->domains()->create(['domain' => $request->domain]);

            MailController::SendWelcomeMail($createdTenant);
            MailController::SendRequestApprovedEmail($createdTenant);
            return response()->json(['NewSubscriber'=>$createdTenant],200);
            DB::commit();
        } catch (\Exception $e) {
            return response()->json(['Error'=>$e],500);

            DB::rollback();
        }
    }
    /**
     * Retrieve One Tenant with his domains.
     * <br>
     * then Returns Blade Owner/Tenants/edit.blade.php.
     * <br>
     * Add Vue Component Their
     * <br>
     * route : route('owner.subscriptions.edit'),
     *
     *
     * @urlParam  TenantID required param of the Tenant (subscriber ID).
     */
    public function edit($TenantID){
        $Tenant = Tenant::where('id',$TenantID)->firstOrFail();
         $Tenant->load('domains');
         return $Tenant;
        return view('Owner.Tenants.edit',compact('Tenant'));
    }
    /**
     * Update the info of the subscriber and its domain.
     * Ziggy route : axios.post(route('owner.subscriptions.update',TenantID),formData).
     * <br>
     * formData.append('_method',"PATCH").
     * <br>
     *
     * @urlParam  TenantID required param of the Tenant (subscriber ID).
     * @bodyParam  name string required The Name of the subscriber.
     * @bodyParam  email string required The Password of the subscriber.
     * @bodyParam  password string required The Password of the subscriber.
     * @bodyParam  status string required one of (pending,active) it will be the current status of the subscriber.
     * @bodyParam  number_of_branches int required The Number Of Branches of the subscriber.
     * @bodyParam  subscription_price double required The subscription_price.
     * @bodyParam  subscription_period_in_days int required The subscription period in days.
     * @bodyParam  subscription_date string required The Password of the subscriber.
     * @bodyParam  subscription_end_date string required The Password of the subscriber.
     */
    public function update($TenantID,updateTenantRequest $request){
        DB::beginTransaction();
        try {
            $Tenant = Tenant::where('id',$TenantID)->firstOrFail();
            // if the subscription_date was null it means its a new tenant and we shall send activation email
            if($Tenant->subscription_date == null && $request['status'] == 'active'){
                MailController::SendRequestApprovedEmail($Tenant);
            }
            $Tenant->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'status' => $request->status,
                'number_of_branches' => $request->number_of_branches,
                'subscription_price' => $request->subscription_price,
                'subscription_date' => $request->subscription_date,
                'subscription_end_date' => $request->subscription_end_date,
            ]);
            return response()->json(['UpdatedSubscriber'=>$Tenant],200);

            DB::commit();
        } catch (\Exception $e) {
            return response()->json(['Error'=>$e],500);

            DB::rollback();
        }
    }
    /**
     * Delete the info of the subscriber and its domain
     * Ziggy route : axios.delete(route('owner.subscriptions.destroy',TenantID),formData).
     * <br>
     * @urlParam  TenantID required param of the Tenant (subscriber ID).
     */
    public function destroy($tenantID){
        Tenant::where('id',$tenantID)->firstOrFail()->delete();
        return response()->json([],200);
    }

}
