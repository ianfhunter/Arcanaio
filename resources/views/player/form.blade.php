@if(Route::currentRouteAction() == 'App\Http\Controllers\PlayerController@edit')
  {!! Form::model($player, ['route' => ['character.update', $player->id], 'class' => 'ui form']) !!}
@else(Route::currentRouteAction() == 'App\Http\Controllers\PlayerController@create')
  {!! Form::open(['route' => 'character.store', 'class' => 'ui form']) !!}
@endif

  @if(Route::currentRouteAction() == 'App\Http\Controllers\PlayerController@edit')
    {{ method_field('PUT') }}
  @endif

    <div class="two fields">

      <div class="field">
        {{ Form::label('name','Name') }}
        {{ Form::text('name') }}
      </div>

      <div class="field">
        {{ Form::label('race','Race') }}
        {{ Form::select('race', GeneralHelper::getRaces(), null,['class' => 'ui compact dropdown', 'placeholder'=>'None']) }}
      </div>

    </div>

    <div class="two fields">
      <div class="field">
        {{ Form::label('alignment','Alignment') }}
        {{ Form::select('alignment', CreatureHelper::getAlignments(), null,['class' => 'ui compact dropdown', 'placeholder'=>'None']) }}
      </div>

      <div class="field">
        {{ Form::label('languages', 'Languages') }}
        {{ Form::select('languages[]', GeneralHelper::getLanguages(), null,['class' => 'ui compact dropdown', 'multiple'=>'true']) }}
      </div>
    </div>

    <div id="class_container">
          @for($j = 0; $j < count($classes); $j++)
            <div id="class-{{ $j }}-container" @if($j != 0 && !old('class.'.$j.'.name', $classes[$j]['name']))style="display:none;"@endif>
              @if($j != 0)<div class="ui horizontal divider">&</div>@endif
              <div class="fields">
                <div class="ten wide field">
                  <label>Class</label>
                  <select name="class[{{ $j }}][name]" class="ui compact dropdown class">
                    @if(!old('class.'.$j.'.name'))
                      <option value="" disabled selected>None</option>
                    @endif
                    @foreach (\GeneralHelper::getClasses() as $key => $value)
                        <option value="{{ $key }}" {{ $value == old('class.'.$j.'.name', $classes[$j]['name']) ? "selected":"" }}>{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="six wide field">
                  <label>Level</label>
                  <input type="text" name="class[{{ $j }}][level]" class="level" placeholder="e.g. 1" value="{{ old('class.'.$j.'.level', $classes[$j]['level']) }}">
                </div>
              </div>
            </div>
          @endfor

          @for($j = 0 + count($classes); $j < 10; $j++)
            <div id="class-{{ $j }}-container" @if($j != 0 && !old('class.'.$j.'.name'))style="display:none;"@endif>
              @if($j != 0 || count($classes) != 0)<div class="ui horizontal divider">&</div>@endif
                <div class="fields">
                  <div class="ten wide field">
                    <label>Class</label>
                    <select name="class[{{ $j }}][name]" class="ui compact dropdown class">
                      @if(!old('class.'.$j.'.name'))
                        <option value="" disabled selected>None</option>
                      @endif
                      @foreach (\GeneralHelper::getClasses() as $key => $value)
                          <option value="{{ $key }}" {{ $value == old('class.'.$j.'.name') ? "selected":"" }}>{{ $value }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="six wide field">
                    <label>Level</label>
                    <input type="text" name="class[{{ $j }}][level]" class="level" placeholder="e.g. 1" value="{{ old('class.'.$j.'.level', 0) }}">
                  </div>
                </div>
              </div>
          @endfor
        </div>

    <div class="ui clearing hidden divider"></div>

    <div class="clearfix">
      <small class="text-muted text-center">Hint: To remove a class, set the level to 0.</small>
      <a class="ui right floated tiny button" id="add-class"><i class="icon add"></i>Add Another Class</a>
    </div>



    <div class="ui clearing hidden divider"></div>

    <div class="five fields">
      <div class="field">
        {{ Form::label('AC','AC') }}
        {{ Form::text('AC') }}
      </div>
      <div class="field">
        {{ Form::label('HP_max','Max HP') }}
        {{ Form::text('HP_max') }}
      </div>
      <div class="field">
        {{ Form::label('hit_dice','Hit Dice') }}
        {{ Form::text('hit_dice') }}
      </div>
      <div class="field">
        {{ Form::label('speed','Speed') }}
        {{ Form::text('speed') }}
      </div>
      <div class="field">
        {{ Form::label('proficiency', 'Proficiency') }}
        {{ Form::text('proficiency', 2) }}
      </div>
    </div>

    <div class="six fields">
      <div class="field">
        {{ Form::label('strength', 'Strength') }}
        {{ Form::selectRange('strength', 1, 30, isset($player->strength) ? $player->strength:'10',['class'=>'ui compact dropdown']) }}
      </div>
      <div class="field">
        {{ Form::label('dexterity', 'Dexterity') }}
        {{ Form::selectRange('dexterity', 1, 30, isset($player->dexterity) ? $player->dexterity:'10',['class'=>'ui compact dropdown']) }}
      </div>
      <div class="field">
        {{ Form::label('constitution', 'Constitution') }}
        {{ Form::selectRange('constitution', 1, 30, isset($player->constitution) ? $player->constitution:'10',['class'=>'ui compact dropdown']) }}
      </div>
      <div class="field">
        {{ Form::label('intelligence', 'Intelligence') }}
        {{ Form::selectRange('intelligence', 1, 30, isset($player->intelligence) ? $player->intelligence:'10',['class'=>'ui compact dropdown']) }}
      </div>
      <div class="field">
        {{ Form::label('wisdom', 'Wisdom') }}
        {{ Form::selectRange('wisdom', 1, 30, isset($player->wisdom) ? $player->wisdom:'10',['class'=>'ui compact dropdown']) }}
      </div>
      <div class="field">
        {{ Form::label('charisma', 'Charisma') }}
        {{ Form::selectRange('charisma', 1, 30, isset($player->charisma) ? $player->charisma:'10',['class'=>'ui compact dropdown']) }}
      </div>
    </div>

    <div class="field">
      {{ Form::label('proficiencies', 'Item Proficiencies') }}
      {{ Form::textarea('proficiencies', null, ['rows' => '2','placeholder'=>'Light armor, martial weapons, etc.']) }}
    </div>

    <div class="field">
      {{ Form::label('darkvision', 'Darkvision? (ft)') }}
      {{ Form::text('darkvision') }}
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
    <div class="field" id="expertise" style="display: none">
      {{ Form::label('expertise', 'Skills') }}
      {{ Form::select('expertise[]', CreatureHelper::getSkills(), $expertise,['class' => 'ui compact dropdown', 'multiple'=>'true']) }}
    </div>

    <h4 class="ui dividing header">Description, Background & Traits</h4>

    <div class="field">
      <div class="sub-label"><small>Tip: Use the Quote option to display descriptive/read aloud text callouts. To end the quote, select the Paragraph option again.</small></div>
      {{ Form::textarea('description', null, ['class' => 'trumbowyg']) }}
    </div>

    <h4 class="ui dividing header">Feats</h4>

    <div class="field">
      <div class="sub-label"><small>Tip: Use the Quote option to display descriptive/read aloud text callouts. To end the quote, select the Paragraph option again.</small></div>
      {{ Form::textarea('feats', null, ['class' => 'trumbowyg']) }}
    </div>

    <h4 class="ui dividing header">Wealth</h4>

    <div class="five fields">
      <div class="field">
        {{ Form::label('PP','PP') }}
        {{ Form::text('PP') }}
      </div>
      <div class="field">
        {{ Form::label('GP','GP') }}
        {{ Form::text('GP') }}
      </div>
      <div class="field">
        {{ Form::label('EP','EP') }}
        {{ Form::text('EP') }}
      </div>
      <div class="field">
        {{ Form::label('SP','SP') }}
        {{ Form::text('SP') }}
      </div>
      <div class="field">
        {{ Form::label('CP','CP') }}
        {{ Form::text('CP') }}
      </div>
    </div>

    <div class="ui clearing hidden divider"></div>
    <button class="ui labeled icon primary fluid button">
      <i class="check icon"></i>
      Save Character
    </button>

  </form>