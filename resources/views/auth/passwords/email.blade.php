@extends('layouts.app')

@section('title', 'Password Reset')

<!-- Main Content -->
@section('content')

<div class="ui stackable grid container">
  <div class="row">
    <div class="column">
        <div class="ui basic segment">
        <img src="/img/logo_dark.svg" class="ui centered image" alt="">
        <h4 class="text-center">Reset Your Password</h4>

        @if (session('status'))
            <div class="ui success message">
              <i class="close icon"></i>
              <div class="header">
                Email Sent!
              </div>
              <p>{{ session('status') }}</p>
            </div>
        @endif

        @if (count($errors) > 0)
          <div class="ui error message">
            <div class="header">Could you check something!</div>
            <ul class="list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
        @endif

        <form class="ui form{{ count($errors) > 0 ? ' error' : '' }}" method="POST" action="{{ url('/password/email') }}">
            {!! csrf_field() !!}

            <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                <label>Email</label>
                <div class="ui left icon input">
                    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" autofocus>
                    <i class="envelope icon"></i>
                </div>
            </div>

            <button class="fluid ui primary button" type="submit"><i class="ui email icon"></i> Send Password Reset Email</button>

          </form>
        </div>
    </div>
  </div>
</div>

@endsection