@extends('layouts.app')

@section('title', $user->name)

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="row">
      <div class="ui eight wide column">
        <h2 class="ui header">
          <img src="{{ $user->avatar }}" class="ui circular image">
          <div class="content">
            {{ $user->name }}
            <div class="sub header">{{ $follower_count }} Followers / {{ $following_count }} Following</div>
          </div>
        </h2>
      </div>
      <div class="ui eight wide column">
        <div class="ui grid">
          <div class="ui sixteen wide mobile only column">
            @if(!$user->isFollowedBy(\Auth::user()))
              <form action="{{ url('profile/follow', $user->id) }}" method="POST" class="ui form">
                {{ csrf_field() }}

              <button class="ui fluid labeled icon primary button" type="submit">
                <i class="add icon"></i>
                Follow
              </button>
              </form>
            @else
              <form action="{{ url('profile/unfollow', $user->id) }}" method="POST" class="ui form">
                {{ csrf_field() }}

              <button class="ui fluid labeled icon orange button" type="submit">
                <i class="minus icon"></i>
                Unfollow
              </button>
              </form>
            @endif
          </div>
          <div class="ui right floated ten wide tablet only computer only column">
            @if(!$user->isFollowedBy(\Auth::user()))
              <form action="{{ url('profile/follow', $user->id) }}" method="POST" class="ui form">
                {{ csrf_field() }}

              <button class="ui fluid labeled icon primary button" type="submit">
                <i class="add icon"></i>
                Follow
              </button>
              </form>
            @else
              <form action="{{ url('profile/unfollow', $user->id) }}" method="POST" class="ui form">
                {{ csrf_field() }}

              <button class="ui fluid labeled icon orange button" type="submit">
                <i class="minus icon"></i>
                Unfollow
              </button>
              </form>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  <div class="ui feed">
    @forelse($feeds as $feed)
      @include('feed.'.$feed->type)
    @empty
      <p class="item">No activity.</p>
    @endforelse
  </div>
</div>
@endsection