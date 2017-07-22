<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-default">
            <div class="clearfix panel-heading {{$post->trashed() ? 'trashed' : ''}}">
                <img src="{{ url('users-avatar/'. $post->user->id . '/50') }}" alt="" class="img-responsive pull-left">

                <div class="pull-left" style="margin: 3px 10px;">
                    <a href="{{ url('/users/' . $post->user->id) }}"><strong>{{ $post->user->name }}</strong></a><br>
                    <a href="{{ url('/posts/' . $post->id) }}" class="text-muted">
                        <small><span class="glyphicon glyphicon-time"></span> {{ $post->created_at }} </small>

                        <small> {{czas($post->created_at)}}</small>
                    </a>
                    @if($post->deleted_at)
                        <br><i class="fa fa-trash-o" aria-hidden="true"></i> <span
                                class="text-danger">{{$post->deleted_at}}</span>
                    @endif
                </div>
                @if (belongs_to_auth($post->user->id) ||is_admin())

                    @include('posts.include.dropdownmenu')

                @endif
            </div>
            <div class="panel-body">
                <div id="post_{{ $post->id }}" style="margin-top: 10px;" class="{{$post->trashed() ? 'trashed' : ''}}">
                    {{ $post->content }}
                </div>

                    <form method="post" action="{{url('/likes')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="post_id" value="{{$post->id }}">
                        <button type="submit" class="btn btn-primary btn-xs marginesy ">
                            <span class="glyphicon glyphicon-thumbs-up"></span>
                             Polub <span class="label label-info">{{$post->likes->count()}}</span>
                        </button>
                    </form>

                <hr class="marginesy">
                @include('comments.create')

                @foreach($post->comments as $comment)
                    @include('comments.include.single')
                @endforeach

            </div>
        </div>
    </div>
</div>
