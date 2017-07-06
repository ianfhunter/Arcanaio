<!DOCTYPE html>
<html>
  <head>
    <!-- Standard Meta -->
    @include('layouts.meta')
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>

    <!-- Site Properties -->
    <title>@yield('title') - Arcana.io</title>

    @include('layouts.scripts')

  </head>
  <body>

    @include('layouts.sidebar')

    <div class="pusher" id="app">

        @include('layouts.menu')

        @if (session('status') || session('error'))
          <div class="ui attached {{ session('error') ? 'error' : 'success' }} message" id="flash-message">
            <div class="sub inline header">
              {{ session('status') ? 'Success!' : '' }}
              {{ session('error') ? 'Error' : '' }}
            </div>
              {{ session('status') ? session('status') : '' }}
              {{ session('error') ? session('error') : '' }}
          </div>
        @endif

        @yield('header')

        @yield('submenu')

        @yield('fluid_content')

        <div class="ui container">
          <div class="ui stackable grid">
            @if (count($errors) > 0)
              @include('partials.errors')
            @endif

            @yield('content')

          </div>
        </div>

        @include('layouts.footer')
    </div>

    @include('partials.javascript')
    @include('partials.algolia')
    @include('partials.google_analytics')
    @yield('scripts')

  </body>
</html>