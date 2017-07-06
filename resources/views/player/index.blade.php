@extends('layouts.app')

@section('title', 'Characters')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="row">
      <div class="ui eight wide column">
        <h4 class="ui header">
          Character Collection
          <div class="sub header">A list of your active characters.</div>
        </h4>
      </div>
      <div class="ui eight wide column">
        <div class="ui grid">
          <div class="ui sixteen wide mobile only column">
            <a href="{{ url('character/create') }}" class="ui primary labeled icon fluid button" onclick="ga('send', 'event', 'character', 'create');"><i class="add icon"></i> Create Character</a>
          </div>
          <div class="ui right floated ten wide mobile hidden column">
            <a href="{{ url('character/create') }}" class="ui primary labeled icon fluid button" onclick="ga('send', 'event', 'character', 'create');"><i class="add icon"></i> Create Character</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  <table class="ui fluid celled unstackable table">
    <thead>
      <tr><th>Character</th>
      <th>Classes</th>
      <th>Race</th>
      <th>Created</th>
    </tr></thead>
    <tbody>
      @if(!$players->isEmpty())
        @foreach($players as $player)
          <tr>
            <td><a href="{{ url('character', $player->id) }}">{{ $player->name }}</a></td>
            <td>
              @if($player->classes != NULL)
                @foreach(json_decode($player->classes, true) as $class)
                  @if(!empty($class['name']))
                    {{ $class['name'] }} {{ $class['level'] }}
                    @if(!$loop->last) / @endif
                  @else
                    @if($loop->last) No Classes @endif
                  @endif
                @endforeach
              @else
                No class selected.
              @endif
            </td>
            <td>{{ $player->race }}</td>
            <td>{{ $player->created_at->diffForHumans() }}</td>
          </tr>
        @endforeach
      @else
        <tr>
          <td>No players yet.</td>
          <td><a href="/character/create">Create a Character</a></td>
        </tr>
      @endif
    </tbody>
  </table>
</div>
@endsection
