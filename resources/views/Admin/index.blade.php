@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <table class="table table-bordered" style="width: 100%">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mail</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($list_user as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <select class="form-control">
                                        <?php foreach ($user->role_name as $key => $value): ?>
                                            <option value="{{$key}}" {{$user->role==$key?'selected':''}}>{{$value}}</option>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                                <td>..</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



