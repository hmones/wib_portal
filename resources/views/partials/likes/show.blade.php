<a href="javascript:void(0);" style="color:{{$reactions->contains('user_id',Auth::id())?'#4183c4':'#999999'}};"
    data-type="{{$type}}" data-id="{{$id}}"
    data-reaction-id="{{$reactions->contains('user_id',Auth::id())?$reactions->where('user_id',Auth::id())->first()->id:0}}"
    data-user-id={{Auth::id()}} class="thumbs up button">
    <i class="thumbs up icon"></i> <span>{{$reactions->count()}}</span> Likes
</a>