@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <span style="float:right;width:100px;padding-top:5px;"><a href="{{url('/admin/team')}}" class="btn btn-info">BACK</a></span>
            <div class="panel panel-default">
                <div class="panel-heading">Create New Player </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/store/player') }}">
                       {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">First Name</label>
                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}">
                                @if ($errors->has('fname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                       <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Last Name</label>
                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}">
                                @if ($errors->has('lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                       <div class="form-group{{ $errors->has('team') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Team</label>
                            <div class="col-md-6">
                                <select name="team">
                                    <option value="">Select Team</option>
                                    @foreach($teams as $key=>$team)
                                    <option value={{$team['id']}}>{{$team['name']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('team'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('team') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                        <div class="form-group{{ $errors->has('imageUri') ? ' has-error' : '' }}">
                            <label for="image-uri" class="col-md-4 control-label">Logo Uri</label>
                            <div class="col-md-6">
                                <input id="imageUri" type="text" class="form-control"  name="imageUri">
                                @if ($errors->has('imageUri'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('imageUri') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
