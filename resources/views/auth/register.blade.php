@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')

<div class="ui stackable grid container">
  <div class="row">
    <div class="column">
        <div class="ui basic segment">
            <img src="/img/logo_dark.svg" class="ui centered image" alt="">
            <h4 class="text-center">Create Your Free Account</h4>

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

            <form class="ui form{{ count($errors) > 0 ? ' error' : '' }}" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}

                <div class="field{{ $errors->has('name') ? ' error' : '' }}">
                    <label>Username</label>
                    <div class="ui left icon input">
                        <input type="text" name="name" placeholder="Username" value="{{ old('name') }}" autofocus>
                        <i class="user icon"></i>
                    </div>
                </div>

                <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                    <label>Email</label>
                    <div class="ui left icon input">
                        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" autofocus>
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

                <button class="fluid ui primary button" type="submit" onclick="ga('send', 'event', 'Account', 'register', 'Arcana');">Create Account</button>

              </form>

            <div class="ui horizontal divider">OR</div>

            <div class="ui two column stackable grid">
                <div class="column"><a href="{{ url('login/facebook') }}" class="ui facebook fluid button" onclick="ga('send', 'event', 'Account', 'register', 'Facebook');"><i class="facebook icon"></i>Facebook Login</a></div>
                <div class="column"><a href="{{ url('login/google') }}" class="ui google plus fluid button" onclick="ga('send', 'event', 'Account', 'register', 'Google');"><i class="google plus icon"></i>Google Plus Login</a></div>
            </div>   
        </div>
        <div class="ui basic segment text-center">
            By signing up, you agree to our <a href="/useragreement">User Agreement</a> and that you have read our <a href="/privacy">Privacy Policy</a>.
        </div>
    </div>
  </div>
</div>
@endsection