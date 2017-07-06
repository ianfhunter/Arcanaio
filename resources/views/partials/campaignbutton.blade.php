<div class="ui floating labeled icon dropdown fluid button" id="campaign-button">
  <i class="icon" data-icon="&#xe096;"></i>
  <span class="text">Add to Campaign</span>
  <div class="menu">
    @forelse(\Auth::user()->campaigns as $campaign)
      <form class="ui form" method="POST" action="{{ url('campaign/add', [$type,$id]) }}">
        {{ csrf_field() }}
        <input type="hidden" name="campaign" value="{{ $campaign->id }}">
          <button class="item link-button" type="submit">

             {{ $campaign->name }}

          </button>
      </form>
    @empty
      <a class="item" href="/campaign/create">
        No campaigns. Create one!
      </a>
    @endforelse
  </div>
</div>