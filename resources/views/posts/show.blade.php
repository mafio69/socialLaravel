@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                @if($posts->count()>0)
                    @include('posts.include.single')
                @else
                    <p>Brak wpisów</p>
                @endif
            </div>

        </div>
    </div>
@endsection
