<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::all();

        if(count($order)> 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $order
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $order = Order::find($id);

        if(!is_null($order)){
            return response([
                'message' => 'Retrieve Order Success',
                'data' => $order
            ], 200);
        }

        return response([
            'message' => 'Order Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'user_id' => 'required|numeric',
            'tanggal' => 'required|date',
            'status' => 'required|max:60',
            'kode' => 'required|numeric',
            'jumlah_harga' => 'required|numeric',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $order = Order::create($storeData);
        return response([
            'message' => 'Add Order Success',
            'data' => $order
        ], 200);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if(is_null($order)){
            return rensponse([
                'message' => 'Order Not Found',
                'data' => null
            ], 404);
        }

        if($order->delete()){
            return response([
                'message' => 'Delete Order Success',
                'data' => $order
            ], 200);
        }

        return response([
            'message' => 'Delete Order Failed',
            'data' => null
        ], 400);
    }

    public function update(Request $request, $id){
        $order = Order::find($id);

        if(is_null($order)){
            return response([
                'message' => 'Order Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'user_id' => 'required|numeric',
            'tanggal' => 'required|date',
            'status' => 'required|max:60',
            'kode' => 'required|numeric',
            'jumlah_harga' => 'required|numeric',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $order->user_id = $updateData['user_id'];
        $order->tanggal = $updateData['tanggal'];
        $order->status = $updateData['status'];
        $order->kode = $updateData['kode'];
        $order->jumlah_harga = $updateData['jumlah_harga'];

        if($order->save()) {
            return response([
                'message' => 'Update Order Success',
                'data' => $order
            ], 200);
        }
        
        return response([
            'message' => 'Update Order Failed',
            'data' => null
        ], 400);
    }
}
