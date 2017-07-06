@if(Route::currentRouteAction() == 'App\Http\Controllers\ItemController@edit')
  {!! Form::model($item, ['route' => ['item.update', $item->id], 'class' => 'ui form']) !!}
@elseif(Route::currentRouteAction() == 'App\Http\Controllers\ItemController@create')
  {!! Form::open(['route' => 'item.store', 'class' => 'ui form']) !!}
@else
  {!! Form::model($item, ['route' => ['item.store'], 'class' => 'ui form']) !!}
@endif

  @if(Route::currentRouteAction() == 'App\Http\Controllers\ItemController@edit')
    {{ method_field('PUT') }}
  @endif

  @if(Request::is('item/fork/*'))
    <input type="hidden" name="fork_id" value="{{ $item->id }}">
  @endif

  <div class="two fields">

    <div class="required field">
      {{ Form::label('name', 'Name') }}
      {{ Form::text('name') }}
    </div>

    <div class="required field">
      {{ Form::label('type', 'Type') }}
      {{ Form::select('type', ItemHelper::getTypes(), null,['class' => 'ui compact dropdown']) }}
    </div>
  </div>

  <div class="five fields subtypes" id="Weapon">
    <div class="required field">
      {{ Form::label('weapon_subtype', 'Weapon Subtype') }}
      {{ Form::select('weapon_subtype', ItemHelper::getWeaponTypes(), null,['class' => 'ui compact dropdown','placeholder' => 'None']) }}
    </div>
    <div class="required field">
      {{ Form::label('damage', 'Damage') }}
      {{ Form::text('weapon_damage', null, ['placeholder' => '1d6']) }}
    </div>
    <div class="required field">
      {{ Form::label('weapon_damage_type', 'Damage Type') }}
      {{ Form::select('weapon_damage_type', GeneralHelper::getDamageTypes(), null,['class' => 'ui compact dropdown','placeholder' => 'None']) }}
    </div>
    <div class="required field">
      {{ Form::label('weapon_range', 'Range') }}
      {{ Form::text('weapon_range', null, ['placeholder' => '5ft or 20/60ft']) }}
    </div>
    <div class="field">
      {{ Form::label('weapon_properties', 'Properties') }}
      {{ Form::text('weapon_properties', null, ['placeholder' => 'Light, Finesse']) }}
    </div>
  </div>

  <div class="four fields subtypes" id="Armor">
    <div class="required field">
      {{ Form::label('armor_subtype', 'Armor Subtype') }}
      {{ Form::select('armor_subtype', ItemHelper::getArmorTypes(), null,['class' => 'ui compact dropdown','placeholder' => 'None']) }}
    </div>
    <div class="required field">
      {{ Form::label('ac', 'AC') }}
      {{ Form::text('ac', null, ['placeholder' => 'e.g. 14']) }}
    </div>
    <div class="field">
      {{ Form::label('armor_str_req', 'Strength Requirement?') }}
      {{ Form::text('armor_str_req', null, ['placeholder' => 'e.g. 12']) }}
    </div>
    <div class="field">
      {{ Form::label('armor_stealth', 'Stealth Disadvantage?') }}
      <div class="ui toggle checkbox">
        {{ Form::checkbox('armor_stealth', 'Disadvantage') }}
        <label></label>
      </div>
    </div>
  </div>

  <div class="two fields subtypes" id="Vehicle" @if(old('type') != "Vehicle")style="display:none;"@endif>
    <div class="field">
      {{ Form::label('vehicle_speed', 'Speed') }}
      {{ Form::text('vehicle_speed', null, ['placeholder' => 'e.g. 40ft or 4 mph']) }}
    </div>
    <div class="field">
      {{ Form::label('vehicle_capacity', 'Capacity') }}
      {{ Form::text('vehicle_capacity', null, ['placeholder' => 'e.g. 400 lbs']) }}
    </div>
  </div>

  <div class="three fields">

    <div class="field">
      {{ Form::label('rarity', 'Rarity') }}
      {{ Form::select('rarity', ItemHelper::getRarity(), null, ['class' => 'ui select dropdown']) }}
    </div>

    <div class="field">
      {{ Form::label('weight', 'Weight') }}
      {{ Form::text('weight', null, ['placeholder' => 'e.g. 2 lbs']) }}
    </div>

    <div class="field">
      {{ Form::label('cost', 'Cost') }}
      {{ Form::text('cost', null, ['placeholder' => 'e.g. 5 gp']) }}
    </div>

  </div>

  <div class="fields">
    <div class="four wide field">
      {{ Form::label('attunement', 'Does it require attunement?') }}
      <div class="ui toggle checkbox">
        {{ Form::checkbox('attunement', 'yes') }}
        <label></label>
      </div>
    </div>
  </div>

  <div class="required field">
    {{ Form::label('description', 'Description') }}
    <div class="sub-label">
      <small>Tip: Use the Quote option to display descriptive/read aloud text callouts. To end the quote, select the Paragraph option again.</small>
    </div>
    {{ Form::textarea('description', null, ['class' => 'trumbowyg']) }}
  </div>

  <h4 class="ui dividing header">Visibility</h4>

  <div class="field">
    <div class="ui toggle checkbox">
      {{ Form::checkbox('private', '1') }}
      {{ Form::label('private', 'Check this to make this item private. This prevents other users from seeing it in the index or search results.') }}
    </div>
  </div>

  <div class="ui hidden divider"></div>

  <button class="ui labeled icon primary fluid button">
    <i class="check icon"></i>
    Save Item
  </button>

{!! Form::close() !!}