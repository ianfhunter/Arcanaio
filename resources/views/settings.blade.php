@extends('layouts.app')

@section('title', 'Settings')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui eight wide column">
      <h2 class="ui header">
        Settings
        <div class="sub header">Edit Your Preferences</div>
      </h2>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  <form class="ui form{{ count($errors) > 0 ? ' error' : '' }}" method="POST" action="{{ url('/settings') }}" enctype="multipart/form-data">
    {!! csrf_field() !!}

    <div class="field{{ $errors->has('name') ? ' error' : '' }}">
        <label>Name</label>
        <div class="ui left icon disabled input">
            <input type="text" name="name" value="{{ Auth::user()->name }}">
            <i class="user icon"></i>
        </div>
    </div>

    <div class="field{{ $errors->has('email') ? ' error' : '' }}">
        <label>Email</label>
        <div class="ui left icon disabled input">
            <input type="text" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
            <i class="envelope icon"></i>
        </div>
    </div>

    <div class="field{{ $errors->has('location') ? ' error' : '' }}">
        <label>Location</label>
        <div class="ui left icon input">
        <input type="text" name="location" placeholder="City, ST" value="{{ Auth::user()->location }}">
            <i class="marker icon"></i>
        </div>
    </div>

    <div class="field{{ $errors->has('website') ? ' error' : '' }}">
        <label>Website</label>
        <div class="ui left icon input">
        <input type="text" name="website" placeholder="http://yoursite.com" value="{{ (Auth::user()->website) ? Auth::user()->website : '' }}">
            <i class="laptop icon"></i>
        </div>
    </div>

    <div class="field{{ $errors->has('bio') ? ' error' : '' }}">
        <label>Bio</label>
        <div class="ui input">
          <textarea rows="2" name="bio" placeholder="A little about yourself." maxlength="200">{{ Auth::user()->bio }}</textarea>
        </div>
    </div>

    <div class="fields">
      <div class="two wide field">
        <img class="ui centered tiny rounded image" src="{{ Common::getAvatar(Auth::user()->avatar) }}">
      </div>

      <div class="fourteen wide field{{ $errors->has('avatar') ? ' error' : '' }}">
        <label>Avatar</label>
        <div class="ui left icon input">
            <input type="file" id="file" name="avatar" placeholder="Choose a File">
            <label for="file" class="ui icon button" >
                <i class="file icon"></i>
                Choose a File
            </label>
        </div>
      </div>
    </div>

    <div class="grouped fields">
      <label for="newsletter">Email Preferences:</label>
      <div class="field">
        <div class="ui radio checkbox">
          <input type="radio" name="newsletter" value="1" tabindex="0" {{ (Auth::user()->newsletter) ? 'checked' : '' }}>
          <label>Please send me commuity updates & news regarding new features.</label>
        </div>
      </div>
      <div class="field">
        <div class="ui radio checkbox">
          <input type="radio" name="newsletter" value="0" tabindex="0" {{ (!Auth::user()->newsletter) ? 'checked' : '' }}>
          <label>Please do not send me email.</label>
        </div>
      </div>
    </div>

    <button class="fluid ui primary button" type="submit">Save Changes</button>

  </form>
  <div class="ui hidden divider"></div>
  <div class="ui divider"></div>
  <p class="text-center">No longer need your account? <a href="#" id="delete-modal-trigger">Delete it here.</a></p>
</div>
@endsection

@section('scripts')
<div class="ui basic modal" id="delete-modal">
  <div class="ui icon header">
    <i class="trash icon"></i>
    Delete Account
  </div>
  <div class="content">
    <p>Are you sure that you wish to delete your account?</p>
  </div>
  <div class="actions">

    <form method="POST" action="{{ url('/settings/delete') }}">
      {!! csrf_field() !!}
      <input type="hidden" name="user_id" value="{{ Auth::id() }}">
      <div class="ui basic cancel inverted button">
        <i class="remove icon"></i>
        No, keep account.
      </div>
      <button class="ui red ok inverted button" type="submit">
        <i class="trash icon"></i>
        Yes, delete it.
      </button>
    </form>
  </div>
</div>
<script>
  $('#delete-modal-trigger').click(function(){
      $('#delete-modal').modal('show');
  });
</script>
@endsection