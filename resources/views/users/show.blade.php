@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @include('layouts.sidebar')

            <div class="col-md-9 ">
                <div class="panel panel-default">


                    <div class="panel-body">
                        <form method="POST" action='{{url('posts/')}}'>
                            {{ csrf_field() }}
                            <textarea name='post_content' class='form-control' rows="5" cols="30"
                                      placeholder="Co słychać  ?" style="margin-bottom: .5rem"></textarea>
                            <button type='submit' class='btn btn-default pull-right'>Zapisz</button>
                        </form>
                    </div>
                </div>
                @foreach($posts as $post)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <img class="img-responsive marginesy"  src="{{url('users-avatar/'.$user->id.'/60')}}" alt="avatar"/>
                            {{$post->user->name}}
                        </div>

                        <div class="panel-body">
                            {{$post->content}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

