@extends('layouts.app')
@section('content')
@if(auth()->check())
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <form method="POST" action="{{ url('/comments/'.$comment->id) }}">
                {{ csrf_field() }}
                {{method_field('patch')}}
                <div class="pull-left">
                    <img src="{{ url('users-avatar/'. auth()->id() . '/35') }}" alt=""
                         class="img-circle img-responsive">
                </div>

                <div class="col-xs-11">
                    <div class="form-group{{ $errors->has('post_' . $comment->id.'_comment_content') ? ' has-error' : '' }}">
                        <input type="hidden" name="post_id" value="{{ $comment->id}}">

                        <textarea name="comment_content" class="form-control"
                                  placeholder="Skomentuj" rows="2"
                                  value="{{$comment->content}}"
                                  style="margin-bottom: 10px;">{{  $comment->content  }} </textarea>
                        <button type="submit" class="btn btn-default btn-sm pull-right">Popraw</button>

                        @if ($errors->has('comment_content'))
                            <span class="help-block">
	                <strong>{{ $errors->first('comment_content') }}</strong>
	            </span>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div>
@endif
    @endsection