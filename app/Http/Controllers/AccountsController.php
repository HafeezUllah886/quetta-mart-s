<?php
 namespace App\Http\Controllers; use App\Models\accounts; use App\Models\transactions; use Barryvdh\DomPDF\Facade\Pdf; use Illuminate\Http\Request; use Illuminate\Support\Facades\DB; use Symfony\Component\Finder\Exception\AccessDeniedException; class AccountsController extends Controller { public function index($filter) { $accounts = accounts::where("\x74\171\x70\145", $filter)->orderBy("\x69\x64", "\141\163\x63")->get(); return view("\106\x69\156\x61\156\x63\x65\x2e\141\x63\143\x6f\x75\x6e\164\x73\56\x69\x6e\144\x65\170", compact("\x61\x63\143\157\165\x6e\x74\x73", "\146\151\x6c\x74\145\162")); } public function create() { return view("\x46\x69\156\x61\156\x63\145\56\141\143\143\157\165\x6e\x74\163\56\x63\x72\145\x61\x74\145"); } public function store(Request $request) { $request->validate(array("\164\x69\x74\x6c\145" => "\162\x65\161\165\x69\162\x65\x64\x7c\165\156\x69\161\165\145\72\141\x63\143\x6f\x75\x6e\164\x73\x2c\x74\151\x74\154\x65"), array("\x74\x69\164\154\x65\x2e\x72\145\x71\165\151\x72\x65\x64" => "\120\x6c\x65\x61\x73\145\40\x45\x6e\164\x65\x72\40\x41\143\143\x6f\x75\156\164\40\x54\151\164\154\145", "\x74\151\x74\154\145\56\x75\156\x69\x71\165\x65" => "\101\143\x63\x6f\x75\x6e\x74\40\x77\151\x74\150\x20\164\150\x69\163\x20\x74\151\x74\x6c\x65\40\x61\154\162\145\x61\144\x79\40\x65\170\151\163\164\x73")); try { DB::beginTransaction(); $ref = getRef(); if ($request->type == "\x43\x75\163\164\x6f\155\145\x72") { $account = accounts::create(array("\x74\151\164\x6c\x65" => $request->title, "\164\171\x70\145" => $request->type, "\x63\x61\x74\x65\147\x6f\162\171" => $request->category, "\x63\157\156\164\x61\x63\164" => $request->contact, "\141\144\x64\x72\145\x73\163" => $request->address)); } else { $account = accounts::create(array("\x74\x69\164\154\145" => $request->title, "\x74\171\160\x65" => $request->type, "\x63\x61\x74\145\147\x6f\x72\171" => $request->category)); } if ($request->initial > 0) { if ($request->initialType == "\60") { createTransaction($account->id, now(), $request->initial, 0, "\x49\156\x69\x74\x69\141\154\x20\101\x6d\x6f\x75\x6e\x74", $ref); } else { createTransaction($account->id, now(), 0, $request->initial, "\x49\156\151\164\151\x61\154\x20\x41\x6d\157\165\156\164", $ref); } } DB::commit(); return back()->with("\x73\165\143\x63\x65\163\x73", "\101\143\x63\157\x75\156\x74\x20\x43\162\x65\x61\164\x65\144\40\x53\165\143\143\x65\x73\163\146\165\154\x6c\171"); } catch (\Exception $e) { return back()->with("\145\162\x72\157\162", $e->getMessage()); } } public function show($id, $from, $to) { $account = accounts::find($id); $transactions = transactions::where("\x61\x63\143\157\x75\x6e\x74\x49\104", $id)->whereBetween("\144\141\164\x65", array($from, $to))->get(); $pre_cr = transactions::where("\x61\x63\143\x6f\165\156\164\x49\104", $id)->whereDate("\144\141\x74\x65", "\x3c", $from)->sum("\x63\162"); $pre_db = transactions::where("\x61\143\143\157\165\x6e\x74\111\104", $id)->whereDate("\144\x61\164\x65", "\74", $from)->sum("\x64\x62"); $pre_balance = $pre_cr - $pre_db; $cur_cr = transactions::where("\x61\143\x63\x6f\x75\x6e\164\111\104", $id)->sum("\x63\162"); $cur_db = transactions::where("\x61\143\x63\157\165\x6e\164\x49\104", $id)->sum("\x64\142"); $cur_balance = $cur_cr - $cur_db; return view("\106\151\x6e\x61\x6e\x63\x65\x2e\x61\x63\x63\x6f\165\x6e\164\x73\x2e\x73\x74\x61\x74\x6d\x65\156\x74", compact("\x61\143\x63\x6f\165\x6e\164", "\x74\x72\141\x6e\x73\141\x63\164\x69\x6f\x6e\163", "\x70\162\x65\137\x62\141\154\x61\156\143\145", "\x63\165\x72\x5f\x62\141\154\x61\x6e\143\x65", "\x66\162\157\x6d", "\164\x6f")); } public function pdf($id, $from, $to) { $account = accounts::find($id); $transactions = transactions::where("\x61\143\143\157\x75\156\164\111\x44", $id)->whereBetween("\144\x61\x74\x65", array($from, $to))->get(); $pre_cr = transactions::where("\x61\143\x63\157\165\x6e\x74\111\104", $id)->whereDate("\144\141\x74\x65", "\74", $from)->sum("\x63\162"); $pre_db = transactions::where("\141\x63\143\x6f\x75\x6e\x74\111\x44", $id)->whereDate("\144\x61\164\x65", "\74", $from)->sum("\x64\x62"); $pre_balance = $pre_cr - $pre_db; $cur_cr = transactions::where("\x61\143\143\157\165\x6e\164\x49\104", $id)->sum("\x63\x72"); $cur_db = transactions::where("\x61\143\x63\x6f\x75\156\164\x49\x44", $id)->sum("\x64\142"); $cur_balance = $cur_cr - $cur_db; $pdf = Pdf::loadview("\x46\x69\156\x61\156\x63\145\56\141\x63\143\157\165\156\x74\163\x2e\160\144\x66", compact("\141\143\143\x6f\165\x6e\x74", "\164\162\141\156\x73\141\143\x74\x69\x6f\x6e\163", "\160\162\145\x5f\142\x61\154\x61\156\x63\x65", "\x63\x75\162\x5f\142\141\x6c\141\x6e\143\145", "\x66\x72\x6f\x6d", "\164\x6f")); return $pdf->download("\x41\x63\x63\157\x75\x6e\164\x20\123\164\141\x74\x65\x6d\145\x6e\x74\x20\x2d\40{$account->id}\x2e\x70\x64\x66"); } public function edit(accounts $account) { return view("\106\x69\x6e\141\x6e\143\145\x2e\141\x63\143\157\165\x6e\164\x73\x2e\145\144\x69\164", compact("\x61\143\x63\157\165\156\x74")); } public function update(Request $request, accounts $account) { $request->validate(array("\x74\x69\x74\154\x65" => "\x72\x65\161\x75\x69\x72\145\144\x7c\165\x6e\x69\x71\x75\145\x3a\141\143\143\157\165\156\164\x73\54\164\151\x74\154\145\x2c" . $request->accountID), array("\164\x69\x74\154\145\56\162\145\161\x75\x69\x72\x65\144" => "\120\x6c\x65\x61\x73\x65\x20\x45\x6e\164\x65\x72\40\101\x63\143\x6f\x75\156\x74\x20\x54\151\164\154\145", "\x74\x69\164\154\145\56\165\x6e\151\161\x75\145" => "\101\x63\x63\x6f\x75\x6e\x74\x20\167\151\x74\150\x20\164\150\151\163\40\164\x69\164\154\145\40\x61\154\x72\145\x61\x64\171\40\x65\x78\151\x73\x74\x73")); $account = accounts::find($request->accountID)->update(array("\x74\151\164\154\145" => $request->title, "\x63\x61\164\x65\147\x6f\162\x79" => $request->category, "\x63\x6f\156\164\x61\143\164" => $request->contact ?? null, "\141\144\144\162\145\x73\x73" => $request->address ?? null)); return redirect()->route("\141\143\x63\157\x75\156\164\x73\114\x69\163\164", $request->type)->with("\163\165\143\143\145\x73\x73", "\101\x63\x63\x6f\165\x6e\x74\x20\x55\x70\x64\141\x74\145\x64"); } public function destroy(accounts $accounts) { } }