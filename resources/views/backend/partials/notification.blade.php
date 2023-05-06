@if (session('status') !== null && isset(session('status')['class']))
  <div id="notification" class="note note-{{ session('status')['class'] }} m-b-15">
    <p class="g-mb-0">
      <i class="fal fa-bullhorn g-mr-5"></i>
      {{ session('status')['message'] }}
    </p>
  </div>
@endif
