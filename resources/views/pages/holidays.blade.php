@extends('layouts.home')
@section('title')
    <title>Holidays | HR-Soft</title>
@endsection
@section('content')
    @include('includes.holiday-modal')
    @if ($errors->any())
    <div class="alert text-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <strong>List of Holidays</strong>
                    @if (Auth::user()->status == 0)
                      <button onclick="add()" class="btn btn-primary active" type="button" aria-pressed="true" data-coreui-toggle="modal" data-coreui-target="#holiday-modal">
                        <svg class="icon me-2">
                          <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-plus"></use>
                        </svg>Add
                      </button>
                    @endif
                </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">Sl.No</th>
                        <th scope="col">Month</th>
                        <th scope="col">Date</th>
                        <th scope="col">Day</th>
                        <th scope="col">Event</th>
                        @if (Auth::user()->status == 0)
                        <th scope="col">Actions</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      @foreach ($holidays as $key=>$data)
                      {{$data}}
                        <tr>
                          <td>{{++$key}}</td>
                          <td>{{\Carbon\Carbon::parse($data->date)->format('F')}}</td>
                          <td>{{$data->date}}</td>
                          <td>{{\Carbon\Carbon::parse($data->date)->isoFormat('dddd')}}</td>
                          <td>{{$data->event}}</td>
                          @if (Auth::user()->status == 0)
                              <td class="d-flex justify-content-around">
                                <a onclick="update('{{$data}}')" class="btn btn-warning btn-sm" aria-pressed="true" data-coreui-toggle="modal" data-coreui-target="#holiday-modal">
                                  <svg class="icon text-white">
                                      <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-pen"></use>
                                  </svg></a>
                                <a class="btn btn-danger btn-sm" href="{{route('delete',($data->id))}}"> 
                                  <svg class="icon text-white">
                                      <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                                  </svg></a>
                              </td>
                          @endif
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
  function update(data){
     const event = JSON.parse(data)
     $("#event-name").val(event.event)
     $("#event-date").val(event.date)
     $("#shift").val(event.shift)
     $("#eventid").val(event.id)
     $(".editbtn").text("Update")
  }

  function add(){
    $('#eventaction').trigger("reset");
    $(".editbtn").text("Add")
  }
</script>
@endsection