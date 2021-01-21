<a href="javascript:void(0);"
   data-type="{{$type}}" data-id="{{$id}}"
   data-reaction-id="{{$reactions->contains('user_id',Auth::id())?$reactions->where('user_id',Auth::id())->first()->id:0}}"
   data-user-id="{{Auth::id()}}"
   class="thumbs up ui basic {{$reactions->contains('user_id',Auth::id())?'teal':''}} mini button">
    <i class="thumbs up icon"></i> Like
</a>