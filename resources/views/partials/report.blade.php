<div class="ui modal" id="report-modal">
  <div class="header">What would you like to report?</div>
  <div class="content">
    {{ Form::open(['url' => url('report', [$type,$id]), 'class'=>'ui form', 'id' => 'report-form']) }}
    <div class="field">
      {{ Form::textarea('description') }}
    </div>
  </div>
  <div class="actions">
      <div class="ui cancel button">Cancel</div>
      <button type="submit" form="report-form" class="ui green approve button">
          <i class="icon check"></i>Submit
      </button>
    </form>
  </div>
</div>