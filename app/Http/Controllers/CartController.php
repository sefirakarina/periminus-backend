<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\User;
//use App\Customer;
use App\Books;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
	//
	protected $cart;
	public function __construct(Cart $cart){
		$this->middleware('auth:api', ['except' => ['index']]);
		$this->cart = $cart;
	}

	public function makeCart($user_id,$books_id,$quantity){
		$newOrder = [
			'user_id' =>$user_id,
			'books_id' =>$books_id,
		 //   'order_status' => $request->order_status,
			'quantity' => $quantity
		];

		if($newOrder!=null){
			$newOrder = $this->cart->create($newOrder);
		   //var_dump($newOrder);
			return response()->json($newOrder, 200);
		} else {
			return response()->json(['error' => 'Failed to add order'], 404);
		}
	}

	public function add(Request $request){
		$newCart = [
			'quantity' => $request->quantity,
			'books_id' => $request->books_id,
			'user_id' => $request->user_id

		];
		if($newCart!=null){
			$newCart = $this->cart->create($newCart);
			return response()->json($newCart, 200);
		} else {
			return response()->json(['error' => 'Failed to add cart'], 404);
		}
	}

	public function update(Request $request){
		$cart = Cart::where('id', $request->id)->update([
				'quantity' => $request->quantity
		]);
		if($cart!=null){
			return response()->json($cart, 200);
		} else {
			return response()->json(['error' => 'Failed to update your cart'], 404);
		}
	}

	public function destroy($id){
		$cart = Cart::where('id', $id)->delete();
		if($cart!=null){
			return response()->json($cart, 200);
		} else {
			return response()->json(['error' => 'Failed to remove cart'], 404);
		}
	}

	public function index(){
		$cart = Cart::all();
		$array = Array();
		$array['data'] = $cart;
		if(count($cart) > 0)
			return response()->json($array, 200);
		return response()->json(['error' => 'Cart not found'], 404);
	}

/*	public function show($id){
		$cart = Cart::where('id', $id)->get();
		if(count($cart) > 0)
			return response()->json($cart, 200);
		return response()->json(['error', 'Cart not found'], 404);
	}*/

	public function showByCustId($id){
		$cart = User::with('carts')->where('id', $id)->where('role', 'customer')->get();
		if(count($cart) > 0)
			return response()->json($cart, 200);
		return response()->json(['error' => 'Cart not found'], 404);
	}

	public function showByBookId($id){
		$cart = Books::with('carts')->where('id', $id)->get();
		if(count($cart) > 0)
			return response()->json($cart, 200);
		return response()->json(['error' => 'Cart not found'], 404);
	}

	public function showById($id){
		
		$cart=Cart::join('users', 'carts.user_id','=','users.id')
			 ->join('books','carts.books_id','=','books.id')
			 ->select('users.*', 'carts.*','books.*')
			 ->where('carts.id', '=', $id)
			 ->get();
		$array = Array();
		$array['data'] = $cart;

		if(count($cart) > 0)
			return response()->json($array, 200);
		return response()->json(['error' => 'cart not found'], 404);
	}

	 public function showAll(){
		
		$cart=Cart::join('users', 'carts.user_id','=','users.id')
			 ->join('books','carts.books_id','=','books.id')
			 ->select('users.*', 'carts.*','books.*')
			 //->where('carts.id', '=', $id)
			 ->get();
		$array = Array();
		$array['data'] = $cart;

		if(count($cart) > 0)
			return response()->json($array, 200);
		return response()->json(['error' => 'cart not found'], 404);
	}
	public function cartAllData($id){

        $order = DB::table('carts')
       // ->leftJoin('users', 'carts.user_id','=','users.id')
        ->leftJoin('books','carts.books_id','=','books.id')
       // ->where('orders.order_status', '=', 'unshipped')
        ->select('carts.*','books.title','books.book_img','books.price')
        ->where('carts.user_id', '=', $id)
        ->get();

        $array = Array();
        $array['data'] = $order;
        if(count($order) > 0)
            return response()->json($array, 200);
        return response()->json(['error' => 'Order not found'], 404);
    }
}
