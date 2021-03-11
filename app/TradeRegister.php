<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeRegister extends Model
{
    //
    protected $table = 'trade_registers';
    protected $guarded = [];
    protected $primaryKey ='id';


    public function institution(){
        return $this->belongsTo('App\institution');
    }
}
