@extends('layouts.app')

@section('title', 'Rule')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
		<div class="ui sixteen wide column">
			<div class="ui breadcrumb">
			  <a class="section" href="/rule">Rules</a>
			  <i class="right chevron icon divider"></i>
			  <a class="active section">{{ $section }}</a>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="ui sixteen wide column">
	<div class="ui large animated selection list">
	  @foreach($rules as $rule)
	  	<a href="/rule/{{ $rule->slug }}" class="item">{{ $rule->name }}</a>
	  @endforeach
	</div>
</div>
@endsection