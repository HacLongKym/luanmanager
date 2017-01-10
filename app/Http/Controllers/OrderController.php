<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Product;
use App\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
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
     * Display a listing of table to chose.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_table = Table::paginate(30);
        return view('Marron/table', array('list_table' => $list_table));
    }
    /**
     * order for table id.
     *
     * @return \Illuminate\Http\Response
     */
    public function order($id)
    {
        $table = Table::find($id);
        if ($table == null) {
            return redirect('/order');
        }
        $order = \App\Order::where('ban_id', $id)->where('status', \App\Order::NO_BILL)->first();
        $list_products = Product::paginate(30);
        if (empty($order)) { // Nếu chưa đặt thì đặt mới
            return view('Marron/order', array('list_products' => $list_products));
        } else { // Nếu đặt rồi thì liệt kê danh sách đã đặt cũ để khách hàng thay đổi
            $order_details = \App\OrderDetail::where('order_id', $order->id)->get();
            return view('Marron/order', array('list_products' => $list_products, 'order_details' =>$order_details));
        }
    }

    /**
     * order for table id.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderPost($id, Request $request)
    {
        $table = Table::find($id);
        if ($table == null) {
            return redirect('/order');
        } else {
            $table->status = Table::CLOSE;
            $table->save();
        }
        $list_order = $request->all();
        unset($list_order['_token']);
        // danh sách sản phẩm khách hàng đặt
        $list_products = Product::find(array_keys($list_order))->getDictionary();
        // Kiểm tra đã đặt hóa đơn từ trước hay chưa
        $order         = \App\Order::where('ban_id', $id)->where('status', \App\Order::NO_BILL)->first();
        if (empty($order)) { // Nếu chưa đặt thì đặt hóa đơn
            $order = \App\Order::create(array('ban_id' => $id));
        }
        // duyệt danh sách sản phẩm khách hàng đặt
        foreach ($list_order as $product_id => $amount) {
            // kiểm tra sản phẩm đã được đặt từ trước chưa
            $order_detail = \App\OrderDetail::where('order_id', $order->id)
                                            ->where('sanpham_id', $product_id)
                                            ->orderBy('updated_at', 'desc')
                                            ->first();
            if (empty($order_detail)) { // chưa đặt thỳ đặt món
                $order_detail = \App\OrderDetail::create(array(
                    'order_id' => $order->id,
                    'ban_id'   => $id,
                    'sanpham_id' => $product_id,
                    'amount' => $amount,
                    'price_each' => $list_products[$product_id]->price,
                ));
            } else {
                // đã đặt thỳ kiểm tra lại đã làm hay chưa
                if ($order_detail->status == \App\OrderDetail::DONE) {
                    // nếu đã làm thỳ so sánh số lượng sản phẩm khách hàng muốn thay đổi trên hóa đơn
                    if ($amount > $order_detail->amount) {
                        // lớn hơn thỳ tiếp tục đặt làm
                        \App\OrderDetail::create(array(
                            'order_id' => $order->id,
                            'ban_id'   => $id,
                            'sanpham_id' => $product_id,
                            'amount' => $amount - $order_detail->amount,
                            'price_each' => $list_products[$product_id]->price,
                        ));
                    } else {
                        // Nhỏ hơn thỳ báo cho khách là làm xong rồi nhân viên đang mang lên
                        $order_details = \App\OrderDetail::where('order_id', $order->id)->get();
                        return view('Marron/order', array('order_details' => $order_details,'error'=>'Đã Làm Xong. Vui Lòng chờ chút nhân viên sẽ mang lên ngay.', 'list_products' => Product::paginate(30)));
                    }
                } else {
                    if ($amount == 0) {
                        // khách hàng muốn bỏ không đặt sản phẩm này nữa thỳ xóa đi
                        $order_detail->delete();
                    } else {
                        // khách hàng muốn thay đổi số lượng sản phẩm này
                        $order_detail->amount = $amount;
                        $order_detail->save();
                    }
                }
            }
        }
        $order_details = \App\OrderDetail::where('order_id', $order->id)->get();
        return view('Marron/order', array('list_products' => Product::paginate(30), 'order_details' => $order_details, 'success' => 'success'));
    }
}
