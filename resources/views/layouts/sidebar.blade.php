<div class='col-md-3'>
    <div class="panel panel-default">
        <div class="panel-heading ">Użytkownik
            @if (belongs_to_auth(auth()->id()))
                <a class="pull-right" href="{{url('/users/'.$user->id.'/edit')}}" title="Edytuj"><i class="fa fa-pencil-square-o"
                                                                                     ></i></a>
            @endif
        </div>
        <img class="img-responsive center-block" style="margin-top:.5rem;"
             src="{{url('users-avatar/'.$user->id.'/180')}}" alt="avatar"/>
        <p style='margin: .5rem' class="text-center">
            <a href='{{url('users/'.$user->id)}}'>{{ $user->name }}</a><br>
            {{ $user->email }}<br>
            @if (Request::segment(1) !== 'friends')
                <a class="btn btn-link center-block" href="{{url('friends/'.$user->id.'')}}"><i class="fa fa-eye"
                                                                                                aria-hidden="true"></i>
                    Pokaż znajomych
                    <span class="label label-default">{{$user->friends()->count()}}</span></a>
            @endif
            @if ($user->sex == 'm')
                Mężczyzna
            @else
                Kobieta
            @endif

        </p>
        @if (Auth::check() && $user->id !== Auth::id())
            @if (!friendship($user->id)->exists && !has_friend($user->id))
                <form action="{{url('friends/'.$user->id)}}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success center-block">Zaproś do znajomych</button>
                </form>

            @elseif(has_friend($user->id))
                <form action="{{url('friends/'.$user->id)}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <button type="submit" class="btn btn-primary center-block">Przyjmij zaproszenie</button>
                </form>
            @elseif(friendship($user->id)->exists && !friendship($user->id)->accepted)

                <button disabled type="submit" class="btn btn-success center-block">Zaproszenie zostało wysłane</button>
            @elseif(friendship($user->id)->exists && friendship($user->id)->accepted)
                <form action="{{url('friends/'.$user->id)}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" onclick="return confirm('Czy na pewno?');"
                            class="btn btn-warning btn-sm center-block btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> Usuń znajomego
                    </button>
                </form>
            @endif
        @endif
        <div class="panel-body">

        </div>
    </div>
</div>
