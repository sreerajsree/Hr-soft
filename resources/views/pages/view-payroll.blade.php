@extends('layouts.home')
@section('title')
    <title>Employee Payroll | HR-Soft</title>
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Payrolls</strong>
                </div>
                <div class="card-body">
                    <table class="table" id="example">
                        <thead>
                            <th>Emp Code</th>
                            <th>Name</th>
                            <th>CTC (₹)</th>
                            <th>No of Day's of Work</th>
                            <th>No of Day's Payable</th>
                            <th>Earned Wages (₹)</th>
                            <th>Total Gross (₹)</th>
                            <th class="text-danger">Deductions (₹)</th>
                            <th>Wages Payable (₹)</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($payrolls as $pr)
                                <tr>
                                    <td>{{ $pr->empcode }}</td>
                                    <td class="fw-bold">{{ $pr->name }}</td>
                                    <td>{{ $pr->total_ctc }}</td>
                                    <td>{{ $pr->no_of_working_days }}</td>
                                    <td>{{ $pr->no_of_days_payable }}</td>
                                    <td>{{ $pr->earned_wages }}</td>
                                    <td>{{ $pr->total_gross_salary }}</td>
                                    <td class="text-danger">{{ $pr->total_deductions }}</td>
                                    <td>{{ $pr->net_wages_payable }}</td>
                                    <td><a href="/edit-payroll/{{ encrypt($pr->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a></td>
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
