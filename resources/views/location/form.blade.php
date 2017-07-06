@if(Route::currentRouteAction() == 'App\Http\Controllers\LocationController@edit')
  {!! Form::model($location, ['route' => ['location.update', $location->id], 'class' => 'ui form']) !!}
@elseif(Route::currentRouteAction() == 'App\Http\Controllers\LocationController@create')
  {!! Form::open(['route' => 'location.store', 'class' => 'ui form']) !!}
@else
  {!! Form::model($location, ['route' => ['location.store'], 'class' => 'ui form']) !!}
@endif

  @if(Route::currentRouteAction() == 'App\Http\Controllers\LocationController@edit')
    {{ method_field('PUT') }}
  @endif

  @if(Request::is('location/fork/*'))
    <input type="hidden" name="fork_id" value="{{ $location->id }}">
  @endif

    <div class="two fields">

      <div class="required field">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name') }}
      </div>

      <div class="required field">
        {{ Form::label('type', 'Type') }}
        {{ Form::select('type', \LocationHelper::getTypes(), null,['class' => 'ui compact dropdown','placeholder' => 'None']) }}
      </div>

    </div>

    <div class="field">
      {{ Form::label('parent', 'Parent Location') }}
      {{ Form::select('parent', $locations, null,['class' => 'ui compact search dropdown','placeholder' => 'None']) }}
    </div>

    <div class="subtypes" id="shop" @if(old('type') != "Shop")style="display:none;"@endif>
      <h4 class="ui dividing header">Shop Details</h4>

      <div class="two fields">
        <div class="field">
          {{ Form::label('subtype', 'Type') }}
          {{ Form::select('subtype', \LocationHelper::getShopTypes(), null,['class' => 'ui compact dropdown','placeholder' => 'None']) }}
        </div>

        <div class="field">
          {{ Form::label('owner_tavern', 'Owner') }}
          {{ Form::text('owner_tavern') }}
        </div>
      </div>

      <div class="field">
        <label for="">What does the shop sell?</label>
        <span class="sub-label">To make a list of what the shop sells, use the Linking section later in the form.</span>
      </div>

      <div class="field">
        {{ Form::label('other_items', 'Food & Drinks') }}
        {{ Form::textarea('other_items',null,['rows'=>'2']) }}
      </div>
    </div>

    <div class="subtypes" id="city" @if(old('type') != "Village/Town/City" || old('type') != "Continent" || old('type') != "Kingdom")style="display:none;"@endif>

      <h4 class="ui dividing header">City/Kingdom Details</h4>

      <div class="field">
        {{ Form::label('demographics', 'Food & Drinks') }}
        {{ Form::textarea('demographics',null,['rows'=>'2']) }}
      </div>

      <div class="field">
        {{ Form::label('government', 'Government') }}
        {{ Form::textarea('government',null,['rows'=>'2']) }}
      </div>
    </div>

    <div class="subtypes" id="tavern" @if(old('type') != "Tavern/Inn")style="display:none;"@endif>
      <h4 class="ui dividing header">Tavern Details</h4>

      <div class="two fields">
        <div class="field">
          {{ Form::label('price', 'Room Price') }}
          {{ Form::text('price') }}
        </div>

        <div class="field">
          {{ Form::label('owner', 'Owner') }}
          {{ Form::text('owner') }}
        </div>
      </div>

      <div class="field">
        {{ Form::label('menu', 'Food & Drinks') }}
        {{ Form::textarea('menu',null,['rows'=>'2']) }}
      </div>
    </div>

    <h4 class="ui dividing header">Description & History</h4>

    <div class="required field">
      {{ Form::label('description', 'Description') }}
      <div class="sub-label">
        <small>Tip: Use the Quote option to display descriptive/read aloud text callouts. To end the quote, select the Paragraph option again.</small>
      </div>
      {{ Form::textarea('description', null, ['class' => 'trumbowyg']) }}
    </div>

    <h4 class="ui dividing header">Link NPCs, Monsters & Items</h4>

    <div class="field">
      {{ Form::label('npcs', 'Are any notable NPCs found at this location?') }}
      @if(old('npcs') || !Form::oldInputIsEmpty())
        <select name="npcs[]" id="" class="ui fluid search dropdown" multiple="true">
          @foreach($npcs as $key => $value)
            <option value="{{ $key }}" {{ is_array(old('npcs')) && in_array($key,old('npcs')) ? 'selected':null }}>{{ $value }}</option>
          @endforeach
        </select>
      @else
        {{ Form::select('npcs[]', $npcs, isset($location->npcs) ? $location->npcs->pluck('id')->toArray():null,['class' => 'ui fluid search dropdown', 'multiple'=>'true']) }}
      @endif
    </div>

    <div class="field">
      {{ Form::label('monsters', 'Are any notable monsters found at this location?') }}
      @if(old('monsters') || !Form::oldInputIsEmpty())
        <select name="monsters[]" id="" class="ui fluid search dropdown" multiple="true">
          @foreach($monsters as $key => $value)
            <option value="{{ $key }}" {{ is_array(old('monsters')) && in_array($key,old('monsters')) ? 'selected':null }}>{{ $value }}</option>
          @endforeach
        </select>
      @else
        {{ Form::select('monsters[]', $monsters, isset($location->monsters) ? $location->monsters->pluck('id')->toArray():null,['class' => 'ui fluid search dropdown', 'multiple'=>'true']) }}
      @endif
    </div>

    <div class="field">
      {{ Form::label('items', 'What does the shop sell or what magic items can be found here?') }}
      @if(old('items') || !Form::oldInputIsEmpty())
        <select name="items[]" id="" class="ui fluid search dropdown" multiple="true">
          @foreach($items as $key => $value)
            <option value="{{ $key }}" {{ is_array(old('items')) && in_array($key,old('items')) ? 'selected':null }}>{{ $value }}</option>
          @endforeach
        </select>
      @else
        {{ Form::select('items[]', $items, isset($location->items) ? $location->items->pluck('id')->toArray():null,['class' => 'ui fluid search dropdown', 'multiple'=>'true']) }}
      @endif
    </div>

    <div class="ui clearing hidden divider"></div>
    <h4 class="ui dividing header">Visibility</h4>
    <div class="field">
      <div class="ui toggle checkbox">
        {{ Form::checkbox('private', '1') }}
        {{ Form::label('private', 'Check this to make this item private. This prevents other users from seeing it in the index or search results.') }}
      </div>
    </div>
    <div class="ui clearing hidden divider"></div>
    <div class="ui clearing hidden divider"></div>

    <button class="ui labeled icon primary fluid button">
      <i class="check icon"></i>
      Save Location
    </button>

  </form>