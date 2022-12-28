@extends('layouts.home')
@section('title')
    <title>{{ str_replace('-', ' ', $employees[0]->name) }} Employees | HR-Soft</title>
@endsection
@section('content')
    <div class="header-divider"></div>

    <div class="body flex-grow-1 px-3">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title text-capitalize">{{ str_replace('-', ' ', $employees[0]->name) }} Employees</h3>
                @if ($users->status == 0)
                    <a href="javascript:void(0);" data-coreui-toggle="modal" data-coreui-target="#empRegisterModal"
                        class="btn btn-primary float-end"><svg class="icon icon-md">
                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-plus"></use>
                        </svg> Add Employee</a>
                @endif
            </div>
            <div class="modal fade" id="empRegisterModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Employee to
                                {{ str_replace('-', ' ', $employees[0]->name) }}</h5>
                            <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('add.employee') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $employees[0]->company_id }}">
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-user"></use>

                                        </svg></span>
                                    <input placeholder="Name" id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                                        </svg></span>
                                    <input placeholder="E-Mail" id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-user-plus"></use>
                                        </svg></span>
                                    <select name="shift" id="" class="form-control">
                                        <option value="" selected>Select Shift</option>
                                        <option value="US">USA Shift</option>
                                        <option value="IN">India Shift</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                        </svg></span>
                                    <input placeholder="Password" id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-4"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                        </svg></span>
                                    <input placeholder="Repeat Password" id="password-confirm" type="password"
                                        class="form-control" name="password_confirmation" required
                                        autocomplete="new-password">
                                </div>
                                <button class="btn btn-block btn-success text-white" type="submit">Create Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%"
                    data-order="[[ 1, &quot;asc&quot; ]]">
                    <thead>
                        <tr>
                            <th>Employee Code</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Status</th>
                            <th>contact</th>
                            <th>email</th>
                            <th>DOB</th>
                            <th>gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $emp)
                            <tr>
                                <td>{{ $emp->empcode }}</td>
                                <td>{{ $emp->fname }}</td>
                                <td>{{ $emp->lname }}</td>
                                <td>{{ $emp->emp_status }}</td>
                                <td>{{ $emp->contact }}</td>
                                <td>{{ $emp->email }}</td>
                                <td>{{ $emp->dob }}</td>
                                <td>{{ $emp->gender }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" data-coreui-toggle="modal"
                                            data-coreui-target="#showEmployee{{ $emp->id }}"
                                            class="btn btn-sm btn-primary m-2">Show</a>
                                        <div class="modal fade" id="showEmployee{{ $emp->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Details of
                                                            {{ $emp->fname }} {{ $emp->lname }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Employee Code</th>
                                                                <td>{{ $emp->empcode }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Employee Status</th>
                                                                <td>
                                                                    @if ($emp->emp_status == 'Training')
                                                                        <button
                                                                            class="btn btn-sm btn-primary">Training</button>
                                                                    @elseif($emp->emp_status == 'Permanent')
                                                                        <button
                                                                            class="btn btn-sm btn-success">Permanent</button>
                                                                    @elseif($emp->emp_status == 'Notice')
                                                                        <button
                                                                            class="btn btn-sm btn-secondary">Notice</button>
                                                                    @elseif($emp->emp_status == 'Resigned')
                                                                        <button
                                                                            class="btn btn-sm btn-danger">Resigned</button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>First Name</th>
                                                                <td>{{ $emp->fname }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Middle Name</th>
                                                                <td>{{ $emp->mname }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Last Name</th>
                                                                <td>{{ $emp->lname }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Contact Number</th>
                                                                <td>{{ $emp->contact }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Contact Email</th>
                                                                <td>{{ $emp->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>DOB</th>
                                                                <td>{{ $emp->dob }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Blood Group</th>
                                                                <td>{{ $emp->blood }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Gender</th>
                                                                <td>{{ $emp->gender }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Marital Status</th>
                                                                <td>{{ $emp->marital }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Spouse Name</th>
                                                                <td>{{ $emp->spouse }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Father Name</th>
                                                                <td>{{ $emp->father }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Mother Name</th>
                                                                <td>{{ $emp->mother }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Father Occupation</th>
                                                                <td>{{ $emp->foccupation }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Mother Occupation</th>
                                                                <td>{{ $emp->moccupation }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Emername</th>
                                                                <td>{{ $emp->emername }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Emercontact</th>
                                                                <td>{{ $emp->emernumber }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-coreui-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="/edit-employee/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-secondary m-2">Edit</a>
                                        <a href="/edit-payroll/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-dark m-2">Salary Details</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
