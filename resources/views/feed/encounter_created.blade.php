<div class="event">
  <div class="label">
    <i class="large icon" data-icon="&#xe0ed;"></i>
  </div>
  <div class="content">
    <div class="summary">
      <a href="{{ url('profile', $feed->data['user_id']) }}">{{ $feed->data['user_name'] }}</a> created <a href="{{ url('encounter', $feed->data['id']) }}">{{ $feed->data['name'] }}</a>
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