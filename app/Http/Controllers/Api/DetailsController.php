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

public function checkiusers(Request $request){
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

    return response()->json(['statusCode' => 400, 'message' => 'Please check your data!'], 400);
}


        public function getcheckin(Request $request)
        {
        //  $id = Auth::id();

           $users = Checkin::where('id', $request->id)->get();

        //    $users = Checkinckeckout::where('status', 1)->get();

           return response()->json(['statusCode' => 200, 'message' => 'Get user checkindetail successfully', 'data' => $users], 200);



    }

public function checkinoutdetail(request $request){

    // $id = Auth::id();

    // $users=User::with('getCheckinDetail','getCheckoutDetail')->where('id',$request->id)->get();
    // return response()->json(['statusCode' => 200, 'message' => 'Get user checkindetail successfully', 'data' => $users], 200);
//checkin_detail
    $users=User::where('id',$request->id)->with(['getCheckinoutDetail'=>function($q){
        $q->where('status','=',1);
    }])->get();


//checkout detail

//  $users=User::with(['getCheckinoutDetail'=>function($q){
//         $q->where('status','=',2);
//     }])->get();

    return response()->json(['statusCode' => 200, 'message' => 'Get user checkindetail successfully', 'data' => $users], 200);





}

public function checkoutdetail(request $request){


    $users=User::where('id',$request->id)->with(['getCheckinoutDetail'=>function($q){
        $q->where('status','=',2);
    }])->get();


//checkout detail

//  $users=User::with(['getCheckinoutDetail'=>function($q){
//         $q->where('status','=',2);
//     }])->get();

    return response()->json(['statusCode' => 200, 'message' => 'Get user checkoutdetail successfully', 'data' => $users], 200);





}

public function checkdetailbyDate(request $request){
    // $now = Carbon::now();

    $history = Checkinckeckout:: where('user_id',$request->user_id)->where('date', $request->date)->where('status', $request->status)

                            ->get();
//  $history=User::with('getCheckinDetail','getCheckoutDetail')->where('date', $request->date)->get();
    return response()->json(['statusCode' => 200, 'message' => 'Get user history successfully', 'data' => $history], 200);

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

    return response()->json(['statusCode' => 400, 'message' => 'Please check your data!'], 400);
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

    return response()->json(['statusCode' => 400, 'message' => 'Please check your data!'], 400);
    }

    public function getcheckout(Request $request){
        $users = Checkinckeckout::get();

        return response()->json(['statusCode' => 200, 'message' => 'Get user checkindetail successfully', 'data' => $users], 200);


    }



    }















