<?php
 use App\Http\Controllers\PurchaseController; use App\Http\Controllers\PurchasePaymentsController; use App\Http\Middleware\confirmPassword; use Illuminate\Support\Facades\Route; Route::middleware("\x61\x75\164\x68")->group(function () { Route::resource("\160\165\x72\x63\x68\141\163\145", PurchaseController::class); Route::get("\160\x75\162\143\150\x61\163\145\163\57\147\x65\164\160\162\x6f\144\165\x63\164\57\173\x69\144\175", array(PurchaseController::class, "\147\x65\164\x53\151\x67\x6e\154\x65\x50\162\157\x64\165\x63\x74")); Route::get("\160\x75\162\x63\150\141\163\x65\x73\57\x64\145\x6c\x65\164\x65\x2f\173\151\x64\175", array(PurchaseController::class, "\x64\145\163\164\162\x6f\171"))->name("\x70\165\162\143\x68\x61\x73\145\x73\56\144\145\x6c\x65\164\145")->middleware(confirmPassword::class); Route::get("\160\x75\162\143\150\141\x73\145\163\x2f\x70\x64\146\57\x7b\x69\144\x7d", array(PurchaseController::class, "\x70\144\146"))->name("\x70\165\x72\143\x68\x61\x73\145\163\x2e\160\144\x66"); Route::get("\x70\x75\x72\143\x68\x61\163\145\160\141\171\x6d\145\156\x74\57\x7b\x69\x64\175", array(PurchasePaymentsController::class, "\x69\156\144\x65\x78"))->name("\160\165\x72\143\x68\x61\x73\x65\x50\x61\x79\x6d\x65\x6e\x74\56\x69\x6e\x64\x65\x78"); Route::get("\160\165\x72\143\x68\141\163\145\160\x61\x79\x6d\x65\156\x74\x2f\x64\x65\154\x65\164\x65\57\173\x69\x64\175\x2f\173\x72\145\x66\x7d", array(PurchasePaymentsController::class, "\144\145\163\164\162\x6f\x79"))->name("\160\165\x72\x63\150\141\163\x65\x50\x61\x79\x6d\145\156\164\x2e\x64\x65\154\x65\164\145")->middleware(confirmPassword::class); Route::resource("\x70\165\x72\143\150\x61\163\x65\137\160\x61\x79\x6d\145\x6e\164", PurchasePaymentsController::class); });