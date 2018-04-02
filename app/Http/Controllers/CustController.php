<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Orders;
use App\User;

class CustController extends Controller
{
    //
    protected $customers;
    public function __construct(Customer $customers){
    	$this->customers = $customers;
    }
    public function add(Request $request){
    	$newCust = [
    		//'cus_username' => $request->cus_username,
    		'cus_password' => md5($request->cus_password),
    		'cus_name' => $request->cus_name,
    		'cus_gender' => $request->cus_gender,
    		'cus_dob' => $request->cus_dob,
    		//'cus_email' => $request->cus_email,
    		'cus_phone' => $request->cus_phone,
    		'cus_address' => $request->cus_address,
    		'cc_num' => $request->cc_num,
    		'cc_type' => $request->cc_type,
    		'cc_name' => $request->cc_name,
    		'cc_exmonth' => $request->cc_exmonth,
    		'cc_exyear' => $request->cc_exyear,
    		'cc_cvv' => $request->cc_cvv
    	];

    	if($newCust!=null){
    		//var_dump($newCust);
            $newCust = $this->customers->create($newCust);
            return response()->json($newCust, 200);
    	} else {
    		return response()->json(['error' => 'Failed to Register'], 404);
    	}
    }
    public function update(Request $request){
    	$customers = Customer::where('id', $request->id)->update([
    			//'cus_username' => $request->cus_username,
    			'cus_password' => md5($request->cus_password),
    			'cus_name' => $request->cus_name,
    			'cus_gender' => $request->cus_gender,
    			'cus_dob' => $request->cus_dob,
    			//'cus_email' => $request->cus_email,
    			'cus_phone' => $request->cus_phone,
    			'cus_address' => $request->cus_address,
    			'cc_num' => $request->cc_num,
    			'cc_type' => $request->cc_type,
    			'cc_name' => $request->cc_name,
    			'cc_exmonth' => $request->cc_exmonth,
    			'cc_exyear' => $request->cc_exyear,
    			'cc_cvv' => $request->cc_cvv
    	]);
        if($customers!=null){
            return response()->json($customers, 200);
        } else {
            return response()->json(['error' => 'Failed to Update'], 404);
        }
    	//return $customers;

    }

    public function destroy($id){
    	//$customers = Customer::where('id', $id)->delete();
        $customers = Customer::find($id);
        $customers->delete();
        //$order = $customers->orders();
        if($customers!=null){
            return response()->json($customers, 200);
        } else {
            return response()->json(['error' => 'Failed to Delete'], 404);
        }
    }

    public function index(){
        $customers = User::with('customers')->where('role', 'customer')->get();
        $array = Array();
        $array['data'] = $customers;
    	//return Customer::all();
        if(count($customers) > 0)
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