<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Table;
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
        return view('Marron/table', array('list_table'=> $list_table));
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
        $list_products = Product::paginate(30);
        return view('Marron/order', array('list_products'=> $list_products));
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
        }
        var_dump($request->all());die;
        $list_products = Product::paginate(30);
        return view('Marron/order', array('list_products'=> $list_products));
    }
}
