<?php

namespace App\Http\Controllers\OrderDetail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OrderDetail;
use Illuminate\Http\Request;
use Session;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orderdetail = OrderDetail::paginate(25);

        return view('OrderDetail.order-detail.index', compact('orderdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('OrderDetail.order-detail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        OrderDetail::create($requestData);

        Session::flash('flash_message', 'OrderDetail added!');

        return redirect('OrderDetail/order-detail');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $orderdetail = OrderDetail::findOrFail($id);

        return view('OrderDetail.order-detail.show', compact('orderdetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $orderdetail = OrderDetail::findOrFail($id);

        return view('OrderDetail.order-detail.edit', compact('orderdetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $orderdetail = OrderDetail::findOrFail($id);
        $orderdetail->update($requestData);

        Session::flash('flash_message', 'OrderDetail updated!');

        return redirect('OrderDetail/order-detail');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        OrderDetail::destroy($id);

        Session::flash('flash_message', 'OrderDetail deleted!');

        return redirect('OrderDetail/order-detail');
    }
}
