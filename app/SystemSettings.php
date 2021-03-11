<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SystemSettings extends Model
{
    //

    protected $guarded = [];


    public function scopeWithLegalEntity($query){

        $query->addSelect('value as LegalEntity')
            ->where('name','LIKE','الكيان القانونى');
    }

}
