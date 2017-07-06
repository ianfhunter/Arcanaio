@extends('layouts.app')

@section('title', 'Oops')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      <h4 class="ui header">
        Oops, something went wrong.
        <div class="sub header">
          You rolled a critical failure.
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
          Content Deleted
          <div class="sub header">The creator has deleted this record.</div>
        </div>
      </h2>
    </div>
  </div>
</div>
@endsection

@section('scripts')

@endsection
