<div class="ui basic modal" id="delete-modal">
  <div class="header">Are you sure?</div>
  <div class="content">
    <p>Deleting the {{ $type }} will remove it permanently.</p>
  </div>
  <div class="actions">
    <form action="{{ url($type, $id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <div class="ui cancel button">Cancel</div>
      <button type="submit" class="ui red approve button">
          <i class="icon trash"></i>Delete
      </button>
    </form>
  </div>
</div>