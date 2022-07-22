<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Checkinckeckout;
use App\Models\Checkinout;
use App\Models\Checkout;
use App\Models\Contactus;
use App\Models\Detail;
use App\Models\History;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailsController extends Controller
{


        public function checkinUserData(request $request){
        $id = Auth::id();

    //     Checkinckeckout::where('user_id',auth()->user()->id)->first();


    //$data['user_id'] =$id;
    //   $data['Restaurant_name'] = $request->Restaurant_name;

    //   $data['date'] = $request->date;

    //   $data['checkin_time'] = $request->checkin_time;
    //   $data['checkout_time'] = $request->checkout_time;

    //    $data['checkin_address'] = $request->checkin_address;
    //     $data['checkout_address'] = $request->checkout_address;


    //     $data['status']=$request->status ;
    //     if(!$user){
    //         Checkinckeckout::create($data);
    //         History::create($data);
    //     }else{
    //         $user->update(['status'=>$request->status,'date' => $request->date,'checkin_time' => $request->checkin_time,'checkout_time' => $request->checkout_time,'checkin_address' => $request->checkin_address,'checkout_address' => $request->checkout_address,]);

    //         History::create($data);

        // }
        $users = new Checkinckeckout();
        $users->user_id =$id;
        $users->Restaurant_name=$request->Restaurant_name;
        $users->date=$request->date;
        // $users->checkin_time=$request->checkin_time;

        $users->checkin_time=$request->checkin_time;
        $users->checkout_time=$request->checkout_time;
        $users->checkin_address=$request->checkin_address;
        $users->checkout_address=$request->checkout_address;
        $users->status=$request->status;
if($users->status==1){
    // $users= Checkinckeckout::create($data);
    $users->save();
}else{
    $users::where('id', $request->id)->update(['status'=>$request->status,'date' => $request->date,'checkin_time' => $request->checkin_time,'checkout_time' => $request->checkout_time,'checkin_address' => $request->checkin_address,'checkout_address' => $request->checkout_address,] );

  //  return response()->json(['statusCode' => 200, 'message' => 'Register successfully', 'data' => $users], 200);

}
     if (!empty($users)) {
            return response()->json(['statusCode' => 200, 'message' => 'Register successfully', 'data' => $users], 200);
        }
        // else{
        //     return response()->json(['statusCode' => 200, 'message' => 'Register successfully', 'data' => $user], 200);
        // }

        return response()->json(['statusCode' => 400, 'message' => 'Please check your data!', 'data' => (object) []], 200);
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

        $history = Checkinckeckout:: where('user_id',auth()->user()->id)->where('date', $request->date)

                                ->first();


                        if ($history != null) {

                                    return response()->json(['statusCode' => 200, 'message' => 'get history successfully', 'data' => $history], 200);
                                }
                                else {

                                    return response()->json(['statusCode' => 400, 'message' => ' There is  no   checkin now   ', 'data' => (object) []], 200);



                                          }


        return response()->json(['statusCode' => 200, 'message' => 'Get user history successfully', 'data' => $history], 200);

    }







        public function history(request $request){
            $history = History:: where('user_id',$request->user_id)->where('date', $request->date)

            ->get();


    if ($history != null) {

                return response()->json(['statusCode' => 200, 'message' => 'get history successfully', 'data' => $history], 200);
            }
            else {

                return response()->json(['statusCode' => 400, 'message' => ' There is  no   checkin now   ', 'data' => (object) []], 200);



                      }

return response()->json(['statusCode' => 200, 'message' => 'Get user history successfully', 'data' => $history], 200);


        }

   public function contactUs( request $request){
    $id = Auth::id();
    $users = new Contactus();

    $users->user_id =$id;
    $users->Query = $request->Query;
    $users->save();
    return response()->json(['statusCode' => 200, 'message' => 'send Query sucessfully', 'data' => $users], 200);


}

public function getdetailcontact(request $request){
    $data=User::where('user_type',1)->with('getContactList')
    ->get();

    return response()->json(['statusCode' => 200, 'message' => 'Register successfully', 'data' => $data], 200);


}






    }















