@extends('layouts.app')

@section('title', $journal->title)

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      <h4 class="ui header">
        Edit a Journal Entry
        <div class="sub header">
          <div class="ui breadcrumb">
            <a href="{{ url('/') }}" class="section">Campaign</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('campaign', $journal->campaign->id) }}" class="section">{{ $journal->campaign->name }}</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{ $journal->title }}</div>
          </div>
        </div>
      </h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  <form action="{{ route('journal.update', $journal->id) }}" method="POST" class="ui form">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="field">
      <label for="">Title</label>
      <input type="text" name="title" value="{{ old('title', $journal->title) }}">
    </div>
    <div class="field">
      <textarea name="body" maxlength="5000" class="trumbowyg">{{ old('body', $journal->body) }}</textarea>
    </div>
    <div class="field">
      <label for="">Days Elapsed During Session</label>
      <input type="text" name="elapsed_time" value="{{ old('elapsed_time', $journal->elapsed_time) }}">
    </div>

    <button type="submit" class="ui fluid primary button">
        <i class="icon check"></i>Save Journal
    </button>
  </form>
</div>



@endsection

@section('scripts')
<script>
  @include('partials.trumbowyg')
</script>
@endsection