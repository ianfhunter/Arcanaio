@extends('layouts.app')

@section('title', $item->name)

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      <h4 class="ui header">
        {{ Request::is('item/fork/*') ? "Create":"Edit" }} an Item
        <div class="sub header">
          <div class="ui breadcrumb">
            <a href="{{ url('/') }}" class="section">Home</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/item') }}" class="section">Items</a>
            <i class="right angle icon divider"></i>
            <a href="{{ url('/item/'.$item->id) }}" class="section">{{ $item->name }}</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{ Request::is('item/fork/*') ? "Create":"Edit" }}</div>
          </div>
        </div>
      </h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
  @include('item.form')
</div>
@endsection

@section('scripts')
<script>
$(function() {
  $('.ui.search.dropdown')
    .dropdown({
      allowAdditions: true
    });

  $('.subtypes').hide();

  var armor = {{ old('type') == "Armor" || (isset($item->type) && $item->type == "Armor") ? "true":"false" }};
  var weapon = {{ old('type') == "Weapon" || (isset($item->type) && $item->type == "Weapon") ? "true":"false" }};

  if(armor){
    $('#Armor').show();
  }else if(weapon){
    $('#Weapon').show();
  }

  $('#type').change(function(){
    $('.subtypes').hide();
    $('#' + $(this).val()).show();
  });


});
</script>
@endsection