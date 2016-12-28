<div class="dropdown pull-right">
    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></a>
    <ul class="dropdown-menu">
        <li><a href="{{url('posts/'.$post->id.'/edit')}}" class=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edytuj</a></li>
        <li class="text-center">
            <form method="post" action="{{url('posts/'.$post->id)}}">
                {{method_field('delete')}}  {{ csrf_field() }}
                <button type="submit" onclick="return confirm('Czy na pewno?')" class=""><i class="fa fa-trash" aria-hidden="true"></i> Usuń</button>
            </form>
        </li>
    </ul>
   </ul>
</div>