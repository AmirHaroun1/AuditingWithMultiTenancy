<?php

namespace App\Http\Controllers;

use App\Tenant;


/**
 * @group  Owner Admin DashBoard
 *
 * API Send All Tenants Stats
 */
class OwnerAdminDashboardController extends Controller
{
    //

    /**
     * Retrieve Tenants Stats
     *
     * [Total Number Of Tenants , Pending Requests To Join, Active Tenants, Expired Tenants, The Money Made By Subscriptions This Month]
     * Ziggy route : axios.get(route('owner.dashboard'))
     * @response  {
     * "TenantsStats": {
     *  "TotalTenants": 4,
     *  "PendingTenants": 4,
     *  "ActiveTenants": 0,
     *  "ExpiredTenants": 0,
     *   "CurrentMonthIncome": 12000
     *  }
     *
     * }
     */
    public function index(){

        if(\request()->expectsJson()){
            $yearMonth = date("Y").'-'. date('m');

            $StartDate = $yearMonth . '-' .'01' . ' ' . '00:00';
            $EndDate = $yearMonth . '-' .'31' . ' ' . '23:59';
            $TenantsStats = Tenant::getQuery()
                ->selectRaw('count(id) as TotalTenants')
                ->selectRaw('COUNT( CASE WHEN STATUS = "pending" then 1 ELSE NULL END ) as PendingTenants')
                ->selectRaw('COUNT( CASE WHEN STATUS = "active" then 1 ELSE NULL END ) as ActiveTenants')
                ->selectRaw('COUNT( CASE WHEN STATUS = "expired" then 1 ELSE NULL END ) as ExpiredTenants')
                ->selectRaw('SUM( CASE WHEN created_at >= ? AND created_at <= ? THEN subscription_price ELSE NULL END ) as CurrentMonthIncome  ',[$StartDate,$EndDate])
                ->first();

            return response()->json(['TenantsStats'=>$TenantsStats],200);
        }

        return view('Owner.Dashboard.index');
    }
}
