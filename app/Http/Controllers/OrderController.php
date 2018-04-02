<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Orders;
//use App\Customer;
use App\User;

class OrderController extends Controller
{
    //
    protected $order;
    public function __construct(Orders $order){
        $this->middleware('auth:api', ['except' => ['index']]);
        $this->order = $order;
    }

    public function makeOrder($user_id,$books_id,$quantity){
        $newOrder = [
            'user_id' =>$user_id,
            'books_id' =>$books_id,
         //   'order_status' => $request->order_status,
            'quantity' => $quantity
        ];

        if($newOrder!=null){
            $newOrder = $this->order->create($newOrder);
           //var_dump($newOrder);
            return response()->json($newOrder, 200);
        } else {
            return response()->json(['error' => 'Failed to add order'], 404);
        }
    }
    public function add(Request $request){
        $newOrder = [
            'user_id' =>$request->user_id,
            'books_id' =>$request->books_id,
         //   'order_status' => $request->order_status,
            'quantity' => $request->quantity
        ];

        if($newOrder!=null){
            $newOrder = $this->order->create($newOrder);
           //var_dump($newOrder);
            return response()->json($newOrder, 200);
        } else {
            return response()->json(['error' => 'Failed to add order'], 404);
        }
    }
    public function cusUpdate(Request $request){
        $order = Orders::where('id', $request->id)->update([
            'quantity' => $request->quantity
        ]);
        if($order!=null){
            return response()->json($newOrder, 200);
        } else {
            return response()->json(['error' => 'Failed to update your order'], 404);
        }
        //return $order;
    }

   /* public function adminUpdate(Request $request,$id){
        $order = Orders::where('id', $request->id)->update([
            'order_status' => $request->order_status
        ]);
        if($order!=null){
            return response()->json($newOrder, 200);
        } else {
            return response()->json(['error' => 'Failed to update your order'], 404);
        }
        //return $order;
    }*/

    public function destroy($id){
        $order = Orders::where('id', $id)->delete();
        if($order!=null){
            return response()->json($order, 200);
        } else {
            return response()->json(['error' => 'Failed to remove order'], 404);
        }
    }

    public function index(){
        $order = Orders::all();
        $array = Array();
        $array['data'] = $order;
        if(count($order) > 0)
            return response()->json($array, 200);
        return response()->json(['error' => 'Orders not found'], 404);
    }

    public function showByCustId($id){
        //$order = Orders::where('order_id', $id)->get();
        //$order = Orders::find($id);
        //$order['customers'] = Orders::find($id)->customers;
        //return $order;

        $order = User::with('orders')->where('id', $id)->where('role', 'customer')->get();
        $array = Array();
        $array['data'] = $order;
        if(count($order) > 0)
            return response()->json($array, 200);
        return response()->json(['error' => 'Order not found'], 404);
        //return $order;
    }

    public function showOrdersAllData(){
        
            
         /*$order=Orders::leftJoin('books','orders.books_id','=','books.id')
              ->leftJoin('users', 'orders.user_id','=','users.id')
              ->select('*')
              ->where('orders.order_status', '=', 'unshipped')
              ->get();*/
        /*$order = DB::table('orders')
                    ->leftJoin('users', 'orders.user_id','=','users.id')
                    //->leftJoin('books','orders.books_id','=','books.id')
                    ->select('orders.*, users.*')
                    ->where('orders.order_status', '=', 'unshipped')
                    ->get();*/
        $order = DB::table('orders')
        ->leftJoin('users', 'orders.user_id','=','users.id')
        ->leftJoin('books','orders.books_id','=','books.id')
       // ->where('orders.order_status', '=', 'unshipped')
        ->select('orders.*','books.title','books.isbn','users.name','users.cus_address','users.email','users.cus_phone')
        ->get();

        $array = Array();
        $array['data'] = $order;
        if(count($order) > 0)
            return response()->json($array, 200);
        return response()->json(['error' => 'Order not found'], 404);
    }
    public function orderShowUserId($id){

        $order = DB::table('orders')
       // ->leftJoin('users', 'carts.user_id','=','users.id')
        ->leftJoin('books','orders.books_id','=','books.id')
       // ->where('orders.order_status', '=', 'unshipped')
        ->select('orders.*','books.title','books.book_img','books.price')
        ->where('orders.user_id', '=', $id)
        ->get();

        $array = Array();
        $array['data'] = $order;
        if(count($order) > 0)
            return response()->json($array, 200);
        return response()->json(['error' => 'Order not found'], 404);
    }
    /*public function showOrdersAllDataById($id){
        
            
         $order=Orders::join('users', 'orders.user_id','=','users.id')
            ->join('books','orders.books_id','=','books.id')
            ->select('users.*', 'orders.*','books.*')
            ->where('orders.id', '=', $id)
            ->get();
        $array = Array();
        $array['data'] = $order;
        if(count($order) > 0)
            return response()->json($array, 200);
        return response()->json(['error' => 'Order not found'], 404);
    }*/
}
