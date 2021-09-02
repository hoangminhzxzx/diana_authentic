<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function manageCategory()
    {
        $categories = Category::where('parent_id', '=', 0)->get();

        $allCategories = Category::all();

        return view('admin.category.categoryTreeview', compact('categories', 'allCategories'));
    }

    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        Category::create($input);
        return back()->with('success', 'New Category added successfully.');
    }

    public function list()
    {
        $list_category = Category::query()->get(['id', 'title']);
        return view('admin.category.list', compact('list_category'));
    }

    public function edit($id)
    {
        $category = Category::query()->find($id);
        $allCategories = Category::all();

        if ($category->parent_id == 0) {
            return back()->with('status-not-exist', 'Page Exist');
        } else {
            return view('admin.category.edit',
                [
                    'category' => $category,
                    'allCategories' => $allCategories
                ]
            );
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();
        $category = Category::query()->find($id);
        $category->title = $data['title'];
        $category->parent_id = $data['parent_id'];
        $category->save();
        return redirect()->route('category-tree-view');
    }

    public function delete($id)
    {
        $category = Category::query()->find($id);
        if ($category) {
            if ($category->parent_id == 0) {
                return back()->with('status-delete-error', 'Delete Error');
            } else {
                $category->delete();
                return back()->with('status-delete', 'Delete Complete');
            }
        }
    }
}
