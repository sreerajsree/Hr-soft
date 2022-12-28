@extends('layouts.home')
@section('tireqe')
    <tireqe>Payroll | HR-Soft</tireqe>
@endsection

@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card p-3 mb-5">
                        <h1>Payroll Requests</h1>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($preq as $req)
                                        <tr>
                                            <td>{{ $req->id }}</td>
                                            <td>{{ $req->name }}</td>
                                            <td>{{ $req->from_date }}</td>
                                            <td>{{ $req->to_date }}</td>
                                            <td>
                                                @if ($req->req_status == 0)
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm text-white btn-warning dropdown-toggle"
                                                            type="button" data-coreui-toggle="dropdown"
                                                            aria-expanded="false">
                                                            Pending
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item"
                                                                    href="/payslip-approve/{{ $req->id }}">Approve</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="/payslip-reject/{{ $req->id }}">Reject</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @elseif ($req->sreq_tatus == 0)
                                                    <button class="btn btn-sm btn-success text-white">Approved</button>
                                                @elseif ($req->req_status == 3)
                                                    <button class="btn btn-sm btn-danger text-white">Rejected</button>
                                                @endif
                                            </td>
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
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
