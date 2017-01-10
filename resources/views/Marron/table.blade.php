@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Table</div>
                <div class="panel-body">
                    @foreach ($list_table as $table)
                        <div class="table-name">
                            <p><a class="table-status-{{$table->status}}" href="{{ url('/order/table/' . $table->id) }}">{{$table->name}}</a></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style type="text/css">
    .table-status-1 {
        color: red;
    }
</style>

