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
  <form class="ui form" method="POST" action="{{ url('campaign/batch/npcs') }}">
    {{ csrf_field() }}
    <input type="hidden" name="campaign" value="{{ $campaign->id }}">
    <div class="field">
      <div class="ui action fluid input">
        <select class="ui fluid search dropdown" multiple="" name="npcs[]">
          @foreach($npcs as $npc)
            <option value="{{ $npc->id }}" {{ ((is_array(old('npcs')) && in_array($npc->id, old('npcs'))) ? "selected":"") }}>{{ $npc->name }}</option>
          @endforeach
        </select>
        <button class="ui primary button" type="submit">Add NPCs</button>
      </div>
    </div>
  </form>
  <table class="ui sortable striped unstackable celled table" id="npc-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Locations</th>
        <th class="default-sort">Added</th>
      </tr>
    </thead>
    <tbody>
    @forelse ($campaign->npcs as $npc)
      <tr>
        <td>
          <a href="{{ url('npc', $npc->id) }}">
            {{ $npc->name }}
          </a>

          {{--
          <p class="text-muted">{{ $npc->private_notes->first()->body or "No recent notes." }}</p> --}}
        </td>
        <td>
          @forelse($npc->locations as $location)
            <a href="/location/{{ $location->id }}">{{ $location->name }}@if(!$loop->last), @endif</a>
          @empty
            Not attached to any locations.
          @endforelse
        </td>
        <td>
          <span class="pull-left">{{ $npc->pivot->created_at->diffForHumans() }}</span>
          <form class="ui form pull-right" method="POST" action="{{ url('campaign/remove/npcs', $npc->id) }}">
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
        <td>No npcs added yet.</td>
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

  $('#npc-table').tablesort().data('tablesort').sort($("th.default-sort"));
</script>
@endsection