<?php

namespace App;


use App\scopes\AgentsScope;

class agent extends User
{
    protected $table = 'users';
    protected $guarded = [];
    protected static function booted()
    {
        static::addGlobalScope(new AgentsScope);
    }
    public function setRoleAttribute()
    {
        $this->attributes['role'] = 'مندوب شركة';
    }
    public function institution()
    {
        return $this->hasMany('App\institution','agent_id');
    }
}
