@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                @if($post->count()>0)
                    @include('posts.include.single')
                @else
                    <div class="text-center">
                    <h4>Brak wpisów <i class="fa fa-frown-o" aria-hidden="true"></i></h4>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection


