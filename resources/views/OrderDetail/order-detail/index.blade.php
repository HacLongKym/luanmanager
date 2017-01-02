@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Orderdetail</div>
                    <div class="panel-body">

                        <a href="{{ url('/OrderDetail/order-detail/create') }}" class="btn btn-primary btn-xs" title="Add New OrderDetail"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Order Id </th><th> Sanpham Id </th><th> Amount </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($orderdetail as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->order_id }}</td><td>{{ $item->sanpham_id }}</td><td>{{ $item->amount }}</td>
                                        <td>
                                            <a href="{{ url('/OrderDetail/order-detail/' . $item->id) }}" class="btn btn-success btn-xs" title="View OrderDetail"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/OrderDetail/order-detail/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit OrderDetail"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/OrderDetail/order-detail', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete OrderDetail" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete OrderDetail',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $orderdetail->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection