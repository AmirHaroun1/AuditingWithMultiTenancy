<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    //
    protected $table = 'documents';

    public function transactions(){
        return $this->belongsToMany('App\Transaction')->withPivot(['id','DocumentPath','original_name','comment']);
    }

    public  function scopeWithTransactionDocuments($query,$transactionID){

        return $query->with(['transactions'=>function($EagerLoadingQuery) use ($transactionID){
            $EagerLoadingQuery->where('transaction_id',$transactionID)->select('financial_year','end_financial_year','transactions.created_at');
        }]);
    }
}
