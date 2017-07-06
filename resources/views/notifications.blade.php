@extends('layouts.app')

@section('title', 'Notifications')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      <h2 class="ui header">
        {{ Auth::user()->name }}'s Notifications
        <div class="sub header">
          <div class="ui breadcrumb">
            <a class="section" href="/dashboard">Dashboard</a>
            <div class="divider"> / </div>
            <div class="active section">Notifications</div>
          </div>
        </div>
      </h2>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  <div class="ui items">
    @forelse(Auth::user()->notifications as $notification)
      @include('notifications.'.snake_case(class_basename($notification->type)))
    @empty
      <p class="item">No new notifications.</p>
    @endforelse
  </div>
</div>
@endsection