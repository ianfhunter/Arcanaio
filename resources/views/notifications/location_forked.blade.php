<div  class="item clearfix" style="display:block">
	<a href="{{url('location', $notification->data['forked_id'])}}">{{ $notification->data['forked_name'] }}</a> was used to create <a href="{{url('location', $notification->data['location_id'])}}">{{ $notification->data['location_name'] }}</a> by <a href="{{ url('profile', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>.
	<small class="text-muted pull-right" style="display:block">{{ $notification->created_at->diffForHumans() }}</small>	
</div>