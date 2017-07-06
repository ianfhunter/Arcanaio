@extends('layouts.app')

@section('title', 'Password Reset')

@section('content')

<div class="ui stackable grid container">
  <div class="row">
    <div class="column">
        <div class="ui basic segment">
        <img src="/img/logo_dark.svg" class="ui centered image" alt="">
        <h4 class="text-center">Reset Your Password</h4>

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

        <form class="ui form{{ count($errors) > 0 ? ' error' : '' }}" method="POST" action="{{ url('/password/reset') }}">
            {!! csrf_field() !!}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                <label>Email</label>
                <div class="ui left icon input">
                    <input type="text" name="email" placeholder="Email" value="{{ request('email') }}" autofocus>
                    <i class="envelope icon"></i>
                </div>
            </div>

            <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                <label>Password</label>
                <div class="ui left icon input">
                <input type="password" name="password" placeholder="Password">
                    <i class="lock icon"></i>
                </div>
            </div>

            <div class="field{{ $errors->has('password_confirmation') ? ' error' : '' }}">
                <label>Confirm Password</label>
                <div class="ui left icon input">
                <input type="password" name="password_confirmation" placeholder="Confirm Password">
                    <i class="lock icon"></i>
                </div>
            </div>

            <button class="fluid ui primary button" type="submit">Reset Password</button>

          </form>
        </div>
    </div>
  </div>
</div>

@endsection