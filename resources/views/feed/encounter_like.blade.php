<div class="event">
  <div class="label">
    <i class="red heart icon"></i>
  </div>
  <div class="content">
    <div class="summary">
      <a href="{{ url('profile', $feed->data['user_id']) }}">{{ $feed->data['user_name'] }}</a> liked <a href="{{ url('encounter', $feed->data['id']) }}">{{ $feed->data['name'] }}</a>
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