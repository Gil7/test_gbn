<?php

namespace App\Http\Controllers;

use Alertas;
use Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::where('deleted',FALSE)->orderBy('id','DESC')->paginate(5);
        return view('categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'description' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else {
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            try {
                $category->save();
                Alertas::setMessage('Category created correctly.' ,'exito');
                return redirect('categories');
            } catch (Exception $e) {
                Alertas::setMessage('Error storing the category.','error');
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
        $data['category'] = Category::findOrFail($id);
        return view('categories.edit', $data);
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
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        try {
            $category->update();
            Alertas::setMessage('Category updated correctly.' ,'exito');
            return redirect('categories');
        } catch (Exception $e) {
            Alertas::setMessage('Error updating the category.','error');
            return redirect()->back();
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
        try {
            $category = Category::findOrFail($id);
            $category->deleted = TRUE;
            $category->update();
            Alertas::setMessage('Category removed correctly.' ,'exito');
            return redirect('categories');
        } catch (Exception $e) {
            Alertas::setMessage('Error removing the category.','error');
            return redirect()->back();
        }
    }
}
