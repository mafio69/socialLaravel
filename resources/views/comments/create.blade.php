@if(auth()->check())
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action="{{ url('/comments') }}">
                {{ csrf_field() }}

                <div class="pull-left">
                    <img src="{{ url('users-avatar/'. auth()->id() . '/35') }}" alt=""
                         class="img-circle img-responsive">
                </div>

                <div class="col-xs-11">
                    <div class="form-group{{ $errors->has('post_' . $post->id .'_comment_content') ? ' has-error' : '' }}">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                        <textarea name="post_{{ $post->id }}_comment_content" class="form-control"
                                  placeholder="Skomentuj" rows="1"
                                  value="{{ old('post_' . $post->id .'_comment_content') }}"
                                  style="margin-bottom: 10px;">{{ old('post_' . $post->id .'_comment_content') }} </textarea>
                        <button type="submit" class="btn btn-default btn-xs pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Skomentuj</button>

                        @if ($errors->has('post_' . $post->id .'_comment_content'))
                            <span class="help-block">
	                <strong>{{ $errors->first('post_' . $post->id .'_comment_content') }}</strong>
	            </span>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div>
@endif