<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request){

        $rules=array(
        'name' => 'required|string',
        'password' => 'required');
        $validate=Validator::make($request->all(),$rules);
        if($validate->fails()){

         return response()->json(['statusCode' => 422, 'message'=> "please fill the required fields", 'data' =>$validate->errors()->all()] , 200);


     }else{
        $users = new User();
        $users->name = $request->name;
        $users->mobile_number=$request->mobile_number;
        $users->employee_id=$request->employee_id;
        $users->user_type=$request->user_type;


        $users->password = Hash::make($request->password);
        $users->device_type = $request->device_type;
        $users->device_token = $request->device_token;
        if ($request->file('profile_pic')) {
            $imagePath = $request->file('profile_pic');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('profile_pic')->storeAs('uploads', $imageName, 'public');


        $users->profile_pic = $imageName;
        $users->profile_pic = '/storage/'.$path;
 }
        $users->save();

if ($users != null) {

        return response()->json(['statusCode' => 200, 'message' => 'Register successfully', 'data' => $users], 200);
    }

    return response()->json(['statusCode' => 400, 'message' => 'Please check your data!','data'=>(object) []], 200);
    }}

}
