@extends('layouts.app')

@section('title', $spell->name)

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      <h4 class="ui header">
        {{ Request::is('spell/fork/*') ? "Create":"Edit" }} a Spell
        <div class="sub header">
          <div class="ui breadcrumb">
            <a href="{{ url('/') }}" class="section">Home</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/spell') }}" class="section">Spells</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/spell/'.$spell->id) }}" class="section">{{ $spell->name }}</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{ Request::is('spell/fork/*') ? "Create":"Edit" }}</div>
          </div>
        </div>
      </h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  @include('spell.form')
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function()
  {
    $('.ui.search.dropdown').dropdown({ allowAdditions: true });
  });
</script>
@endsection