@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
         @include('layouts.sidebar') 
     
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">Lista znajomych {{$user->friends()->count()}}</div>

                @if ($friends->count() == 0)
                <h3>Brak znojomych</h3>
                @else
                <div class="row">
                    @foreach ($friends as $friend)
                    <div class="col-md-4">
                        <img class="img-responsive center-block thumbnail" style="margin-top:.5rem;" src="{{url('users-avatar/'.$friend->id.'/150')}}" alt="avatar"/>
                        <p style="margin:.5rem">{{$friend->name}} <br> {{$friend->email}} </p>
                        <a href="{{url('users/'.$friend->id)}}" class="pull-right">Wyświetl</a>
                    </div>

                    @endforeach
                   
                    @endif
                </div>
                
                
            </div>
        </div>
    </div>
</div>
@endsection

