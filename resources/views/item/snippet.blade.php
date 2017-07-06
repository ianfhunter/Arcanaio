

      @if($item->type == 'Weapon')
      <div class="ui hidden divider"></div>
      <div class="ui horizontal list">
        <div class="item">
          <div class="header inline">Damage</div>
          {{ $item->weapon_damage or "None"}}
        </div>
        <div class="item">
          <div class="header inline">Range</div>
          {{ $item->weapon_range or "None"}}
        </div>
        <div class="item">
          <div class="header inline">Type</div>
          {{ $item->subtype or "None" }}
        </div>
        <div class="item">
          <div class="header inline">Properties</div>
          {{ $item->weapon_properties or "None" }}
        </div>
      </div>
      @elseif($item->type == 'Armor')
      <div class="ui hidden divider"></div>
      <div class="ui horizontal list">
        <div class="item">
          <div class="header inline">AC</div>
          {{ $item->ac or "None"}}
        </div>
        <div class="item">
          <div class="header inline">Type</div>
          {{ $item->subtype != null ? $item->subtype : "None" }}
        </div>
        <div class="item">
          <div class="header inline">Strength Req</div>
          {{ $item->armor_str_req or "None"}}
        </div>
        <div class="item">
          <div class="header inline">Stealth</div>
          {{ $item->armor_stealth or "None" }}
        </div>
      </div>
      @endif

      <div class="ui hidden divider"></div>

      <div class="ui horizontal list" id="item-stats">
        <div class="item">
          <div class="header inline">Cost</div>
          {{ $item->cost or "None"}}
        </div>
        <div class="item">
          <div class="header inline">Weight</div>
          {{ $item->weight or "None"}}
        </div>
        <div class="item">
          <div class="header inline">Rarity</div>
          {{ $item->rarity ? ucwords($item->rarity) : "None" }}
        </div>
        <div class="item">
          <div class="header inline">Attunement?</div>
          {{ $item->attunement != "yes" ? "None" : "Yes" }}
        </div>
      </div>

      <div class="ui hidden divider"></div>

      <div class="description-box">
        {!! ($item->description) ? clean($item->description) :"You rolled a 1 on your Investigation roll. No description for this item." !!}
      </div>