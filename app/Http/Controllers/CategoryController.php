<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Scopes\CategoryScope;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'address' => 'nullable'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        Category::create($data);


        toastr()->success('Have fun storming the castle!');


        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'sometimes|required|unique:categories,name,'.$category->id,
            'address' => 'nullable'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $category->update($data);

        toastr()->success('Have fun storming the castle!');


        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        toastr()->error('Have fun storming the castle!');

        return redirect(route('categories.index'));
    }

    //sub category

    public function subcategorylist (){
        $categories= Category::where('status','Active')->whereNull('parent_id')->get();

        return view('admin.categories.subCategories.index',compact('categories'));
    }

    public function subcategory(){
        $categories = Category::where('status','Active')->get();

        return view('admin.categories.subCategories.create',compact('categories'));
    }

    public function subcategroystore(Request  $request){
        $request->validate([
            'name' => 'required|unique:categories,name',
            'parent_id' => 'required',
            'status' => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        Category::create($data);

        toastr()->success('Sub category create successfully!');

        return redirect(route('subcategorylist'));
    }

    public function subcategoryedit($id){
       $subcategory = Category::findOrFail($id);
       $categories = Category::where('status','Active')->get();

       return view('admin.categories.subCategories.edit',compact('subcategory','categories'));
    }

    public function subcategoryupdate(Request $request,$id){
        $subcategory = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,'.$subcategory->id,
            'parent_id' => 'required',
            'status' => 'required'
        ]);

        $data = $request->all();

        $subcategory->update($data);

        toastr()->info('Sub category update successfully');

        return redirect(route('subcategorylist'));
    }
}
