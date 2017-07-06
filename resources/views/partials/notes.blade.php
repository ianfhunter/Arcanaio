<div class="ui comments">
      @if(!$notes->isEmpty())
        @foreach($notes as $note)
          <div class="comment">
            <a class="avatar">
              <img src="{{ $note->user->avatar }}">
            </a>
            <div class="content">
              <a class="author" href="{{ url('profile', $note->user->id) }}">{{ $note->user->name }}</a>
              <div class="metadata">
                <span class="date">{{ $note->created_at->diffForHumans() }}</span>
              </div>
              <div class="text">
                {!! clean($note->body) !!}
              </div>
              <div class="actions">
                @can('delete', $note)
                  <a class="delete" href="{{ url('note/delete', $note->id) }}"><i class="trash icon"></i>Delete</a>
                @endcan
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="ui message">
          <div class="ui small header">Your Eyes Only</div>
          <p class="text-muted">This is where you can keep details specific to your campaign. These notes are only visible to you.</p>
        </div>
      @endif
      @if(Auth::check())
        <form class="ui reply form" method="POST" action="{{ url('note', [$type,$id]) }}">
          {{ csrf_field() }}
          <div class="field">
            <textarea name="body" rows="3" class="trumbowyg"></textarea>
          </div>
          <div class="clearfix">
            <button type="submit" class="ui primary labeled submit icon right floated tiny button">
              <i class="icon edit"></i> Add Note
            </button>
          </div>
        </form>
      @else
        <h4 class="ui header text-center">You must be <a href="{{ url('login') }}">logged in</a> to leave a note.</h4>
      @endif
    </div>