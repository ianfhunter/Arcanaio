<div class="ui fluid steps"  id="create-npc-form">
  <a class="active step" data-tab="first">
    <i class="icon" data-icon="&#xe2ee;"></i>
    <div class="content">
      <div class="title">Basics</div>
      <div class="description">Main details.</div>
    </div>
  </a>
  <a class="step" data-tab="second">
    <i class="icon" data-icon="&#xe141;"></i>
    <div class="content">
      <div class="title">Skills, Senses & Modifiers</div>
      <div class="description">Unique traits.</div>
    </div>
  </a>
  <a class="step" data-tab="third">
    <i class="icon" data-icon="&#xe033;"></i>
    <div class="content">
      <div class="title">Spells, Abilities & Actions</div>
      <div class="description">What your npc can do.</div>
    </div>
  </a>
</div>

@if(Route::currentRouteAction() == 'App\Http\Controllers\NpcController@edit')
  {!! Form::model($npc, ['route' => ['npc.update', $npc->id], 'class' => 'ui form']) !!}
@elseif(Route::currentRouteAction() == 'App\Http\Controllers\NpcController@create')
  {!! Form::open(['route' => 'npc.store', 'class' => 'ui form']) !!}
@else
  {!! Form::model($npc, ['route' => ['npc.store'], 'class' => 'ui form']) !!}
@endif

  @if(Route::currentRouteAction() == 'App\Http\Controllers\NpcController@edit')
    {{ method_field('PUT') }}
  @endif

  @if(Request::is('npc/fork/*'))
    <input type="hidden" name="fork_id" value="{{ $npc->id }}">
  @endif

  <div class="ui active basic tab segment"  data-tab="first">
    <h4 class="ui dividing header">General</h4>

    <div class="two fields">



    </div>

    <div class="three fields">

      <div class="required field">
        {{ Form::label('name','Name') }}
        {{ Form::text('name') }}
      </div>

      <div class="field">
        {{ Form::label('race','Race') }}
        {{ Form::select('race', GeneralHelper::getRaces(), null,['class' => 'ui compact dropdown', 'placeholder'=>'None']) }}
      </div>

      <div class="field">
        {{ Form::label('size','Size') }}
        {{ Form::select('size', CreatureHelper::getSizes(), isset($npc->size) ? $npc->size:'Medium',['class' => 'ui compact dropdown']) }}
      </div>
    </div>

    <div class="three fields">
      <div class="field">
        {{ Form::label('profession', 'Profession/Title') }}
        {{ Form::text('profession') }}
      </div>

      <div class="field">
        {{ Form::label('languages', 'Languages') }}
        {{ Form::select('languages[]', GeneralHelper::getLanguages(), null,['class' => 'ui compact dropdown', 'multiple'=>'true']) }}
      </div>

      <div class="field">
        {{ Form::label('alignment','Alignment') }}
        {{ Form::select('alignment', CreatureHelper::getAlignments(), null,['class' => 'ui compact dropdown']) }}
      </div>


    </div>

    <div class="field">
      {{ Form::label('CR','CR') }}
      {{ Form::select('CR', CreatureHelper::getCR(), null,['class' => 'ui compact dropdown']) }}
    </div>

    <div class="required field">
      {{ Form::label('description','Description') }}
      <div class="sub-label"><small>Tip: Use the Quote option to display descriptive/read aloud text callouts. To end the quote, select the Paragraph option again.</small></div>
      {{ Form::textarea('description', null, ['class' => 'trumbowyg']) }}
    </div>

    <div class="field">
      {{ Form::label('ideal','Ideal') }}
      {{ Form::text('ideal') }}
    </div>

    <div class="field">
      {{ Form::label('bond','Bond') }}
      {{ Form::text('bond') }}
    </div>

    <div class="field">
      {{ Form::label('flaw','Flaw') }}
      {{ Form::text('flaw') }}
    </div>

    <div class="field">
      {{ Form::label('environment','Suggested Environment') }}
      {{ Form::select('environment', LocationHelper::getEnvironments(), null,['class' => 'ui compact dropdown']) }}
    </div>

    <h4 class="ui dividing header">AC & HP</h4>

    <div class="four fields">
      <div class="field">
        {{ Form::label('AC', 'AC') }}
        {{ Form::text('AC',isset($npc->AC) ? $npc->AC:'10') }}
      </div>
      <div class="required field">
        {{ Form::label('hit_dice_amount', 'Hit Dice Amount') }}
        {{ Form::text('hit_dice_amount',isset($npc->hit_dice_amount) ? $npc->hit_dice_amount:'5') }}
      </div>
      <div class="field">
        {{ Form::label('hit_dice_size', 'Hit Dice Size') }}
        {{ Form::text('hit_dice_size',isset($npc->hit_dice_size) ? $npc->hit_dice_size:'6',['readonly'=>'readonly', 'class'=> 'ui disabled input']) }}
      </div>
      <div class="field">
        {{ Form::label('HP') }}
        {{ Form::text('HP',null,['readonly'=>'readonly', 'class'=> 'ui disabled input']) }}
      </div>
    </div>

    <h4 class="ui dividing header">Ability Scores</h4>

    <div class="six fields">
      <div class="field">
        {{ Form::label('strength', 'Strength') }}
        {{ Form::selectRange('strength', 1, 30, isset($npc->strength) ? $npc->strength:'10',['class'=>'ui compact dropdown']) }}
      </div>
      <div class="field">
        {{ Form::label('dexterity', 'Dexterity') }}
        {{ Form::selectRange('dexterity', 1, 30, isset($npc->dexterity) ? $npc->dexterity:'10',['class'=>'ui compact dropdown']) }}
      </div>
      <div class="field">
        {{ Form::label('constitution', 'Constitution') }}
        {{ Form::selectRange('constitution', 1, 30, isset($npc->constitution) ? $npc->constitution:'10',['class'=>'ui compact dropdown']) }}
      </div>
      <div class="field">
        {{ Form::label('intelligence', 'Intelligence') }}
        {{ Form::selectRange('intelligence', 1, 30, isset($npc->intelligence) ? $npc->intelligence:'10',['class'=>'ui compact dropdown']) }}
      </div>
      <div class="field">
        {{ Form::label('wisdom', 'Wisdom') }}
        {{ Form::selectRange('wisdom', 1, 30, isset($npc->wisdom) ? $npc->wisdom:'10',['class'=>'ui compact dropdown']) }}
      </div>
      <div class="field">
        {{ Form::label('charisma', 'Charisma') }}
        {{ Form::selectRange('charisma', 1, 30, isset($npc->charisma) ? $npc->charisma:'10',['class'=>'ui compact dropdown']) }}
      </div>
    </div>

    <div class="two fields" style="display:none">
      <div class="field">
        {{ Form::label('proficiency', 'Proficiency') }}
        {{ Form::hidden('proficiency', 2) }}
      </div>
    </div>

    <h4 class="ui dividing header">Movement (in ft.)</h4>

    <div class="five fields">
      <div class="field">
        {{ Form::label('speed', 'Base') }}
        {{ Form::text('speed',isset($npc->speed) ? $npc->speed:'30') }}
      </div>
      <div class="field">
        {{ Form::label('fly_speed', 'Fly') }}
        {{ Form::text('fly_speed') }}
      </div>
      <div class="field">
        {{ Form::label('burrow_speed', 'Burrow') }}
        {{ Form::text('burrow_speed') }}
      </div>
      <div class="field">
        {{ Form::label('swim_speed', 'Swim') }}
        {{ Form::text('swim_speed') }}
      </div>
      <div class="field">
        {{ Form::label('climb_speed', 'Climb') }}
        {{ Form::text('climb_speed') }}
      </div>
    </div>

    <div class="ui clearing hidden divider"></div>
    <button class="ui labeled icon fluid button next-button" data-rel="second" type="button">
      <i class="chevron right icon"></i>
      Next Page
    </button>

  </div>

  <div class="ui basic tab segment"  data-tab="second">

    <h4 class="ui dividing header">Senses</h4>

    <div class="four fields">
      <div class="field">
        {{ Form::label('blindsight', 'Blindsight') }}
        {{ Form::text('blindsight') }}
      </div>
      <div class="field">
        {{ Form::label('darkvision', 'Darkvision') }}
        {{ Form::text('darkvision') }}
      </div>
      <div class="field">
        {{ Form::label('truesight', 'Truesight') }}
        {{ Form::text('truesight') }}
      </div>
      <div class="field">
        {{ Form::label('tremorsense', 'Tremorsense') }}
        {{ Form::text('tremorsense') }}
      </div>
    </div>

    <h4 class="ui dividing header">Skill & Saving Throw Proficiencies</h4>

    <div class="field">
      {{ Form::label('saving_throws', 'Saving Throws') }}
      {{ Form::select('saving_throws[]', GeneralHelper::getSavingThrows(), $saving_throws,['class' => 'ui compact dropdown', 'multiple'=>'true']) }}
    </div>
    <div class="field">
      {{ Form::label('skills', 'Skills') }}
      {{ Form::select('skills[]', CreatureHelper::getSkills(), $skills,['class' => 'ui compact dropdown', 'multiple'=>'true']) }}
    </div>

    <h4 class="ui dividing header">Damage & Condition Modifiers</h4>

    <div class="field">
      {{ Form::label('damage_vulnerabilities', 'Damage Vulnerabilities') }}
      {{ Form::select('damage_vulnerabilities[]', GeneralHelper::getDamageTypes(), null,['class' => 'ui compact dropdown', 'multiple'=>'true']) }}
    </div>

    <div class="field">
      {{ Form::label('damage_resistances', 'Damage Resistances') }}
      {{ Form::select('damage_resistances[]', GeneralHelper::getDamageTypes(), null,['class' => 'ui compact dropdown', 'multiple'=>'true']) }}
    </div>

    <div class="field">
      {{ Form::label('damage_immunities', 'Damage Immunities') }}
      {{ Form::select('damage_immunities[]', GeneralHelper::getDamageTypes(), null,['class' => 'ui compact dropdown', 'multiple'=>'true']) }}
    </div>

    <div class="field">
      {{ Form::label('condition_immunities', 'Condition Immunities') }}
      {{ Form::select('condition_immunities[]', GeneralHelper::getConditions(), null,['class' => 'ui compact dropdown', 'multiple'=>'true']) }}
    </div>

    <div class="ui clearing hidden divider"></div>
    <button class="ui labeled icon fluid button next-button" data-rel="third" type="button">
      <i class="chevron right icon"></i>
      Next Page
    </button>

  </div>

  <div class="ui basic tab segment"  data-tab="third">

    <h4 class="ui dividing header">Spellcasting</h4>

    <div class="field">
      {{ Form::label('spell_ability','Spellcasting Ability') }}
      {{ Form::select('spell_ability', SpellHelper::getSpellAbilities(), null,['class' => 'ui compact dropdown', 'placeholder' => 'None']) }}
    </div>

    <h4 class="ui dividing header">
      Spell List
    </h4>

    <div class="field">
          {{ Form::label('spells_at_will', 'At Will') }}
          @if(old('spells_at_will') || !Form::oldInputIsEmpty())
            <select name="spells_at_will[]" id="" class="ui fluid search dropdown" multiple="true">
              @foreach($spells as $key => $value)
                <option value="{{ $key }}" {{ is_array(old('spells_at_will')) && in_array($key, old('spells_at_will')) ? 'selected':null }}>{{ $value }}</option>
              @endforeach
            </select>
          @else
            {{ Form::select('spells_at_will[]', $spells, isset($npc->spells) ? $npc->spells->where('pivot.level', 'at_will')->pluck('id')->toArray():null,['class' => 'ui fluid search dropdown', 'multiple'=>'true']) }}
          @endif
        </div>
        <div class="field">
          {{ Form::label('spells_one','1/day each') }}
          @if(old('spells_one') || !Form::oldInputIsEmpty())
            <select name="spells_one[]" id="" class="ui fluid search dropdown" multiple="true">
              @foreach($spells as $key => $value)
                <option value="{{ $key }}" {{ is_array(old('spells_one')) && in_array($key, old('spells_one')) ? 'selected':null }}>{{ $value }}</option>
              @endforeach
            </select>
          @else
            {{ Form::select('spells_one[]', $spells, isset($npc->spells) ? $npc->spells->where('pivot.level', 'one')->pluck('id')->toArray():null,['class' => 'ui fluid search dropdown', 'multiple'=>'true']) }}
          @endif
        </div>
        <div class="field">
          {{ Form::label('spells_two','2/day each') }}
          @if(old('spells_two') || !Form::oldInputIsEmpty())
            <select name="spells_two[]" id="" class="ui fluid search dropdown" multiple="true">
              @foreach($spells as $key => $value)
                <option value="{{ $key }}" {{ is_array(old('spells_two')) && in_array($key, old('spells_two')) ? 'selected':null }}>{{ $value }}</option>
              @endforeach
            </select>
          @else
            {{ Form::select('spells_two[]', $spells, isset($npc->spells) ? $npc->spells->where('pivot.level', 'two')->pluck('id')->toArray():null,['class' => 'ui fluid search dropdown', 'multiple'=>'true']) }}
          @endif
        </div>
        <div class="field">
          {{ Form::label('spells_three','3/day each') }}
          @if(old('spells_three') || !Form::oldInputIsEmpty())
            <select name="spells_three[]" id="" class="ui fluid search dropdown" multiple="true">
              @foreach($spells as $key => $value)
                <option value="{{ $key }}" {{ is_array(old('spells_three')) && in_array($key, old('spells_three')) ? 'selected':null }}>{{ $value }}</option>
              @endforeach
            </select>
          @else
            {{ Form::select('spells_three[]', $spells, isset($npc->spells) ? $npc->spells->where('pivot.level', 'three')->pluck('id')->toArray():null,['class' => 'ui fluid search dropdown', 'multiple'=>'true']) }}
          @endif
        </div>

    <h4 class="ui dividing header">Special Abilities</h4>

    <div id="ability-container">
      @if(old('abilities'))
        @foreach(old('abilities') as $ability)
          <div class="field">
            <label for="abilities[name]">Name</label>
            <input type="text" name="abilities[{{ $loop->index }}][name]" placeholder="e.g. Undead Fortitude" value="{{ $ability['name'] }}">
          </div>

          <div class="field">
            <label for="abilities[description]">Description</label>
            <textarea name="abilities[{{ $loop->index }}][description]" rows="2" placeholder="e.g. If damage reduces the zombie to 0 hit points, it must make a Constitution saving throw with a DC of 5 + the damage taken, unless the damage is radiant or from a critical hit. On a success, the zombie drops to 1 hit point instead.">{{ $ability['description'] }}</textarea>
          </div>
        @endforeach
      @elseif(isset($npc) && $npc->abilities)
        @foreach($npc->abilities as $ability)
          <div class="field">
            <label for="abilities[{{ $loop->index }}][name]">Name</label>
            <input type="text" name="abilities[{{ $loop->index }}][name]" placeholder="e.g. Undead Fortitude" value="{{ $ability->name }}">
          </div>

          <div class="field">
            <label for="abilities[{{ $loop->index }}][description]">Description</label>
            <textarea name="abilities[{{ $loop->index }}][description]" rows="2" placeholder="e.g. If damage reduces the zombie to 0 hit points, it must make a Constitution saving throw with a DC of 5 + the damage taken, unless the damage is radiant or from a critical hit. On a success, the zombie drops to 1 hit point instead.">{{ $ability->description }}</textarea>
          </div>
        @endforeach
      @else
        <div class="field">
          <label for="abilities[0][name]">Name</label>
          <input type="text" name="abilities[0][name]" placeholder="e.g. Undead Fortitude" value="">
        </div>

        <div class="field">
          <label for="abilities[0][description]">Description</label>
          <textarea name="abilities[0][description]" rows="2" placeholder="e.g. If damage reduces the zombie to 0 hit points, it must make a Constitution saving throw with a DC of 5 + the damage taken, unless the damage is radiant or from a critical hit. On a success, the zombie drops to 1 hit point instead."></textarea>
        </div>
      @endif
    </div>

    <div class="clearfix">
      <a class="ui right floated button" id="add-ability"><i class="icon add"></i>Add Another Ability</a>
    </div>

    <h4 class="ui dividing header">Actions</h4>

    <div id="action-container">
     @if(old('actions'))
        @foreach(old('actions') as $action)
          <div class="fields">
            <div class="sixteen wide field">
              <label for="actions[{{ $loop->index }}][name]">Name</label>
              <input type="text" name="actions[{{ $loop->index }}][name]" value="{{ $action['name'] }}">
            </div>
          </div>
          <div class="fields">
            <div class="four wide field">
              <label for="actions[{{ $loop->index }}][attack_type]">Attack Type</label>
              <select name="actions[{{ $loop->index }}][attack_type]" class="ui compact dropdown">
                <option value="none" {{ $action['attack_type'] == 'none' ? 'selected':'' }}>None</option>
                <option value="melee" {{ $action['attack_type'] == 'melee' ? 'selected':'' }}>Melee</option>
                <option value="ranged" {{ $action['attack_type'] == 'ranged' ? 'selected':'' }}>Ranged/Finesse</option>
              </select>
            </div>
            <div class="four wide field">
              <label for="actions[{{ $loop->index }}][damage_dice]">Damage Dice</label>
              <input type="text" name="actions[{{ $loop->index }}][damage_dice]" value="{{ $action['damage_dice'] }}">
            </div>
            <div class="four wide field">
              <label for="actions[{{ $loop->index }}][damage_type]">Damage Type</label>
              <select name="actions[{{ $loop->index }}][damage_type]" class="ui compact dropdown">
                @foreach(\GeneralHelper::getDamageTypes() as $key => $value)
                  <option value="{{ $key }}" {{ $action['damage_type'] == $key ? 'selected':'' }}>{{ $value }}</option>
                @endforeach
              </select>
            </div>
            <div class="four wide field">
              <label for="actions[{{ $loop->index }}][range]">Range (ft.)</label>
              <input type="text" name="actions[{{ $loop->index }}][range]" value="{{ $action['range'] }}">
            </div>
          </div>
          <div class="field">
            <label for="actions[{{ $loop->index }}][description]">Description</label>
            <textarea name="actions[{{ $loop->index }}][description]" rows="2">{{ $action['description'] }}</textarea>
          </div>
          <div class="four wide inline field">
            <div class="field">

              <div class="ui toggle checkbox">
                <input type="checkbox" name="actions[{{ $loop->index }}][legendary]" value="1" {{ isset($action['legendary']) ?'checked':NULL}}>
                <label for="actions[{{ $loop->index }}][legendary]">Legendary action?</label>
              </div>
            </div>
          </div>
        @endforeach
      @elseif(isset($npc) && $npc->actions)
        @foreach($npc->actions as $action)
          <div class="fields">
            <div class="sixteen wide field">
              <label for="actions[{{ $loop->index }}][name]">Name</label>
              <input type="text" name="actions[{{ $loop->index }}][name]" value="{{ $action->name }}">
            </div>
          </div>
          <div class="fields">
            <div class="four wide field">
              <label for="actions[{{ $loop->index }}][attack_type]">Attack Type</label>
              <select name="actions[{{ $loop->index }}][attack_type]" class="ui compact dropdown">
                <option value="none" {{ $action->attack_type == 'none' ? 'selected':'' }}>None</option>
                <option value="melee" {{ $action->attack_type == 'melee' ? 'selected':'' }}>Melee</option>
                <option value="ranged" {{ $action->attack_type == 'ranged' ? 'selected':'' }}>Ranged/Finesse</option>
              </select>
            </div>
            <div class="four wide field">
              <label for="actions[{{ $loop->index }}][damage_dice]">Damage Dice</label>
              <input type="text" name="actions[{{ $loop->index }}][damage_dice]" value="{{ $action->damage_dice }}">
            </div>
            <div class="four wide field">
              <label for="actions[{{ $loop->index }}][damage_type]">Damage Type</label>
              <select name="actions[{{ $loop->index }}][damage_type]" class="ui compact dropdown">
                @foreach(\GeneralHelper::getDamageTypes() as $key => $value)
                  <option value="{{ $key }}" {{ $action->damage_type == $key ? 'selected':'' }}>{{ $value }}</option>
                @endforeach
              </select>
            </div>
            <div class="four wide field">
              <label for="actions[{{ $loop->index }}][range]">Range (ft.)</label>
              <input type="text" name="actions[{{ $loop->index }}][range]" value="{{ $action->range }}">
            </div>
          </div>
          <div class="field">
            <label for="actions[{{ $loop->index }}][description]">Description</label>
            <textarea name="actions[{{ $loop->index }}][description]" rows="2">{{ $action->description }}</textarea>
          </div>
          <div class="four wide inline field">
            <div class="field">

              <div class="ui toggle checkbox">
                <input type="checkbox" name="actions[{{ $loop->index }}][legendary]" value="1" {{ $action->legendary ? 'checked':'' }}>
                <label for="actions[{{ $loop->index }}][legendary]">Legendary action?</label>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="fields">
          <div class="sixteen wide field">
            <label for="actions[0][name]">Name</label>
            <input type="text" name="actions[0][name]" value="">
          </div>
        </div>
        <div class="fields">
          <div class="four wide field">
            <label for="actions[0][attack_type]">Attack Type</label>
            <select name="actions[0][attack_type]" class="ui compact dropdown">
              <option value="none">None</option>
              <option value="melee">Melee</option>
              <option value="ranged">Ranged/Finesse</option>
            </select>
          </div>
          <div class="four wide field">
            <label for="actions[0][damage_dice]">Damage Dice</label>
            <input type="text" name="actions[0][damage_dice]" value="">
          </div>
          <div class="four wide field">
            <label for="actions[0][damage_type]">Damage Type</label>
            <select name="actions[0][damage_type]" class="ui compact dropdown">
              @foreach(\GeneralHelper::getDamageTypes() as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
              @endforeach
            </select>
          </div>
          <div class="four wide field">
            <label for="actions[0][range]">Range (ft.)</label>
            <input type="text" name="actions[0][range]" value="">
          </div>
        </div>
        <div class="field">
          <label for="actions[0][description]">Description</label>
          <textarea name="actions[0][description]" rows="2"></textarea>
        </div>
        <div class="four wide inline field">
          <div class="field">

            <div class="ui toggle checkbox">
              <input type="checkbox" name="actions[0][legendary]" value="1">
              <label for="actions[0][legendary]">Legendary action?</label>
            </div>
          </div>
        </div>
      @endif
    </div>

    <div class="clearfix">
      <a class="ui right floated button margin-t" id="add-action"><i class="icon add"></i>Add Another Action</a>
    </div>

    <div class="ui clearing hidden divider"></div>
    <h4 class="ui dividing header">Visibility</h4>
    <div class="field">
      <div class="ui toggle checkbox">
        {{ Form::checkbox('private', '1') }}
        {{ Form::label('private', 'Check this to make this item private. This prevents other users from seeing it in the index or search results.') }}
      </div>
    </div>

    <button class="ui labeled icon primary fluid button">
      <i class="check icon"></i>
      Save Npc
    </button>

  </div>

</form>