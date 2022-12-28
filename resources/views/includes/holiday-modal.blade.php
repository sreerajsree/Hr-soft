<div class="modal fade" id="holiday-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><span class="editbtn">Add</span> Event</h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="eventaction" action="{{route('add-holiday')}}" method="POST">
            @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="eventid">
            <div class="mb-3">
              <label for="event-name" class="col-form-label">Event name:</label>
              <input type="text" name="eventname" class="form-control" id="event-name">
            </div>
            <div class="mb-3">
              <label for="event-date" class="col-form-label">Event date:</label>
              <input type="date" name="eventdate" class="form-control" id="event-date">
            </div>
            <div class="mb-3">
              <label for="shift" class="col-form-label">Select Shift:</label>
                <select name="shift" class="form-control" id="shift">
                    <option value="">-</option>
                    <option value="IN">Indian Shift</option>
                    <option value="US">US Shift</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary editbtn">Add</button>
        </div>
        </form>
      </div>
    </div>
  </div>