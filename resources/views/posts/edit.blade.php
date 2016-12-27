@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                <form method="POST" action="{{ url('/posts/'.$post->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div class="form-group{{ $errors->has('post_content') ? ' has-error' : '' }}">
                        @if ($errors->has('post_content'))
                            <span class="help-block">
                <strong>{{ $errors->first('post_content') }}</strong>
            </span>
                        @endif
                        <textarea name="post_content" class="form-control" cols="60" rows="10" placeholder="Co słychać?"
                                  style="margin-bottom: 10px;">{{ $post->content }}</textarea>

                    </div>
                    <button type="submit" class="btn btn-default pull-right">Zapisz zmiany</button>

                </form>
            </div>

        </div>
    </div>
@endsection