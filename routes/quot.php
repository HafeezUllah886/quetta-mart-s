<?php
 use App\Http\Controllers\QuotationController; use App\Http\Middleware\confirmPassword; use Illuminate\Support\Facades\Route; Route::middleware("\141\165\164\150")->group(function () { Route::resource("\161\165\157\164\x61\x74\x69\x6f\x6e", QuotationController::class); Route::get("\161\165\x6f\x74\x61\x74\151\x6f\156\57\144\145\154\145\164\x65\x2f\x7b\x69\144\x7d", array(QuotationController::class, "\x64\145\x73\164\x72\157\171"))->name("\161\165\x6f\x74\141\164\151\157\156\56\x64\145\x6c\145\164\x65")->middleware(confirmPassword::class); Route::get("\161\x75\157\164\x61\x74\x69\157\x6e\57\160\x64\146\57\x7b\x69\x64\175", array(QuotationController::class, "\x70\x64\x66")); });