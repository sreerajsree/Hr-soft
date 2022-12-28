@extends('layouts.home')
@section('title')
    <title>Edit Payroll | HR-Soft</title>
@endsection

@section('content')
    <div class="header-divider"></div>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card p-3 mb-5">
                        <h1>Payroll Section of {{ $employee->fname }} {{ $employee->mname }} {{ $employee->lname }}</h1>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('payroll.update', $employee->id) }}" method="POST">
                                @csrf
                                @if (Auth::user()->status == 0)
                                    <div class="row mt-3">
                                        <div class="mb-3">
                                            <h3>Fixed Payroll (₹)</h3>
                                            <button type="button"
                                                class="float-end calculate btn btn-secondary">Calculate</button>
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">Basic + DA @ 45%</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->fixed_basic_da }}" name="basic_da" id="basic_da">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">HRA @ 20%</label>
                                            <input type="text" class="form-control" value="{{ $employee->fixed_hra }}"
                                                name="fixed_hra" id="fixed_hra">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">Medical @12.2%</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->fixed_med_allowance }}" name="fixed_med_allowance"
                                                id="fixed_med_allowance">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">Conveyance @ 12%</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->fixed_conveyance }}" name="fixed_conveyance"
                                                id="fixed_conveyance">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">EPF @10.8%</label>
                                            <input type="text" class="form-control" value="{{ $employee->fixed_epf }}"
                                                name="fixed_epf" id="fixed_epf">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">CTC</label>
                                            <input type="text" class="form-control" value="{{ $employee->fixed_ctc }}"
                                                name="fixed_ctc" id="fixed_ctc">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">Shift Allowance</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->shift_allowance }}" name="shift_allowance" id="shift_allowance">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">Total CTC</label>
                                            <input type="text" class="form-control" value="{{ $employee->total_ctc }}"
                                                name="total_ctc" id="total_ctc">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">No of Day's of Work</label>
                                            <input type="number" class="form-control"
                                                value="{{ $employee->no_of_working_days }}" name="no_of_working_days"
                                                id="no_of_working_days">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">No of Day's Payable</label>
                                            <input type="number" class="form-control"
                                                value="{{ $employee->no_of_days_payable }}" name="no_of_days_payable"
                                                id="no_of_days_payable">
                                        </div>
                                    </div>
                                    <div class="my-5">
                                        <h3>Earned Wages and other Allowances (₹)</h3>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">Basic + DA @ 45%</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->earned_basic_da }}" name="earned_basic_da"
                                                id="earned_basic_da">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">HRA @ 20%</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->earned_hra }}" name="earned_hra" id="earned_hra">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">Medical @12.2%</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->earned_med_allowance }}" name="earned_med_allowance"
                                                id="earned_med_allowance">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">Conveyance @ 12%</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->earned_conveyance }}" name="earned_conveyance"
                                                id="earned_conveyance">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">EPF @10.8%</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->earned_epf }}" name="earned_epf" id="earned_epf">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">Others</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->earned_epf }}" name="others" id="others">
                                        </div>
                                        <div class="col">
                                            <label class="fw-bold mb-2" for="">Earned Wages</label>
                                            <input type="text" class="form-control"
                                                value="{{ $employee->earned_wages }}" name="earned_wages"
                                                id="earned_wages">
                                        </div>
                                        <div class="my-5">
                                            <h3>Benefits (₹)</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label class="fw-bold mb-2"
                                                    for="">Incentives+Bonus+Rewards</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->incentives }}" name="incentives"
                                                    id="incentives">
                                            </div>
                                            <div class="col">
                                                <label class="fw-bold mb-2" for="">Arrears/Loans</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->loans }}" name="loans" id="loans">
                                            </div>
                                            <div class="col">
                                                <label class="fw-bold mb-2" for="">Fuel allowance</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->ben_fuel_allowance }}" name="ben_fuel_allowance"
                                                    id="ben_fuel_allowance">
                                            </div>
                                            <div class="col">
                                                <label class="fw-bold mb-2" for="">Food allowance</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->ben_food_allowance }}" name="ben_food_allowance"
                                                    id="ben_food_allowance">
                                            </div>
                                            <div class="col">
                                                <label class="fw-bold mb-2" for="">Shift allowance</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->ben_shift_allowance }}"
                                                    name="ben_shift_allowance" id="ben_shift_allowance">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <label class="fw-bold mb-2 h5" for="">Total Gross Salary</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->total_gross_salary }}" name="total_gross_salary"
                                                    id="total_gross_salary">
                                            </div>
                                        </div>
                                        <div class="my-5">
                                            <h3 class="text-danger">Deductions (₹)</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label class="fw-bold mb-2 text-danger" for="">Special
                                                    Deductions</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->special_deductions }}" name="special_deductions"
                                                    id="special_deductions">
                                            </div>
                                            <div class="col">
                                                <label class="fw-bold mb-2 text-danger" for="">Esic</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->last_esic }}" name="last_esic" id="last_esic">
                                            </div>
                                            <div class="col">
                                                <label class="fw-bold mb-2 text-danger" for="">EPF
                                                    Emloyer+Employee</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->last_epf }}" name="last_epf" id="last_epf">
                                            </div>
                                            <div class="col">
                                                <label class="fw-bold mb-2 text-danger" for="">Govt Admin
                                                    Charges</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->govt_charges }}" name="govt_charges"
                                                    id="govt_charges">
                                            </div>
                                            <div class="col">
                                                <label class="fw-bold mb-2 text-danger" for="">Professional
                                                    Tax</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->professional_tax }}" name="professional_tax"
                                                    id="professional_tax">
                                            </div>
                                            <div class="col">
                                                <label class="fw-bold mb-2 text-danger" for="">Total
                                                    Deduction</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->total_deductions }}" name="total_deductions"
                                                    id="total_deductions">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <label class="fw-bold mb-2 h5 fst-italic" for="">Net Wages
                                                    Payable</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->net_wages_payable }}" name="net_wages_payable"
                                                    id="net_wages_payable">
                                            </div>
                                        </div>
                                @endif
                                <div class="row mt-5">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Save</button>
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
            $(".calculate").click(function() {
                var fixed_ctc = $('input[name="fixed_ctc"]').val();
                var no_of_days_payable = $('input[name="no_of_days_payable"]').val();
                var total_gross_salary = $('input[name="total_gross_salary"]').val();
                var special_deductions = $('input[name="special_deductions"]').val();
                var shift_allowance = $('input[name="shift_allowance"]').val();
                var total_ctc = parseInt(fixed_ctc) + parseInt(shift_allowance);
                $('#total_ctc').val(total_ctc);
                var basic_da = fixed_ctc * (45 / 100);
                $('#basic_da').val(basic_da);
                var fixed_hra = fixed_ctc * (20 / 100);
                $('#fixed_hra').val(fixed_hra);
                var fixed_med_allowance = fixed_ctc * (12.2 / 100);
                $('#fixed_med_allowance').val(fixed_med_allowance);
                var fixed_conveyance = fixed_ctc * (12 / 100);
                $('#fixed_conveyance').val(fixed_conveyance);
                var fixed_epf = parseInt(fixed_ctc * (10.8 / 100));
                $('#fixed_epf').val(fixed_epf);
                var earned_basic_da = (basic_da / 30) * no_of_days_payable;
                $('#earned_basic_da').val(earned_basic_da);
                var earned_hra = parseInt((fixed_hra / 30) * no_of_days_payable);
                $('#earned_hra').val(earned_hra);
                var earned_epf = (fixed_epf / 30) * no_of_days_payable;
                $('#earned_epf').val(earned_epf);
                var earned_med_allowance = parseInt((fixed_med_allowance / 30) * no_of_days_payable);
                $('#earned_med_allowance').val(earned_med_allowance);
                var earned_conveyance = (fixed_conveyance / 30) * no_of_days_payable;
                $('#earned_conveyance').val(earned_conveyance);
                var earned_wages = earned_basic_da + earned_hra + earned_epf + earned_med_allowance +
                    earned_conveyance;
                $('#earned_wages').val(earned_wages);

                var last_esic = "";
                if (total_ctc < 21001) {
                    var last_esic = (total_gross_salary * 4)/100;
                } else if(total_ctc > 21001) {
                    var last_esic = 0;
                }
                $('#last_esic').val(last_esic);

                var last_epf = "";
                if (earned_basic_da < 15000) {
                    var last_epf = (earned_basic_da * 24)/100;
                } else if(earned_basic_da > 15000) {
                    var last_epf = 3600;
                }
                $('#last_epf').val(last_epf);
                
                var govt_charges = parseInt((last_epf * 4)/100);
                $('#govt_charges').val(govt_charges);

                var professional_tax = "";
                if (earned_wages < 14999) {
                    var professional_tax = 0;
                } else if(earned_wages > 14999) {
                    var professional_tax = 200;
                }
                $('#professional_tax').val(professional_tax);

                var total_deductions = last_esic + last_epf + govt_charges + professional_tax + parseInt(special_deductions);
                $('#total_deductions').val(total_deductions);

                var net_wages_payable = total_gross_salary - total_deductions;
                $('#net_wages_payable').val(net_wages_payable);
            });
        });
    </script>
@endsection
