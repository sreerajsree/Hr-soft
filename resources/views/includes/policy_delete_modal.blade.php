<div class="modal" tabindex="-1" id="policydelete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Policy Categories</h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @foreach ($policies as $item)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <p class="mb-0">{{$item->policyheading}}</p>
                    <a href="{{ route('deletepolicyheading',$item->id) }}" class="btn btn-sm btn-danger text-white">Delete</a>
                </div>
            @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>