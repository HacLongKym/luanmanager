<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class ChefController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_order = Order::where('status_make', Order::WAIT)->orderBy('created_at', 'asc')->get();
        return view('Marron/chef', array('list_order' => $list_order));
    }

    public function complete($id, Request $request)
    {
        $order = \App\Order::find($id);
        if (empty($order)) {
            return response()->json(array('status' => 'error', 'message' => 'Bàn này đã hủy order!', 'data' => null));
        }
        $list_product_done = $request->all();
        unset($list_product_done['_token']);
        unset($list_product_done['remember_token']);
        foreach ($list_product_done as $product_id => $amount) {
            $order_detail = \App\OrderDetail::where('order_id', $id)
                                            ->where('sanpham_id', $product_id)
                                            ->where('amount', $amount)
                                            ->first();
            $order_detail->status = \App\OrderDetail::DONE;
            $order_detail->save();
        }
        $order_details = $order->orderDetails;
        foreach ($order_details as $order_detail) {
            if ($order_detail->status != \App\OrderDetail::DONE) {
                return response()->json(array('status' => 'update', 'message' => 'Bàn này update order!', 'data' => $order_details));
            }
        }
        $order->status_make = Order::DONE;
        $order->save();
        return response()->json(array('status' => 'done', 'message' => 'Hoàn Thành order bàn ' . $order->ban_id, 'data' => null));
    }
}
