<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Checkinckeckout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index(Request $request){
    //     $lat ='30.7333°';
    //     $long='76.7794°';

    //     $data = DB::table("checkinouts")
    //     ->select("checkinouts.user_id"
    //         ,DB::raw("6371 * acos(cos(radians(" . $lat . "))
    //         * cos(radians(checkinouts.lat))
    //         * cos(radians(checkinouts.long) - radians(" . $long . "))
    //         + sin(radians(" .$lat. "))
    //         * sin(radians(checkinouts.lat))) AS distance"))
    //         ->groupBy("checkinouts.User_id")
    //         ->get();
    // return response()->json(['statusCode' => 200, 'message' => 'get address sucessfully', 'data' => $data], 200);

        $latitude = "23.033863";
        $longitude = "72.585022";
        $users = Checkinckeckout::select("User_id", DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                * cos(radians(lat)) * cos(radians(long) - radians(" . $longitude . "))
                + sin(radians(" .$latitude. ")) * sin(radians(lat))) AS distance"))
                ->having('distance', '<', 1000)
                ->orderBy('distance')
                ->get()->toArray();
                    return response()->json(['statusCode' => 200, 'message' => 'Register successfully', 'data' => $users], 200);



    }
}
