<div class="panel panel-default">
    <div class="panel-body">

		<div class="clearfix">
			<img src="{{ url('users-avatar/'. $post->user->id . '/50') }}" alt="" class="img-responsive pull-left">
			<div class="pull-left" style="margin: 3px 10px;">
				<a href="{{ url('/users/' . $post->user->id) }}"><strong>{{ $post->user->name }}</strong></a><br>
				<a href="{{ url('/posts/' . $post->id) }}" class="text-muted"><small><span class="glyphicon glyphicon-time"></span> {{ $post->created_at }}</small></a>
			</div>
		</div>

 		<div id="post_{{ $post->id }}" style="margin-top: 10px;">
			{{ $post->content }}
		</div>

    </div>
</div>
