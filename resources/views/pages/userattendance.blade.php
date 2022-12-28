@extends('layouts.home')
@section('title')
    <title>User Attendance | HR-Soft</title>
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header"><strong>User Attendance</strong></div>
                        <div class="card-body table-responsive">
                            <div class="body flex-grow-1 px-3">
                                <div class="container-lg">
                                        <div id="nav-tab" role="tablist">
                                            <div class="row">
                                                <div class="col-sm-6 col-lg-4">
                                                    <a class="nav-link active" id="nav-home-tab" data-coreui-toggle="tab"
                                                        data-coreui-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                                        aria-selected="true">
                                                        <div class="card mb-4 p-3 cardhover">
                                                            <img src="assets/img/apsensys-logo.png" alt="" style="width: 200px; height: 50px" class="d-flex mx-auto">
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <a class="nav-link" id="nav-profile-tab" data-coreui-toggle="tab"
                                                        data-coreui-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                                        aria-selected="false">
                                                        <div class="card mb-4 p-3 cardhover">
                                                            <img src="assets/img/tsr-logo.png" alt="" style="width: 260px; height: 50px" class="d-flex mx-auto">
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <a class="nav-link" id="nav-contact-tab" data-coreui-toggle="tab"
                                                        data-coreui-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                                        aria-selected="false">
                                                        <div class="card mb-4 p-3 cardhover">
                                                            <img src="assets/img/cb-logo.svg" alt="" style="width: 200px; height: 50px"
                                                                class="d-flex mx-auto">
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row">
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                                                tabindex="0">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <table class="table table-bordered dtable">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>Name</th>
                                                                    <th>Employee ID</th>
                                                                    <th>Designation</th>
                                                                    <th>Company</th>
                                                                    <th>Shift</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($apsensys as $item)
                                                            <tr>
                                                                <td>{{$item->fname}}</td>
                                                                <td>{{$item->empcode}}</td>
                                                                <td>{{$item->designation}}</td>
                                                                <td>{{$item->companyname}}</td>
                                                                <td>{{$item->shift}}</td>
                                                                <td><a onclick="" class="btn btn-primary btn-sm" aria-pressed="true" href="{{ route('userattendview',$item->id) }}">View</a></td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                                                tabindex="0">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <table class="table table-bordered dtable">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>Name</th>
                                                                    <th>Employee ID</th>
                                                                    <th>Designation</th>
                                                                    <th>Company</th>
                                                                    <th>Shift</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($tsr as $item0)
                                                            <tr>
                                                                <td>{{$item0->fname}}</td>
                                                                <td>{{$item0->empcode}}</td>
                                                                <td>{{$item0->designation}}</td>
                                                                <td>{{$item0->companyname}}</td>
                                                                <td>{{$item0->shift}}</td>
                                                                <td><a onclick="" class="btn btn-primary btn-sm" aria-pressed="true" href="{{ route('userattendview',$item0->id) }}">View</a></td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                                                tabindex="0">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <table class="table table-bordered dtable">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>Name</th>
                                                                    <th>Employee ID</th>
                                                                    <th>Designation</th>
                                                                    <th>Company</th>
                                                                    <th>Shift</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($cio as $item1)
                                                            <tr>
                                                                <td>{{$item1->fname}}</td>
                                                                <td>{{$item1->empcode}}</td>
                                                                <td>{{$item1->designation}}</td>
                                                                <td>{{$item1->companyname}}</td>
                                                                <td>{{$item1->shift}}</td>
                                                                <td><a onclick="" class="btn btn-primary btn-sm" aria-pressed="true" href="{{ route('userattendview',$item1->id) }}">View</a></td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('table.dtable').DataTable({
                order: [[0, 'desc']],
            });
        });
    </script>
@endsection