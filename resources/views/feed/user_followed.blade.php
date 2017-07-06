<div class="event">
  <div class="label">
    <img src="{{ $feed->data['followed_avatar'] }}" alt="">
  </div>
  <div class="content">
    <div class="summary">
      @if(\Auth::id() == $feed->data['follower_id'])
        You
      @else
        <a href="{{ url('profile', $feed->data['follower_id']) }}">{{ $feed->data['follower_name'] }}</a>
      @endif
       followed
      @if(\Auth::id() == $feed->data['followed_id'])
        you.
      @else
        <a href="{{ url('profile', $feed->data['followed_id']) }}">{{ $feed->data['followed_name'] }}</a>
      @endif

      <div class="date">
        {{ $feed->created_at->diffForHumans() }}
      </div>
    </div>
    @if($feed->body)
      <div class="extra text">
        {{ $feed->body }}
      </div>
    @endif
  </div>
</div>