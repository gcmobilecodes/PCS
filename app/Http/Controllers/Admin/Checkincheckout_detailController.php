<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Checkinckeckout;
use App\Models\Checkout;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class Checkincheckout_detailController extends Controller
{
    public function FullDetail(request $request){
        // if ($request->ajax()) {

            $data=User::where('user_type',1)->with('getCheckinoutDetail')
            ->get();


      return view('Admin.Checkin_outDetail',compact('data'));
    }


    public function delete_service_provider(request $request){

        $service_provider= User::where('id',$request->id);
        $service_provider->delete();
        echo "service_provider detail Deleted Successfully";

        return redirect('userss')->with('success',"service_provider detail Deleted successfully");
    }

    public function servicesproviders(Request $request)
    {


        $companys=User::where('id',$request->id)->with('getCheckinoutDetail')->first();

        return Response()->json($companys);
    }



    function datepicker(Request $request)
    {
     if(request()->ajax())
     {
      if(!empty($request->date))
      {
      //  $data =Checkinckeckout::where('date',$request->date)
      //    ->get();

    $data=User::where('user_type',1)->with('getCheckinoutDetail')->whereHas('getCheckinoutDetail', function ($q) use ($request) {
                                      $q->where('date','=',$request->date);

                              })->get();
                              return datatables()->of($data)->make(true);

    // $data  =\DB::table('users')->leftjoin('checkinouts','checkinouts.user_id','=','users.id')->select('users.id','users.name','users.mobile_number','checkinouts.')->where('checkinouts.date','=',$request->date)->get();
     // $data=User::where('user_type',1)->with(['getCheckinoutDetail'=>function($q,$request){
    //     $q->where('date','=',$request->date);
    // }])->get();


      }
      else
      {
        $data=User::where('user_type',1)->with('getCheckinoutDetail')
        ->get(); }
      return datatables()->of($data)->make(true);
     }
     return view('Admin.Checkin_outDetail');
    }

    public function datePickers(request $request){
      $date=date('Y-m-d',strtotime($request->date));
      $data=User::where('user_type',1)->with('getCheckinoutDetail')->whereHas('getCheckinoutDetail', function ($q) use ($date) {
        $q->where('date','=',$date);

    })->get();
     $html= view('Admin.Ajax.table',compact('data'))->render();
     return response([
      'data'=>$html
     ]);


    }




}
