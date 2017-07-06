  <h4 class="ui horizontal divider header">
    <i class="comments outline icon"></i>
    Comments
  </h4>

  <div class="ui comments">
    @if($data)
      @foreach($data as $comment)
        <div class="comment">
          <a class="avatar">
            <img src="{{ $comment->user->avatar }}">
          </a>
          <div class="content">
            <a class="author" href="{{ url('profile', $comment->user->id) }}">{{ $comment->user->name }}</a>
            <div class="metadata pull-right">
              <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="text">
              {{ $comment->body }}
            </div>
            <div class="actions">
              <like-button id="{{ $comment->id }}" type="comment" count="{{ $comment->likes->count() }}" liked="{{ $comment->likes->contains('user_id', \Auth::id()) }}"></like-button>
              @can('delete', $comment)
                <a class="delete" href="{{ url('comment/delete', $comment->id) }}">/ Delete</a>
              @endcan
            </div>
          </div>
        </div>
      @endforeach
    @endif
    @if(Auth::check())
      <form class="ui reply form" method="POST" action="{{ url('comment', [$type,$id]) }}">
        {{ csrf_field() }}
        <div class="field">
          <textarea name="body" id="comment-form" maxlength="1000"></textarea>
        </div>
        <div class="clearfix">
          <button type="submit" class="ui primary labeled submit icon right floated tiny button">
            <i class="icon edit"></i> Add Comment
          </button>
        </div>
      </form>
    @else
      <h4 class="ui header text-center">You must be <a href="{{ url('login') }}">logged in</a> to leave a comment.</h4>
    @endif
  </div>


