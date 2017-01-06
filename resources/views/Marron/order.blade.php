@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <fieldset>
                            <legend>Bill</legend>
                            <form action="{{ url('orderPost')}}" method="POST" id="form-order">
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
</style>
<script type="text/javascript">
var list_id_in_bill = [];
function removeProduct(id) {
    check = confirm('Remove this product of Bill?');
    if (check) {
        child  = document.getElementById('product'+id);
        child.parentNode.removeChild(child);
        index = list_id_in_bill.indexOf(id);
        list_id_in_bill.splice(index,1);
    }
}
function change(id,value) {
    document.getElementById(id).value = parseInt(document.getElementById(id).value) + parseInt(value);
}
function addProduct(id, name) {
    if (list_id_in_bill.indexOf(id) === -1) {
        list_id_in_bill.push(id);
        document.getElementById('form-order').innerHTML += htmlForEachProduct(id, name);
    }
}
function htmlForEachProduct(id, name) {
    return  '' +
            '<div class="form-group col-xs-12 col-sm-12 col-md-12" id="product' + id + '">' +
                '<label class="control-label col-xs-4 col-sm-4 col-md-4" style="padding:0" for="' + id + '">' + name + ':</label>' +
                '<div class="col-xs-2 col-sm-2 col-md-2" style="padding:0">' +
                    '<input type="number" class="form-control" placeholder="Enter number" id="' + id + '" name="' + id + '" value="1">' +
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