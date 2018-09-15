<?php

namespace App\Http\Controllers;

use Auth;
use Alertas;
use Validator;
use App\Models\Book;
use App\Http\Requests;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['books'] = Book::with(['categories','current_user'])->orderBy('id','DESC')->paginate(5);
        return view('books.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::where('deleted',0)->get();
        return view('books.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z]+$/u',
            'author' => 'required|string|max:255|regex:/^[a-zA-Z]+$/u',
            'categories' => 'required',
            'published' => 'required|date'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else {
            $book = new book();
            $book->name = $request->name;
            $book->author = $request->author;
            $book->published = $request->published;
            $book->available = $request->available;
            try {
                $book->save();
                $book->categories()->attach($request->categories);
                Alertas::setMessage('Book created correctly.' ,'exito');
                return redirect('books');
            } catch (Exception $e) {
                Alertas::setMessage('Error storing the book.','error');
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['book'] = $book = Book::with(['current_user','categories'])->findOrFail($id);
        $data['categories'] = Category::where('deleted',0)->get();
        $data['categories_id'] = $book->categories->pluck('id')->toArray();
        return view('books.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z]+$/u',
            'author' => 'required|string|max:255|regex:/^[a-zA-Z]+$/u',
            'categories' => 'required',
            'published' => 'required|date'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else {
            $book = Book::findOrFail($id);
            $book->name = $request->name;
            $book->author = $request->author;
            $book->published = $request->published;
            $book->available = $request->available;
            if ($request->available == 0) {
                $book->user_id = Auth::user()->id;
            }
            try {
                $book->save();
                $book->categories()->detach();
                $book->categories()->attach($request->categories);
                Alertas::setMessage('Book updated correctly.' ,'exito');
                return redirect('books');
            } catch (Exception $e) {
                Alertas::setMessage('Error storing the book.','error');
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->categories()->detach();
        try {
            $book->delete();
            Alertas::setMessage('Book removed correctly.' ,'exito');
        } catch (Exception $e) {
            Alertas::setMessage('Error removing the book.','error');
        }
        return redirect('books');
    }
}
