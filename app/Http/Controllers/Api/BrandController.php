<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        if(count($brands)> 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $brands
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $brand = Brand::find($id);

        if(!is_null($brand)){
            return response([
                'message' => 'Retrieve Brand Success',
                'data' => $brand
            ], 200);
        }

        return response([
            'message' => 'Brand Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'namaBrand' => 'required|max:60|unique:brands',
            'deskripsi' => 'required',
            'gambarBrand' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $brand = Brand::create($storeData);
        return response([
            'message' => 'Add Brand Success',
            'data' => $brand
        ], 200);
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);

        if(is_null($brand)){
            return rensponse([
                'message' => 'Brand Not Found',
                'data' => null
            ], 404);
        }

        if($brand->delete()){
            return response([
                'message' => 'Delete Brand Success',
                'data' => $brand
            ], 200);
        }

        return response([
            'message' => 'Delete Brand Failed',
            'data' => null
        ], 400);
    }

    public function update(Request $request, $id){
        $brand = Brand::find($id);

        if(is_null($brand)){
            return response([
                'message' => 'Brand Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'namaBrand' => 'required|max:60',
            'deskripsi' => 'required',
            'gambarBrand' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $brand->namaBrand = $updateData['namaBrand'];
        $brand->deskripsi = $updateData['deskripsi'];
        $brand->gambarBrand = $updateData['gambarBrand'];

        if($brand->save()) {
            return response([
                'message' => 'Update Brand Success',
                'data' => $brand
            ], 200);
        }
        
        return response([
            'message' => 'Update Brand Failed',
            'data' => null
        ], 400);
    }
}
