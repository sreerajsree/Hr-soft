<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\companyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CompanypolicyController;
use App\Http\Controllers\UserattendanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PayrollController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/add-employee', [App\Http\Controllers\HomeController::class, 'add'])->name('add.employee');
    Route::get('/{companyname}/employees', [companyController::class, 'employees'])->name('employees');
    Route::get('/personaldetails', [companyController::class, 'add'])->name('add');
    Route::post('/add-personaldetails', [companyController::class, 'addDetails'])->name('add.details');
    Route::get('/office', [companyController::class, 'office'])->name('office');
    Route::get('/edit-employee/{id}', [companyController::class, 'edit'])->name('edit.employee');
    Route::post('/update-employee/{id}', [companyController::class, 'update'])->name('update.employee');
    Route::get('/documents', [DocumentController::class, 'documents'])->name('documents');
    Route::post('/image-upload', [DocumentController::class, 'fileUpload'])->name('imageUpload');
    Route::get('/view-documents', [DocumentController::class, 'viewDocuments'])->name('view.documents');
    Route::get('/leave', [LeaveController::class, 'leave'])->name('leave');
    Route::post('/leave-request', [LeaveController::class, 'leaveRequest'])->name('leave.request');
    Route::get('/leaveapplications', [LeaveController::class, 'leaveApplications'])->name('leave.applications');
    Route::get('/leave-approve/{id}', [LeaveController::class, 'leaveApprove'])->name('leave.approve');
    Route::get('/leave-reject/{id}', [LeaveController::class, 'leaveReject'])->name('leave.reject');
    Route::get('/our-gallery', [GalleryController::class, 'gallery'])->name('gallery');
    Route::post('/gallery-upload', [GalleryController::class, 'fileUpload'])->name('galleryUpload');
    Route::get('/attendance',[AttendanceController::class, 'index'])->name('attendance');
    Route::get('/holidays',[HolidaysController::class, 'holidays'])->name('holidays');
    Route::post('/add-holiday',[HolidaysController::class, 'add'])->name('add-holiday');
    // Route::post('/eventupdate',[HolidaysController::class, 'add'])->name('eventupdate');
    Route::get('/delete/{id}',[HolidaysController::class, 'del'])->name('delete');
    Route::get('/announcements',[AnnouncementController::class, 'announcements'])->name('announcements');
    Route::post('/add-announcement',[AnnouncementController::class, 'add'])->name('add-announcement');
    Route::get('/view-announcements/{id}',[AnnouncementController::class, 'viewAnnouncements'])->name('view-announcements');
    Route::post('/update-announcement/{id}',[AnnouncementController::class, 'update'])->name('update-announcement');
    Route::get('/delete-announcement/{id}',[AnnouncementController::class, 'delete'])->name('delete-announcement');
    Route::post('time-out',[AttendanceController::class, 'timeOut'])->name('time-out');
    Route::get('/viewpolicy',[CompanypolicyController::class, 'viewpolicy'])->name('viewpolicy');
    Route::post('/addpolicyname',[CompanypolicyController::class, 'addpolicyname'])->name('addpolicyname');
    Route::get('/deletepolicyheading/{id}',[CompanypolicyController::class, 'delete'])->name('deletepolicyheading');
    Route::post('/addpolicycontent/{id}',[CompanypolicyController::class, 'addpolicycontent'])->name('policycontent');
    Route::get('/userattendance',[UserattendanceController::class, 'index'])->name('userattendance');
    Route::get('/userattendanceview/{id}',[UserattendanceController::class, 'userattendview'])->name('userattendview');
    Route::get('/view-profile',[ProfileController::class, 'viewprofile'])->name('view-profile');
    Route::post('/profile-pic-upload',[ProfileController::class, 'fileUpload'])->name('profile-pic-upload');
    Route::get('/trainees-leave',[LeaveController::class, 'traineesleave'])->name('trainees.leave');
    Route::post('/trainee-request', [LeaveController::class, 'traineeRequest'])->name('trainee.request');
    Route::get('/tleave-approve/{id}', [LeaveController::class, 'tleaveApprove'])->name('tleave.approve');
    Route::get('/tleave-reject/{id}', [LeaveController::class, 'tleaveReject'])->name('tleave.reject');
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::get('/edit-payroll/{id}', [PayrollController::class, 'edit'])->name('payroll.edit');
    Route::post('/update-payroll/{id}', [PayrollController::class, 'update'])->name('payroll.update');
    Route::get('/view-payroll', [PayrollController::class, 'view'])->name('payroll.view');
    Route::post('/request-payslip', [PayrollController::class, 'request'])->name('payroll.request');
    Route::get('/payroll-requests', [PayrollController::class, 'requests'])->name('payroll.requests');
    Route::get('/payslip-approve/{id}', [PayrollController::class, 'payrollApprove'])->name('preq.approve');
    Route::get('/payslip-reject/{id}', [PayrollController::class, 'payrollReject'])->name('preq.reject');

});
