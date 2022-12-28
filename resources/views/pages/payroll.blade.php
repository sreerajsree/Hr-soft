@extends('layouts.home')
@section('title')
    <title>Payroll | HR-Soft</title>
@endsection

@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card p-3 mb-5">
                        <h1>Payrolls</h1>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Request for Payslip</h4>
                            <form action="{{ route('payroll.request') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id; }}">
                                <div class="row mt-4">
                                    <div class="col">
                                        <label class="fw-bold mb-2" for="">From</label>
                                        <input type="month" class="form-control" name="from_request" id="from_request">
                                    </div>
                                    <div class="col">
                                        <label class="fw-bold mb-2" for="">To</label>
                                        <input type="month" class="form-control" name="to_request" id="from_request">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Request</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>My Requests</h4>
                            <table class="table table-striped table-bordered" id="example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($myreq as $req)
                                    <tr>
                                        <td>{{ $req->id }}</td>
                                        <td>{{ $req->from_date }}</td>
                                        <td>{{ $req->to_date }}</td>
                                        <td>
                                            @if ($req->req_status == 0)
                                            <button class="btn btn-sm btn-warning text-white">Pending</button>
                                            @elseif ($req->req_status == 1)
                                            <button class="btn btn-sm btn-success text-white">Approved</button>
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