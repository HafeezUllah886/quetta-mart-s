<?php
 use App\Http\Controllers\dailycashbookController; use App\Http\Controllers\ledgerReportController; use App\Http\Controllers\profitController; use Illuminate\Support\Facades\Route; Route::middleware("\141\x75\164\x68")->group(function () { Route::get("\57\x72\x65\x70\x6f\162\164\x73\x2f\x70\x72\157\146\151\x74", array(profitController::class, "\151\156\x64\145\170"))->name("\162\145\160\x6f\x72\164\120\162\157\x66\x69\x74"); Route::get("\x2f\162\x65\160\x6f\x72\164\x73\57\x70\x72\157\146\x69\164\57\173\146\162\157\x6d\175\57\173\164\157\175", array(profitController::class, "\144\x61\164\141"))->name("\162\145\160\157\162\164\x50\x72\x6f\146\x69\x74\104\141\164\x61"); Route::get("\57\x72\145\x70\157\x72\x74\163\57\144\141\x69\154\171\x63\x61\x73\x68\x62\157\x6f\153", array(dailycashbookController::class, "\151\156\x64\145\170"))->name("\162\x65\160\157\x72\x74\x43\141\x73\150\x62\x6f\x6f\153"); Route::get("\x2f\162\145\x70\157\x72\x74\x73\57\x64\141\151\x6c\171\143\141\163\150\x62\x6f\157\x6b\x2f\173\x64\x61\164\145\175", array(dailycashbookController::class, "\144\145\x74\141\x69\154\x73"))->name("\x72\145\x70\x6f\x72\x74\x43\x61\x73\150\142\157\157\x6b\x44\x61\164\x61"); Route::get("\57\162\x65\x70\157\x72\x74\x73\x2f\154\145\x64\x67\145\162", array(ledgerReportController::class, "\151\x6e\x64\x65\x78"))->name("\162\145\x70\x6f\162\x74\x4c\x65\x64\147\x65\x72"); Route::get("\x2f\162\145\x70\157\x72\x74\x73\57\x6c\145\144\x67\145\162\x2f\x7b\x66\x72\157\x6d\175\57\x7b\164\x6f\175\x2f\x7b\x74\171\x70\x65\x7d", array(ledgerReportController::class, "\144\141\164\141"))->name("\162\145\x70\x6f\162\164\114\x65\x64\147\x65\x72\x44\141\x74\141"); });