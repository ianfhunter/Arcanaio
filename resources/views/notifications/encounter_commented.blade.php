<div  class="item clearfix" style="display:block">
	<a href="{{url('encounter', $notification->data['encounter_id'])}}">{{ $notification->data['encounter_name'] }}</a> was commented on by <a href="{{ url('profile', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>.
	<small class="text-muted pull-right" style="display:block">{{ $notification->created_at->diffForHumans() }}</small>	
</div>