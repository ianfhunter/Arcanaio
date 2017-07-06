@extends('layouts.app')

@section('title', 'Create a Location')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      <h4 class="ui header">
        Create a Location
        <div class="sub header">
          <div class="ui breadcrumb">
            <a href="{{ url('/') }}" class="section">Home</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/location') }}" class="section">Locations</a>
            <i class="right angle icon divider"></i>
            <div class="active section">Create</div>
          </div>
        </div>
      </h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  @include('location.form')
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function()
{

  $('.ui.search.dropdown.tags')
    .dropdown({
      allowAdditions: true
    });

  $('#type').change(function(){
    $('.subtypes').hide();
    if($(this).val() == 'Shop'){
      $('#shop').show();
    }else if($(this).val() == 'Village/Town/City' || $(this).val() == 'Continent' || $(this).val() == 'Kingdom'){
      $('#city').show();
    }else if($(this).val() == 'Tavern/Inn'){
      $('#tavern').show();
    }
  });

  $('.popup').popup();
});
</script>
@endsection