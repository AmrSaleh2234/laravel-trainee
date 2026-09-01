<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store()
    {
        // Root
        $root = new Category();
        $root->name = 'Science';
        $root->save();

        // Child
        $child = new Category();
        $child->name = 'Physics';
        $child->parent()->associate($root);
        $child->save();

        return response()->json([
            'root' => $root,
            'child' => $child,

        ]);
    }


    public function parent($id)
    {
        $category = Category::findOrfail($id);

        return response()->json([
            'category' => $category->name,
            'parent' => $category->parent->name,
        ]);
    }

    public function childern($id)
    {
        $category = Category::findOrfail($id);
        foreach ($category->childern as $child) {

            echo $child->name;
        }
    }



    public function ancestors($id)
    {
        $category = Category::findOrFail($id);

        foreach ($category->ancestors as $ancestor) {
            echo $ancestor->name;
        }
    }

    public function ancestorsQuery($id)
    {
        $category = Category::findOrFail($id);

        $ancestors = $category->ancestors()->get();

        return response()->json($ancestors);
    }




    public function hierarchy($id)
    {

        $category = Category::findOrFail($id);
        $hierarchy = $category->joinAncestors();

        return response()->json($hierarchy);
    }
    public function descendants($id)
    {

        $category = Category::findOrFail($id);

        foreach ($category->descendants as $descendant) {
            echo $descendant->name;
        }
    }

    public function descendantsQuery($id)
    {
        $category = Category::findOrFail($id);

        $descendants = $category->descendants()->get();

        return response()->json($descendants);
    }


    public function roots()
    {
        $roots = Category::query()
            ->root()
            ->get();

        return response()->json($roots);
    }


    public function depth()
    {


        $categories = Category::query()
            ->withDepth(3)
            ->get();

        return response()->json($categories);
    }

    public function ancestorsOfCategory()
    {
        $category = Category::findOrFail(4);

        $ancestors = Category::query()
            ->whereSelfOrAncestorOf($category)
            ->get();

        return response()->json($ancestors);
    }

    public function descendantsOfCategory()
    {
        $category = Category::findOrFail(2);

        $descendants = Category::query()
            ->whereSelfOrDescendantOf($category)
            ->get();

        return response()->json($descendants);
    }

    public function categoriesByDepth()
    {
$categories = Category::query()
            ->orderByDepth()
            ->get();

        return response()->json($categories);


    }
}
