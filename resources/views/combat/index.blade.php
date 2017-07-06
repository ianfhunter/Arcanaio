@extends('layouts.app')

@section('title', 'Initiative Tracker')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui eight wide column">
      <h4 class="ui header">
        Initiative Tracking
        <div class="sub header">Combat management tool.</div>
      </h4>
    </div>
    <div class="ui eight wide column">
      @if(Auth::check())
        <div class="ui grid">
          <div class="ui sixteen wide mobile only column">
            <div class="ui fluid buttons">
              <div class="ui labeled icon button load-modal-trigger"><i class="folder open outline icon"></i> Load</div>
              <div class="ui primary right labeled icon button save-modal-trigger" onClick ="$('#initiative-table').tableExport({type:'json',escape:'false',htmlContent:'true'});"><i class="save icon"></i> Save</div>
            </div>
          </div>
          <div class="ui ten wide mobile hidden right floated column">
            <div class="ui fluid buttons">
              <div class="ui labeled icon button load-modal-trigger"><i class="folder open outline icon"></i> Load</div>
              <div class="ui primary right labeled icon button save-modal-trigger" onClick ="$('#initiative-table').tableExport({type:'json',escape:'false',htmlContent:'true'});"><i class="save icon"></i> Save</div>
            </div>
          </div>
        </div>
      @else
      <div class="ui grid">
        <div class="ui sixteen wide mobile only column">
          <div class="ui primary labeled icon fluid disabled button"><i class="add icon"></i> Log In to Save</div>
        </div>
        <div class="ui ten wide mobile hidden right floated column">
          <div class="ui primary labeled icon fluid disabled button"><i class="add icon"></i> Log In to Save</div>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  <table class="ui sortable fluid celled unstackable table" id="initiative-table">
    <thead>
      <tr>
        <th class="ten wide">Character</th>
        <th class="two wide default-sort">Init</th>
        <th class="two wide">AC</th>
        <th class="two wide">HP</th>
        <th><i class="trash icon"></i></th>
      </tr>
    </thead>
    <tbody>
      @if($data)
        @foreach($data['0']->data as $row)
          <tr>
            <td>{!! $row['0'] !!}</td>
            <td class="edit" contenteditable>{{ $row['1'] }}</td>
            <td contenteditable>{{ $row['2'] }}</td>
            <td contenteditable>{{ $row['3'] }}</td>
            <td class="collapsing" contenteditable><div class="ui compact icon mini right floated basic red circular button delete"><i class="delete icon"></i></div></td>
          </tr>
        @endforeach
      @else
        <tr>
          <td contenteditable>Example Player (click to edit)</td>
          <td class="edit" contenteditable>11</td>
          <td contenteditable>10</td>
          <td contenteditable>30</td>
          <td class="collapsing" contenteditable><div class="ui compact icon mini right floated basic red circular button delete"><i class="delete icon"></i></div></td>
        </tr>
      @endif
    </tbody>
  </table>

  <div class="ui fluid basic button margin-b-1" id="add-row"><i class="add icon"></i>Add Row</div>

  <div class="ui hidden divider"></div>

  <div class="ui horizontal divider">
    Or
  </div>

  <div class="ui hidden divider"></div>
  <div class="ui hidden divider"></div>

  <div class="ui grid">
    <div class="row compact">
      <div class="ten wide column">
        <select class="ui fluid search dropdown" name="monsters[]" id="monster-select">
          @foreach($monsters as $monster)
            <option value="{{ $monster->id }}" {{ ((is_array(old('monsters')) && in_array($monster->id, old('monsters'))) ? "selected":"") }}>{{ $monster->name }}</option>
          @endforeach
        </select>

      </div>
      <div class="six wide column">
        <div class="ui labeled icon fluid button monster-add"><i class="plus icon"></i> Monster</div>
      </div>
    </div>

    <div class="row compact">
      <div class="ten wide column">
        <select class="ui fluid search dropdown" name="npcs[]" id="npc-select">
          @foreach($npcs as $npc)
            <option value="{{ $npc->id }}" {{ ((is_array(old('npcs')) && in_array($npc->id, old('npcs'))) ? "selected":"") }}>{{ $npc->name }}</option>
          @endforeach
        </select>

      </div>
      <div class="six wide column">
        <div class="ui labeled icon fluid button npc-add"><i class="plus icon"></i> NPC</div>
      </div>
    </div>

    @if(Auth::check())
      <div class="row compact">
        <div class="ten wide column">
          <select class="ui fluid search dropdown" name="players[]" id="player-select">
            @foreach($players as $player)
              <option value="{{ $player['id'] }}" {{ ((is_array(old('players')) && in_array($player['id'], old('players'))) ? "selected":"") }}>{{ $player['name'] }}</option>
            @endforeach
          </select>

        </div>
        <div class="six wide column">
          <div class="ui labeled icon fluid button player-add"><i class="plus icon"></i> Player</div>
        </div>
      </div>
    @else
      <div class="row compact">
        <div class="ten wide column">
          <select class="ui fluid search disabled dropdown" name="players[]" id="player-select">
            <option value="none">Log in or create account to save player info...</option>
          </select>

        </div>
        <div class="six wide column">
          <div class="ui labeled icon fluid disabled button player-add"><i class="plus icon"></i> Player</div>
        </div>
      </div>
    @endif
  </div>

  <h4 class="ui header">Tips:</h4>
  <div class="ui bulleted list">
    <li class="item">Table headers sort on click.</li>
    <li class="item">Most cells are manually editable.</li>
    <li class="item">Monster/NPC link opens in new tab by default.</li>
    <li class="item">If you have an account, you can create Players to save AC & HP and quickly add each time.</li>
  </div>
</div>
@endsection

@section('scripts')

<div class="ui modal" id="save-modal">
  <div class="header">Save Combat</div>
  <div class="content">
    <form action="@if($data) {{ route('combat.update', $combat->id) }} @else {{ route('combat.store') }} @endif" class="ui form" method="POST">
      {{ csrf_field() }}
      @if($data)
        {{ method_field('PUT') }}
      @endif
      <div class="field">
        <label for="">Name</label>
        <input type="text" name="name" value="@if($data){{ $combat->name }}@endif">
        <input type="hidden" value="" id="combat-data" name="data">
      </div>
      <button class="ui fluid primary button" type="submit">Save</button>
    </form>
  </div>
</div>

<div class="ui modal" id="load-modal">
  <div class="header">Saved Combat Encounters</div>
  <div class="content">
    <table class="ui unstackable table" id="load-table">
      <thead>
        <th>Name</th>
        <th>Created</th>
        <th class="collapsing"><i class="trash icon"></i></th>
      </thead>
      <tbody>

        @if(!$combat_list)
          <tr>
            <td>No saved combat encounters.</td>
            <td></td>
            <td></td>
          </tr>
        @else
          @foreach($combat_list as $combat)
            <tr>
              <td><a href="/combat/{{ $combat->id }}">{{ $combat->name }}</a></td>
              <td>{{ $combat->created_at->diffForHumans() }}</td>
              <td>
                <form class="ui form pull-right" method="POST" action="{{ url('combat', $combat->id) }}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button class="ui mini basic icon compact red button pull-right" type="submit">

                     <i class="remove icon"></i>

                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

<script type="text/javascript" src="/js/tableExport.js"></script>
<script type="text/javascript" src="/js/jquery.base64.js"></script>
<script>

  var monster_array = {};
  var npc_array = {};
  var player_array = {};
  monster_array[0] = {'name': 'none'};
  npc_array[0] = {'name': 'none'};
  player_array[0] = {'name': 'none'};

  @foreach($monsters as $monster)
    monster_array[{{ $monster->id }}] = {'name': '{{ $monster->name }}', 'ac':'{{ $monster->AC }}', 'dex':'{{ $monster->dexterity }}', 'hp':'{{ $monster->HP }}'};
  @endforeach

  @foreach($npcs as $npc)
    npc_array[{{ $npc->id }}] = {'name': '{{ $npc->name }}', 'ac':'{{ $npc->AC }}', 'dex':'{{ $npc->dexterity }}', 'hp':'{{ $npc->HP }}'};
  @endforeach

  @foreach($players as $player)
    player_array[{{ $player['id'] }}] = {'name': '{{ $player['name'] }}', 'ac':'{{ $player['AC'] }}', 'dex':'{{ $player['dexterity'] }}', 'hp':'{{ $player['HP'] }}'};
  @endforeach

  function getRandomInt(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  function checkDuplicates(name){
    var count = 0;
    $('#initiative-table td:first-child a').each(function() {
      if(name == $(this).text()){
        count++;
      }
    });

    if(count == 0){
      return '';
    }else{
      return '<div class="ui mini label">'+count+'</div>';
    }

  }

  $('#initiative-table').tablesort().data('tablesort').sort($("th.default-sort"));

  $('#add-row').on('click', function(e) {
    $('#initiative-table > tbody:last-child').append('<tr><td contenteditable>New Player</td><td contenteditable></td><td contenteditable></td><td contenteditable></td><td class="collapsing"><div class="ui compact icon mini right floated basic red circular button delete"><i class="delete icon"></i></div></td></tr>');
  });

  $(document).on('click', '.monster-add', function () {
      {

        var selected_monster = $('#monster-select :selected');

        selected_monster.each(function () {
          var init = Math.floor((monster_array[$(this).val()]['dex'] - 10) / 2) + getRandomInt(1,20);

          var number = checkDuplicates(monster_array[$(this).val()]['name']);

          $('#initiative-table').append('<tr><td><a href="/monster/'+$(this).val()+'" target="_blank">'+monster_array[$(this).val()]['name']+'</a> '+number+'</td><td contenteditable>'+init+'</td><td contenteditable>'+monster_array[$(this).val()]['ac']+'</td><td contenteditable>'+monster_array[$(this).val()]['hp']+'</td><td class="collapsing"><div class="ui compact icon mini right floated basic red circular button delete"><i class="delete icon"></i></div></td></tr>');
        });



        $('#initiative-table').tablesort().data('tablesort').sort($("th.default-sort"));
        return false;
      }
  });

  $(document).on('click', '.npc-add', function () {
      {

        var selected_npc = $('#npc-select :selected');

        selected_npc.each(function () {
          var init = Math.floor((npc_array[$(this).val()]['dex'] - 10) / 2) + getRandomInt(1,20);
          var number = checkDuplicates(npc_array[$(this).val()]['name']);
          $('#initiative-table').append('<tr><td><a href="/npc/'+$(this).val()+'" target="_blank">'+npc_array[$(this).val()]['name']+'</a> '+number+'</td><td contenteditable>'+init+'</td><td contenteditable>'+npc_array[$(this).val()]['ac']+'</td><td contenteditable>'+npc_array[$(this).val()]['hp']+'</td><td class="collapsing"><div class="ui compact icon mini right floated basic red circular button delete"><i class="delete icon"></i></div></td></tr>');
        });

        $('#initiative-table').tablesort().data('tablesort').sort($("th.default-sort"));
        return false;
      }
  });

  $(document).on('click', '.player-add', function () {
      {

        var selected_player = $('#player-select :selected');

        selected_player.each(function () {
          var init = Math.floor((player_array[$(this).val()]['dex'] - 10) / 2) + getRandomInt(1,20);
          $('#initiative-table').append('<tr><td><a href="/character/'+$(this).val()+'" target="_blank">'+player_array[$(this).val()]['name']+'</a></td><td contenteditable>'+init+'</td><td contenteditable>'+player_array[$(this).val()]['ac']+'</td><td contenteditable>'+player_array[$(this).val()]['hp']+'</td><td class="collapsing"><div class="ui compact icon mini right floated basic red circular button delete"><i class="delete icon"></i></div></td></tr>');
        });

        $('#initiative-table').tablesort().data('tablesort').sort($("th.default-sort"));
        return false;
      }
  });

  $(document).on('blur', 'td.edit', function() {
    $('#initiative-table').tablesort().data('tablesort').sort($("th.default-sort"));
  });

  $(document).ready(function() {
      $("#initiative-table").on("click", ".delete", function(e) {

          $(this).closest('tr').transition({
              animation  : 'fade',
              duration   : '0.5s',
              onComplete : function() {
                $(this).closest('tr').remove();
              }
            })
          ;
          return false;
      });
  });

  $('.load-modal-trigger').click(function(){
      $('#load-modal').modal('show');
  });

  $('.save-modal-trigger').click(function(){
      $('#save-modal').modal('show');
  });

</script>
@endsection