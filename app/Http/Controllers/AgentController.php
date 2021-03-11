<?php

namespace App\Http\Controllers;

use App\agent;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use App\institution;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function GuzzleHttp\Promise\all;

class AgentController extends Controller
{
    //

    public function store(StoreAgentRequest $request,Institution $institution)
    {
        $agent = agent::firstWhere('national_id',$request->national_id);
        if ( $agent == null)
        {
            $request['password'] = Hash::make($request->password);
            $agent =  agent::create($request->all());
        }

        $institution->agent()->associate($agent);
        $institution->save();

        return response()->json($agent,200);
    }
    public function update(UpdateAgentRequest $request,agent $agent)
    {

        $request['password'] = Hash::make($request->password);


        $agent->update($request->all());

        return response()->json($agent,200);

    }
}
