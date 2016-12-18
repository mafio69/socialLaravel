@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Wyniki wyszukiwania</div>

                @if ($users->count() == 0)
                <h3>Brak wyników wyszukiwania</h3>
                @else
                <div class="row">
                    @foreach ($users as $user)
                    <div class="col-md-4">
                        <img class="img-responsive center-block thumbnail" style="margin-top:.5rem;" src="{{url('users-avatar/'.$user->id.'/150')}}" alt="avatar"/>
                        <p>{{$user->name}} <br> {{$user->email}} </p>
                        <a href="{{url('users/'.$user->id)}}">Wyświetl</a>
                    </div>

                    @endforeach
                   
                    @endif
                </div>
                
                 {{ $users->appends(['q' => $query])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

