    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/hogan.js/3.0/hogan.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autocomplete.js/0.21.3/autocomplete.min.js"></script>

    <script>
      var client = algoliasearch("{{ env('ALGOLIA_APP_ID') }}", "{{ \Common::generateAlgoliaKey() }}");
      var spells = client.initIndex('spells');
      var monsters = client.initIndex('monsters');
      var items = client.initIndex('items');
      var npcs = client.initIndex('npcs');
      var encounters = client.initIndex('encounters');
      var locations = client.initIndex('locations');
      var rules = client.initIndex('rules');

      // Mustache templating by Hogan.js (http://mustache.github.io/)
      var templateMonster = Hogan.compile('<a class="monster" href="/monster/@{{ id }}">' +
        '<div class="name clearfix">@{{{ _highlightResult.name.value }}} <small class="pull-right">CR @{{ CR }}</small></div>' +
        '<div class="type">@{{ type }}</div>' +
      '</a>');
      // Mustache templating by Hogan.js (http://mustache.github.io/)
      var templateSpell = Hogan.compile('<a class="spell" href="/spell/@{{ id }}">' +
        '<div class="name clearfix">@{{{ _highlightResult.name.value }}} <small class="pull-right"> @{{ level }}</small></div>' +
        '<div class="type">@{{ school }}</div>' +
      '</a>');
      // Mustache templating by Hogan.js (http://mustache.github.io/)
      var templateItem = Hogan.compile('<a class="items" href="/item/@{{ id }}">' +
        '<div class="name clearfix">@{{{ _highlightResult.name.value }}} <small class="pull-right"> @{{ cost }}</small></div>' +
        '<div class="type">@{{ type }}</div>' +
      '</a>');
      var templateNpc = Hogan.compile('<a class="npc" href="/npc/@{{ id }}">' +
        '<div class="name clearfix">@{{{ _highlightResult.name.value }}} <small class="pull-right">@{{ race }}</small></div>' +
      '</a>');
      var templateEncounter = Hogan.compile('<a class="npc" href="/encounter/@{{ id }}">' +
        '<div class="name clearfix">@{{{ _highlightResult.name.value }}} <small class="pull-right">Level @{{ level }}</small></div>' +
      '</a>');
      var templateLocation = Hogan.compile('<a class="npc" href="/location/@{{ id }}">' +
        '<div class="name clearfix">@{{{ _highlightResult.name.value }}} <small class="pull-right"> @{{ type }}</small></div>' +
      '</a>');
      var templateRule = Hogan.compile('<a class="rule" href="/rule/@{{ slug }}">' +
        '<div class="name clearfix">@{{{ _highlightResult.name.value }}} <small class="pull-right"> @{{ parent }}</small></div>' +
      '</a>');
      var templateFooter = Hogan.compile('<div>Footer</div>');

      // autocomplete.js initialization
      autocomplete('#search', {hint: false,autoselect:true,minLength: 3,templates: {footer: '<div class="search-footer">Powered by <img src="https://www.algolia.com/assets/algolia128x40.png" width="50px"/></div>'}}, [
        {
          source: autocomplete.sources.hits(spells, {hitsPerPage: 3}),
          displayKey: 'name',
          templates: {
            header: '<div class="category">Spells</div>',
            suggestion: function(hit) {
              // render the hit using Hogan.js
              return templateSpell.render(hit);
            }
          }
        },
        {
          source: autocomplete.sources.hits(monsters, {hitsPerPage: 3}),
          displayKey: 'name',
          templates: {
            header: '<div class="category">Monsters</div>',
            suggestion: function(hit) {
              // render the hit using Hogan.js
              return templateMonster.render(hit);
            }
          }
        },
        {
          source: autocomplete.sources.hits(items, {hitsPerPage: 3}),
          displayKey: 'name',
          templates: {
            header: '<div class="category">Items</div>',
            suggestion: function(hit) {
              // render the hit using Hogan.js
              return templateItem.render(hit);
            }
          }
        },
        {
          source: autocomplete.sources.hits(npcs, {hitsPerPage: 3}),
          displayKey: 'name',
          templates: {
            header: '<div class="category">NPCs</div>',
            suggestion: function(hit) {
              // render the hit using Hogan.js
              return templateNpc.render(hit);
            }
          }
        },
        {
          source: autocomplete.sources.hits(encounters, {hitsPerPage: 3}),
          displayKey: 'name',
          templates: {
            header: '<div class="category">Encounters</div>',
            suggestion: function(hit) {
              // render the hit using Hogan.js
              return templateEncounter.render(hit);
            }
          }
        },
        {
          source: autocomplete.sources.hits(locations, {hitsPerPage: 3}),
          displayKey: 'name',
          templates: {
            header: '<div class="category">Locations</div>',
            suggestion: function(hit) {
              // render the hit using Hogan.js
              return templateLocation.render(hit);
            }
          }
        },
        {
          source: autocomplete.sources.hits(rules, {hitsPerPage: 3}),
          displayKey: 'name',
          templates: {
            header: '<div class="category">Rules</div>',
            suggestion: function(hit) {
              // render the hit using Hogan.js
              return templateRule.render(hit);
            }
          }
        },
      ]).on('autocomplete:selected', function(event, suggestion, dataset) {
        console.log(suggestion, dataset);
        if(dataset == 0){
          window.location.href = "/spell/"+suggestion.id;
        }else if(dataset == 1){
          window.location.href = "/monster/"+suggestion.id;
        }else if(dataset == 2){
          window.location.href = "/item/"+suggestion.id;
        }else if(dataset == 3){
          window.location.href = "/npc/"+suggestion.id;
        }else if(dataset == 4){
          window.location.href = "/encounter/"+suggestion.id;
        }else if(dataset == 5){
          window.location.href = "/location/"+suggestion.id;
        }else if(dataset == 6){
          window.location.href = "/rule/"+suggestion.slug;
        }
      });
    </script>