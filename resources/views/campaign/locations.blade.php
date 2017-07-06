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
  <form class="ui form" method="POST" action="{{ url('campaign/batch/locations') }}">
    {{ csrf_field() }}
    <input type="hidden" name="campaign" value="{{ $campaign->id }}">
    <div class="field">
      <div class="ui action fluid input">
        <select name="locations[]" id="" class="ui fluid search dropdown" multiple="true">
          @foreach($locations as $key => $value)
            <option value="{{ $key }}" {{ is_array(old('locations')) && in_array($key,old('locations')) ? 'selected':null }}>{{ $value }}</option>
          @endforeach
        </select>
        <button class="ui primary button" type="submit">Add Locations</button>
      </div>
    </div>
  </form>
  <table class="ui sortable striped unstackable celled table" id="location-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th class="default-sort">Added</th>
      </tr>
    </thead>
    <tbody>
    @forelse ($campaign->locations as $location)
      <tr>
        <td>


          @if($location->parent)
            <div class="ui small breadcrumb">
              <a href="{{ $location->parent }}" class="section">{{ $location->root()->name }}</a>
              <i class="right angle icon divider"></i>
              <a href="{{ url('location', $location->id) }}" class="section">
                {{ $location->name }}
              </a>
            </div>
          @else
            <a href="{{ url('location', $location->id) }}">
              {{ $location->name }}
            </a>
          @endif



          {{--
          <p class="text-muted">{{ $location->private_notes->first()->body or "No recent notes." }}</p> --}}
        </td>
        <td>
          {{ $location->type }} @if($location->subtype) / {{ $location->subtype }} @endif
        </td>
        <td>
          <span class="pull-left">{{ $location->pivot->created_at->diffForHumans() }}</span>
          <form class="ui form pull-right" method="POST" action="{{ url('campaign/remove/locations', $location->id) }}">
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
        <td>No locations added yet.</td>
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

  $('#location-table').tablesort().data('tablesort').sort($("th.default-sort"));
</script>
@endsection