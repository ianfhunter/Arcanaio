@extends('layouts.app')

@section('title', 'Edit Monster')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      <h4 class="ui header">
        {{ Request::is('monster/fork/*') ? "Create":"Edit" }} a Monster
        <div class="sub header">
          <div class="ui breadcrumb">
            <a href="{{ url('/') }}" class="section">Home</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/monster') }}" class="section">Monsters</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/monster/'.$monster->id) }}" class="section">{{ $monster->name }}</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{ Request::is('monster/fork/*') ? "Create":"Edit" }}</div>
          </div>
        </div>
      </h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  <div class="ui fluid steps"  id="create-monster-form">
    <a class="active step" data-tab="first">
      <i class="icon" data-icon="&#xe016;"></i>
      <div class="content">
        <div class="title">Basics</div>
        <div class="description">Main details.</div>
      </div>
    </a>
    <a class="step" data-tab="second">
      <i class="icon" data-icon="&#xe141;"></i>
      <div class="content">
        <div class="title">Skills, Senses & Modifiers</div>
        <div class="description">Unique traits.</div>
      </div>
    </a>
    <a class="step" data-tab="third">
      <i class="icon" data-icon="&#xe033;"></i>
      <div class="content">
        <div class="title">Spells, Abilities & Actions</div>
        <div class="description">What your monster can do.</div>
      </div>
    </a>
  </div>

  @include('monster.form')

</div>
@endsection

@section('scripts')

  @include('monster.scripts')

@endsection