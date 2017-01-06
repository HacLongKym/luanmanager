<?php

namespace App\Http\Controllers\Category;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('checkRole');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $category = Category::paginate(25);

        return view('Category.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Category.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        

if ($request->hasFile('img_url')) {
    $uploadPath = public_path('/uploads/');

    $extension = $request->file('img_url')->getClientOriginalExtension();
    $fileName = rand(11111, 99999) . '.' . $extension;

    $request->file('img_url')->move($uploadPath, $fileName);
    $requestData['img_url'] = $fileName;
}

        Category::create($requestData);

        Session::flash('flash_message', 'Category added!');

        return redirect('admin/Category/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('Category.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('Category.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        

if ($request->hasFile('img_url')) {
    $uploadPath = public_path('/uploads/');

    $extension = $request->file('img_url')->getClientOriginalExtension();
    $fileName = rand(11111, 99999) . '.' . $extension;

    $request->file('img_url')->move($uploadPath, $fileName);
    $requestData['img_url'] = $fileName;
}

        $category = Category::findOrFail($id);
        $category->update($requestData);

        Session::flash('flash_message', 'Category updated!');

        return redirect('admin/Category/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Category::destroy($id);

        Session::flash('flash_message', 'Category deleted!');

        return redirect('admin/Category/category');
    }
}
