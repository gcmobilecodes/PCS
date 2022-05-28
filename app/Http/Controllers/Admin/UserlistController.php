<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserlistController extends Controller
{
    public function userlist(Request $request){
        if ($request->ajax()) {
            $data = User::all();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<div class="delete-modal btn  btn-sm" data-id=' . $row->id . '  id="deletecategory" name='.$row->name.'><i class="fa fa-trash" aria-hidden="true"></i></div> ';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }




return view('Admin.users_list');}
public function deleteusers(request $request){

    $users= User::where('id',$request->id);
    $users->delete();
    echo "users detail Deleted Successfully";
    return redirect('users')->with('success',"service_provider detail Deleted successfully");
}
}
