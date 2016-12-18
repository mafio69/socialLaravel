@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edycja Profilu</div>
                <img class="img-responsive center-block" style="margin-top:.5rem;" src="{{url('users-avatar/'.$user->id.'/400')}}" alt="avatar"/>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{url('users/'.$user->id)}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field("Patch")}}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Imie</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                            <label for="sex" class="col-md-4 control-label">Płeć</label>

                            <div class="col-md-6">
                                <select name="sex" class="form-control">
                                    <option value="m" 
                                            @if ($user->sex == 'm') 
                                            selected
                                            @endif
                                            >Mężczyzna</option>
                                    <option value="f" 
                                            @if ($user->sex == 'f') 
                                            selected
                                            @endif
                                            >Kobieta</option>
                                </select>

                                @if ($errors->has('sex'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sex') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Avatar</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="avatar" value="{{$user->avatar}}">

                                @if ($errors->has('avatar'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Popraw
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
