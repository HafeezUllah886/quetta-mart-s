<?php
 namespace App\Http\Controllers; use App\Models\expenses; use App\Models\products; use App\Models\sale_details; use Illuminate\Http\Request; class profitController extends Controller { public function index() { return view("\162\x65\x70\x6f\x72\x74\163\x2e\160\x72\x6f\x66\151\164\x2e\x69\156\144\x65\x78"); } public function data($from, $to) { $products = products::all(); $data = array(); foreach ($products as $product) { $purchaseRate = avgPurchasePrice($from, $to, $product->id); $saleRate = avgSalePrice($from, $to, $product->id); $sold = sale_details::where("\160\x72\157\x64\x75\143\164\111\104", $product->id)->whereBetween("\x64\x61\164\145", array($from, $to))->sum("\x71\164\171"); $ppu = $saleRate - $purchaseRate; $profit = $ppu * $sold; $stock = getStock($product->id); $stockValue = productStockValue($product->id); $data[] = array("\x6e\141\x6d\x65" => $product->name, "\160\x75\162\143\150\x61\163\x65\x52\x61\164\x65" => $purchaseRate, "\163\x61\x6c\x65\122\x61\164\x65" => $saleRate, "\x73\x6f\154\x64" => $sold, "\x70\x70\x75" => $ppu, "\160\x72\157\146\x69\x74" => $profit, "\163\164\x6f\x63\153" => $stock, "\163\x74\157\143\x6b\126\141\154\x75\145" => $stockValue); } $expenses = expenses::whereBetween("\x64\x61\164\145", array($from, $to))->sum("\x61\155\157\x75\156\x74"); return view("\x72\145\160\157\x72\x74\x73\x2e\160\162\x6f\x66\151\164\56\x64\145\164\141\151\x6c\x73", compact("\x66\x72\157\x6d", "\x74\x6f", "\144\x61\x74\141", "\x65\170\x70\145\x6e\163\145\x73")); } }