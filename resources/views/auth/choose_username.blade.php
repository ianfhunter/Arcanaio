@extends('layouts.app')

@section('title', 'Choose a Username')

<!-- Main Content -->
@section('content')

<div class="ui stackable grid container">
  <div class="row">
    <div class="column">
        <div class="ui basic segment">
        <img src="/img/logo_dark.svg.png" class="ui centered image" alt="">
        <h4 class="text-center">Choose a Username</h4>

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

        <form class="ui form{{ count($errors) > 0 ? ' error' : '' }}" method="POST" action="{{ url('/auth/username') }}">
            {!! csrf_field() !!}

            <div class="field{{ $errors->has('name') ? ' error' : '' }}">
                <label>Email</label>
                <div class="ui left icon input">
                    <input type="text" name="name" placeholder="Username" value="{{ old('name') }}" autofocus>
                    <i class="user icon"></i>
                </div>
            </div>

            <button class="fluid ui primary button" type="submit"><i class="ui user icon"></i> Save Username</button>

          </form>
        </div>
    </div>
  </div>
</div>

@endsection