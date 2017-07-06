@extends('layouts.app')

@section('title', $location->name)

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      <h4 class="ui header">
        {{ Request::is('location/fork/*') ? "Create":"Edit" }} a Location
        <div class="sub header">
          <div class="ui breadcrumb">
            <a href="{{ url('/') }}" class="section">Home</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/location') }}" class="section">Locations</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/location/'.$location->id) }}" class="section">{{ $location->name }}</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{ Request::is('location/fork/*') ? "Create":"Edit" }}</div>
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

    if($('#type').val() == 'Shop'){
      $('#shop').show();
    }else if($('#type').val() == 'Village/Town/City' || $('#type').val() == 'Continent' || $('#type').val() == 'Kingdom'){
      $('#city').show();
    }else if($('#type').val() == 'Tavern/Inn'){
      $('#tavern').show();
    }

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