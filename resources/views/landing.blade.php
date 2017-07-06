@extends('layouts.app')

@section('title', 'Welcome')

@section('header')
<div class="ui attached info message" id="flash-message">
  <div class="content">
    <div class="header">
      We're running a Kickstarter!
    </div>
    <p>Find out more at <a href="http://arcanegoods.com">ArcaneGoods.com</a>.</p>
  </div>
</div>
<div class="landing-cover" id="landing-hero">
	<div class="ui stackable centered grid container">
		<div class="middle aligned centered row">
			<div class="sixteen wide column text-center">
        <h1 class="ui header text-center">5E Tools & Database <div class="sub header" id="#landing-sub-header">Instant search, campaign management, homebrew tools and more.  </div></h1>


      </div>

		</div>
    <div class="middle aliged centered row">
      <div class="eight wide column">
        <a href="{{ url('register') }}" class="ui fluid primary button">Create a Free Account</a>
      </div>
    </div>
	</div>
</div>
@endsection

@section('fluid_content')
<div class="ui stackable vertically padded grid container">
  <div class="three column equal width middle aligned row">
    <div class="column">
      <h2 class="ui icon header">
        <i class="search icon"></i>
        <div class="content">
          Instant Search
          <div class="sub header">Quickly search 5E SRD, homebrew and community content. Use the search above to try it out.</div>
        </div>
      </h2>
    </div>
    <div class="column">
      <h2 class="ui icon header">
        <i class="icon" data-icon="&#xe255;"></i>
        <div class="content">
          Homebrew Tools
          <div class="sub header">Easily create your own content to use in your campaign and share with others for their campaigns.</div>
        </div>
      </h2>
    </div>
    <div class="column">
      <h2 class="ui icon header">
        <i class="icon" data-icon="&#xe096;"></i>
        <div class="content">
          Campaign Management
          <div class="sub header">Organize your content by campaign. Quickly add community content to campaigns with a few simple clicks.</div>
        </div>
      </h2>
    </div>
  </div>
  <div class="three column equal width middle aligned row">
    <div class="column">
      <h2 class="ui icon header">
        <i class="fork icon"></i>
        <div class="content">
          Inspire & Be Inspired
          <div class="sub header">Use SRD and community creations as templates to create your own content faster than ever.</div>
        </div>
      </h2>
    </div>
    <div class="column">
      <h2 class="ui icon header">
        <i class="icon" data-icon="&#xe2ee;"></i>
        <div class="content">
          Character Sheets
          <div class="sub header">Character sheets with inventory management and spellbooks to help you track everything.</div>
        </div>
      </h2>
    </div>
    <div class="column">
      <h2 class="ui icon header">
        <i class="settings icon"></i>
        <div class="content">
          Share & Print
          <div class="sub header">Markup for reddit and homebrewery is automatically generated for you to make sharing and printing even easier.</div>
        </div>
      </h2>
    </div>
  </div>
</div>

<div class="landing-cover" id="landing-campaign">
  <div class="ui stackable centered grid container">
    <div class="middle aligned centered row">
      <div class="twelve wide column text-center">
        <h1 class="ui header text-center">Campaign Management <div class="ui red label">New!</div> <div class="sub header" id="#landing-sub-header">Quickly and easily add anything from our database to your campaign, keep campaign journals and instantly search through campaign records.</div></h1>
        <a href="{{ url('register') }}" class="ui fluid primary button">Create an Account to Get Started!</a>

      </div>

    </div>
  </div>
</div>

<div class="ui stackable vertically padded grid container">
  <div class="row text-center">
    <div class="column">
      <h2 class="ui header">Providing...</h2>
    </div>
  </div>
  <div class="three column equal width middle aligned row text-center">
    <div class="column">
      <h2 class="ui icon header">
        <i class="icon" data-icon="&#xe016;"></i>
        <div class="content">
          500+ Monsters
        </div>
      </h2>
    </div>
    <div class="column">
      <h2 class="ui icon header">
        <i class="icon" data-icon="&#xe128;"></i>
        <div class="content">
          680+ Items
        </div>
      </h2>
    </div>
    <div class="column">
      <h2 class="ui icon header">
        <i class="icon" data-icon="&#xe0c9;"></i>
        <div class="content">
          470+ Spells
        </div>
      </h2>
    </div>
  </div>
</div>

@endsection