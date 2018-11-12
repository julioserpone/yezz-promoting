<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategoryRequest;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends YezzController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCategories(Request $request, $module = null)
    {
        $this->data['data'] = Category::paginate(10);
        return $this->view($request, 'category.manager');
    }

    public function showCategoryEdit(Request $request, $id = null)
    {
        $this->data['data'] = $id ? Category::findOrFail($id) : null;

        return $this->view($request, 'category.edit');
    }

    public function updateCategory(UpdateCategoryRequest $request, $id = null)
    {
        $category = $id ? Category::findOrFail($id) : new Category;

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = (int) $request->input('status');
        $category->save();

        return redirect('store/category')->with('msg', trans('globals.success_alert_content'));
    }

    public function categoryData(Request $request, $id = null) {

        $q = trim($request->get('q'));
        $data = [];

        $query = Category::select(['id', 'name', 'description'])->where('id', $id);

        if ($q != '') {
            $query->whereRaw("name like '%" . $q . "%'");
        }

        $state = $query->orderBy('name', 'asc')->first();

        return json_encode($state);
    }
}
