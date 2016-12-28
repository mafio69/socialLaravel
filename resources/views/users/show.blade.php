@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @include('layouts.sidebar')

            <div class="col-md-7">

                @if (auth()->check())

                    @if (auth()->id() == Request::segment(2))
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @include('posts.include.create')
                            </div>
                        </div>
                    @endif

                @endif
                @if($posts->count() > 0)
                @foreach($posts as $post)
                    @include('posts.include.single')
                @endforeach
                @else
                    <p>Brak wpisów :-( </p>
                @endif
                <div class="text-center">
                    {{$posts}}
                </div>

            </div>

        </div>
    </div>
@endsection
