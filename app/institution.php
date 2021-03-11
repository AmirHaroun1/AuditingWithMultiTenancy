<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class institution extends Model
{
    //

    protected $guarded = [];

    public static function boot() {
        parent::boot();

    }
    public function agent(){
        return $this->belongsTo('App\User','agent_id');
    }
    public function TradeRegisters()
    {
        return $this->hasMany('App\TradeRegister');
    }
    public function MainTradeRegister()
    {
        return $this->hasMany('App\TradeRegister','institution_id')->where('type','LIKE','رئيسي');
    }
    public function BranchedTradeRegister()
    {
        return $this->hasMany('App\TradeRegister','institution_id')->where('type','LIKE','فرعي');
    }
    public function Transactions(){
        return $this->hasMany('App\Transaction','institution_id');
    }

}
