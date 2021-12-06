<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();

        if(count($produks)> 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $produks
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $produk = Produk::find($id);

        if(!is_null($produk)){
            return response([
                'message' => 'Retrieve Produk Success',
                'data' => $produk
            ], 200);
        }

        return response([
            'message' => 'Produk Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'namaProduk' => 'required|max:60',
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required',
            'gambarProduk' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $produk = Produk::create($storeData);
        return response([
            'message' => 'Add Produk Success',
            'data' => $produk
        ], 200);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);

        if(is_null($produk)){
            return rensponse([
                'message' => 'Produk Not Found',
                'data' => null
            ], 404);
        }

        if($produk->delete()){
            return response([
                'message' => 'Delete Produk Success',
                'data' => $produk
            ], 200);
        }

        return response([
            'message' => 'Delete Produk Failed',
            'data' => null
        ], 400);
    }

    public function update(Request $request, $id){
        $produk = Produk::find($id);

        if(is_null($produk)){
            return response([
                'message' => 'Produk Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'namaProduk' => 'required|max:60',
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required',
            'gambarProduk' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $produk->namaProduk = $updateData['namaProduk'];
        $produk->category_id = $updateData['category_id'];
        $produk->brand_id = $updateData['brand_id'];
        $produk->harga = $updateData['harga'];
        $produk->stok = $updateData['stok'];
        $produk->deskripsi = $updateData['deskripsi'];
        $produk->gambarProduk = $updateData['gambarProduk'];

        if($produk->save()) {
            return response([
                'message' => 'Update Produk Success',
                'data' => $produk
            ], 200);
        }
        
        return response([
            'message' => 'Update Produk Failed',
            'data' => null
        ], 400);
    }
}
