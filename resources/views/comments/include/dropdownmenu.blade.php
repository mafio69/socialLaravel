@if(belongs_to_auth(auth()->id()) ||is_admin() )
    <div class="dropdown pull-right">
        <a class="dropdown-toggle" id="dropdownMenu1"
           data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="true">
            <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="{{url('/comments/'.$comment->id .'/edit')}}"><i class="fa fa-pencil-square-o"
                                                                         aria-hidden="true"></i> Popraw</a></li>
            <li>
                <form method="post" action="{{url('comments/'.$comment->id)}}">
                    {{method_field('delete')}}  {{ csrf_field() }}
                    <button type="submit" onclick="return confirm('Czy na pewno?')" class=""><i
                                class="fa fa-trash" aria-hidden="true"></i> Usuń
                    </button>
                </form>
            </li>
        </ul>
    </div>

@endif