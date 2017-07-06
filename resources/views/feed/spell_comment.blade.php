<div class="event">
  <div class="label">
    <i class="comments icon"></i>
  </div>
  <div class="content">
    <div class="summary">
      @if(\Auth::id() == $feed->data['user_id'])
        You
      @else
        <a href="{{ url('profile', $feed->data['user_id']) }}">{{ $feed->data['user_name'] }}</a>
      @endif commented on <a href="{{ url('spell', $feed->data['id']) }}">{{ $feed->data['name'] }}</a>
      <div class="date">
        {{ $feed->created_at->diffForHumans() }}
      </div>
    </div>
    @if($feed->data['body'])
      <div class="extra text">
        {{ str_limit($feed->data['body'], 140) }}
      </div>
    @endif
  </div>
</div>