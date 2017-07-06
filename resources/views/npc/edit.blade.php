@extends('layouts.app')

@section('title', 'Edit '.$npc->name)

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      <h4 class="ui header">
        {{ Request::is('npc/fork/*') ? "Create":"Edit" }} an NPC
        <div class="sub header">
          <div class="ui breadcrumb">
            <a href="{{ url('/') }}" class="section">Home</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/npc') }}" class="section">NPCs</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/npc/'.$npc->id) }}" class="section">{{ $npc->name }}</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{ Request::is('npc/fork/*') ? "Create":"Edit" }}</div>
          </div>
        </div>
      </h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">

  @include('npc.form')

</div>
@endsection

@section('scripts')
  @include('npc.scripts')
@endsection