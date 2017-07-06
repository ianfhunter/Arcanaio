@extends('layouts.app')

@section('content')
<div class="container-fluid">

  <div class="row">

    <div class="col-xs-12 col-md-9 m-y-1">
      <div class="media">
        <a class="media-left" href="#">
          <h1><span data-icon="&#xe001;"></span></h1>
        </a>
        <div class="media-body">
          <h4 class="media-heading m-b-0">Item Name Here</h4>
          <small class="text-muted">Weapon | +1 attack | +1 damage</small>
          <p>Short description goes here.</p>
          <a href=""><i class="fa fa-fw fa-plus-square-o"></i> <strong>Pick Up Item</strong></a>
        </div>
      </div>

      <div class="media">
        <a class="media-left" href="#">
          <h1><span data-icon="&#xe017;"></span></h1>
        </a>
        <div class="media-body">
          <h4 class="media-heading m-b-0">Potion of Giant's Strength</h4>
          <small class="text-muted">Potion</small>

          <p>When you drink this potion, your Strength score changes for 1 hour. The type of giant determines the score (see the table below). The potion has no effect on you if your Strength is equal to or greater than that score.

          This potion’s transparent liquid has floating in it a sliver of fingernail from a giant of the appropriate type. The potion of frost giant strength and the potion of stone giant strength have the same effect.</p>
          <button type="button" class="btn btn-primary btn-sm btn-block">Pick Up</button>
        </div>
      </div>

      <div class="media">
        <a class="media-left" href="#">
          <h1><span data-icon="&#xe00a;"></span></h1>
        </a>
        <div class="media-body">
          <h4 class="media-heading m-b-0">Item Name Here</h4>
          Stats and description here.

          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          <button type="button" class="btn btn-primary btn-sm btn-block">Pick Up</button>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-md-3 m-y-1">
      
      <div class="list-group">
        <a href="#" class="list-group-item active"><i class="fa fa-fw fa-plus"></i> Add Item</a>
        <a href="#" class="list-group-item"><i class="fa fa-fw fa-minus"></i> Remove Item</a>
        <a href="#" class="list-group-item"><i class="fa fa-fw fa-diamond"></i> Randomly Generate</a>
        <a href="#" class="list-group-item"><i class="fa fa-fw fa-trash"></i> Clear All Loot</a>
      </div>

    </div>

  </div>

</div>


@endsection