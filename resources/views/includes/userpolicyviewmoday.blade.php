<div class="modal fade" id="userpolicyviewmodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Company Policy - User View</h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="nav nav-pills mb-4 border-bottom pb-3" id="nav-tab" role="tablist">
            @foreach ($policies as $key=>$item)
              <li class="nav-item" role="presentation">
                <button class="nav-link @if($key==0) active @endif" id="pills-home-tab" data-coreui-toggle="pill" data-coreui-target="#nav{{$item['id']}}" type="button" role="tab" aria-controls="nav{{$item['id']}}" aria-selected="true">{{$item['policyheading']}}</button>
              </li>
            @endforeach
          </div>
        </nav>
        <div class="tab-content border rounded overflow-auto" id="nav-tabContent">
          @foreach ($policies as $key=>$item)
          <div class="tab-pane fade show p-3 @if($key==0) active @endif" id="nav{{$item['id']}}" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            {!!$item['policycontent']!!}
          </div>
          @endforeach
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>