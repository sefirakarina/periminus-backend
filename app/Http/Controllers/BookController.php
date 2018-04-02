<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Books;

class BookController extends Controller
{
    //

    protected $books;
    public function __construct(Books $books){
        $this->middleware('auth:api', ['except' => ['index']]);
    	$this->books = $books;
    }
    public function add(Request $request){
    	$newBook = [
    		'isbn' => $request->isbn,
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'book_img' => $request->book_img,
            'genre' => $request->genre
    	];

    	if($newBook!=null){
            $new = $this->books->create($newBook);
            $array = Array();
            $array['data'] = $new;
            return response()->json($array,200);
        } else {
            return response()->json(['error' => 'Book not added'], 404);
        }
    }
    public function update(Request $request,$id){
    	$books = Books::where('id', $request->id)->update([
    		'isbn' => $request->isbn,
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'price' => $request->price,
            'stock' => $request->stock,
            'genre' => $request->genre,
            'book_img' => $request->book_img
    	]);
        if($books!=null){
            return response()->json($books, 200);
        } else {
            return response()->json(['error' => 'Book not updated'], 404);
        }
    	//return $books;
    }

    public function destroy($id){
    	$books= Books::where('id', $id)->delete();
        if($books!=null){
            return response()->json($books, 200);
        } else {
            return response()->json(['error' => 'Book cannot be deleted'], 404);
        }
    }

    public function index(){
    	$books = Books::all();
        $array = Array();
        $array['data'] = $books;
        if(count($books) > 0)
            return response()->json($array, 200);
        return response()->json(['error' => 'Book not found'], 404);
    }

    public function show($id){
    	$books = Books::where('id', $id)->get();
        $array = Array();
        $array['data'] = $books;
        if(count($books) > 0)
            return response()->json($array, 200);
        return response()->json(['error' => 'Book not found'], 404);
    }
}
