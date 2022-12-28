@extends('layouts.home')
@section('title')
    <title>Trainee Leaves | HR-Soft</title>
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Leave Status</strong>
                </div>
                <div class="card-body">
                    <table class="table" id="example">
                        <thead>
                            <th>ID</th>
                            <th>Applied On</th>
                            <th>Reason</th>
                            <th>Date</th>
                            <th>Status</th>
                        </thead>
                        @foreach ($traineeStatus as $key => $item)
                            <tbody>
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                    <td>{{ $item->leave_reason }}</td>
                                    <td>{{ $item->leave_date }}</td>
                                    <td>
                                        @if ($item->status == 'Pending')
                                            <button class="btn btn-sm btn-warning text-white">{{ $item->status }}</button>
                                        @elseif ($item->status == 'Approved')
                                            <button class="btn btn-sm btn-success text-white">{{ $item->status }}</button>
                                        @elseif ($item->status == 'Rejected')
                                            <button class="btn btn-sm btn-danger text-white">{{ $item->status }}</button>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>
                                Casual Leave
                            </strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <table class="table">
                                        <tr>
                                            <td>Total Leaves</td>
                                            <td>1 Per Month</td>
                                        </tr>
                                        <tr>
                                            <td>Applied Leaves<br>( Normal )</td>
                                            <td>{{ $appliedCasual }}</td>
                                        </tr>
                                        <tr>
                                            <td>Applied Leaves<br>( Half Day )</td>
                                            <td>{{ $appliedHalfDay }}</td>
                                        </tr>
                                        <tr>
                                            <td>Approved Leaves<br>( Normal )</td>
                                            <td>{{ $approvedCasual }}</td>
                                        <tr>
                                            <td>Approved Leaves<br>( Half Day )</td>
                                            <td>{{ $approvedHalfDay }}</td>
                                        </tr>
                                        <tr>
                                            <td>Penalty Deduction</td>
                                            <td>₹ {{ $penaltyCasual }}.00</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <div class="text-center" style="padding:20px 0; ">
                                        <h1 class="text-primary">{{ $approvedHalfDay }}</h1>
                                        <p>Half Day's Taken</p>
                                        <hr>
                                        <h1 class="text-primary">{{ $approvedCasual }}</h1>
                                        <p>Casual Leaves Taken</p>
                                        <hr>
                                        <h1 class="text-primary">{{ $remainingLeaves }}</h1>
                                        <p>Remainig Leaves</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>
                                Loss of Pay
                            </strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <table class="table">
                                        <tr>
                                            <td>Credited Leaves</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>Total Leaves</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>Applied Leaves<br>(Normal)</td>
                                            <td>{{ $appliedLossOfPay }}</td>
                                        </tr>
                                        <tr>
                                            <td>Applied Leaves<br>(Half Day)</td>
                                            <td>{{ $appliedLossOfPaySpecial }}</td>
                                        </tr>
                                        <tr>
                                            <td>Approved Leaves<br>( Normal )</td>
                                            <td>{{ $approvedLossOfPay }}</td>
                                        </tr>
                                        <tr>
                                            <td>Approved Leaves<br>( Half Day )</td>
                                            <td>{{ $approvedLossOfPaySpecial }}</td>
                                        </tr>
                                        <tr>
                                            <td>Penalty Deduction</td>
                                            <td>₹ {{ $penaltyLossOfPay }}.00</td>
                                        </tr>
                                    </table>
                                    <p style="font-size: 12px; font-style:italic; margin:0; padding:0; margin-left:-0.5rem;">**L.O.P = Loss of Pay</p>
                                </div>
                                <div class="col-6">
                                    <div class="text-center" style="padding:40px 0; ">
                                        <h1 class="text-primary">{{ $approvedLossOfPaySpecial }}</h1>
                                        <p>L.O.P Half Day's Taken</p>
                                        <hr>
                                        <h1 class="text-primary">{{ $approvedLossOfPay }}</h1>
                                        <p>L.O.P Leaves Taken</p>
                                        <hr>
                                        <h1 class="text-primary">{{ $totalLossofPaycount }}</h1>
                                        <p>Total Loss of Pay Leaves</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>
                                Apply for Leave
                            </strong>
                        </div>
                        <div class="card-body p-5">
                            <form action="{{ route('trainee.request') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <select name="leave_type" id="" class="form-control">
                                            <option value="" selected>Select Leave Type</option>
                                            @if ($remainingLeaves < 1 && (\today()->format('M') == \Carbon\Carbon::parse($leaveDetails->last()->updated_at)->format('M')))
                                                <option value="Half Day">Half Day</option>
                                                <option value="Casual Leave">Casual Leave</option>
                                            @endif
                                            <option value="Loss of Pay">Loss of Pay</option>
                                            <option value="Loss of Pay (Half Day)">Loss of Pay (Half Day)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <div id="leave_date" data-coreui-footer="true" data-coreui-locale="en-US"
                                            data-coreui-toggle="date-picker" data-coreui-placeholder="Date"></div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <textarea name="leave_reason" id="" cols="30" rows="5" class="form-control" placeholder="Reason"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <button class="btn btn-primary btn-block">Apply <svg class="icon">
                                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-send"></use>
                                            </svg></button>
                                    </div>
                                </div>
                            </form>
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
                order: [
                    [0, 'desc']
                ],
            });
        });
    </script>
@endsection
