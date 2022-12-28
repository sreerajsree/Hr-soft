@extends('layouts.home')

@section('title')
    <title>Dashboard | HR-Soft</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/marquee.css') }}">
    <style>
        .swal2-icon{
            border:none !important;
        }
    </style>
@endsection

@section('content')
    @if (Auth::User()->status == 1 && Carbon\Carbon::parse($users->dob)->format('d-m') == Carbon\Carbon::now()->format('d-m'))
    <lottie-player class="lottie position-absolute" src="https://assets1.lottiefiles.com/packages/lf20_rovf9gzu.json"  background="transparent"  speed="0.6"  style="z-index:20; width: 80%; height: 100vh;"    autoplay></lottie-player>
    @endif
    <div class="header-divider"></div>

    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            @if (Auth::user()->status == 0)
                <div id="nav-tab" role="tablist">
                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <a class="nav-link active" id="nav-home-tab" data-coreui-toggle="tab"
                                data-coreui-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">
                                <div class="card mb-4 p-5 cardhover">
                                    <img src="assets/img/apsensys-logo.png" alt=""
                                        style="width: 200px; height: 50px" class="d-flex mx-auto">
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a class="nav-link" id="nav-profile-tab" data-coreui-toggle="tab"
                                data-coreui-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">
                                <div class="card mb-4 p-5 cardhover">
                                    <img src="assets/img/tsr-logo.png" alt="" style="width: 260px; height: 50px"
                                        class="d-flex mx-auto">
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a class="nav-link" id="nav-contact-tab" data-coreui-toggle="tab"
                                data-coreui-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                aria-selected="false">
                                <div class="card mb-4 p-5 cardhover">
                                    <img src="assets/img/cb-logo.svg" alt="" style="width: 200px; height: 50px"
                                        class="d-flex mx-auto">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endif


            <div class="row">
                <div class="tab-content" id="nav-tabContent">
                    <div class="ticker">
                        <div class="title">
                            <h5>Notifications </h5>
                        </div>
                        <div class="news">
                            <marquee class="news-content" onmouseover="this.stop();" onmouseout="this.start();">
                                @foreach ($announcements as $ac)
                                    <p> <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                                        </svg> <a href="/view-announcements/{{ $ac->id }}">{{ $ac->heading }}</a>
                                    </p>
                                @endforeach
                            </marquee>
                        </div>
                    </div>

                    @if (Auth::user()->status != 0)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="/ProfileImages/{{ Auth::user()->profile_pic }}" alt="Profile Picture"
                                            class="rounded-circle mt-2" width="150">
                                    </div>
                                    <div class="col-4">
                                        <table class="table">
                                            <tr>
                                                <th>Employee ID</th>
                                                <td>
                                                    @if (Auth::user()->empcode == null)
                                                        Not Yet Updated
                                                    @else
                                                        {{ Auth::user()->empcode }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Designation</th>
                                                <td>
                                                    @if (isset($users->designation))
                                                        {{ $users->designation }}
                                                    @else
                                                        Not Yet Updated
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <td>
                                                    @if (isset($users->fname) && isset($users->mname) && isset($users->lname))
                                                        {{ $users->fname }} {{ $users->mname }} {{ $users->lname }}
                                                    @else
                                                        Not Yet Updated
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>E-Mail</th>
                                                <td>{{ Auth::user()->email }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-4">
                                        <table class="table">
                                            <tr>
                                                <th>Employee Status</th>
                                                <td>
                                                    @if (Auth::user()->emp_status == 'Training')
                                                        <span class="badge bg-primary">Training</span>
                                                    @elseif(Auth::user()->emp_status == 'Permanent')
                                                        <span class="badge bg-success">Permanent</span>
                                                    @elseif(Auth::user()->emp_status == 'Notice')
                                                        <span class="badge bg-secondary">Notice</span>
                                                    @elseif(Auth::user()->emp_status == 'Resigned')
                                                        <span class="badge bg-danger">Resigned</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Department</th>
                                                <td>
                                                    @if (isset($users->department))
                                                        {{ $users->department }}
                                                    @else
                                                        Not Yet Updated
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Manager</th>
                                                <td>
                                                    @if (isset($users->manager))
                                                        {{ $users->manager }}
                                                    @else
                                                        Not Yet Updated
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Joined Date</th>
                                                <td>
                                                    {{ Carbon\Carbon::parse(Auth::user()->created_at)->format('d-M-Y') }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @switch(Auth::user()->company_id)
                        @case(3)
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                                tabindex="0">
                                <div class="col-12">
                                    <div class="card mb-3 p-3">
                                        <h1>Apsensys Technologies Pvt Ltd.</h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6">
                                            
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="card mb-4">
                                                <img src="assets/img/apsensys-logo.png" alt="" style="width: 400px;"
                                                    class="mx-auto">
                                                <div class="p-3">
                                                    <table class="table">
                                                        <tr>
                                                            <th scope="col">Company Name</th>
                                                            <th>Apsensys Technologies Pvt. Ltd.</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Website</th>
                                                            <th><a target="blank" href="www.apsensys.com">www.apsensys.com</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Address</th>
                                                            <th>No: 105, Apsensys Business Tower,<br> Service Road, Hormavu,
                                                                <br>Bengaluru, Karnataka 560043
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Phone</th>
                                                            <th>+91 9568256595</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">E-Mail</th>
                                                            <th><a href="mailto:hr@apsensys.com">hr@apsensys.com</a></th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @section('scripts1')
                                    <script>
                                        const doughnutChart = new Chart(document.getElementById('apsensys'), {
                                            type: 'doughnut',
                                            data: {
                                                labels: ['Employees on Training', 'Permanent Employees', 'Employees on Notice Period',
                                                    'Inactive Employees'
                                                ],
                                                datasets: [{
                                                    data: [{{ $trainingApsensys }}, {{ $permanentApsensys }}, {{ $noticeApsensys }},
                                                        {{ $inactiveApsensys }}
                                                    ],
                                                    backgroundColor: ['#0A84A4', '#F7C85E', '#6E4F7C', '#9DD866'],
                                                    hoverBackgroundColor: []
                                                }]
                                            },
                                            options: {
                                                responsive: true
                                            }
                                        }); // eslint-disable-next-line no-unused-vars
                                    </script>
                                @endsection
                            </div>
                        @break

                        @case(1)
                            <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab" tabindex="0">
                                <div class="col-12">
                                    <div class="card mb-3 p-3">
                                        <h1>The Silicon Review</h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6">
                                            
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="card">
                                                <img src="assets/img/tsr-logo.png" alt="" style="width: 430px;"
                                                    class="mx-auto">
                                                <div class="p-3">
                                                    <table class="table">
                                                        <tr>
                                                            <th scope="col">Company Name</th>
                                                            <th>The Silicon Review</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Website</th>
                                                            <th><a target="blank"
                                                                    href="https://thesiliconreview.com/">www.thesiliconreview.com</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">US Address</th>
                                                            <th>Silicon Review LLC, <br> 3240 E State St, Hamilton Township,
                                                                <br>NJ 08619, United States
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">India Address</th>
                                                            <th>No. 298/299,1st Floor,<br> 7th Cross, SGR Towers, Domlur,
                                                                <br>Bengaluru, Karnataka 560071
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Phone</th>
                                                            <th>+91 9568256595</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">E-Mail</th>
                                                            <th><a
                                                                    href="mailto:hr@thesiliconreview.com">hr@thesiliconreview.com</a>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @section('scripts2')
                                    <script>
                                        const doughnutChart1 = new Chart(document.getElementById('tsr'), {
                                            type: 'doughnut',
                                            data: {
                                                labels: ['Employees on Training', 'Permanent Employees', 'Employees on Notice Period',
                                                    'Inactive Employees'
                                                ],
                                                datasets: [{
                                                    data: [{{ $trainingTSR }}, {{ $permanentTSR }}, {{ $noticeTSR }},
                                                        {{ $inactiveTSR }}
                                                    ],
                                                    backgroundColor: ['#0A84A4', '#F7C85E', '#6E4F7C', '#9DD866'],
                                                    hoverBackgroundColor: []
                                                }]
                                            },
                                            options: {
                                                responsive: true
                                            }
                                        }); // eslint-disable-next-line no-unused-vars
                                    </script>
                                @endsection
                            </div>
                        @break

                        @case(2)
                            <div class="tab-pane fade show active" id="nav-contact" role="tabpanel"
                                aria-labelledby="nav-contact-tab" tabindex="0">
                                <div class="col-12">
                                    <div class="card mb-3 p-3">
                                        <h1>CIO Bulletin Inc</h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6">
                                            
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="card">
                                                <img src="assets/img/cb-logo.svg" alt="" style="width: 430px;"
                                                    class="mx-auto py-5">
                                                <div class="p-3">
                                                    <table class="table">
                                                        <tr>
                                                            <th scope="col">Company Name</th>
                                                            <th>CIO Bulletin Inc</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Website</th>
                                                            <th><a target="blank"
                                                                    href="https://ciobulletin.com/">www.ciobulletin.com</a></th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">US Address</th>
                                                            <th>340 S Lemon Ave #7046,<br> Walnut, CA 91789,
                                                                <br>United States
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">India Address</th>
                                                            <th>No. 298/299,1st Floor,<br> 7th Cross, SGR Towers, Domlur,
                                                                <br>Bengaluru, Karnataka 560071
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Phone</th>
                                                            <th>+91 9568256595</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">E-Mail</th>
                                                            <th><a href="mailto:hr@ciobulletin.com">hr@ciobulletin.com</a></th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @section('scripts3')
                                    <script>
                                        const doughnutChart2 = new Chart(document.getElementById('cb'), {
                                            type: 'doughnut',
                                            data: {
                                                labels: ['Employees on Training', 'Permanent Employees', 'Employees on Notice Period',
                                                    'Inactive Employees'
                                                ],
                                                datasets: [{
                                                    data: [{{ $trainingCB }}, {{ $permanentCB }}, {{ $noticeCB }},
                                                        {{ $inactiveCB }}
                                                    ],
                                                    backgroundColor: ['#0A84A4', '#F7C85E', '#6E4F7C', '#9DD866'],
                                                    hoverBackgroundColor: []
                                                }]
                                            },
                                            options: {
                                                responsive: true
                                            }
                                        }); // eslint-disable-next-line no-unused-vars
                                    </script>
                                @endsection
                            </div>
                        @break

                        @default
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                                tabindex="0">
                                <div class="col-12">
                                    <div class="card mb-3 p-3">
                                        <h1>Apsensys Technologies Pvt Ltd.</h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="card mb-4">
                                                <div class="c-chart-wrapper">
                                                    <canvas id="apsensys"></canvas>
                                                </div>
                                                <div class="p-5">
                                                    <table class="table">
                                                        <tr>
                                                            <th scope="col">Employees on Training</th>
                                                            <th>{{ $trainingApsensys }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Permanent Employees</th>
                                                            <th>{{ $permanentApsensys }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Employees on Notice Period</th>
                                                            <th>{{ $noticeApsensys }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Inactive Employees</th>
                                                            <th>{{ $inactiveApsensys }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col" class="h5 fst-italic">Total</th>
                                                            <th class="h5 fst-italic">{{ $totalApsensys }}</th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            {{-- Company details Card --}}
                                            <div class="card">
                                                <img src="assets/img/apsensys-logo.png" alt="" style="width: 400px;"
                                                    class="mx-auto">
                                                <div class="p-3">
                                                    <table class="table">
                                                        <tr>
                                                            <th scope="col">Company Name</th>
                                                            <th>Apsensys Technologies Pvt. Ltd.</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Website</th>
                                                            <th><a target="blank" href="www.apsensys.com">www.apsensys.com</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Address</th>
                                                            <th>No: 105, Apsensys Business Tower,<br> Service Road, Hormavu,
                                                                <br>Bengaluru, Karnataka 560043
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Phone</th>
                                                            <th>+91 9568256595</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">E-Mail</th>
                                                            <th><a href="mailto:hr@apsensys.com">hr@apsensys.com</a></th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            {{-- Birthday card --}}
                                            <div class="card mb-4 mt-4">
                                                <div class="card-header">
                                                    <strong>Birthday's Tomorrow</strong>
                                                </div>
                                                <div class="card-body p-0 m-0">
                                                    <div class="p-3">
                                                        <table class="table">
                                                            <table class="table">
                                                                <thead>
                                                                    <th>Name</th>
                                                                    <th>DOB</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($birthday as $item)
                                                                        @if ($item->company_id == 3)
                                                                            <tr>
                                                                                <td>{{$item->fname.' '.$item->lname}}</td>
                                                                                <td>{{\Carbon\Carbon::parse($item->dob)->format('d-M-Y')}}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Anniversary card --}}
                                            <div class="card">
                                                <div class="card-header">
                                                    <strong>Anniversaries Tomorrow</strong>
                                                </div>
                                                <div class="card-body m-0 p-0">
                                                    <div class="p-3">
                                                        <table class="table">
                                                            <thead>
                                                                <th>Name</th>
                                                                <th>Date of joining</th>
                                                                <th>Years completing</th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($anniversary as $item)
                                                                    @if ($item->company_id == 3)
                                                                        <tr>
                                                                            <td>{{$item->fname.' '.$item->lname}}</td>
                                                                            <td>{{\Carbon\Carbon::parse($item->joined_on)->format('d-M-Y')}}</td>
                                                                            <td>@php
                                                                                $joined = \Carbon\Carbon::parse($item->joined_on)->format('Y');
                                                                                $today = \Carbon\Carbon::now()->format('Y');
                                                                                echo $difference = $today - $joined;
                                                                            @endphp</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @section('scripts1')
                                    <script>
                                        const doughnutChart = new Chart(document.getElementById('apsensys'), {
                                            type: 'doughnut',
                                            data: {
                                                labels: ['Employees on Training', 'Permanent Employees', 'Employees on Notice Period',
                                                    'Inactive Employees'
                                                ],
                                                datasets: [{
                                                    data: [{{ $trainingApsensys }}, {{ $permanentApsensys }}, {{ $noticeApsensys }},
                                                        {{ $inactiveApsensys }}
                                                    ],
                                                    backgroundColor: ['#0A84A4', '#F7C85E', '#6E4F7C', '#9DD866'],
                                                    hoverBackgroundColor: []
                                                }]
                                            },
                                            options: {
                                                responsive: true
                                            }
                                        }); // eslint-disable-next-line no-unused-vars
                                    </script>
                                @endsection
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                                tabindex="0">
                                <div class="col-12">
                                    <div class="card mb-3 p-3">
                                        <h1>The Silicon Review</h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="card mb-4">
                                                <div class="c-chart-wrapper">
                                                    <canvas id="tsr"></canvas>
                                                </div>
                                                <div class="p-5">
                                                    <table class="table">
                                                        <tr>
                                                            <th scope="col">Employees on Training</th>
                                                            <th>{{ $trainingTSR }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Permanent Employees</th>
                                                            <th>{{ $permanentTSR }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Employees on Notice Period</th>
                                                            <th>{{ $noticeTSR }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Inactive Employees</th>
                                                            <th>{{ $inactiveTSR }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col" class="h4 fst-italic">Total</th>
                                                            <th class="h4 fst-italic">{{ $totalTSR }}</th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="card">
                                                <img src="assets/img/tsr-logo.png" alt="" style="width: 430px;"
                                                    class="mx-auto">
                                                <div class="p-3">
                                                    <table class="table">
                                                        <tr>
                                                            <th scope="col">Company Name</th>
                                                            <th>The Silicon Review</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Website</th>
                                                            <th><a target="blank"
                                                                    href="https://thesiliconreview.com/">www.thesiliconreview.com</a>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">US Address</th>
                                                            <th>Silicon Review LLC, <br> 3240 E State St, Hamilton Township,
                                                                <br>NJ 08619, United States
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">India Address</th>
                                                            <th>No. 298/299,1st Floor,<br> 7th Cross, SGR Towers, Domlur,
                                                                <br>Bengaluru, Karnataka 560071
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Phone</th>
                                                            <th>+91 9568256595</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">E-Mail</th>
                                                            <th><a
                                                                    href="mailto:hr@thesiliconreview.com">hr@thesiliconreview.com</a>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            {{-- Birthday card --}}
                                            <div class="card mb-4 mt-4">
                                                <div class="card-header">
                                                    <strong>Birthday's Tomorrow</strong>
                                                </div>
                                                <div class="card-body p-0 m-0">
                                                    <div class="p-3">
                                                        <table class="table">
                                                            <table class="table">
                                                                <thead>
                                                                    <th>Name</th>
                                                                    <th>DOB</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($birthday as $item)
                                                                        @if ($item->company_id == 1)
                                                                            <tr>
                                                                                <td>{{$item->fname.' '.$item->lname}}</td>
                                                                                <td>{{\Carbon\Carbon::parse($item->dob)->format('d-M-Y')}}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Anniversary card --}}
                                            <div class="card">
                                                <div class="card-header">
                                                    <strong>Anniversaries Tomorrow</strong>
                                                </div>
                                                <div class="card-body m-0 p-0">
                                                    <div class="p-3">
                                                        <table class="table">
                                                            <thead>
                                                                <th>Name</th>
                                                                <th>Date of joining</th>
                                                                <th>Years completing</th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($anniversary as $item)
                                                                    @if ($item->company_id == 1)
                                                                        <tr>
                                                                            <td>{{$item->fname.' '.$item->lname}}</td>
                                                                            <td>{{\Carbon\Carbon::parse($item->joined_on)->format('d-M-Y')}}</td>
                                                                            <td>@php
                                                                                $joined = \Carbon\Carbon::parse($item->joined_on)->format('Y');
                                                                                $today = \Carbon\Carbon::now()->format('Y');
                                                                                echo $difference = $today - $joined;
                                                                            @endphp</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @section('scripts2')
                                    <script>
                                        const doughnutChart1 = new Chart(document.getElementById('tsr'), {
                                            type: 'doughnut',
                                            data: {
                                                labels: ['Employees on Training', 'Permanent Employees', 'Employees on Notice Period',
                                                    'Inactive Employees'
                                                ],
                                                datasets: [{
                                                    data: [{{ $trainingTSR }}, {{ $permanentTSR }}, {{ $noticeTSR }},
                                                        {{ $inactiveTSR }}
                                                    ],
                                                    backgroundColor: ['#0A84A4', '#F7C85E', '#6E4F7C', '#9DD866'],
                                                    hoverBackgroundColor: []
                                                }]
                                            },
                                            options: {
                                                responsive: true
                                            }
                                        }); // eslint-disable-next-line no-unused-vars
                                    </script>
                                @endsection
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                                tabindex="0">
                                <div class="col-12">
                                    <div class="card mb-3 p-3">
                                        <h1>CIO Bulletin Inc</h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="card mb-4">
                                                <div class="c-chart-wrapper">
                                                    <canvas id="cb"></canvas>
                                                </div>
                                                <div class="p-5">
                                                    <table class="table">
                                                        <tr>
                                                            <th scope="col">Employees on Training</th>
                                                            <th>{{ $trainingCB }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Permanent Employees</th>
                                                            <th>{{ $permanentCB }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Employees on Notice Period</th>
                                                            <th>{{ $noticeCB }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Inactive Employees</th>
                                                            <th>{{ $inactiveCB }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col" class="h4 fst-italic">Total</th>
                                                            <th class="h4 fst-italic">{{ $totalCB }}</th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="card">
                                                <img src="assets/img/cb-logo.svg" alt="" style="width: 430px;"
                                                    class="mx-auto py-5">
                                                <div class="p-3">
                                                    <table class="table">
                                                        <tr>
                                                            <th scope="col">Company Name</th>
                                                            <th>CIO Bulletin Inc</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Website</th>
                                                            <th><a target="blank"
                                                                    href="https://ciobulletin.com/">www.ciobulletin.com</a></th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">US Address</th>
                                                            <th>340 S Lemon Ave #7046,<br> Walnut, CA 91789,
                                                                <br>United States
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">India Address</th>
                                                            <th>No. 298/299,1st Floor,<br> 7th Cross, SGR Towers, Domlur,
                                                                <br>Bengaluru, Karnataka 560071
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Phone</th>
                                                            <th>+91 9568256595</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">E-Mail</th>
                                                            <th><a href="mailto:hr@ciobulletin.com">hr@ciobulletin.com</a></th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            {{-- Birthday card --}}
                                            <div class="card mb-4 mt-4">
                                                <div class="card-header">
                                                    <strong>Birthday's Tomorrow</strong>
                                                </div>
                                                <div class="card-body p-0 m-0">
                                                    <div class="p-3">
                                                        <table class="table">
                                                            <table class="table">
                                                                <thead>
                                                                    <th>Name</th>
                                                                    <th>DOB</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($birthday as $item)
                                                                        @if ($item->company_id == 2)
                                                                            <tr>
                                                                                <td>{{$item->fname.' '.$item->lname}}</td>
                                                                                <td>{{\Carbon\Carbon::parse($item->dob)->format('d-M-Y')}}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Anniversary card --}}
                                            <div class="card">
                                                <div class="card-header">
                                                    <strong>Anniversaries Tomorrow</strong>
                                                </div>
                                                <div class="card-body m-0 p-0">
                                                    <div class="p-3">
                                                        <table class="table">
                                                            <thead>
                                                                <th>Name</th>
                                                                <th>Date of joining</th>
                                                                <th>Years completing</th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($anniversary as $item)
                                                                    @if ($item->company_id == 2)
                                                                        <tr>
                                                                            <td>{{$item->fname.' '.$item->lname}}</td>
                                                                            <td>{{\Carbon\Carbon::parse($item->joined_on)->format('d-M-Y')}}</td>
                                                                            <td>@php
                                                                                $joined = \Carbon\Carbon::parse($item->joined_on)->format('Y');
                                                                                $today = \Carbon\Carbon::now()->format('Y');
                                                                                echo $difference = $today - $joined;
                                                                            @endphp</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @section('scripts3')
                                    <script>
                                        const doughnutChart2 = new Chart(document.getElementById('cb'), {
                                            type: 'doughnut',
                                            data: {
                                                labels: ['Employees on Training', 'Permanent Employees', 'Employees on Notice Period',
                                                    'Inactive Employees'
                                                ],
                                                datasets: [{
                                                    data: [{{ $trainingCB }}, {{ $permanentCB }}, {{ $noticeCB }},
                                                        {{ $inactiveCB }}
                                                    ],
                                                    backgroundColor: ['#0A84A4', '#F7C85E', '#6E4F7C', '#9DD866'],
                                                    hoverBackgroundColor: []
                                                }]
                                            },
                                            options: {
                                                responsive: true
                                            }
                                        }); // eslint-disable-next-line no-unused-vars
                                    </script>
                                @endsection
                            </div>
                    @endswitch
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@if (Auth::User()->status == 1 && Carbon\Carbon::parse($users->dob)->format('d-m') == Carbon\Carbon::now()->format('d-m'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script>
    setTimeout(() => {
        $('.lottie').remove()
        Swal.fire({
        title: 'Happy Birthday!',
        iconHtml: '<img class=" m-auto border-none" style="width:7rem;" src="https://i.pinimg.com/originals/84/68/92/846892323a1e5eaa44597a73d4057588.gif">',
    })    
    }, 7000);
    </script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endif
@endsection