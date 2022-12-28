@extends('layouts.home')
@section('title')
    <title>Edit Employee Details | HR-Soft</title>
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Personal Details</strong></div>
                        <div class="card-body">
                            <form action="{{ route('update.employee',$employee->id) }}" method="POST">
                                @csrf
                                @if ( Auth::user()->status == 0  )
                                <div class="row mt-3">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="empcode" value="{{ $employee->empcode }}"
                                            aria-label="Employee Id" name="empcode">
                                            <span class="text-danger">* to be filled by HR</span>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Department" value="{{ $employee->department }}"
                                            aria-label="Department" name="department">
                                            <span class="text-danger">* to be filled by HR</span>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Designation" value="{{ $employee->designation }}"
                                            aria-label="Designation" name="designation">
                                            <span class="text-danger">* to be filled by HR</span>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Manager" value="{{ $employee->manager }}"
                                            aria-label="Manager" name="manager">
                                            <span class="text-danger">* to be filled by HR</span>
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control" placeholder="Joining date" value="{{ $employee->joined_on }}"
                                            aria-label="joined_on" name="joined_on">
                                            <span class="text-danger">* to be filled by HR</span>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" aria-label="Employee Status" name="empstatus">
                                            <option select>Select Employee Status</option>
                                            <option value="Training" <?php if ($employee->emp_status == 'Training') {echo 'selected';} ?>> Training </option>
                                            <option value="Permanent" <?php if ($employee->emp_status == 'Permanent') {echo 'selected';} ?>> Permanent </option>
                                            <option value="Notice" <?php if ($employee->emp_status == 'Notice') {echo 'selected';} ?>> Notice </option>
                                            <option value="Resigned" <?php if ($employee->emp_status == 'Resigned') {echo 'selected';} ?>> Resigned </option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="row mt-5">
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $employee->fname }}"
                                            aria-label="First name" name="fname" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $employee->mname }}"
                                            aria-label="Middle name" name="mname" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $employee->lname }}"
                                            aria-label="Last name" name="lname" required>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col">
                                        <input type="email" class="form-control" value="{{ $employee->email }}" aria-label="E-Mail"
                                            name="email" required>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" value="{{ $employee->contact }}"
                                            aria-label="Contact Number" name="contact" required>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col">
                                        <input type="date" class="form-control" value="{{ $employee->dob }}"
                                            aria-label="Date of Birth" name="dob" required>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" aria-label="Blood Group" name="blood" required>
                                            
                                            <option select>Select Blood Group</option>
                                            <option value="A+" <?php if ($employee->blood == 'A+') {echo 'selected';} ?>> A-positive (A+) </option>
                                            <option value="A-" <?php if ($employee->blood == 'A-') {echo 'selected';} ?>>A-negative (A-)</option>
                                            <option value="B+" <?php if ($employee->blood == 'B+') {echo 'selected';} ?>>B-positive (B+)</option>
                                            <option value="B-" <?php if ($employee->blood == 'B-') {echo 'selected';} ?>>B-negative (B-)</option>
                                            <option value="AB+" <?php if ($employee->blood == 'AB+') {echo 'selected';} ?>>AB-positive (AB+)</option>
                                            <option value="AB-" <?php if ($employee->blood == 'AB-') {echo 'selected';} ?>>AB-negative (AB-)</option>
                                            <option value="O+" <?php if ($employee->blood == 'O+') {echo 'selected';} ?>>O-positive (O+)</option>
                                            <option value="O-" <?php if ($employee->blood == 'O-') {echo 'selected';} ?>>O-negative (O-)</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" aria-label="Gender" name="gender" required>
                                            <option selected>Select Gender</option>
                                            <option value="Male" <?php if($employee->gender == 'Male'){ echo 'selected'; } ?>>Male</option>
                                            <option value="Female" <?php if($employee->gender == 'Female'){ echo 'selected'; } ?>>Female</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" aria-label="Marital Status" name="marital" required>
                                            <option selected>Marital Status</option>
                                            <option value="Single" <?php if($employee->marital == 'Single'){ echo 'selected'; } ?>>Single</option>
                                            <option value="Married" <?php if($employee->marital == 'Married'){ echo 'selected'; } ?>>Married</option>
                                            <option value="Divorced" <?php if($employee->marital == 'Divorced'){ echo 'selected'; } ?>>Divorced</option>
                                            <option value="Widowed" <?php if($employee->marital == 'Widowed'){ echo 'selected'; } ?>>Widowed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $employee->spouse }}"
                                            aria-label="Spouse Name" name="spouse" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $employee->father }}"
                                            aria-label="Father Name" name="father" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $employee->mother }}"
                                            aria-label="Mother Name" name="mother" required>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $employee->foccupation }}"
                                            aria-label="Father Occupation" name="foccupation" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $employee->moccupation }}"
                                            aria-label="Mother Occupation" name="moccupation" required>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $employee->emername }}"
                                            aria-label="Emer Name" name="emername" required>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" value="{{ $employee->emernumber }}"
                                            aria-label="Emer Contact" name="emernumber" required>
                                    </div>
                                </div>
                        </div>
                        <div class="card-header"><strong>Address Section</strong></div>
                        <h5 class="text-center mt-3">Temorary Address</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <textarea name="temp_address_1" cols="30" rows="10" class="form-control" required>{{ $employee->temp_address_1 }}</textarea>
                                </div>
                                <div class="col">
                                    <textarea name="temp_address_2" cols="30" rows="10" class="form-control" required>{{ $employee->temp_address_2 }}</textarea>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $employee->temp_city }}" name="temp_city"
                                        aria-label="City" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $employee->temp_state }}" name="temp_state"
                                        aria-label="State" required>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" value="{{ $employee->temp_pincode }}" name="temp_pincode"
                                        aria-label="Pincode" required>
                                </div>
                            </div>
                        </div>
                        <h5 class="text-center mt-3">Permanent Address</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <textarea name="perm_address_1" cols="30" rows="10" class="form-control" required>{{ $employee->perm_address_1 }}</textarea>
                                </div>
                                <div class="col">
                                    <textarea name="perm_address_2" cols="30" rows="10" class="form-control" required>{{ $employee->perm_address_2 }}</textarea>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $employee->perm_city }}" name="perm_city"
                                        aria-label="City" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $employee->perm_state }}" name="perm_state"
                                        aria-label="State" required>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" value="{{ $employee->perm_pincode }}" name="perm_pincode"
                                        aria-label="Pincode" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-header"><strong>Qualification Section</strong></div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $employee->qualification }}"
                                        aria-label="Qualification" name="qualification" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $employee->education }}"
                                        aria-label="Education" name="education" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-header"><strong>Bank Section</strong></div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $employee->pancard }}"
                                        aria-label="Pan Card" name="pancard" required>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" value="{{ $employee->aadhaar }}"
                                        aria-label="Aadhaar Card" name="aadhaar" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $employee->uan }}"
                                        aria-label="UAN Number" name="uan" required>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $employee->bank_name }}"
                                        aria-label="Bank Name" name="bank_name" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $employee->bank_branch }}"
                                        aria-label="Branch Name" name="bank_branch" required>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" value="{{ $employee->acc_number }}"
                                        aria-label="Account Number" name="acc_number" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ $employee->ifsc }}"
                                        aria-label="IFSC Code" name="ifsc" required>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    @endsection
