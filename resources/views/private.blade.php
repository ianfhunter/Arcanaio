@extends('layouts.app')

@section('title', 'Oops')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      <h4 class="ui header">
        What are you doing here?
        <div class="sub header">
          You rolled a critical failure on your stealth check.
        </div>
      </h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui one column centered grid">
  <div class="column">
    <div class="text-center margin-t">
      <h2 class="ui icon header">
        <i class="icon" data-icon="&#xe10f;"></i>
        <div class="content">
          Private Content
          <div class="sub header">The creator has made this record private.</div>
        </div>
      </h2>
    </div>
  </div>
</div>
@endsection

@section('scripts')

@endsection
