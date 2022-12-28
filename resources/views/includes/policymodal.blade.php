
<div class="modal fade" id="policymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="{{ route('addpolicyname') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="col-form-label">Policy category:</label>
              <input type="text" name="policy_cat" class="form-control" id="policy_cat">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
    </div>
  </div>
</div>

