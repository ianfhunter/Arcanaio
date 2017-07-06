@extends('layouts.app')

@section('title', $campaign->name)

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      @include('campaign.menu')
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  <table class="ui sortable striped unstackable celled table" id="player-table">
    <thead>
      <tr>
        <th class="default-sort">Name</th>
        <th>Classes</th>
        <th>Race</th>
      </tr>
    </thead>
    <tbody>
    @forelse ($campaign->players as $player)
      <tr>
        <td>
          <a href="{{ url('character', [$player->id, $player->key]) }}">
            {{ $player->name }}
          </a>

          {{--
          <p class="text-muted">{{ $player->private_notes->first()->body or "No recent notes." }}</p> --}}
        </td>
        <td>

          @foreach(json_decode($player->classes, true) as $class)
            @if(!empty($class['name']))
              {{ $class['name'] }} {{ $class['level'] }}
              @if(!$loop->last) / @endif
            @else
              @if($loop->last) No Classes @endif
            @endif
          @endforeach
        </td>
        <td>
          <span class="pull-left">{{ $player->race or "No Race"}}</span>
          <form class="ui form pull-right" method="POST" action="{{ url('campaign/remove/players', $player->id) }}">
            {{ csrf_field() }}
            <input type="hidden" name="campaign" value="{{ $campaign->id }}">
              <button class="ui mini basic icon compact red button pull-right" type="submit">

                 <i class="remove icon"></i>

              </button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td>No players added yet.</td>
        <td>N/A</td>
        <td>N/A</td>
      </tr>
    @endforelse
    </tbody>
  </table>
</div>
@endsection

@section('scripts')
<script>
  $('#delete-modal-trigger').click(function(){
      $('#delete-modal').modal('show');
  });
  $('#journal-create').click(function(){
      $('#journal-modal').modal('show');
  });

  $('#player-table').tablesort().data('tablesort').sort($("th.default-sort"));
</script>
@endsection