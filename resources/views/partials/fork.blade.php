<div class="ui fluid feed">
    <div class="event">
      <div class="label">
        <img src="{{ $data->user->avatar }}">
      </div>
      <div class="content">
        <div class="date">
          {{ $data->created_at->diffForHumans() }}
        </div>
        <div class="summary">
          <a href="{{ url('profile', $data->user->id) }}">{{ $data->user->name }}</a> created this {{ $type == 'npc' ? 'NPC':$type  }}.
        </div>
      </div>
    </div>
    @if($data->forkedFrom)
    <div class="event">
      <div class="label">
        <i class="icon fork"></i>
      </div>
      <div class="content">
        <div class="summary">
          This {{ $type == 'npc' ? 'NPC':$type }} was created from <a href="{{ url($type, $data->forkedFrom->id) }}">{{ $data->forkedFrom->name }}</a>.
        </div>
      </div>
    </div>
    @endif
    @if($data->forkedTo)
      @foreach($data->forkedTo as $forked)
        @if(!$forked->private)
          <div class="event">
            <div class="label">
              <i class="icon" data-icon="&#xe097;"></i>
            </div>
            <div class="content">
              <div class="summary">
                This {{ $type == 'npc' ? 'NPC':$type  }} was used to create <a href="{{ url($type, $forked->id) }}">{{ $forked->name }}</a>.
              </div>
            </div>
          </div>
        @endif
      @endforeach
    @endif
  </div>