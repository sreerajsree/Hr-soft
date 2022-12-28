<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('user_name');
            $table->string('fixed_basic_da');
            $table->string('fixed_hra');
            $table->string('fixed_med_allowance');
            $table->string('fixed_conveyance');
            $table->string('fixed_epf');
            $table->string('fixed_ctc');
            $table->string('shift_allowance');
            $table->string('total_ctc');
            $table->string('no_of_working_days');
            $table->string('no_of_days_payable');
            $table->string('earned_basic_da');
            $table->string('earned_hra');
            $table->string('earned_med_allowance');
            $table->string('earned_conveyance');
            $table->string('earned_epf');
            $table->string('earned_wages');
            $table->string('incentives');
            $table->string('loans');
            $table->string('ben_fuel_allowance');
            $table->string('ben_food_allowance');
            $table->string('ben_shift_allowance');
            $table->string('total_gross_salary');
            $table->string('special_deductions');
            $table->string('last_esic');
            $table->string('last_epf');
            $table->string('govt_charges');
            $table->string('professional_tax');
            $table->string('total_deductions');
            $table->string('net_wages_payable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
};
