@extends('layouts.home')
@section('title')
    <title>Company policy | HR-Soft</title>
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Company Policy</strong>
                    @if (Auth::user()->status == 0)
                      <div class="d-flex">
                        <button class="me-5 btn btn-danger active text-white" type="button" aria-pressed="true" data-coreui-toggle="modal" data-coreui-target="#policydelete">
                          <svg class="icon me-2">
                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-ban"></use>
                          </svg>Delete Policy
                        </button>
                        <button class="btn btn-primary active" type="button" aria-pressed="true" data-coreui-toggle="modal" data-coreui-target="#policymodal">
                          <svg class="icon me-2">
                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-plus"></use>
                          </svg>Add Category
                        </button>
                      </div>
                    @endif
                </div>
                <div class="card-body">
<!--ADMIN POLICY VIEW-->
                    @if (Auth::user()->status == 0)
                        <nav>
                          <div class="nav nav-pills mb-4 border-bottom pb-3" id="nav-tab" role="tablist">
                            @foreach ($policies as $key=>$item)
                            <li class="nav-item" role="presentation">
                              <button class="nav-link @if($key==0) active @endif" id="pills-home-tab" data-coreui-toggle="pill" data-coreui-target="#pills{{$item['id']}}" type="button" role="tab" aria-controls="pills{{$item['id']}}" aria-selected="true">{{$item['policyheading']}}</button>
                            </li>
                            @endforeach
                          </div>
                        </nav>
                      @foreach ($policies as $key=>$item)
                      <form action="/addpolicycontent/{{$item['id']}}" method="POST">
                        @csrf
                        <div class="tab-content" id="nav-tabContent">
                          <div class="tab-pane fade show @if($key==0) active @endif" id="pills{{$item['id']}}" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                            <textarea id="textarea" name="policycontent">{{$item['policycontent']}}</textarea>
                            <div class="modal-footer mt-3">
                              <button class="btn btn-secondary active" type="button" aria-pressed="true" data-coreui-toggle="modal" data-coreui-target="#userpolicyviewmodal">User's View</button>
                              <button type="submit" class="btn btn-primary ms-4">Save changes</button>
                            </div>
                          </div> 
                        </div>
                      </form>
                      @endforeach
                      </div>
<!--USER POLICY VIEW-->
                    @else
                      <nav>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('includes.policymodal')
    @include('includes.userpolicyviewmoday')
    @include('includes.policy_delete_modal')
@endsection
@section('scripts')
<script src="https://cdn.tiny.cloud/1/2vs69j3qoqxd2osmkgudoiqa7oq8pt9wdeuivfwqaewog53a/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#textarea',
    height: 550
});
</script>
@endsection