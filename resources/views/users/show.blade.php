@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('layouts.sidebar')
    
        <div class="col-md-7">
            
            @if (auth()->check())
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('posts.create')
                    </div>
                </div>
            @endif
            @foreach($posts as $post)
                @include('posts.single')
            @endforeach

        </div>

    </div>
</div>
@endsection
