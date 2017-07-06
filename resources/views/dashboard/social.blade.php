@extends('layouts.app')

@section('title', 'Dashboard')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="row">
      <div class="ui eight wide column">
        @include('dashboard.menu')
      </div>
      <div class="ui eight wide column">
         <div class="ui grid">
          <div class="ui sixteen wide mobile only column">
            <div class="ui labeled icon dropdown primary fluid button">
              <i class="down caret icon"></i>
              <span class="text">Create</span>
              <div class="menu">
                <a class="item" href="/campaign/create">
                  <i class="large icon" data-icon="&#xe096;"></i>
                  Campaign
                </a>
                <a class="item" href="/monster/create">
                  <i class="large icon" data-icon="&#xe016;"></i>
                  Monster
                </a>
                <a class="item" href="/item/create">
                  <i class="large icon" data-icon="&#xe128;"></i>
                  Item
                </a>
                <a class="item" href="/spell/create">
                  <i class="large icon" data-icon="&#xe0c9;"></i>
                  Spell
                </a>
                <a class="item" href="/npc/create">
                  <i class="large icon" data-icon="&#xe2ee;"></i>
                  NPC
                </a>
                <a class="item" href="/location/create">
                  <i class="large icon" data-icon="&#xe112;"></i>
                  Location
                </a>
              </div>
            </div>
          </div>
          <div class="ui right floated ten wide mobile hidden column">
            <div class="ui labeled icon dropdown primary fluid button">
              <i class="down caret icon"></i>
              <span class="text">Create</span>
              <div class="menu">
                <a class="item" href="/campaign/create">
                  <i class="large icon" data-icon="&#xe096;"></i>
                  Campaign
                </a>
                <a class="item" href="/monster/create">
                  <i class="large icon" data-icon="&#xe016;"></i>
                  Monster
                </a>
                <a class="item" href="/item/create">
                  <i class="large icon" data-icon="&#xe128;"></i>
                  Item
                </a>
                <a class="item" href="/spell/create">
                  <i class="large icon" data-icon="&#xe0c9;"></i>
                  Spell
                </a>
                <a class="item" href="/npc/create">
                  <i class="large icon" data-icon="&#xe2ee;"></i>
                  NPC
                </a>
                <a class="item" href="/location/create">
                  <i class="large icon" data-icon="&#xe112;"></i>
                  Location
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui eleven wide column">

  <div class="ui feed">
    @forelse($feeds as $feed)
      @include('feed.'.$feed->type)
    @empty
      <p class="item">No activity yet. Try following some users then check back later!</p>
    @endforelse
  </div>

  <div class="text-center">
    {{ $feeds->links() }}
  </div>
</div>

<div class="ui five wide column">
  @include('dashboard.right')
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $('.pointing.menu .item').tab();
});
</script>
@endsection
