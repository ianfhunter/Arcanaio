@if(Route::currentRouteAction() == 'App\Http\Controllers\SpellController@edit')
  {!! Form::model($spell, ['route' => ['spell.update', $spell->id], 'class' => 'ui form']) !!}
@elseif(Route::currentRouteAction() == 'App\Http\Controllers\SpellController@create')
  {!! Form::open(['route' => 'spell.store', 'class' => 'ui form']) !!}
@else
  {!! Form::model($spell, ['route' => ['spell.store'], 'class' => 'ui form']) !!}
@endif

  @if(Route::currentRouteAction() == 'App\Http\Controllers\SpellController@edit')
    {{ method_field('PUT') }}
  @endif

  @if(Request::is('spell/fork/*'))
    <input type="hidden" name="fork_id" value="{{ $spell->id }}">
  @endif

  <div class="three fields">

    <div class="required field">
      {{ Form::label('name', 'Name') }}
      {{ Form::text('name') }}
    </div>

    <div class="required field">
      {{ Form::label('level', 'Level') }}
      {{ Form::select('level', SpellHelper::getSpellLevels(), null,['class' => 'ui compact dropdown','placeholder' => 'None']) }}
    </div>

    <div class="required field">
      {{ Form::label('school', 'School') }}
      {{ Form::select('school', SpellHelper::getSpellSchools(), null,['class' => 'ui compact dropdown','placeholder' => 'None']) }}
    </div>

  </div>

  <div class="three fields">

    <div class="required field">
      {{ Form::label('class[]', 'Classes') }}
      {{ Form::select('class[]', SpellHelper::getSpellClasses(), null,['class' => 'ui compact dropdown','placeholder' => 'None', 'multiple'=>'true']) }}
    </div>

    <div class="required field">
      {{ Form::label('casting_time', 'Casting Time') }}
      {{ Form::text('casting_time',null,['placeholder'=>'1 action']) }}
    </div>

    <div class="required field">
      {{ Form::label('range', 'Range') }}
      {{ Form::text('range',null,['placeholder'=>'30 ft']) }}
    </div>

  </div>

  <div class="three fields">

    <div class="required field">
      {{ Form::label('duration', 'Duration') }}
      {{ Form::text('duration',null,['placeholder'=>'1 hour']) }}
    </div>

    <div class="required field">
      {{ Form::label('components[]', 'Components') }}
      {{ Form::select('components[]', SpellHelper::getSpellComponents(), null,['class' => 'ui compact dropdown','placeholder' => 'None', 'multiple'=>'true']) }}
    </div>

    <div class="field">
      {{ Form::label('material', 'Materials') }}
      {{ Form::text('material',null,['placeholder'=>'A pinch of gold dust.']) }}
    </div>

  </div>

  <div class="fields">
    <div class="three wide field">
      {{ Form::label('concentration', 'Concentration?') }}
      <div class="ui toggle checkbox">
        {{ Form::checkbox('concentration', '1') }}
        <label></label>
      </div>
    </div>
    <div class="three wide field">
      {{ Form::label('ritual', 'Ritual?') }}
      <div class="ui toggle checkbox">
        {{ Form::checkbox('ritual', '1') }}
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

  <div class="field">
    {{ Form::label('higher_level', 'At Higher Levels') }}
    {{ Form::textarea('higher_level',null,['rows'=>'2']) }}
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
    <i class="add icon"></i>
    Save Spell
  </button>

</form>