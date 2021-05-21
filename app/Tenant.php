<?php

namespace App;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;
    protected $hidden = ['password'];


    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'password',
            'status',
            'number_of_branches',
            'subscription_price',
            'subscription_period_in_days',
            'subscription_date',
            'subscription_end_date',
            'activation_token',
            'created_at',
            'updated_at',
        ];
    }
    public static function getDataColumn(): string
    {
        return 'data';
    }

}
