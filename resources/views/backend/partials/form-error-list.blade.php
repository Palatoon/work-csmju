@if(count($errors) > 0)
  <div id="error-lists" class="note note-danger">
    <h4>
      <b>
        <i class="fas fa-exclamation-circle g-mr-5"></i>
        @lang('error.message.form.title')
      </b>
    </h4>
    <ul class="m-b-0 p-l-25">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
