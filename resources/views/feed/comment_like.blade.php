<div class="event">
  <div class="label">
    <i class="red heart icon"></i>
  </div>
  <div class="content">
    <div class="summary">
      @if(\Auth::id() == $feed->data['user_id'])
        You
      @else
        <a href="{{ url('profile', $feed->data['user_id']) }}">{{ $feed->data['user_name'] }}</a>
      @endif liked a comment on <a href="{{ url(lcfirst(class_basename($feed->data['commented_object_type'])),$feed->data['commented_object_id']) }}">{{ $feed->data['commented_object_name'] }}</a>
      <div class="date">
        {{ $feed->created_at->diffForHumans() }}
      </div>
    </div>
    @if($feed->data['body'])
      <div class="extra text">
        {{ $feed->data['body']}}
      </div>
    @endif
  </div>
</div>