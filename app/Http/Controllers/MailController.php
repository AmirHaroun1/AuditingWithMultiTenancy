<?php

namespace App\Http\Controllers;

use App\Events\JoiningRequestApproved;
use App\Events\NewOfficeAskingForJoining;
use App\Tenant;
use Illuminate\Http\Request;

class MailController extends Controller
{
    //
    public static function SendWelcomeMail($Tenant){
        NewOfficeAskingForJoining::dispatch($Tenant);
        return response()->json([],200);
    }
    public static function SendRequestApprovedEmail($Tenant){
        JoiningRequestApproved::dispatch($Tenant);
        return response()->json([],200);
    }

}
