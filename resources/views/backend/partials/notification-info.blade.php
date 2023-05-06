  @if( (!empty(request()->get('keyword')) || !empty(request()->get('start'))) && $total == 0 )
    <!-- start @Notification -->
    <div class="note note-primary m-b-15">
      <h4><b>{{ $title }}</b></h4>
      <p class="g-mb-0">{{ $body }}</p>
    </div>
    <!-- end @Notification -->
  @endif
