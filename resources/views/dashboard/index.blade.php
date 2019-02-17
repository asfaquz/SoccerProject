@extends('layouts.app')
@section('content')
<div class="panel panel-default" style="text-align: center">
    @include('common.errors')
    <div class="panel-heading">
        <h2>Welcome To Admin Dashboard</h2>
    </div>

    <div class="list-group">
        <div style="margin-top:20px;margin-bottom: 20px;">
            <a class="btn btn-info" href="{{url('/admin/team')}}" class="list-group-item">Manage Team</a>
        </div>
        <div style="margin-top:20px;margin-bottom: 20px;">
            <a class="btn btn-info" href="{{url('/admin/player')}}" class="list-group-item">Manage Player</a>
        </div>

    </div>



</div>

@endsection
