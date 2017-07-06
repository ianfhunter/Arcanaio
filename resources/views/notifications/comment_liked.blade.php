<div  class="item clearfix" style="display:block">
	Your comment on <a href="{{url(lcfirst(class_basename($notification->data['object_type'])), $notification->data['object_id'])}}">{{ $notification->data['object_name'] }}</a> was liked by {{ $notification->data['user_name'] }}.
	<small class="text-muted pull-right" style="display:block">{{ $notification->created_at->diffForHumans() }}</small>	
</div>