@extends('layouts.home')
@section('title')
<title>Leave | HR-Soft</title>
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
                        <th>Leave Type</th>
                        <th>Reason</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Status</th>
                    </thead>
                    @foreach ($status as $key=>$item)
                    <tbody>
                        <tr>
                            <td>{{ ++$key}}</td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                            <td class="fw-bold">{{ $item->leave_type }}</td>
                            <td>{{ $item->leave_reason }}</td>
                            <td>{{ $item->leave_start_date }}</td>
                            <td>{{ $item->leave_end_date }}</td>
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
                                        <td>20</td>
                                    </tr>
                                    <tr>
                                        <td>Applied Leaves<br>( Normal )</td>
                                        <td>{{ $appliedleavesCasual }}</td>
                                    </tr>
                                    <tr>
                                        <td>Applied Leaves<br>( Half Day )</td>
                                        <td>{{ $appliedleavesHalfday }}</td>
                                    </tr>
                                    <tr>
                                        <td>Approved Leaves<br>( Normal )</td>
                                        <td>{{ $approvedleavesCasualnew }}</td>
                                    <tr>
                                        <td>Approved Leaves<br>( Half Day )</td>
                                        <td>{{ $approvedHalfday }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penalty Deduction</td>
                                        <td>₹ 0.00</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <div class="text-center" style="padding:20px 0; ">
                                    <h1 class="text-primary">{{ $approvedHalfday }}</h1>
                                    <p>Half Day's Taken</p>
                                    <hr>
                                    <h1 class="text-primary">{{ $approvedleavesCasualnew }}</h1>
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
                                        <td>{{ $appliedleavesLossOfPayNormal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Applied Leaves<br>(Half Day)</td>
                                        <td>{{ $appliedleavesLossOfPaySpecial }}</td>
                                    </tr>
                                    <tr>
                                        <td>Approved Leaves<br>( Normal )</td>
                                        <td>{{ $grandtotalLossofPay }}</td>
                                    </tr>
                                    <tr>
                                        <td>Approved Leaves<br>( Half Day )</td>
                                        <td>{{ $approvedHalfdaySpecial }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penalty Deduction</td>
                                        <td>₹ {{ $penaltyDeduction }}.00</td>
                                    </tr>
                                </table>
                                <p
                                    style="font-size: 12px; font-style:italic; margin:0; padding:0; margin-left:-0.5rem;">
                                    **L.O.P = Loss of Pay</p>
                            </div>
                            <div class="col-6">
                                <div class="text-center" style="padding:40px 0; ">
                                    <h1 class="text-primary">{{ $approvedHalfdaySpecial }}</h1>
                                    <p>L.O.P Half Day's Taken</p>
                                    <hr>
                                    <h1 class="text-primary">{{ $grandtotalLossofPay }}</h1>
                                    <p>L.O.P Leaves Taken</p>
                                    <hr>
                                    <h1 class="text-primary">{{ $lossofpaytotal }}</h1>
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
                        <form action="{{ route('leave.request') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <select name="leave_type" id="" class="form-control" required>
                                        <option value="" selected>Select Leave Type</option>
                                        @if ($takenleaves < 10 && (\today()->format('M') != 'Jun' ||
                                            \today()->format('M') != 'Dec'))
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
                                    <div id="leave_start_date" data-coreui-footer="true" data-coreui-locale="en-US"
                                        data-coreui-toggle="date-picker" data-coreui-placeholder="From Date">
                                    </div>
                                </div>
                                <div class="col">
                                    <div id="leave_end_date" data-coreui-footer="true" data-coreui-locale="en-US"
                                        data-coreui-toggle="date-picker" data-coreui-placeholder="To Date">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <textarea name="leave_reason" id="" cols="30" rows="5" class="form-control"
                                        placeholder="Reason" required></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <input type="hidden" name="Total_Leave" id="Total_Leave" value=" ">
                                    <input type="hidden" name="loss_Leave" id="loss_Leave" value=" ">
                                    <input type="hidden" name="remainingLeaves" id="remainingLeaves"
                                        value="{{$remainingLeaves}} ">
                                    <button class="btn btn-primary btn-block">Apply <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-send"></use>
                                        </svg></button>
                                    <p id="SandwichLeave" class="text-danger " style="display: none">You are applying
                                        for Sandwich Leave</p>
                                </div>
                            </div>
                        </form>
                        <input type="hidden" id="hidden" value="{{$holidays}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    let leave_start_day,leave_end_day,leave_end_date;
    let start_date,end_date;
    let final_leave_end_date,orgleave_end_date;
    let Total_Days,Total_Leave,No_of_holidays=0,loss_Leave=0;
    //Getting leave from date....
    const leave_start_dateObj = document.getElementById('leave_start_date')
    leave_start_dateObj.addEventListener('dateChange.coreui.date-picker', date => {
        leave_start_Day=date.date.getDay();
        start_date=date.date;
        leave_start_date=`${date.date.getFullYear()}-${(date.date.getMonth())+1}-${date.date.getDate()}`;
        CountLeave();
    })
    //getting leave end Date....
    const leave_end_dateObj = document.getElementById('leave_end_date')
    leave_end_dateObj.addEventListener('dateChange.coreui.date-picker', date => {
        leave_end_Day=date.date.getDay();
        end_date=date.date;
        leave_end_date=`${date.date.getFullYear()}-${(date.date.getMonth())+1}-${date.date.getDate()}`;
        CountLeave();
    })

    // CountL total leave ....
    const CountLeave=()=>{
        if(start_date!=undefined&&end_date!=undefined){
            var Difference_In_Time = end_date.getTime() - start_date.getTime();
            Total_Days = (Difference_In_Time / (1000 * 3600 * 24))+1;
            if (Total_Days>0) {
                 if(SandwichLeave(Total_Days)){
                    document.getElementById('SandwichLeave').style.display="block";
                    //count holidays after count days of leave
                    var Day_after_start_day= new Date(leave_start_date);
                    var Leave_count=0,holiday_count=0,loss_Leave=0;
                    let i=0
                    while (i!=Total_Days) {
                        orgleave_end_date=`${Day_after_start_day.getFullYear()}-${(Day_after_start_day.getMonth())+1}-${Day_after_start_day.getDate()}`;
                        if (holidays(orgleave_end_date)) {
                            holiday_count++;
                            Leave_count++;
                        } else {
                            Leave_count++;
                        }
                        Day_after_start_day.setDate(Day_after_start_day.getDate() + 1);
                        i++;
                    }
                    
                    if (holiday_count>0) {
                    Total_Leave=Leave_count-holiday_count
                    document.getElementById('Total_Leave').value=Total_Leave;
                    document.getElementById("loss_Leave").value=loss_Leave
                    } else {
                    Total_Leave=Leave_count;
                    document.getElementById('Total_Leave').value=Total_Leave;
                    document.getElementById("loss_Leave").value=loss_Leave
                    }
                    //console.log("Total_Leave-> "+Total_Leave+" No_of_holidays ->"+holiday_count)
                    let remainingLeaves=document.getElementById("remainingLeaves").value
                    loss_Leave=0
                    if (remainingLeaves<Total_Leave) {
                        loss_Leave=Total_Leave-remainingLeaves
                        Total_Leave=remainingLeaves;
                        document.getElementById("loss_Leave").value=loss_Leave
                        document.getElementById('Total_Leave').value=Total_Leave;
                    } else {
                        document.getElementById('Total_Leave').value=Total_Leave;
                        document.getElementById("loss_Leave").value=loss_Leave
                    }
                    return 0;
                 }else{
                    document.getElementById('SandwichLeave').style.display="none";
                    var Day_after_start_day= new Date(leave_start_date);
                    const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                    var day = weekday[6];
                    var Leave_count=0,holiday_count=0,loss_Leave=0;
                    let i=0
                    while (i!=Total_Days) {
                        if (weekday[Day_after_start_day.getDay()]!=day) {
                            orgleave_end_date=`${Day_after_start_day.getFullYear()}-${(Day_after_start_day.getMonth())+1}-${Day_after_start_day.getDate()}`;
                            if (holidays(orgleave_end_date)) {
                            holiday_count++;
                            Leave_count++;
                            } else {
                            Leave_count++;
                            }
                            Day_after_start_day.setDate(Day_after_start_day.getDate() + 1);
                        }
                        i++;
                    }
                    if (holiday_count>0) {
                        Total_Leave=Leave_count-holiday_count
                        document.getElementById('Total_Leave').value=Total_Leave;
                        document.getElementById("loss_Leave").value=loss_Leave
                    } else {
                        Total_Leave=Leave_count;
                        document.getElementById('Total_Leave').value=Total_Leave;
                        document.getElementById("loss_Leave").value=loss_Leave
                    }
                    return 0;
                 }
            }
        }
    }
    // check it is sandwich leave or not....
    const SandwichLeave=(Total_Days)=>{
        var Day_after_start_day= new Date(leave_start_date)
        Day_after_start_day.setDate(Day_after_start_day.getDate() + 1);
        let daynumber =1;
        if(leave_start_Day!=undefined&&leave_end_Day!=undefined){
            let i=1;
            const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
            let day = weekday[daynumber];
            while(i<Total_Days){
                let day = weekday[daynumber];
                //console.log(weekday[Day_after_start_day.getDay()]);
                if (weekday[Day_after_start_day.getDay()]==day) {
                    orgleave_end_date=`${Day_after_start_day.getFullYear()}-${(Day_after_start_day.getMonth())+1}-${Day_after_start_day.getDate()}`;
                    if (holidays(orgleave_end_date)) {
                        daynumber++
                    } else {
                        return true;
                    }
                }
                Day_after_start_day.setDate(Day_after_start_day.getDate() + 1);
                i++;
            }
        }
    }
    // Store all holidays date  in string format yyyy/mm/dd
    const holidaysv=JSON.parse(document.getElementById('hidden').value);
    const holidaysList=[];
    holidaysv.forEach(element => {
        holidaysList.push(element.date);
    });
    // Check holidays date or not...
    const holidays=(orgleave_end_date)=>{
        if(holidaysList.includes(orgleave_end_date)){
            No_of_holidays=No_of_holidays+1;
            return true
        }else {
            return false
        }
    }
    //------------------------------------------------------
    $(document).ready(function() {
            $('#example').DataTable({
                order: [[0, 'desc']],
            });
        });
</script>
@endsection