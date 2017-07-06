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
  <form class="ui form" method="POST" action="{{ url('campaign/batch/items') }}">
    {{ csrf_field() }}
    <input type="hidden" name="campaign" value="{{ $campaign->id }}">
    <div class="field">
      <div class="ui action fluid input">
        <select class="ui fluid search dropdown" multiple="" name="items[]">
          @foreach($items as $item)
            <option value="{{ $item->id }}" {{ ((is_array(old('items')) && in_array($item->id, old('items'))) ? "selected":"") }}>{{ $item->name }}</option>
          @endforeach
        </select>
        <button class="ui primary button" type="submit">Add Items</button>
      </div>
    </div>
  </form>
  <table class="ui sortable striped unstackable celled table" id="item-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Locations</th>
        <th class="default-sort">Added</th>
      </tr>
    </thead>
    <tbody>
    @forelse ($campaign->items as $item)
      <tr>
        <td>
          <a href="{{ url('item', $item->id) }}">
            {{ $item->name }}
          </a>

          {{--
          <p class="text-muted">{{ $item->private_notes->first()->body or "No recent notes." }}</p> --}}
        </td>
        <td>
          @forelse($item->locations as $location)
            <a href="/location/{{ $location->id }}">{{ $location->name }}@if(!$loop->last), @endif</a>
          @empty
            Not attached to any locations.
          @endforelse
        </td>
        <td>
          <span class="pull-left">{{ $item->pivot->created_at->diffForHumans() }}</span>
          <form class="ui form pull-right" method="POST" action="{{ url('campaign/remove/items', $item->id) }}">
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
        <td>No items added yet.</td>
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

  $('#item-table').tablesort().data('tablesort').sort($("th.default-sort"));
</script>

@endsection