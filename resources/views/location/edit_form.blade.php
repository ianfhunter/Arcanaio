<form class="ui form" method="POST" action="@if(Route::currentRouteAction() == 'App\Http\Controllers\LocationController@edit') {{  route('location.update', $location->id) }} @else {{ route('location.store') }} @endif">

  {{ csrf_field() }}

  @if(Route::currentRouteAction() == 'App\Http\Controllers\LocationController@edit')
    {{ method_field('PUT') }}
  @endif

  @if(Request::is('location/fork/*'))
    <input type="hidden" name="fork_id" value="{{ $location->id }}">
  @endif

  <div class="two fields">

    <div class="required field">
      <label>Name</label>
      <input type="text" name="name" placeholder="e.g. Annie's Armor, Frostspine Peaks, etc" value="{{ old('name', $location->name) }}">
    </div>

    <div class="required field">
      <label>Type</label>
      <select name="type" class="ui compact dropdown" id="type">
        @if(!old("type", $location->type))
          <option value="" disabled selected>None</option>
        @endif
        @foreach (Config::get('constants.location_types') as $key => $value)
            <option value="{{ $value }}" {{ ($value == old('type', $location->type)) ? "selected":"" }}>{{ $value }}</option>
        @endforeach
      </select>
    </div>

  </div>

  <div class="field">
    <label>Does this location belong to another location?</label>
    <div class="ui fluid input">
      <select class="ui fluid search dropdown" name="parent">
        <option value="0">None</option>
        @foreach($locations as $place)
          <option value="{{ $place->id }}" {{ old('parent', $location->parent) == $place->id ? "selected":"" }}>{{ $place->name }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="subtypes" id="shop" @if(old('type', $location->type) != "Shop")style="display:none;"@endif>
    <h4 class="ui dividing header">Shop Details</h4>

    <div class="two fields">
      <div class="field">
        <label>Subtype</label>
        <select name="subtype" class="ui compact dropdown">
          @if(!old("subtype"))
            <option value="" disabled selected>None</option>
          @endif
          @foreach (Config::get('constants.location_shop_types') as $key => $value)
              <option value="{{ $value }}" {{ ($value == old('subtype', $location->subtype)) ? "selected":"" }}>{{ $value }}</option>
          @endforeach
        </select>
      </div>
      <div class="field">
        <label>Owner</label>
        <input type="text" name="owner" placeholder="e.g. Annie Irongrip" value="{{ old('owner', $location->owner) }}">
      </div>
    </div>

    <div class="field">
      <label for="">What does the shop sell?</label>
      <span class="sub-label">To make a list of what the shop sells, use the Linking section later in the form.</span>
    </div>

    <div class="field">
      <label for="">Other Items</label>
      <textarea rows="2" name="other_items" placeholder="e.g. gems, tools, or any other items that may not deserve creating their own record.">{{ old('other_items', $location->other_items) }}</textarea>
    </div>
  </div>

  <div class="subtypes" id="city" @if(old('type', $location->type) != "Village/Town/City" || old('type') != "Continent" || old('type') != "Kingdom")style="display:none;"@endif>

    <h4 class="ui dividing header">City Details</h4>

    <div class="field">
      <label for="">Demographics</label>
      <textarea rows="2" name="demographics" placeholder="e.g. The city is mostly run by the wood elves that established it. However, the port district is majority dwarf sailors...">{{ old('demographics', $location->demographics) }}</textarea>
    </div>

    <div class="field">
      <label for="">Government</label>
      <textarea rows="2" name="government" placeholder="e.g. The city uses a democracy where the citizens with the most wealth are able to buy more votes. The funds from the purchased votes go towards community efforts.">{{ old('government', $location->government) }}</textarea>
    </div>
  </div>

  <div class="subtypes" id="tavern" @if(old('type', $location->type) != "Tavern/Inn")style="display:none;"@endif>
    <h4 class="ui dividing header">Tavern Details</h4>

    <div class="two fields">
      <div class="field">
        <label>Room Price</label>
        <input type="text" name="price" placeholder="e.g. 50 SP per night, 1 GP luxury room" value="{{ old('price', $location->price) }}">
      </div>
      <div class="field">
        <label>Owner</label>
        <input type="text" name="owner_tavern" placeholder="e.g. Luthar Silverglint" value="@if($location->type == 'Tavern/Inn'){{$location->owner}}@else{{old('owner_tavern')}}@endif">
      </div>
    </div>

    <div class="field">
      <label for="">Food/Drinks</label>
      <textarea rows="2" name="menu" placeholder="e.g. basilisk eye stew, luthar's special reserve, etc. ">{{ old('menu', $location->menu) }}</textarea>
    </div>
  </div>

  <h4 class="ui dividing header">Description & History</h4>

  <div class="required field">
    <label for="">Description</label>
    <div class="sub-label"><small>Tip: Use the Quote option to display descriptive/read aloud text callouts. To end the quote, select the Paragraph option again.</small></div>
    <textarea rows="4" name="description" placeholder="" class="trumbowyg">{{ old('description', $location->description) }}</textarea>
  </div>

  <h4 class="ui dividing header">Link NPCs, Monsters & Items</h4>

  <div class="field">
    <div class="sub-label">Linking items to this location will provide quick look stats and convenient links to quickly access content.</div>
  </div>

  <div class="field">
    <label>Do any notable NPCs hang out at this location?</label>
    <span class="sub-label"><small>Don't see an NPC you like? <a href="{{ url('npc/create') }}" target="_blank">Create your own!</a></small></span>
    <select class="ui fluid search dropdown" multiple="" name="npcs[]">
      @foreach($npcs as $npc)
        <option value="{{ $npc->id }}" {{ ((is_array(old('npcs', $selected_npcs)) && in_array($npc->id, old('npcs', $selected_npcs))) ? "selected":"") }}>{{ $npc->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="field">
    <label>Do any notable monsters roam this location?</label>
    <span class="sub-label"><small>Don't see a monster you like? <a href="{{ url('monster/create') }}" target="_blank">Create your own!</a></small></span>
    <select class="ui fluid search dropdown" multiple="" name="monsters[]">
      @foreach($monsters as $monster)
        <option value="{{ $monster->id }}" {{ ((is_array(old('monsters', $selected_monsters)) && in_array($monster->id, old('monsters', $selected_monsters))) ? "selected":"") }}>{{ $monster->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="field">
    <label>What does the shop sell or what magic items can be found here?</label>
    <span class="sub-label"><small>Don't see an item you like? <a href="{{ url('item/create') }}" target="_blank">Create your own!</a></small></span>
    <select class="ui fluid search dropdown" multiple="" name="items[]">
      @foreach($items as $item)
        <option value="{{ $item->id }}" {{ ((is_array(old('items')) && in_array($item->id, old('items'))) ? "selected":"") }}>{{ $item->name }}</option>
      @endforeach
    </select>
  </div>

  <h4 class="ui dividing header">Tags</h4>
  <div class="field">
    <label for="tags">Tags (type + enter to add tags)</label>
    <select class="ui fluid search dropdown" multiple="" name="tags[]" id="tags">
      @if(old('tags'))
        @for($i = 0; $i < count(old('tags')); $i++)
          <option value="{{ old('tags.'.$i) }}" selected>{{ old('tags.'.$i) }}</option>
        @endfor
        @foreach($tags as $tag)
          @if(!in_array($tag->name, old('tags')))
            <option value="{{ $tag->name }}" {{ (is_array($location->tags) && in_array($tag, $location->tags)) ? "selected":"" }}>{{ $tag }}</option>
          @endif
        @endforeach
      @else
        @foreach($tags as $tag)
          <option value="{{ $tag->name }}" {{ $location->tags->contains('name', $tag->name) ? "selected":"" }}>{{ $tag->name }}</option>
        @endforeach
      @endif
    </select>
  </div>


  <div class="ui clearing hidden divider"></div>
  <h4 class="ui dividing header">Visibility</h4>
  <div class="ui toggle checkbox">
    <input type="checkbox" name="private" value="1" @if(old('private', $location->private)) checked @endif>
    <label>Make this location private. This prevents other users from seeing it in the index or search results.</label>
  </div>
  <div class="ui clearing hidden divider"></div>
  <div class="ui clearing hidden divider"></div>

  <button class="ui labeled icon primary fluid button">
    <i class="check icon"></i>
    Save Location
  </button>

</form>