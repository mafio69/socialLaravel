@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @include('layouts.sidebar')

            <div class="col-md-7">

                @if (auth()->check())
                    <div class="panel panel-default">

                        @if (auth()->check() )

                            <div class="panel-body">
                                @include('posts.include.create')
                            </div>

                        @endif

                    </div>
                @endif

                @foreach($posts as $post)
                    @include('posts.include.single')
                @endforeach

                <div class="text-center">
                    {{$posts}}
                </div>
            </div>

        </div>
    </div>
@endsection