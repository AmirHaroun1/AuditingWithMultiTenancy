<?php

namespace App;


use App\scopes\EmployeesScope;

class employee extends User
{
    protected $table = 'users';
    protected $guarded = [];
    protected static function booted()
    {
        static::addGlobalScope(new EmployeesScope);
    }

    public function updateUserInfo($request){

        if($request->signature){
            if(auth()->user()->signature){
                unlink('storage/'.auth()->user()->signature);
            }
            $signaturePath = $request->file('signature')->storeAs(
                'PartnersSignatures',
                $request->file('signature')->getClientOriginalName()
            );
            $this->update(['signature'=>$signaturePath]);
        }
        else{
            $this->update($request->all());
        }
    }

}
