<?php

namespace App;

use App\Scopes\AuditorScope;
use Illuminate\Database\Eloquent\Model;

class auditor extends Model
{
    //
    protected $table = 'users';
    protected $guarded = [];
    protected static function booted()
    {
        static::addGlobalScope(new AuditorScope());
    }
    public function setRoleAttribute()
    {
        $this->attributes['role'] = 'مدقق';
    }
    public function transactions()
    {
        return $this->hasMany('App\institution','auditor_id');
    }
}
