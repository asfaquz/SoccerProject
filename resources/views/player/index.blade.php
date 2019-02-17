@extends('layouts.app')
@section('content')
<div class="panel panel-default" style="text-align: center">
    <div class="panel-heading">
        <h2>Player Listing</h2>
        <span><a href="{{url('/admin/dashboard')}}"  class="btn btn-info">Dashboard</a></span>
        <span><a href="{{url('/admin/create/player')}}"  class="btn btn-info">Add New Player</a></span>
    </div>
    @if(\Session::has('message'))
    <div class="alert alert-success">
        {{\Session::get('message')}}
    </div>
    @endif
    <div class="table-responsive-sm ">
        <table class="table table-striped w-auto">
            <tr>
                <th scope="col">Sl.</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Image Uri</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody class="table-striped">
            @foreach($players as $key=>$player)
            <tr scope="row">
                <td>{{$key+1}}</td>
                <td>{{$player['firstName']}}</td>
                <td>{{$player['lastName']}}</td>
                <td style="width:150px;float:left;overflow: hidden;text-overflow: ellipsis;">{{$player['imageUri']}}</td>
                <td>
                    <a  class="btn btn-info" href="{{url('/admin/player/'.$player['id'].'/delete')}}" class="list-group-item">Delete</a> 
                    <a  class="btn btn-info" href="{{url('/admin/player/'.$player['id'].'/edit/')}}" class="list-group-item">Update</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
