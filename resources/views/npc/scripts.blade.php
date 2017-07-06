<script type="text/template" id="ability-template">
  <div class="field">
    <label for="abilities[@{{{ count }}}][name]">Name</label>
    <input type="text" name="abilities[@{{{ count }}}][name]" placeholder="e.g. Undead Fortitude" value="">
  </div>

  <div class="field">
    <label for="abilities[@{{{ count }}}][description]">Description</label>
    <textarea name="abilities[@{{{ count }}}][description]" rows="2" placeholder="e.g. If damage reduces the zombie to 0 hit points, it must make a Constitution saving throw with a DC of 5 + the damage taken, unless the damage is radiant or from a critical hit. On a success, the zombie drops to 1 hit point instead."></textarea>
  </div>

</script>
<script type="text/template" id="action-template">
  <div class="fields">
    <div class="sixteen wide field">
      <label for="actions[@{{{ count }}}][name]">Name</label>
      <input type="text" name="actions[@{{{ count }}}][name]" value="">
    </div>
  </div>
  <div class="fields">
    <div class="four wide field">
      <label for="actions[@{{{ count }}}][attack_type]">Attack Type</label>
      <select name="actions[@{{{ count }}}][attack_type]" class="ui compact dropdown">
        <option value="none">None</option>
        <option value="melee">Melee</option>
        <option value="ranged">Ranged/Finesse</option>
      </select>
    </div>
    <div class="four wide field">
      <label for="actions[@{{{ count }}}][damage_dice]">Damage Dice</label>
      <input type="text" name="actions[@{{{ count }}}][damage_dice]" value="">
    </div>
    <div class="four wide field">
      <label for="actions[@{{{ count }}}][damage_type]">Damage Type</label>
      <select name="actions[@{{{ count }}}][damage_type]" class="ui compact dropdown">
        @foreach(\GeneralHelper::getDamageTypes() as $key => $value)
          <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
      </select>
    </div>
    <div class="four wide field">
      <label for="actions[@{{{ count }}}][range]">Range (ft.)</label>
      <input type="text" name="actions[@{{{ count }}}][range]" value="">
    </div>
  </div>
  <div class="field">
    <label for="actions[@{{{ count }}}][description]">Description</label>
    <textarea name="actions[@{{{ count }}}][description]" rows="2"></textarea>
  </div>
  <div class="four wide inline field">
    <div class="field">

      <div class="ui toggle checkbox">
        <input type="checkbox" name="actions[@{{{ count }}}][legendary]" value="1">
        <label for="actions[@{{{ count }}}][legendary]">Legendary action?</label>
      </div>
    </div>
  </div>
</script>
<script>
  $(document).ready(function()
  {
    function calculateHP() {
      var amount = $('#hit_dice_amount').val();
      var dice = $('#hit_dice_size').val();
      var con = $('#constitution').find('option:selected').val();
      var hp = 0;

      hp = Math.floor(amount * ((dice / 2) + 0.5) + (Math.floor((con - 10) / 2) * amount));

      $('#HP').val(hp);
    }

    calculateHP();

    var actionTemplate = Hogan.compile($('#action-template').html());
    var actionCount = @if(old('actions')){{ count(old('actions')) }};@elseif(isset($npc->actions)) {{ $npc->actions->count() }}; @else 1; @endif

    var abilityTemplate = Hogan.compile($('#ability-template').html());
    var abilityCount = @if(old('abilities')){{ count(old('abilities')) }};@elseif(isset($npc->abilities)) {{ $npc->abilities->count() }}; @else 1; @endif

    $('#add-action').click(function() {
      $('#action-container').append(actionTemplate.render({count:actionCount}));
      actionCount++;
    });

    $('#add-ability').click(function(){
      $('#ability-container').append(abilityTemplate.render({count:abilityCount}));
      abilityCount++;
    });

    $('#size').change(function() {
    var size = $(this).find('option:selected').val();

    if(size == 'Tiny') {
     $('#hit_dice_size').val('4');
    }
    else if(size == 'Small') {
     $('#hit_dice_size').val('6');
    }
    else if(size == 'Medium') {
     $('#hit_dice_size').val('8');
    }
    else if(size == 'Large') {
     $('#hit_dice_size').val('10');
    }
    else if(size == 'Huge') {
     $('#hit_dice_size').val('12');
    }
    else if(size == 'Gargantuan'){
     $('#hit_dice_size').val('20');
    }

    });

    $('#CR').change(function() {
     var cr = $(this).find('option:selected').val();
     if(cr <= 4) {
       $('#proficiency').val('2');
     }
     else if(cr >= 5 && cr <= 8) {
       $('#proficiency').val('3');
     }
     else if(cr >= 9 && cr <= 12) {
       $('#proficiency').val('4');
     }
     else if(cr >= 13 && cr <= 16) {
       $('#proficiency').val('5');
     }
     else if(cr >= 17 && cr <= 20) {
       $('#proficiency').val('6');
     }
     else if(cr >= 21 && cr <= 24) {
       $('#proficiency').val('7');
     }
     else if(cr >= 25 && cr <= 28) {
       $('#proficiency').val('8');
     }
     else {
       $('#proficiency').val('9');
     }
    });

    $('#CR').trigger('change');

    $('.ui .step').tab();

    $('.next-button')
     .on('click', function() {
       $('.ui.steps').find('.step').tab('change tab', $(this).attr("data-rel"))
     });

    $('.ui.search.dropdown')
      .dropdown({
        allowAdditions: true
      })
    ;

    $('#type .ui.compact.dropdown').dropdown({
     maxSelections: 6
    });

    $('#hit_dice_amount, #constitution, #size').change(calculateHP);
});
</script>