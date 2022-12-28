@extends('layouts.home')
@section('title')
<title>Leave Applications | HR-Soft</title>
@endsection
@section('content')
<div class="header-divider"></div>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="card mb-4">
            <div class="card-header">
                <strong>Latest 10 Leave Applications</strong>
            </div>
            <div class="card-body table-responsive" style="min-height: 13rem">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Leave Type</th>
                            <th>Leave Reason</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                        <tr>
                            <td>{{ $leave->id }}</td>
                            <td class="text-capitalize">{{ $leave->username }}</td>
                            <td class="fw-bold">{{ $leave->company_name }}</td>
                            <td>{{ $leave->leave_type }}</td>
                            <td>{{ $leave->leave_reason }}</td>
                            <td>{{ $leave->leave_start_date }}</td>
                            <td>{{ $leave->leave_end_date }}</td>
                            <td>
                                @if ($leave->status == 'Pending')
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white btn-warning dropdown-toggle" type="button"
                                        data-coreui-toggle="dropdown" aria-expanded="false">
                                        Pending
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/leave-approve/{{ $leave->id }}">Approve</a>
                                        </li>
                                        <li><a class="dropdown-item" href="/leave-reject/{{ $leave->id }}">Reject</a>
                                        </li>
                                    </ul>
                                </div>
                                @elseif ($leave->status == 'Approved')
                                <button class="btn btn-sm btn-success text-white">Approved</button>
                                @elseif ($leave->status == 'Rejected')
                                <button class="btn btn-sm btn-danger text-white">Rejected</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <strong>Latest 10 Trainee Leave Applications</strong>
            </div>
            <div class="card-body table-responsive" style="min-height: 13rem">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Leave Type</th>
                            <th>Leave Reason</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($traineeLeaves as $tl)
                        <tr>
                            <td>{{ $tl->id }}</td>
                            <td class="text-capitalize">{{ $tl->username }}</td>
                            <td class="fw-bold">{{ $tl->company_name }}</td>
                            <td>{{ $tl->leave_type }}</td>
                            <td>{{ $tl->leave_reason }}</td>
                            <td>{{ $tl->leave_date }}</td>
                            <td>
                                @if ($tl->status == 'Pending')
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white btn-warning dropdown-toggle" type="button"
                                        data-coreui-toggle="dropdown" aria-expanded="false">
                                        Pending
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/tleave-approve/{{ $tl->id }}">Approve</a>
                                        </li>
                                        <li><a class="dropdown-item" href="/tleave-reject/{{ $tl->id }}">Reject</a></li>
                                    </ul>
                                </div>
                                @elseif ($tl->status == 'Approved')
                                <button class="btn btn-sm btn-success text-white">Approved</button>
                                @elseif ($tl->status == 'Rejected')
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