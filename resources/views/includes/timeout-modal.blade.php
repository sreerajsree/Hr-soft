<div class="modal fade" id="timeOutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong class="text-danger">Are Your Sure..?</strong></h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="https://c.tenor.com/4qs0klfg8nMAAAAM/time-waiting.gif" alt="" class="d-flex mx-auto">
          <h3 class="text-center">Completed Today's Session</h3>
        </div>
        <div class="modal-footer">
            <form action="{{ route('time-out') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <svg class="icon">
                        <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-av-timer"></use>
                    </svg>
                    Time Out
                </button>
            </form>
        </div>
      </div>
    </div>
  </div>