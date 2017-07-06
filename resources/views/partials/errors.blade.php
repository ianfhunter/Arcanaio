<div class="ui sixteen wide column">
  <div class="ui error message">
    <div class="header">Could you check something!</div>
    <ul class="list">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div>
</div>