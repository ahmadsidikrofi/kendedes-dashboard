<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ReportController::class, 'GetBusinessReportData'])->name('dashboard');

Route::post('/upload-business-report', [ReportController::class, "UploadBusinessReport"])->name('report.upload');