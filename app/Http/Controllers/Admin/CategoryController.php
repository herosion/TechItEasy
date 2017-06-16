<?php

namespace App\Http\Controllers\Admin;

use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page       = 'category';
        $categories = Category::paginate(8);
        
        return view('admin.category-index', compact('page', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page     = 'category';
        $category = new Category;

        return view('admin.category-create-update', compact('page', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()
                    ->route('admin.category.create')
                    ->withErrors($validator)
                    ->withInput();
        }

        $category = new Category;

        $category->name = $request->name;
        $category->save();

        return redirect()
                ->route('admin.category.index') 
                ->withSuccess('La catégorie a bien été enregistrée.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page     = 'category';
        $category = Category::findOrFail($id);

        return view('admin.category-create-update', compact('page', 'category'));
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
        $page     = 'category';
        $category = Category::findOrFail($id);

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()
                    ->route('admin.category.create')
                    ->withErrors($validator)
                    ->withInput();
        }

        $category->name = $request->name;
        $category->save();

        return redirect()
                ->route('admin.category.index')
                ->withSuccess('La catégorie a bien été modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        DB::table('questions')->where('category_id', '=', $id)->delete();
        /*DB::table('questionnaire_has_category')->where('category_id', '=', $id)->delete();*/
        DB::table('categories')->where('id', '=', $id)->delete();

       
        return redirect()
                ->route('admin.category.index')
                ->withSuccess('La catégorie a été supprimée.');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|min:4'
        ]);
    }

}
