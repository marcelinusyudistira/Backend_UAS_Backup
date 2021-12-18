<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderdetails = OrderDetail::all();

        if(count($orderdetails)> 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $orderdetails
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function total(){
        $totalharga = OrderDetail::all()->sum('jumlah_harga');
        return response($totalharga,200);
    }

    public function show($id)
    {
        $orderdetail = OrderDetail::find($id);

        if(!is_null($orderdetail)){
            return response([
                'message' => 'Retrieve orderdetail Success',
                'data' => $orderdetail
            ], 200);
        }

        return response([
            'message' => 'orderdetail Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'produk_id' => 'required|numeric',
            'order_id' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'jumlah_harga' => 'required|numeric',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $orderdetail = OrderDetail::create($storeData);
        return response([
            'message' => 'Add orderdetail Success',
            'data' => $orderdetail
        ], 200);
    }

    public function destroy($id)
    {
        $orderdetail = OrderDetail::find($id);

        if(is_null($orderdetail)){
            return rensponse([
                'message' => 'orderdetail Not Found',
                'data' => null
            ], 404);
        }

        if($orderdetail->delete()){
            return response([
                'message' => 'Delete orderdetail Success',
                'data' => $orderdetail
            ], 200);
        }

        return response([
            'message' => 'Delete orderdetail Failed',
            'data' => null
        ], 400);
    }

    public function update(Request $request, $id){
        $orderdetail = OrderDetail::find($id);

        if(is_null($orderdetail)){
            return response([
                'message' => 'orderdetail Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'produk_id' => 'required|numeric',
            'order_id' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'jumlah_harga' => 'required|numeric',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $orderdetail->produk_id = $updateData['produk_id'];
        $orderdetail->order_id = $updateData['order_id'];
        $orderdetail->jumlah = $updateData['jumlah'];
        $orderdetail->jumlah_harga = $updateData['jumlah_harga'];

        if($orderdetail->save()) {
            return response([
                'message' => 'Update orderdetail Success',
                'data' => $orderdetail
            ], 200);
        }
        
        return response([
            'message' => 'Update orderdetail Failed',
            'data' => null
        ], 400);
    }
}
