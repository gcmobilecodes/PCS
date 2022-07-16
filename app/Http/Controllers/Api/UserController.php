<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    function login(Request $request)
    {
        $rules=array(  'mobile_number'          => 'required',
        'password'            => 'required',
       );
        $validate=Validator::make($request->all(),$rules);
        if($validate->fails()){


        return response()->json(['statusCode' => 400, 'message' => 'please fill the required fields.','data'=>(object) []], 200);

     }else{


        $user = User::where('mobile_number', $request->mobile_number)->first();

        $credentials = [
            'mobile_number'    => $request->mobile_number,
            'password' => $request->password
        ];


        if(auth()->attempt($credentials)) {



                $token = $user->createToken('my-app-token')->plainTextToken;

                $user['token'] = $token;

                return response()->json(['statusCode' => 200, 'message' => 'login successfully', 'data' => $user], 200);


        } else {

          return response()->json(['statusCode' => 400, 'message' => 'Credential are not correct', 'data' => (object) []], 200);



                }

    }}
    public function update(Request $request)
    {

        $id  =Auth::id();

        $users = User::find($id);
        $users->name              = isset($request->name) && !empty($request->name) ? $request->name : $users->name;
        $users->mobile_number  =  isset($request->mobile_number) && !empty($request->mobile_number) ? $request->mobile_number : $users->mobile_number;
        $users->employee_id  =  isset($request->employee_id) && !empty($request->employee_id) ? $request->employee_id : $users->employee_id;

        $users->profile_pic             =  isset($request->profile_pic) && !empty($request->profile_pic) ? $request->profile_pic : $users->profile_pic;

        // if ($request->profile_pic) {
        //     $profile = $request->file('profile_pic')->getClientOriginalName();
        //     $address =  $request->file('profile_pic')->store('public/images');
        //     $users->profile_pic = $address;



        // }
        if ($request->file('profile_pic')) {
            $imagePath = $request->file('profile_pic');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('profile_pic')->storeAs('uploads', $imageName, 'public');


        $users->profile_pic = $imageName;
        $users->profile_pic = '/storage/'.$path;
 }
        $result = $users->save();
        if ($result) {
            return response()->json(['statusCode' => 200, 'message' => 'User Profile  Updated  successfully',  'data' => $users], 200);
        } else {
            return response()->json(['statusCode' => 400, 'message' => 'update operation  failed' ,'data'=>(object) []], 200);
        }
    }
    public function logout()
  {
    $id = Auth::User()->id;

        if (Auth::check()) {
         User::where('id', $id)->update(['device_token' => 1]);
            Auth::user()->tokens()->delete();
            return response()->json(['statusCode' => 200, 'message' => 'User logout successfully.'], 200);
        } else {
return response()->json(['statusCode' => 400, 'message' => 'Already   logout'], 200);


        }

    // $checkinUsers=Checkinckeckout::whereStatus(1)->filter($request)->where('user_id',auth()->user()->id)->first();
    // $checkoutUsers=Checkinckeckout::whereStatus(2)->filter($request)->where('user_id',auth()->user()->id)->first();



    // return response()->json(['statusCode' => 200, 'message' => 'Get user history successfully','checkin_user'=>$checkinUsers,'checkout_user' => $checkoutUsers], 200);

//     $history = Checkinckeckout:: where('user_id',$request->user_id)->where('date', $request->date)->where('status', $request->status)

//                             ->first();

// if($history->status==1){

// $history->update(['status', 1]);
//     return response()->json(['statusCode' => 200, 'message' => 'get history successfully', 'data' => $history], 200);

// }elseif($history->status==2){
//     $history->update(['status', 2]);
//     return response()->json(['statusCode' => 200, 'message' => 'get history successfully', 'data' => $history], 200);

// }

    }




}
