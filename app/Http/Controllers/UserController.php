<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    //
    protected $users;
    public function __construct(User $users){
    	$this->users = $users;
    }
    public function addAdmin(Request $request){
    	$newUser = [
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => Hash::make($request->password),
    		'role' => $request->role
    	];

    	if($newUser!=null){
            $newUser = $this->users->create($newUser);
            return response()->json($newUser, 200);
    	} else {
    		return response()->json(['error' => 'Failed to Register'], 404);
    	}
    }
    public function updateAdmin(Request $request){
    	$users = User::where('id', $request->id)->update([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => Hash::make($request->password),
    		'role' => $request->role
    	]);
        if($users!=null){
            return response()->json($users, 200);
        } else {
            return response()->json(['error' => 'Failed to Update'], 404);
        }
    	//return $customers;

    }
    public function add(Request $request){
    	$newUser = [
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => Hash::make($request->password),
    		'role' => 'customer',
    		'cus_gender' => $request->cus_gender,
    		'cus_dob' => $request->cus_dob,
    		'cus_phone' => $request->cus_phone,
    		'cus_address' => $request->cus_address,
    		'cc_num' => $request->cc_num,
    		'cc_type' => $request->cc_type,
    		'cc_name' => $request->cc_name,
    		'cc_exmonth' => $request->cc_exmonth,
    		'cc_exyear' => $request->cc_exyear,
    		'cc_cvv' => $request->cc_cvv
    	];


    	if($newUser!=null){
            $new = $this->users->create($newUser);
            $array = Array();
            $array['data'] = $new;
            return response()->json($array,200);
        } else {
            return response()->json(['error' => 'Book not added'], 404);
        }
    }


    public function updateCust(Request $request){
    	$users = User::where('id', $request->id)->update([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => Hash::make($request->password),
    		'role' => $request->role,
    		'cus_gender' => $request->cus_gender,
    		'cus_dob' => $request->cus_dob,
    		'cus_phone' => $request->cus_phone,
    		'cus_address' => $request->cus_address,
    		'cc_num' => $request->cc_num,
    		'cc_type' => $request->cc_type,
    		'cc_name' => $request->cc_name,
    		'cc_exmonth' => $request->cc_exmonth,
    		'cc_exyear' => $request->cc_exyear,
    		'cc_cvv' => $request->cc_cvv
    	]);
        if($users!=null){
            return response()->json($users, 200);
        } 
        else {
            return response()->json(['error' => 'Failed to Update'], 404);
        }   
    }

    public function destroy($id){
    	//$customers = Customer::where('id', $id)->delete();
        $users = User::find($id);
        $users->delete();
        //$order = $customers->orders();
        if($users!=null){
            return response()->json($users, 200);
        } else {
            return response()->json(['error' => 'Failed to Delete'], 404);
        }
    }

    public function index(){
        $users = User::where('role', 'customer')->get();
        $array = Array();
        $array['data'] = $users;
    	//return Customer::all();
        if(count($users) > 0)
            return response()->json($array, 200);

        return response()->json(['error' => 'No users found'], 404);
    }

    /*public function show($id){
    	$customers = User::with('customers')->where('id', $id)->get();
        if(count($customers) > 0)
            return response()->json($customers, 200);

        return response()->json(['error' => 'No users found'], 404);
    }*/
}
