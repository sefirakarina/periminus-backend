<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;

class AdminController extends Controller
{
    //
    protected $admin;
    public function __construct(Admin $admin){
    	$this->admin = $admin;
    }
    public function add(Request $request){
    	$newAdmin = [
    		//'admin_username' => $request->admin_username,
			'admin_password' => md5($request->admin_password)
    	];
    	if($newAdmin!=null){
    		//var_dump($newAdmin);
            $newAdmin = $this->admin->create($newAdmin);
            return response()->json($newAdmin, 200);
    	} else {
    		return response()->json(['error' => 'Failed to add'], 404);
    	}
    }
    public function update(Request $request){
    	$admin = Admin::where('id', $request->id)->update([
    			//'admin_username' => $request->admin_username,
				'admin_password' => md5($request->admin_password)
    	]);
    	if($admin!=null){
            return response()->json($admin, 200);
        } else {
            return response()->json(['error' => 'Failed to update'], 404);
        }
    }

    public function destroy($id){
    	$admin = Admin::find($id);
        $admin->delete();
        if($admin!=null){
            return response()->json($admin, 200);
        } else {
            return response()->json(['error' => 'Failed to delete'], 404);
        }
    }

    public function index(){
    	$admin = User::with('admins')->where('role', 'admin')->get();
        $array = Array();
        $array['data'] = $admin;
        if(count($admin) > 0)
            return response()->json($array, 200);
        return response()->json(['error' => 'Not found'], 404);
    }

    /*public function show($id){
    	$admin = User::with('admins')->where('id', $id)->get();
        if(count($admin) > 0)
            return response()->json($admin, 200);
        return response()->json(['error' => 'Not found'], 404);*/
}
