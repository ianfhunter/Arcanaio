<div class="ui modal" id="share-modal">
  <div class="header inline">Share Your Private Content</div>
  <div class="content">
    <p>This link will provide access to your private content.</p>
    <div id="share-markdown">
      <a href="{{ url($type, $data->id) }}/{{ $data->key }}">{{ url($type, $data->id) }}/{{ $data->key }}</a>
    </div>
  </div>
  <div class="actions">
    <div class="ui cancel button">Close</div>
    <div class="ui approve primary button copy-button" data-clipboard-action="copy" data-clipboard-target="#share-markdown">Copy to Clipboard</div>
  </div>
</div>