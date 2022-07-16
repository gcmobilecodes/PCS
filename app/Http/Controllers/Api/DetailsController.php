<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Checkinckeckout;
use App\Models\Checkinout;
use App\Models\Checkout;
use App\Models\Detail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailsController extends Controller
{


 public function checkinUserData(request $request){
    $id = Auth::id();
    $users = new Checkinckeckout();

    $users->user_id =$id;
    $users->Restaurant_name = $request->Restaurant_name;

    $users->date = $request->date;

    $users->checkin_time = $request->checkin_time;
    $users->checkout_time = $request->checkout_time;
    $users->status=$request->status;

    $users->save();

    if ($users != null) {
        return response()->json(['statusCode' => 200, 'message' => 'Register successfully', 'data' => $users], 200);
    }

    return response()->json(['statusCode' => 400, 'message' => 'Please check your data!', 'data' => (object) []], 200);
}


        public function getcheckin(Request $request)
        {
        //  $id = Auth::id();

           $users = Checkin::where('User_id', $request->User_id)->get();

        //    $users = Checkinckeckout::where('status', 1)->get();

           return response()->json(['statusCode' => 200, 'message' => 'Get user checkindetail successfully', 'data' => $users], 200);



    }

public function checkinoutdetail(request $request){


    $users=User::where('id',$request->user_id)->with(['getCheckinoutDetail'=>function($q){
        $q->where('status','=',1);
    }])->get();


    return response()->json(['statusCode' => 200, 'message' => 'Get user checkindetail successfully', 'data' => $users], 200);





}

public function checkoutdetail(request $request){


    $users=User::where('id',$request->id)->with(['getCheckinoutDetail'=>function($q){
        $q->where('status','=',2);
    }])->get();



    return response()->json(['statusCode' => 200, 'message' => 'Get user checkoutdetail successfully', 'data' => $users], 200);





}

public function checkdetailbyDate(request $request){

    $checkinUsers=Checkinckeckout::whereStatus(1)->filter($request)->where('id',auth()->user()->id)->first();
    $checkoutUsers=Checkinckeckout::whereStatus(2)->filter($request)->where('id',auth()->user()->id)->first();
    return response()->json(['statusCode' => 200, 'message' => 'Get user history successfully','checkin_user'=>$checkinUsers,'checkout_user' => $checkoutUsers], 200);


    // $latitude = "23.033863";
    // $longitude = "72.585022";
    // $users = User::select("name", \DB::raw("6371 * acos(cos(radians(" . $latitude . "))
    //         * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . "))
    //         + sin(radians(" .$latitude. ")) * sin(radians(latitude))) AS distance"))
    //         ->having('distance', '<', 1000)
    //         ->orderBy('distance')
    //         ->get()->toArray();



                    // if ($history != null) {

                    //             return response()->json(['statusCode' => 200, 'message' => 'get history successfully', 'data' => $history], 200);
                    //         }
                    //         else {

                    //             return response()->json(['statusCode' => 400, 'message' => ' There is  no   checkin now   ', 'data' => (object) []], 200);



                    //                   }

    // return response()->json(['statusCode' => 200, 'message' => 'Get user history successfully', 'data' => $history], 200);

}
    public function CheckdetailNow(request $request){
    // $now = Carbon::now();

    $history = Checkout::whereDate('created_at',  Carbon::today())->get();

    $history=User::with('getCheckinDetail','getCheckoutDetail')->whereDate('created_at',  Carbon::today())->get();
    return response()->json(['statusCode' => 200, 'message' => 'Get user history successfully', 'data' => $history], 200);

}

public function checkin (Request $request )
{
    $id = Auth::id();
    $users = new checkin();

    $users->user_id =$id;
    $users->Restaurant_name = $request->Restaurant_name;

    $users->date = $request->date;

    $users->checkin_time = $request->checkin_time;
    $users->status = 1;

    $users->save();

    if ($users != null) {
        return response()->json(['statusCode' => 200, 'message' => 'Register successfully', 'data' => $users], 200);
    }

    return response()->json(['statusCode' => 400, 'message' => 'Please check your data!'], 200);
    }


    public function checkout (Request $request )
{
    $id = Auth::id();
    $users = new Checkout();

    $users->user_id =$id;
    $users->Restaurant_name = $request->Restaurant_name;

    $users->date = $request->date;

    $users->checkin_time = $request->checkin_time;
    $users->checkout_time = $request->checkout_time;

    $users->status = 2;

    $users->save();

   if ($users != null) {
        return response()->json(['statusCode' => 200, 'message' => 'user checkout successfully', 'data' => $users], 200);
    }

    return response()->json(['statusCode' => 400, 'message' => 'Please check your data!','data'=>$users], 200);
    }

    public function getcheckout(Request $request){
        $users = Checkinckeckout::get();

        return response()->json(['statusCode' => 200, 'message' => 'Get user checkindetail successfully', 'data' => $users], 200);


    }



    }















