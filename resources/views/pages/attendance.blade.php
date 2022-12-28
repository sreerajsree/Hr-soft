@php
use Carbon\Carbon;
$attendance = Session::get('attendance');
$totalHours = Carbon::parse($attendance->time_out)
    ->diff(Carbon::parse($attendance->time_in))
    ->format('%H:%I:%S');
$noLogout = Carbon::parse(\now())
    ->diff(Carbon::parse($attendance->time_in))
    ->format('%H:%I:%S');
@endphp
@extends('layouts.home')
@section('title')
    <title>Attendance | HR-Soft</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
@endsection

@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-10">
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>Attendance @if (Auth::user()->status == 0) | {{$myattendance[0]->fname}}  @endif</strong>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="d-flex">
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">From: </span>
                                            <input type="text" id="min" name="min" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">To :</span>
                                            <input type="text" id="max" name="max" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="example1" class="display nowrap table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th></th>
                                        <th>Day</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Total Hours</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($myattendance as $my)
                                        <tr>
                                            <td>{{ $my->date }}</td>
                                            <td>{{ Carbon::parse($my->date)->format('d F Y') }}</td>
                                            <td>{{ Carbon::parse($my->date)->format('l') }}</td>
                                            <td>{{ Carbon::parse($my->time_in)->format('g:i A') }}</td>
                                            <td>
                                                @if ($my->time_out == '00:00:00')
                                                    <span class="text-danger">Not Yet</span>
                                                @else
                                                    {{ Carbon::parse($my->time_out)->format('g:i A') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($my->time_out == '00:00:00')
                                                    ----
                                                @else
                                                    {{ Carbon::parse($my->time_out)->diff(Carbon::parse($my->time_in))->format('%H:%I') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="card mb-4">
                        <div class="card-header text-center">
                            <strong>Your Shift Timings</strong>
                        </div>
                        <div class="card-body text-center text-uppercase">
                            <h6>Shift</h6>
                            <svg class="icon">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-arrow-thick-from-top"></use>
                            </svg>
                            <p class="border-bottom">
                                @if (Auth::user()->shift == 'IN')
                                12:00 PM to 09:00 PM
                                @else
                                07:00 PM to 04:00 AM
                                @endif
                            </p>
                            <h6 class="pt-3">Working Hours</h6>
                            <svg class="icon">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-arrow-thick-from-top"></use>
                            </svg>
                            <p class="border-bottom">9 Hours</p>
                            <h6 class="pt-3">Weekly Off</h6>
                            <svg class="icon">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-arrow-thick-from-top"></use>
                            </svg>
                            <p class="border-bottom">Saturdays & Sundays</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
    <script>
        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[0]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });

            // DataTables initialisation
            var table = $('#example1').DataTable();

            // Refilter the table
            $('#min, #max').on('change', function() {
                table.draw();
            });
        });
    </script>
@endsection
