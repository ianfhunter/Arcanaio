@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="map-content">
  <div class="ui icon buttons" id="map-buttons">
    <button class="ui button" id="map-grid-toggle"><i class="eye icon"></i></button>
    <button class="ui button" id="map-grid-minus"><i class="minus icon"></i></button>
    <button class="ui button" id="map-grid-plus"><i class="plus icon"></i></button>
    <button class="ui button" id="map-grid-snap" onclick="setSnap()"><i class="table icon"></i></button>
  </div>  
  <img src="/img/test-map.png" alt="">
  <div class="map-grid"></div>
  <div class="map-token"></div>
  <div class="map-token large"></div>
</div>

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
  var gridSize = 40;
  var snapToggle = false;

  $('#map-grid-toggle').click(function(){
      $('.map-grid').toggle();
  }); 

  $('#map-grid-minus').on('click', function() {
      var newSize = gridSize - 5;
      var sizeString = newSize+'px '+newSize+'px';

      $(".map-grid").css({
          'background-size': sizeString
      });

      gridSize = newSize;
      setTokenSize();
      setSnap();
  }); 

  $('#map-grid-plus').on('click', function() {
      var newSize = gridSize + 5;
      var sizeString = newSize+'px '+newSize+'px';

      $(".map-grid").css({
          'background-size': sizeString
      });

      gridSize = newSize;
      setTokenSize();
      setSnap();
  });

  function setSnap(){
    if(snapToggle == true){
      $( ".map-token" ).draggable({ containment: ".map-grid", snap: ".map-grid", snapMode:'inner', grid: [gridSize, gridSize] });
      snapToggle = false;
    }else{
      $( ".map-token" ).draggable({ containment: ".map-grid", snap: false, grid: false });
      snapToggle = true;
    }
  }

  function setTokenSize(){
    $('.map-token').width(gridSize);
    $('.map-token').height(gridSize);
    $('.map-token.large').width(gridSize * 2);
    $('.map-token.large').height(gridSize * 2);
  }

  $(function() {
      setSnap();
  });
</script>
@endsection