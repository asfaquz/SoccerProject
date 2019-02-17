@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <span style="float:right;width:100px;padding-top:5px;"><a href="{{url('/admin/team')}}" class="btn btn-info">BACK</a></span>
            <div class="panel panel-default">
                
                <div class="panel-heading">Create Team </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/store/team') }}">
                       {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('logoUri') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Logo Uri</label>
                            <div class="col-md-6">
                                <input id="logouri" type="text" class="form-control"  name="logoUri">
                                @if ($errors->has('logoUri'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('logoUri') }}</strong>
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
