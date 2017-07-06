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
  <form class="ui form" method="POST" action="{{ url('campaign/batch/monsters') }}">
    {{ csrf_field() }}
    <input type="hidden" name="campaign" value="{{ $campaign->id }}">
    <div class="field">
      <div class="ui action fluid input">
        <select class="ui fluid search dropdown" multiple="" name="monsters[]">
          @foreach($monsters as $monster)
            <option value="{{ $monster->id }}" {{ ((is_array(old('monsters')) && in_array($monster->id, old('monsters'))) ? "selected":"") }}>{{ $monster->name }}</option>
          @endforeach
        </select>
        <button class="ui primary button" type="submit">Add Monsters</button>
      </div>
    </div>
  </form>
  <table class="ui sortable striped unstackable celled table" id="monster-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Locations</th>
        <th class="default-sort">Added</th>
      </tr>
    </thead>
    <tbody>
    @forelse ($campaign->monsters as $monster)
      <tr>
        <td>
          <a href="{{ url('monster', $monster->id) }}">
            {{ $monster->name }}
          </a>

          {{--
          <p class="text-muted">{{ $monster->private_notes->first()->body or "No recent notes." }}</p> --}}
        </td>
        <td>
          @forelse($monster->locations as $location)
            <a href="/location/{{ $location->id }}">{{ $location->name }}@if(!$loop->last), @endif</a>
          @empty
            Not attached to any locations.
          @endforelse
        </td>
        <td>
          <span class="pull-left">{{ $monster->pivot->created_at->diffForHumans() }}</span>
          <form class="ui form pull-right" method="POST" action="{{ url('campaign/remove/monsters', $monster->id) }}">
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
        <td>No monsters added yet.</td>
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

  $('#monster-table').tablesort().data('tablesort').sort($("th.default-sort"));
</script>
@endsection