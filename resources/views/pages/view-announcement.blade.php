@extends('layouts.home')
@section('title')
    <title>{{ $announcement->heading }}</title>
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <strong>{{ $announcement->heading }}</strong>
                    <a href="{{ route('announcements') }}" class="btn btn-sm btn-primary float-end">
                        Go Back <svg class="icon">
                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-backspace"></use>
                        </svg> 
                    </a>
                </div>
               <div class="card-body">
                {!! $announcement->event !!}
               </div>
            </div>
        </div>
    </div>  
@endsection
