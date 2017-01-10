@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">CHEF</div>

                <div class="panel-body">
                    <div class="alert alert-success" id="alert-success" style="display:none">
                    </div>

                    <div class="alert alert-warning" id="alert-warning" style="display:none">
                    </div>
                    <div class="grid-masonry">
                        @foreach ($list_order as $order)
                            <div class="grid-masonry-item">
                                <form action="{{ url('api/chef/'.$order->id)}}" method="POST" class="form-complete">
                                {{ csrf_field() }}
                                <input type="hidden" name="remember_token" value="{{Auth::guest()?'':Auth::user()->getRememberToken()}}">
                                <fieldset>
                                    <legend>Bàn {{$order->ban_id}}</legend>
                                    @foreach ($order->orderDetails as $order_detail)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="{{$order_detail->product->id}}" value="{{$order_detail->amount}}" class="checkbox check{{$order->id}}" onchange="checkedChanged({{$order->id}})" />
                                                {{$order_detail->amount}} x {{$order_detail->product->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                    <button id="{{$order->id}}" name="{{$order->id}}" class="btn btn-primary hidden" disabled="disabled">Done</button>
                                </fieldset>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style type="text/css">
    .alert {
    }
    .grid-masonry {
        /*padding: 10px;*/
    }
    .grid-masonry-item {
        margin: 10px;
        min-width: 50px;
        border: 1px solid black;
        padding: 5px;
    }
    .hidden {
        display: none;
    }
</style>
<script type="text/javascript">
function output_error(message) {
    document.getElementById('alert-warning').innerHTML = '<strong>ERROR!</strong> ' + message;
    document.getElementById('alert-warning').style.display = 'block';
    setTimeout(function(){ 
        document.getElementById('alert-warning').style.display = 'none';
        document.getElementById('alert-warning').innerHTML = '';
    }, 2000);
}
function output_success(message) {
    document.getElementById('alert-success').innerHTML = '<strong>Success!</strong> ' + message;
    document.getElementById('alert-success').style.display = 'block';
    setTimeout(function(){ 
        document.getElementById('alert-success').style.display = 'none';
        document.getElementById('alert-success').innerHTML = '';
    }, 2000);
}
function checkedChanged(id) {
    check_enable = true;
    arr_check = document.getElementsByClassName('check'+id);
    for (var i = arr_check.length - 1; i >= 0; i--) {
        check_enable = check_enable && arr_check[i].checked;
    }
    var myLayer = document.getElementById(id);
    if (check_enable) {
        myLayer.className = "btn btn-primary";
        myLayer.disabled = "";
    } else {
        myLayer.className = "btn btn-primary hidden";
        myLayer.disabled = "disabled";
    };
}
document.addEventListener("DOMContentLoaded", function(event) { 
    var msnry = new Masonry( '.grid-masonry', {
      // set itemSelector so .grid-sizer is not used in layout
      itemSelector: '.grid-masonry-item',
      // use element for option
      columnWidth: '.grid-masonry-item',
      percentPosition: true
    });
     $('.form-complete').submit(function (e) {

          e.preventDefault();
          form = e.target;
          $.ajax({
            type: form.method,
            url: form.action,
            data: $(form).serialize(),
            success: function (data) {
                console.log(data);
                if (data.status == 'error') {
                    output_error(data.message);
                }
                if (data.status == 'update') {
                    
                }
                if (data.status == 'done') {
                    output_success(data.message);
                    msnry.remove(form.parentNode);
                    msnry.layout();
                    // form.parentNode.parentNode.removeChild(form.parentNode);
                }
            }
          });

        });
});
</script>