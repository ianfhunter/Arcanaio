@extends('layouts.app')

@section('title', 'Create a Character')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="row">
      <div class="ui eight wide column">
        <h4 class="ui header">
          Create a Character
          <div class="sub header">
            <div class="ui breadcrumb">
              <a href="{{ url('/') }}" class="section">Home</a>
              <i class="right angle icon divider"></i>
              <a href="{{ url('/character') }}" class="section">Characters</a>
              <i class="right angle icon divider"></i>
              <div class="active section">Create</div>
            </div>
          </div>
        </h4>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  @include('player.form')
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function()
  {

    var class_counter = 0;
    $('#add-class').click(function(){
      if (class_counter < 10){
        ++class_counter;
        $('#class-'+class_counter+'-container').show()
      }
    });

    $('.class').on('change', 'select', function(){
      if($(this).val() == 'Rogue' || $(this).val() == 'Bard'){
        $('#expertise').show();
      }
    });

    $('.level').change(function() {
      var level = 0;
      $('.level').each(function(){
          level += parseFloat($(this).val());
      });

      if(level <= 4) {
        $('#proficiency').val('2');
      }
      else if(level >= 5 && level <= 8) {
        $('#proficiency').val('3');
      }
      else if(level >= 9 && level <= 12) {
        $('#proficiency').val('4');
      }
      else if(level >= 13 && level <= 16) {
        $('#proficiency').val('5');
      }
      else if(level >= 17 && level <= 20) {
        $('#proficiency').val('6');
      }
    });

   $('.popup').popup();

  });
</script>
@endsection