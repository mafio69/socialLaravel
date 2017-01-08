@if ( ! $loop->first)
    <hr style="margin: 10px 0;">
@endif

<div id="comment_{{ $comment->id }}">

    <img src="{{ url('users-avatar/'. $comment->user->id. '/35') }}" alt="" class="img-responsive pull-left marginesy">
    <div style="padding-left: 10px; ">
        <a href="{{ url('/users/' . $comment->user->id) }}"><strong>{{ $comment->user->name }}</strong></a> <small> <span class="pull-right">{{czas($comment->created_at)}}</span></small> <br>
        {{ $comment->content }}
        @include('comments.include.dropdownmenu')
    </div>


</div>