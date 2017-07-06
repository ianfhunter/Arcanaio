@extends('layouts.app')

@section('title', 'Edit a Campaign')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui eight wide column">
      <h4 class="ui header">
        Edit {{ $campaign->name }}
        <div class="sub header">
          <div class="ui breadcrumb">
            <a href="{{ url('/') }}" class="section">Home</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/campaign') }}" class="section">Campaigns</a>
            <i class="right angle icon divider"></i>
            <div class="active section">Edit</div>
          </div>
        </div>
      </h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  <form class="ui form" method="POST" action="{{ route('campaign.update', $campaign->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="required field">
      <label>Name</label>
      <input type="text" name="name" placeholder="e.g. Waffle Crew" value="{{ old('name', $campaign->name) }}">
    </div>

    <div class="ui clearing hidden divider"></div>
    <button class="ui labeled icon primary fluid button">
      <i class="check icon"></i>
      Save Campaign
    </button>

  </form>
</div>
@endsection