<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Checkincheckout_detailController extends Controller
{
    public function FullDetail(request $request){
    if ($request->ajax()) {
        $data=User::with('getCheckinDetail','getCheckoutDetail')->get();


        return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function($row){
$btn =
'<div  class="btn btn-sm edit-modal"  data-id=' . $row->id .' name='.$row-> name .'> <button type="button" class="btn btn-primary" > View Details</button>
                </div> <div class="delete-modal btn  btn-sm" data-id=' . $row->id . '  id="deletecategory1" name='.$row->name.'><i class="fa fa-trash" aria-hidden="true"></i></div>';
return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
    }

  return view('Admin.Checkin_outDetail');
}
public function service_provider_detail(request $request){

    // $service_provider = User::first();

    $companys=User::where('id',$request->id)->with('getCheckinDetail','getCheckoutDetail')->get();

   return view ('Admin.vendors',compact('service_provider'));


}
public function delete_service_provider(request $request){

    $service_provider= User::where('id',$request->id);
    $service_provider->delete();
    echo "service_provider detail Deleted Successfully";
    return redirect('userss')->with('success',"service_provider detail Deleted successfully");
}

public function servicesproviders(Request $request)
{

    // $id= array('id' => $request->id);
    // $companys  = User::where($users)->first();
    $companys=User::where('id',$request->id)->with('getCheckinDetail','getCheckoutDetail')->first();
       return Response()->json($companys);
}



}
