<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index(Request $request){
        $lat ='30.7333°';
        $long='76.7794°';

        $data = DB::table("checkinouts")
        ->select("checkinouts.user_id"
            ,DB::raw("6371 * acos(cos(radians(" . $lat . "))
            * cos(radians(checkinouts.lat))
            * cos(radians(checkinouts.lon) - radians(" . $long . "))
            + sin(radians(" .$lat. "))
            * sin(radians(checkinouts.lat))) AS distance"))
            ->groupBy("users.id")
            ->get();
    return response()->json(['statusCode' => 200, 'message' => 'Register successfully', 'data' => $data], 200);

    }
}
