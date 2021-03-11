<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevisingGuid extends Model
{
    //
    protected $table = 'revising_guid';
    protected $guarded = [];


    public function children(){
        return $this->hasMany('App\RevisingGuid','parent_id');
    }
    public function transactions(){
        return $this->belongsToMany(Transaction::class,'revising_transaction','revising_id','transaction_id')
            ->withPivot([
                'status',
                'reference',
                'text',
                'first_value',
                'second_value',
                'third_value',
                'fourth_value',
            ]);
    }
}
