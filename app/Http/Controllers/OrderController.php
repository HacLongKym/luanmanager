<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_products = Product::paginate(30);
        return view('Marron/order', array('list_products'=> $list_products));
    }
}
