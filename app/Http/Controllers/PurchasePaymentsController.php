<?php
 namespace App\Http\Controllers; use App\Models\accounts; use App\Models\purchase; use App\Models\purchase_payments; use App\Models\transactions; use Illuminate\Http\Request; use Illuminate\Support\Facades\DB; class PurchasePaymentsController extends Controller { public function index($id) { $purchase = purchase::with("\x64\x65\164\x61\151\x6c\x73", "\160\141\x79\155\145\156\x74\x73")->find($id); $amount = $purchase->total; $paid = $purchase->payments->sum("\141\155\x6f\165\x6e\164"); $due = $amount - $paid; $accounts = accounts::business()->get(); return view("\x70\x75\x72\143\x68\141\163\145\56\160\141\x79\155\x65\x6e\x74\163", compact("\160\165\162\143\x68\x61\x73\145", "\144\165\145", "\x61\x63\143\157\165\156\x74\163")); } public function create() { } public function store(Request $request) { try { DB::beginTransaction(); $ref = getRef(); $purchase = purchase::find($request->purchaseID); purchase_payments::create(array("\160\165\162\143\150\x61\163\x65\111\104" => $purchase->id, "\141\x63\143\157\165\x6e\x74\x49\x44" => $request->accountID, "\x64\x61\x74\x65" => $request->date, "\x61\155\x6f\x75\156\164" => $request->amount, "\156\157\164\145\163" => $request->notes, "\162\x65\x66\111\104" => $ref)); createTransaction($request->accountID, $request->date, 0, $request->amount, "\120\141\x79\155\x65\156\x74\40\157\146\40\x50\165\162\143\150\141\x73\x65\40\x4e\157\x2e\40{$purchase->id}", $ref); createTransaction($purchase->vendorID, $request->date, $request->amount, 0, "\x50\141\171\155\x65\156\x74\40\157\146\x20\120\x75\x72\143\x68\141\x73\x65\x20\116\157\56\40{$purchase->id}", $ref); DB::commit(); return back()->with("\163\x75\143\x63\145\163\163", "\x50\141\x79\155\145\156\164\x20\x53\x61\166\145\144"); } catch (\Exception $e) { DB::rollBack(); return back()->with("\145\162\x72\157\162", $e->getMessage()); } } public function show(purchase_payments $purchase_payments) { } public function edit(purchase_payments $purchase_payments) { } public function update(Request $request, purchase_payments $purchase_payments) { } public function destroy($id, $ref) { try { DB::beginTransaction(); purchase_payments::where("\x72\x65\146\x49\x44", $ref)->delete(); transactions::where("\162\x65\146\x49\104", $ref)->delete(); DB::commit(); session()->forget("\x63\x6f\x6e\x66\x69\x72\x6d\145\144\137\160\141\x73\x73\x77\x6f\162\144"); return redirect()->route("\160\x75\x72\x63\x68\x61\163\x65\120\x61\171\x6d\x65\x6e\x74\x2e\x69\156\x64\145\x78", $id)->with("\163\x75\x63\x63\x65\x73\163", "\120\x75\x72\143\150\x61\163\x65\x20\x50\x61\x79\155\145\156\164\40\104\x65\154\145\164\x65\144"); } catch (\Exception $e) { DB::rollBack(); session()->forget("\143\157\x6e\146\x69\162\x6d\x65\144\x5f\x70\x61\163\x73\x77\x6f\162\x64"); return redirect()->route("\160\x75\x72\x63\x68\x61\x73\145\120\141\x79\x6d\145\156\164\56\x69\x6e\x64\145\x78", $id)->with("\x65\x72\x72\x6f\x72", $e->getMessage()); } } }