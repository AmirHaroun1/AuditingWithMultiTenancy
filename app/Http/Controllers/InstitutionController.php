<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstitutionRequest;
use App\institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    //
    public function store(StoreInstitutionRequest $request){

        $newCompany =  institution::create($request->except('password_confirmation'));

        return response()->json($newCompany,200);
    }
    public function update(StoreInstitutionRequest $request,institution $institution){

        $institution->update($request->all());

        return response()->json($institution,200);
    }
}
