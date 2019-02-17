@extends('layouts.app')
@section('content')
<div class="panel panel-default" style="text-align: center">
    <div class="panel-heading">
        <h2>Team Listing</h2>
        <span><a href="{{url('/admin/dashboard')}}" class="btn btn-info">Dashboard</a></span>
        <span><a href="{{url('/admin/create/team')}}" class="btn btn-info">Add New Team</a></span>
    </div>
    @if(\Session::has('message'))
    <div class="alert alert-success">
        {{\Session::get('message')}}
    </div>
    @endif
    <div class="table-responsive-sm ">
        <table class="table table-striped w-auto">
            <thead class="thead-dark">
                <tr class="d-flex">
                    <th class="col-xs-1">Sl.</th>
                    <th class="col-xs-3">Name</th>
                    <th class="col-xs-5">Logo Uri</th>
                    <th class="col-xs-3">Actions</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                @foreach($teams as $key=>$team)
               <tr class="d-flex">
                    <td class="col-xs-1">{{$key+1}}</td>
                    <td class="col-xs-3">{{$team['name']}}</td>
                    <td class="col-xs-5">{{$team['logoUri']}}</td>
                    <td class="col-xs-3">
                        <a class="btn btn-info" href="{{url('/admin/player/'.$team['id'].'/delete')}}" class="list-group-item">Delete</a> 
                        <a class="btn btn-info" href="{{url('/admin/player/'.$team['id'].'/edit/')}}" class="list-group-item">Update</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
