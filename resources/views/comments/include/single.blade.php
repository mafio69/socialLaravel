@if ( ! $loop->first)
    <hr style="margin: 10px 0;">
@endif

<div id="comment_{{ $comment->id }}" class="{{$comment->trashed() ? 'trashed' : ''}}">

    <img src="{{ url('users-avatar/'. $comment->user->id. '/35') }}" alt="" class="img-responsive pull-left marginesy">
    @if($post->deleted_at)
        <br><span class="text-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> {{$comment->deleted_at}}</span>
    @endif
    <div style="padding-left: 10px; ">
        <a href="{{ url('/users/' . $comment->user->id) }}"><strong>{{ $comment->user->name }}</strong></a> <small> <span class="pull-right">{{czas($comment->created_at)}}</span></small> <br>
        {{ $comment->content }}
        @include('comments.include.dropdownmenu')
    </div>


</div>

@section('footer')
    <script>
               function addHighlightClass() {
                   if (window.location.hash.substring(1)) {
                   let hash = window.location.hash.substring(1);
                   //console.log(hash);
                   let comment = document.getElementById(hash);
                   comment.classList.add('highlight');
                   comment.classList.add('highlightYellow');
                   setTimeout(function () {
                       comment.classList.remove('highlightYellow');
                   }, 4500);
               }
            }
            window.addEventListener('load',addHighlightClass);
            window.addEventListener('hashchange', function(){
                addHighlightClass();
            }, false);
    </script>
@endsection