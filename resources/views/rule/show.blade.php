@extends('layouts.app')

@section('title', 'Rule')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
			<div class="ui breadcrumb">
			  <a class="section" href="/rule">Rules</a>
			  <i class="right chevron icon divider"></i>
			  <a class="section" href="/rule/section/{{ $rule->parent }}">{{ $rule->parent }}</a>
			  <i class="right chevron icon divider"></i>
			  <div class="active section">{{ $rule->name }}</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="ui eleven wide column">
  {!! str_replace('<br>', '', $rule->description) !!}
</div>
@endsection