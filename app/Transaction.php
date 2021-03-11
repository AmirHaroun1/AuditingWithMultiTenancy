<?php

namespace App;

use Alkoumi\LaravelHijriDate\Hijri;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use function GuzzleHttp\Psr7\copy_to_string;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    //
    protected $guarded = [];
    protected $appends =['hijri_financial_year','hijri_created_at','engagement_letter_date','hijri_engagement_letter_Date'];
    protected $dates = ['created_at', 'updated_at'];

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->format('Y / m / d');
    }

    public function getHijriFinancialYearAttribute(){

       return Hijri::Date('Y ','ar',Carbon::createFromDate($this->attributes['financial_year'],1,1) );
    }

    public function getEngagementLetterDateAttribute(){

       return Carbon::parse($this->attributes['created_at'])->addDays(2)->format('Y / m / d');
    }

    public function getHijriEngagementLetterDateAttribute(){

        return Hijri::Date('Y / m / j','ar', Carbon::parse($this->attributes['created_at'])->addDays(2)  );
    }
    public function getHijriCreatedAtAttribute(){


       return Hijri::Date('Y /m / j','ar',$this->attributes['created_at']);

    }
    public function getEndFinancialYearAttribute(){

        return Carbon::parse($this->attributes['end_financial_year'])->format('Y-m-d');
    }

    public function reviser(){
        return $this->belongsTo('App\reviser','reviser_id');
    }

    public function auditor(){
        return $this->belongsTo('App\auditor','auditor_id');
    }
    public function fieldDelegate(){
        return $this->belongsTo('App\User','fieldDelegate_id');
    }
    public function partner(){
        return $this->belongsTo('App\User','partner_id');
    }
    public function revisingManager(){
        return $this->belongsTo('App\User','revisingManager_id');
    }

    public function institution(){
        return $this->belongsTo('App\institution','institution_id');
    }

    public function documentations(){
        return $this->belongsToMany('App\document')->withPivot(['id','DocumentPath','original_name','comment']);
    }
    public function FirstLVLAccounts(){
        return $this->belongsToMany(AccountLVL1::class,'account_transaction','transaction_id','first_level_account_id')
            ->using(account_transaction::class)
            ->withPivot([
                'id',
                'name',
                'code',
            ]);
    }
    public function SecondLVLAccounts(){
        return $this->belongsToMany(AccountLVL2::class,'account_transaction','transaction_id','second_level_account_id')
            ->using(account_transaction::class)
            ->withPivot([
                'id',
                'name',
                'code',
            ]);
    }
    public function ThirdLVLAccounts(){
        return $this->belongsToMany(AccountLVL3::class,'account_transaction','transaction_id','third_level_account_id')
            ->using(account_transaction::class)
            ->withPivot([
                'id',
                'name',
                'code',
            ]);
    }
    public function FourthLVLAccounts(){
        return $this->belongsToMany(AccountLVL4::class,'account_transaction','transaction_id','fourth_level_account_id')
            ->using(account_transaction::class)
            ->withPivot([
                'id',
                'name',
                'code',
            ]);
    }

    public function StoreNewFirstLvlAccountStatement($request){
        $this->FirstLVLAccounts()
            ->attach($request->first_level_account_id,[
                'name'=>$request->name,
                'code'=>$request->code,
                'account_level'=>$request->account_level,

                'current_year'=>$request->current_year,
                'current_year_creditor'=>$request->current_year_creditor,
                'current_year_debtor'=>$request->current_year_debtor,

                'first_past_year'=>$request->first_past_year,

                'second_past_year'=>$request->second_past_year,

                'third_past_year'=>$request->third_past_year,

                'fourth_past_year'=>$request->fourth_past_year,

                'policy' => $request->policy,
                'considerations' => $request->considerations,
                'study' => $request->study,
                'second_study' => $request->second_study,

                'ReadDataOnly' => $request->ReadDataOnly,
                'is_related_party' => $request->is_related_party,
                'related_party_type' => $request->related_party_type,
                'related_party_branch' => $request->related_party_branch

            ]);

       // return $this->FirstLVLAccounts()->latest('id')->first()->pivot->id;
        return DB::table('account_transaction')->where('transaction_id',$this->attributes['id'])->where('first_level_account_id','!=',null)->latest('id')->select('id')->first();

    }
    public function StoreNewSecondLvlAccountStatement($request){
        $this->SecondLVLAccounts()
            ->attach($request->second_level_account_id,[
                'name'=>$request->name,
                'code'=>$request->code,
                'account_level'=>$request->account_level,

                'current_year'=>$request->current_year,
                'current_year_creditor'=>$request->current_year_creditor,
                'current_year_debtor'=>$request->current_year_debtor,

                'first_past_year'=>$request->first_past_year,

                'second_past_year'=>$request->second_past_year,

                'third_past_year'=>$request->third_past_year,

                'fourth_past_year'=>$request->fourth_past_year,

                'policy' => $request->policy,
                'considerations' => $request->considerations,
                'study' => $request->study,
                'second_study' => $request->second_study,
                'ReadDataOnly' => $request->ReadDataOnly,

                'is_related_party' => $request->is_related_party,
                'related_party_type' => $request->related_party_type,
                'related_party_branch' => $request->related_party_branch

            ]);
     //   return $this->SecondLVLAccounts()->latest('id')->first()->pivot->id;
        return DB::table('account_transaction')->where('transaction_id',$this->attributes['id'])->where('second_level_account_id','!=',null)->latest('id')->select('id')->first();

    }
    public function StoreNewThirdLvlAccountStatement($request)
    {
        $this->ThirdLVLAccounts()
            ->attach($request->third_level_account_id,[
                'name'=>$request->name,
                'code'=>$request->code,
                'account_level'=>$request->account_level,

                'current_year'=>$request->current_year,
                'current_year_creditor'=>$request->current_year_creditor,
                'current_year_debtor'=>$request->current_year_debtor,

                'first_past_year'=>$request->first_past_year,

                'second_past_year'=>$request->second_past_year,

                'third_past_year'=>$request->third_past_year,

                'fourth_past_year'=>$request->fourth_past_year,

                'policy' => $request->policy,
                'considerations' => $request->considerations,
                'study' => $request->study,
                'second_study' => $request->second_study,
                'ReadDataOnly' => $request->ReadDataOnly,

                'is_related_party' => $request->is_related_party,
                'related_party_type' => $request->related_party_type,
                'related_party_branch' => $request->related_party_branch

            ]);
        //return $this->ThirdLVLAccounts()->latest('id')->first()->pivot->id;
        return DB::table('account_transaction')->where('transaction_id',$this->attributes['id'])->where('third_level_account_id','!=',null)->latest('id')->select('id')->first();

    }
    public function StoreNewFourthLvlAccountStatement($request){
        $this->FourthLVLAccounts()
            ->attach($request->fourth_level_account_id,[
                'name'=>$request->name,
                'code'=>$request->code,
                'account_level'=>$request->account_level,

                'current_year'=>$request->current_year,
                'current_year_creditor'=>$request->current_year_creditor,
                'current_year_debtor'=>$request->current_year_debtor,

                'first_past_year'=>$request->first_past_year,

                'second_past_year'=>$request->second_past_year,

                'third_past_year'=>$request->third_past_year,

                'fourth_past_year'=>$request->fourth_past_year,

                'policy' => $request->policy,
                'considerations' => $request->considerations,
                'study' => $request->study,
                'second_study' => $request->second_study,
                'ReadDataOnly' => $request->ReadDataOnly,

                'is_related_party' => $request->is_related_party,
                'related_party_type' => $request->related_party_type,
                'related_party_branch' => $request->related_party_branch

            ]);

        //return $this->FourthLVLAccounts()->latest('id')->first()->pivot->id;
        return DB::table('account_transaction')->where('transaction_id',$this->attributes['id'])->where('fourth_level_account_id','!=',null)->latest('id')->select('id')->first();
    }
}
