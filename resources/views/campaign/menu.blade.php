<div class="text-center">
  <div class="ui labeled icon secondary stackable compact menu mobile hidden">
    <a class="{{ Route::currentRouteName() == 'campaign.show' ? 'active' : null }} item" href="{{ url('campaign', $campaign->id) }}">
      <i class="icon" data-icon="&#xe096;"></i>
      Home
    </a>

    <a class="{{ \Common::setActive('campaign/*/players') }} item" href="{{ url('campaign', [$campaign->id, 'players']) }}">
      <i class="icon" data-icon="&#xe0e3;"></i>
      Players
    </a>
    
    <a class="{{ \Common::setActive('campaign/*/locations') }} item" href="{{ url('campaign', [$campaign->id, 'locations']) }}">
      <i class="icon" data-icon="&#xe112;"></i>
      Locations
    </a>

    {{-- 

    <a class="{{ \Common::setActive('campaign/encounters') }} item">
      <i class="icon" data-icon="&#xe0ed;"></i>
      Encounters
    </a>
    --}}
    <a class="{{ \Common::setActive('campaign/*/monsters') }} item" href="{{ url('campaign', [$campaign->id, 'monsters']) }}">
      <i class="icon" data-icon="&#xe016;"></i>
      Monsters
    </a>
    <a class="{{ \Common::setActive('campaign/*/npcs') }} item" href="{{ url('campaign', [$campaign->id, 'npcs']) }}">
      <i class="icon" data-icon="&#xe2ee;"></i>
      NPCs
    </a>
    <a class="{{ \Common::setActive('campaign/*/items') }} item" href="{{ url('campaign', [$campaign->id, 'items']) }}">
      <i class="icon" data-icon="&#xe128;"></i>
      Items
    </a>
    {{-- 
    <a class="{{ \Common::setActive('campaign/organizations') }} item">
      <i class="icon" data-icon="&#xe081;"></i>
      Organizations
    </a>
    --}}
  </div>
</div>
<div class="ui floating labeled icon dropdown fluid button mobile only">
  <i class="chevron down icon"></i>
  <span class="text">Campaign Menu</span>
  <div class="menu">
    <a class="{{ Route::currentRouteName() == 'campaign.show' ? 'active' : null }} item" href="{{ url('campaign', $campaign->id) }}">
      <i class="large icon" data-icon="&#xe096;"></i>
      Home
    </a>

    <a class="{{ \Common::setActive('campaign/*/players') }} item" href="{{ url('campaign', [$campaign->id, 'players']) }}">
      <i class="large icon" data-icon="&#xe0e3;"></i>
      Players
    </a>
        
    <a class="{{ \Common::setActive('campaign/*/locations') }} item" href="{{ url('campaign', [$campaign->id, 'locations']) }}">
      <i class="large icon" data-icon="&#xe112;"></i>
      Locations
    </a>
{{-- 
    <a class="item">
      <i class="large icon" data-icon="&#xe0ed;"></i>
      Encounters
    </a>
    --}}
    <a class="{{ \Common::setActive('campaign/*/monsters') }} item" href="{{ url('campaign', [$campaign->id, 'monsters']) }}">
      <i class="large icon" data-icon="&#xe016;" ></i>
      Monsters
    </a>
    <a class="{{ \Common::setActive('campaign/*/npcs') }} item" href="{{ url('campaign', [$campaign->id, 'npcs']) }}">
      <i class="large icon" data-icon="&#xe2ee;"></i>
      NPCs
    </a>
    <a class="{{ \Common::setActive('campaign/*/items') }} item" href="{{ url('campaign', [$campaign->id, 'items']) }}">
      <i class="large icon" data-icon="&#xe128;"></i>
      Items
    </a>
    {{-- 
    <a class="item">
      <i class="large icon" data-icon="&#xe081;"></i>
      Organizations
    </a>
    --}}
  </div>
</div>