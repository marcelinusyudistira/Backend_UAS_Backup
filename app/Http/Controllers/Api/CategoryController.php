<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        if(count($categories)> 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $categories
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if(!is_null($category)){
            return response([
                'message' => 'Retrieve category Success',
                'data' => $category
            ], 200);
        }

        return response([
            'message' => 'category Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'namaKategori' => 'required|max:60|unique:categories',
            'deskripsi' => 'required',
            'gambarKategori' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $category = Category::create($storeData);
        return response([
            'message' => 'Add category Success',
            'data' => $category
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if(is_null($category)){
            return rensponse([
                'message' => 'category Not Found',
                'data' => null
            ], 404);
        }

        if($category->delete()){
            return response([
                'message' => 'Delete category Success',
                'data' => $category
            ], 200);
        }

        return response([
            'message' => 'Delete category Failed',
            'data' => null
        ], 400);
    }

    public function update(Request $request, $id){
        $category = Category::find($id);

        if(is_null($category)){
            return response([
                'message' => 'category Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'namaKategori' => 'required|max:60|unique:categories',
            'deskripsi' => 'required',
            'gambarKategori' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $category->namaKategori = $updateData['namaKategori'];
        $category->deskripsi = $updateData['deskripsi'];
        $category->gambarKategori = $updateData['gambarKategori'];

        if($category->save()) {
            return response([
                'message' => 'Update category Success',
                'data' => $category
            ], 200);
        }
        
        return response([
            'message' => 'Update category Failed',
            'data' => null
        ], 400);
    }
}
