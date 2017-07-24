@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @include('layouts.sidebar')

            <div class="col-md-7 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading">Powiadomienia</div>

                    @if (Auth::user()->notifications->count() == 0)
                        <h3 class="text-center">Brak powiadomień</h3>
                    @else

                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach (Auth::user()->notifications as $notify)
                                    <li class="list-group-item">

                                        @if(is_null($notify->read_at))
                                            {!! $notify->data['message'] !!}
                                            <form method="POST" class="pull-right"
                                                  action="{{ '/notifications/'.$notify->id}}">
                                                {{ csrf_field() }}
                                                {{method_field('patch')}}
                                                <button class="btn btn-info btn-xs ">Przeczytane</button>
                                            </form>
                                        @else
                                            <span style="opacity:.7;">{!! $notify->data['message'] !!}</span>
                                            <i style="color:green;" class="fa fa-check fa-2x"></i>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                            @endif
                        </div>
                </div>

            </div>
        </div>
@endsection