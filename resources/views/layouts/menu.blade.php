      <div class="ui inverted top attached menu" id="navbar">
        <a class="item" id="menu-toggle"><i class="sidebar icon"></i></a>
        <a href="/" class="item mobile hidden" id="menu-toggle"><img src="/img/logo_light.svg" alt="" id="logo-top"></a>
        <div class="item">
          <div class="ui inverted transparent input search">
            <input type="text" placeholder="Search Everything..." id="search">
            <i class="search icon"></i>
          </div>
        </div>
        <div class="right menu">

          @if (Auth::check())
            <div class="ui right dropdown link item mobile hidden">
              <img class="ui avatar image" id="nav-avatar" src="{{ Common::getAvatar(Auth::user()->avatar) }}">
              <div class="menu">
                <a href="/profile" class="item"><i class="user icon"></i> Profile</a>
                <a href="/settings" class="item"><i class="settings icon"></i> Settings</a>
                <a href="/logout" class="item"><i class="sign out icon"></i> Sign Out</a>
              </div>
            </div>
            <div class="ui right dropdown link item" id="notifications-button">
              <i class="large @if(Auth::user()->unreadNotifications->count()) red @endif icon" id="notifications-icon" data-icon="&#xe0f7;"></i>
              <div class="menu" id="notifications-wrapper">
                @forelse(Auth::user()->unreadNotifications as $notification)
                  @include('notifications.'.snake_case(class_basename($notification->type)))
                @empty
                  <p class="item">No new notifications.</p>
                @endforelse
                <a href="/notifications" class="item">See All Notifications</a>
              </div>
            </div>
          @else
            <a href="/register" class="active primary item mobile hidden" >Sign Up</a>
            <a href="/login" class="item">Sign In</a>
          @endif
        </div>
      </div>