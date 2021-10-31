<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use Psy\Util\Str;

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
        $data = $request->all();
//        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
//        if (isset($input['is_accessory']) && $input['is_accessory'] == 'on') {
//            $input['is_accessory'] = 1;
//        }
        $category = new Category();
        $category->title = $data['title'];
        $category->parent_id = $data['parent_id'];
        $category->is_accessory = (isset($data['is_accessory']) && $data['is_accessory'] == 'on') ? 1 : 0;
        $category->slug = \Illuminate\Support\Str::slug($data['title']);
        $category->save();
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
        $category->is_accessory = (isset($data['is_accessory']) && $data['is_accessory'] == 'on') ? 1 : 0;
        $category->slug = \Illuminate\Support\Str::slug($data['title']);
        $category->save();
        return redirect()->route('category-tree-view');
    }

    public function delete(Request $request)
    {
        $res = ['success' => false];
        $id = intval($request->input('category_id'));
        $category = Category::query()->find($id);
        if ($category) {
            if ($category->parent_id == 0) {
                $res['mess_error'] = 'Delete Error';
//                return back()->with('status-delete-error', 'Delete Error');
            } else {
                if ($category->products->count() == 0) {
                    $category->delete();
                    $res['success'] = true;
                } else {
                    $res['mess_error'] = 'Danh mục này đang có sản phẩm, đại ca không nên xóa danh mục này !!!';
                }
//                return back()->with('status-delete', 'Delete Complete');
            }
        }

        return response()->json($res);
    }
}
