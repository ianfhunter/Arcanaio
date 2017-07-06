<div  class="item clearfix" style="display:block">
	<a href="{{url('npc', $notification->data['npc_id'])}}">{{ $notification->data['npc_name'] }}</a> was liked by <a href="{{ url('profile', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>.
	<small class="text-muted pull-right" style="display:block">{{ $notification->created_at->diffForHumans() }}</small>	
</div>