@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Order</div>
                <div class="panel-body">
                    @if (isset($success))
                        <div class="success-message">{{$success}}</div>
                    @endif
                    @if (isset($error))
                        <div class="error-message">{{$error}}</div>
                    @endif
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <fieldset>
                            <legend>Bill</legend>
                            <form action="#" method="POST" id="form-order">
                                <div id="form-append">
                                </div>
                                {{ csrf_field() }}
                                <button type="submit" id="btn-submit-form" class="btn btn-primary">OK</button>
                            </form>
                        </fieldset>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <fieldset>
                            <legend>List Product</legend>
                            @foreach ($list_products as $product)
                                <div class="each-product" onclick="addProduct({{$product->id}},'{{$product->name}}')" >
                                    <p>{{$product->name}}</p>
                                </div>
                            @endforeach
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style type="text/css">
    #btn-submit-form {
        display: none;
    }
</style>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(event) { 
@if (isset($order_details))
@foreach ($order_details as $order_detail)
    addProduct({{$order_detail->sanpham_id}},'{{$order_detail->name()}}',{{$order_detail->amount}},'old');
@endforeach
@endif
});
var list_id_in_bill = [];
function removeProduct(id) {
    check = confirm('Remove this product of Bill?');
    if (check) {
        child  = document.getElementById('product'+id);
        if (child.getAttribute('datatype') == 'new') {
            child.parentNode.parentNode.removeChild(child.parentNode);
            index = list_id_in_bill.indexOf(id);
            list_id_in_bill.splice(index,1);
        } else {
            child.style.display = "none";
            document.getElementById(id).value = '0';
        }
    }
    if (list_id_in_bill.length == 0) {
        document.getElementById("btn-submit-form").style.display = 'none';
    }
}
function change(id,value) {
    result = parseInt(document.getElementById(id).value) + parseInt(value);
    child  = document.getElementById('product'+id);
    if (result > 0) {
        child.style.display = "block";
        document.getElementById(id).value = result;
    } else {
        removeProduct(id);
    }
}
function addProduct(id, name, value = 1, dataType = 'new') {
    if (list_id_in_bill.indexOf(id) === -1) {
        list_id_in_bill.push(id);
        product = document.createElement("div");
        product.innerHTML = htmlForEachProduct(id, name, value, dataType);
        document.getElementById('form-append').appendChild(product);
        if (list_id_in_bill.length != 0) {
            document.getElementById("btn-submit-form").style.display = 'inline-block';
        }
    } else {
        change(id,value);
    }
}
function htmlForEachProduct(id, name, value = 1, dataType = 'new') {
    return  '' +
            '<div class="form-group col-xs-12 col-sm-12 col-md-12" id="product' + id + '"  datatype="' + dataType + '">' +
                '<label class="control-label col-xs-4 col-sm-4 col-md-4" style="padding:0" for="' + id + '">' + name + ':</label>' +
                '<div class="col-xs-2 col-sm-2 col-md-2" style="padding:0">' +
                    '<input type="number" class="form-control" placeholder="Enter number" id="' + id + '" name="' + id + '" value="' + value + '">' +
                '</div>' +
                '<div class="col-xs-2 col-sm-2 col-md-2" style="padding:0;text-align:right">' +
                    '<div onclick="change(' + id + ',-1)" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true" title="Down" /></div>' +
                '</div>' +
                '<div class="col-xs-2 col-sm-2 col-md-2" style="padding:0;text-align:right">' +
                    '<div onclick="change(' + id + ',1)" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true" title="Up" /></div>' +
                '</div>' +
                '<div class="col-xs-2 col-sm-2 col-md-2" style="padding:0;text-align:right">' +
                    '<div onclick="removeProduct(' + id + ')" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Product in Bill" /></div>' +
                '</div>' +
            '</div>' +
            '<div class="clear"></div>';
}
</script>