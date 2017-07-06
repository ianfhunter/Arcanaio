@extends('layouts.app')

@section('title', 'Rules')

@section('header')
<div class="page-header">
  <div class="ui middle aligned stackable grid container">
    <div class="ui sixteen wide column">
      <h4 class="ui large header">
        Rules Compendium
      </h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="ui eleven wide column">
  <div class="ui fluid input">
    <input type="text" placeholder="Search Rules..." id="search-narrow">
    <div id="sort-by-wrapper"><span id="sort-by"></span></div>
  </div>

  <main>
    <div class="ui clearing horizontal divider" id="search-stats"><small id="stats" class="text-muted"></small></div>
    <div id="hits"></div>
    <div id="pagination"></div>
  </main>
</div>
<div class="ui five wide column">
  <div class="ui fluid card">
    <div class="content">
      <div class="ui small header">Filter Results</div>
    </div>
    <div class="content">
      <div id="parent" class="facet"></div>
    </div>
    <div class="extra content text-center">
      <span id="clear-all"></span>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/ion.rangeslider/2.0.6/js/ion.rangeSlider.min.js"></script>
<script src="//cdn.jsdelivr.net/instantsearch.js/1/instantsearch.min.js"></script>

<!-- TEMPLATES -->
<script type="text/html" id="hit-template">
    <div class="content">
      <div class="right floated meta">
        <div class="ui right ribbon label">
          @{{ parent }}
        </div>
      </div>
      <a class="small header" href="/rule/@{{ slug }}">
        @{{{ _highlightResult.name.value }}}
      </a>
      <div class="description">
        @{{{ summary }}}
      </div>
    </div>
    <div class="extra content">
      <div class="ui mini breadcrumb">
        <a class="section" href="/rule/section/@{{ parent }}">@{{ parent }}</a>
        <i class="right chevron icon divider"></i>
        <div class="active section">@{{ name }}</div>
      </div>
    </div>

</script>

<script type="text/html" id="no-results-template">
  <div id="no-results-message">
    <p>We didn't find any results for the search <em>"@{{query}}"</em>.</p>
  </div>
</script>
<!-- /TEMPLATES -->


<script>

$( document ).ready(function() {

  var search = instantsearch({
    // Replace with your own values
    appId: '{{ env('ALGOLIA_APP_ID', 'KAJKVCOSDK') }}',
    apiKey: '{{ env('ALGOLIA_APP_KEY') }}', // search only API key, no ADMIN key
    indexName: 'rules',
    urlSync: true
  });

  search.addWidget(
    instantsearch.widgets.searchBox({
      container: '#search-narrow',
      placeholder: 'Search for rules...'
    })
  );

  search.addWidget(
    instantsearch.widgets.hits({
      container: '#hits',
      hitsPerPage: 10,
      templates: {
        item: getTemplate('hit'),
        empty: getTemplate('no-results')
      },
      cssClasses: {
        root: "ui one raised cards",
        item: "card"
      }
    })
  );

  search.addWidget(
    instantsearch.widgets.stats({
      container: '#stats'
    })
  );

  search.addWidget(
    instantsearch.widgets.clearAll({
      container: '#clear-all',
      templates: {
        link: 'Clear All'
      },
      autoHideContainer: false
    })
  );

  search.addWidget(
    instantsearch.widgets.pagination({
      container: '#pagination',
      cssClasses: {
        active: 'active'
      }
    })
  );

  search.addWidget(
    instantsearch.widgets.refinementList({
      container: '#parent',
      attributeName: 'parent',
      autoHideContainer: false,
      operator: 'or',
      limit: 30,
      templates: {
        header: '<h4 class="ui sub header">Section</h4>'
      },
      cssClasses: {
        item: ''
      }
    })
  );

  search.start();

  function getTemplate(templateName) {
    return document.getElementById(templateName + '-template').innerHTML;
  }

});
</script>
@endsection