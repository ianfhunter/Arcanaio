<div  class="item clearfix" style="display:block">
	<a href="{{url('spell', $notification->data['spell_id'])}}">{{ $notification->data['spell_name'] }}</a> was liked by <a href="{{ url('profile', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>.
	<small class="text-muted pull-right" style="display:block">{{ $notification->created_at->diffForHumans() }}</small>	
</div>