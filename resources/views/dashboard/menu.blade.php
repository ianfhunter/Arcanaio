<div class="ui secondary labeled icon compact small menu mobile hidden">
  <a class="{{ \Common::setActive('dashboard') }} item" href="{{ url('dashboard') }}">
    <i class="home icon"></i>
    Home
  </a>
  <a class="{{ \Common::setActive('social') }} item" href="{{ url('social') }}">
    <i class="icon" data-icon="&#xe120;"></i>
    Social
  </a>
  <a class="{{ \Common::setActive('liked') }} item" href="{{ url('liked') }}">
    <i class="icon" data-icon="&#xe054;"></i>
    Liked
  </a>
  <a class="{{ \Common::setActive('created') }} item" href="{{ url('created') }}">
    <i class="icon" data-icon="&#xe255;"></i>
    Created
  </a>
</div>
<div class="text-center mobile only overflow-scroll">
  <div class="ui secondary icon compact huge menu">
    <a class="{{ \Common::setActive('dashboard') }} item" href="{{ url('dashboard') }}">
      <i class="large home icon"></i>
    </a>
    <a class="{{ \Common::setActive('social') }} item" href="{{ url('social') }}">
      <i class="large icon" data-icon="&#xe120;"></i>
    </a>
    <a class="{{ \Common::setActive('liked') }} item" href="{{ url('liked') }}">
      <i class="large icon" data-icon="&#xe054;"></i>
    </a>
    <a class="{{ \Common::setActive('created') }} item" href="{{ url('created') }}">
      <i class="large icon" data-icon="&#xe255;"></i>
    </a>
  </div>
</div>
