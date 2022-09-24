<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash, DB, Session;
use App\Grn;
use App\Purchase;
use App\Dailysuper;
use App\Distribute;
use App\Dailyentry;
use App\Gtog;
use App\Stos;
use App\Stog;
use App\Vendor;
use App\Godawn;
use App\Item;
use App\Shop;
use App\Grnrow;
use App\StockDispose;

class MoreController extends Controller
{
	public function grn()
	{
		return view('more/grn');
	}
	public function purchaseform()
	{
		return view('more/purchaseform');
	}
	public function dailysuper()
	{
		$this->data['godawns'] = DB::table('godawns')->select('id', 'godawnname', 'opening_birds')->get();
		return view('more/3dailysuper', $this->data);
	}
	public function distribute()
	{
		$this->data['godawns'] = DB::table('godawns')->select('id', 'godawnname', 'opening_birds')->get();
		return view('more/4distribute', $this->data);
	}
	public function dailyentry()
	{
		$this->data['shops'] = DB::table('shops')->select('id', 'shopname', 'opening_birds')->get();
		return view('more/5dailyentry', $this->data);
	}
	public function godowntogodown()
	{
		echo view('more/6godowntogodown');
	}
	public function shoptoshop()
	{
		return view('more/7shoptoshop');
	}


	public function get_godawn_opening_birds()
	{
		$userdata = Session::get('userdata');

		if ($userdata->role == 1) {
			$data['user_id'] = $userdata->id;
			$data['response'] = 1;
			return response()->json($data);
		} else {
			$opening_birds = DB::table('assign_godawns')->join('godawns', 'godawns.id', '=', 'assign_godawns.godawns')->select('opening_birds', 'godawns', 'user_id')->where('assign_godawns.user_id', $userdata->id)->first();
			return response()->json($opening_birds);
		}
	}
	public function get_shop_opening_birds()
	{
		$userdata = Session::get('userdata');
		if ($userdata->role == 2) {
			$opening_birds = DB::table('shops')->select('opening_birds', 'birds_weights', 'id', 'userid')->where('userid', $userdata->id)->first();
			return response()->json($opening_birds);
		}
		if ($userdata->role == 1) {
			$data['user_id'] = $userdata->id;
			$data['response'] = 1;
			return response()->json($data);
		}
	}

	//post
	public function insertpurchaseform(Request $request)
	{
		if ($request['inputmode'] == 'insert') {
			$pid = Purchase::select('pid')->orderBy('id', 'desc')->first();
			if ($pid != null) {
				$pid = Purchase::whereRaw('MONTH(created_at) = ?', date('m'))
					->orderBy('id', 'desc')->first();
				if ($pid != null) {
					$pid = substr($pid['pid'], 8);
					$pid = $pid + 1;
					$pid = str_pad($pid, 3, '0', STR_PAD_LEFT);
					$pid = 'AH/' . date('my') . '/' . $pid;
				} else {
					$pid = 'AH/' . date('my') . '/' . '001';
				}
			} else {
				$pid = 'AH/' . date('my') . '/' . '001';
			}


			$insert = Purchase::create([
				'pid' => $pid,
				'grn_id' => $request['grn_id'],
				'date' => $request['date'],
				'time' => $request['time'],
				'vehicleno' => $request['vehicleno'],
				'vendor' => $request['vendor'],
				'refno' => $request['refno'],
			]);
			$successcode = 1;
			return redirect()->route('purchaseform')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$insert = Purchase::where('id', $request->updateid)->update([
				'date' => $request['date'],
				'grn_id' => $request['grn_id'],
				'time' => $request['time'],
				'vehicleno' => $request['vehicleno'],
				'vendor' => $request['vendor'],
				'refno' => $request['refno'],
			]);
			$successcode = 2;
			return redirect()->route('purchaseform')->with('successcode', $successcode);
		}
	}


	public function insertgrn(Request $request)
	{
		if ($request['inputmode'] == 'insert') {
			$grnid = Grn::select('grnid')->orderBy('id', 'desc')->first();
			if ($grnid != null) {
				$grnid = Grn::whereRaw('MONTH(created_at) = ?', date('m'))
					->orderBy('id', 'desc')->first();
				if ($grnid != null) {
					$grnid = substr($grnid['grnid'], 8);
					$grnid = $grnid + 1;
					$grnid = str_pad($grnid, 3, '0', STR_PAD_LEFT);
					$grnid = 'AH/' . date('my') . '/' . $grnid;
				} else {
					$grnid = 'AH/' . date('my') . '/' . '001';
				}
			} else {
				$grnid = 'AH/' . date('my') . '/' . '001';
			}
			$insert = Grn::create([
				'grnid' => $grnid,
				'grnrefid' => $request['grnrefid'],
				'godawn' => $request['godawn'],
				'dateofpur' => $request['dateofpur'],
				'vendor' => $request['vendor'],
				'vehno' => $request['vehno'],
				'drivername' => $request['drivername'],
				'transmornos' => $request['transmornos'],
				'transmorwt' => $request['transmorwt']
			]);
			$successcode = 1;
			return redirect()->route('grn')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$insert = Grn::where('id', $request->updateid)->update([
				'godawn' => $request['godawn'],
				'dateofpur' => $request['dateofpur'],
				'vendor' => $request['vendor'],
				'vehno' => $request['vehno'],
				'drivername' => $request['drivername'],
				'transmornos' => $request['transmornos'],
				'transmorwt' => $request['transmorwt']
			]);
			$successcode = 2;
			return redirect()->route('grn')->with('successcode', $successcode);
		}
	}
	public function insertdailysuper(Request $request)
	{
		if ($request['inputmode'] == 'insert') {
			$insert = Dailysuper::create([
				'date' => $request['date'],
				'time' => $request['time'],
				'openingbirds' => $request['openingbirds'],
				'feedconsumption' => $request['feedconsumption'],
				'avgbirdwt' => $request['avgbirdwt'],
				'mortality' => $request['mortality'],
				'user_id' => $request['user_id'],
				'closingbird' => $request['closingbird'],
			]);

			Godawn::where('id', $request->godawn_id)->update([
				'opening_birds' => $request['closingbird'],
				'birds_weights' => $request['closingbird'] * $request['avgbirdwt'],
			]);
			$successcode = 1;
			return redirect()->route('dailysuper')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$insert = Dailysuper::where('id', $request->updateid)->update([
				'date' => $request['date'],
				'time' => $request['time'],
				'openingbirds' => $request['openingbirds'],
				'feedconsumption' => $request['feedconsumption'],
				'avgbirdwt' => $request['avgbirdwt'],
				'mortality' => $request['mortality'],
				'user_id' => $request['user_id'],
				'closingbird' => $request['closingbird']
			]);
			// Godawn::where('id',$request->godawn_id)->update([
			// 	'opening_birds'=>$request['closingbird'],
			// 	'birds_weights'=>$request['closingbird']*$request['avgbirdwt'],
			// ]);
			$successcode = 2;
			return redirect()->route('dailysuper')->with('successcode', $successcode);
		}
	}
	public function insertdistribute(Request $request)
	{
		if ($request['inputmode'] == 'insert') {
			$insert = Distribute::create([
				'date' => $request['date'],
				'time' => $request['time'],
				'user_id' => $request['user_id'],
				'vehno' => $request['vehno'],
				'drivername' => $request['drivername'],
				'openingbirds' => $request['openingbirds'],
				'noofbirds' => $request['noofbirds'],
				'totalwt' => $request['totalwt'],
				'avgbirdwt' => $request['avgbirdwt'],
				'shopcutunit' => $request['shopcutunit'],
			]);
			$old_wbirds_weight = Godawn::select('birds_weights')->where('id', $request->godawn_id)->first();
			$new_weight = ($old_wbirds_weight->birds_weights) - $request['totalwt'];
			Godawn::where('id', $request->godawn_id)->update([
				'opening_birds' => $request['openingbirds'] - $request['noofbirds'],
				'birds_weights' => $new_weight,
			]);



			Shop::where('id', $request['shopcutunit'])->update([
				'birds_weights' => DB::raw('birds_weights + ' . $request['totalwt']),
				'opening_birds' => DB::raw('opening_birds + ' . $request['noofbirds']),
			]);
			$successcode = 1;
			return redirect()->route('distribute')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$insert = Distribute::where('id', $request->updateid)->update([
				'date' => $request['date'],
				'user_id' => $request['user_id'],
				'time' => $request['time'],
				'vehno' => $request['vehno'],
				'drivername' => $request['drivername'],
				'noofbirds' => $request['noofbirds'],
				'openingbirds' => $request['opening_birds'],
				'totalwt' => $request['totalwt'],
				'avgbirdwt' => $request['avgbirdwt'],
				'shopcutunit' => $request['shopcutunit'],
			]);
			// $old_wbirds_weight=Godawn::select('birds_weights')->where('id',$request->godawn_id)->first();
			// $new_weight=($old_wbirds_weight->birds_weights)-$request['totalwt'];
			// Godawn::where('id',$request->godawn_id)->update([
			// 	'opening_birds'=>$request['openingbirds']-$request['noofbirds'],
			// 	'birds_weights'=>$new_weight,
			// ]);
			$successcode = 2;
			return redirect()->route('distribute')->with('successcode', $successcode);
		}
	}
	public function insertdailyentry(Request $request)
	{
		//dd($request['shop_id']);

		if ($request['inputmode'] == 'insert') {
			$insert = Dailyentry::create([
				'user_id' => $request['user_id'],
				'date' => $request['date'],
				'time' => $request['time'],
				'salegbird' => $request['salegbird'],
				'openingbirds' => $request['openingbirds'],
				'salegwt' => $request['salegwt'],
				'billqtywt' => $request['billqtywt'],
				'mortality' => $request['mortality'],
				'closingbird' => $request['closingbird'],
				'wt' => $request['wt'],
				'tsaleamt' => $request['tsaleamt'],
				'disamt' => $request['disamt'],
				'stock_g_k_sale' => $request['stock_g_k_sale'],
				'stock_chick_sale' => $request['stock_chick_sale'],
				'meat_percent' => $request['meat_percent'],
				'deposit_amount_bank'=>$request['deposit_amount_bank'],
				'deposit_amount_office'=>$request['deposit_amount_office'],
				'expenses'=>$request['expenses'],
				'closing_amount'=>$request['closing_amount'],
				'opening_amount'=>$request['opening_amount'],
				'deposit_amount_phonepay'=>$request['deposit_amount_phonepay'],
				
			]);

			Shop::where('id', $request['shop_id'])->update([
				'birds_weights' => DB::raw('birds_weights - ' . (($request['avg_body_wt']*$request['salegbird']) + $request['wt'])),
				'opening_birds' => $request['closingbird'],
			]);

			$update=StockDispose::where('shop_id', $request['shop_id'])->orderby('id','desc')->first();
			if($update){
				$update->update([
				'total_salable_chicken' => DB::raw('total_salable_chicken - ' . $request['stock_chick_sale']),
				'total_salable_g_k' => DB::raw('total_salable_g_k - ' . $request['stock_g_k_sale']),
			]);
			}
			
	
			$successcode = 1;
			return redirect()->route('dailyentrys')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$insert = Dailyentry::where('id', $request->updateid)->update([
				'date' => $request['date'],
				'time' => $request['time'],
				'salegbird' => $request['salegbird'],
				'openingbirds' => $request['openingbirds'],
				'salegwt' => $request['salegwt'],
				'billqtywt' => $request['billqtywt'],
				'mortality' => $request['mortality'],
				'closingbird' => $request['closingbird'],
				'wt' => $request['wt'],
				'tsaleamt' => $request['tsaleamt'],
				'disamt' => $request['disamt'],
				'stock_g_k_sale' => $request['stock_g_k_sale'],
				'stock_chick_sale' => $request['stock_chick_sale'],
				'meat_percent' => $request['meat_percent'],
				'deposit_amount_bank'=>$request['deposit_amount_bank'],
				'deposit_amount_office'=>$request['deposit_amount_office'],
				'expenses'=>$request['expenses'],
				'closing_amount'=>$request['closing_amount'],
				'opening_amount'=>$request['opening_amount'],
				'deposit_amount_phonepay'=>$request['deposit_amount_phonepay'],

			]);
			// Shop::where('id',$request['shop_id'])->update([
			// 	'birds_weights' => DB::raw('birds_weights - '.($request['salegwt']+$request['wt'])),
			// 	'opening_birds' => $request['closingbird'],
			// ]);
			$successcode = 2;
			return redirect()->route('dailyentrys')->with('successcode', $successcode);
		}
	}
	public function insertgodowntogodown(Request $request)
	{
		if ($request['inputmode'] == 'insert') {

			$insert = Gtog::create([
				'date' => $request['date'],
				'time' => $request['time'],
				'targetgod' => $request['targetgod'],
				'sourcegod' => $request['sourcegod'],
				'vehicleno' => $request['vehicleno'],
				'drivername' => $request['drivername'],
				'livebird' => $request['livebird'],
				'totalwt' => $request['totalwt'],
				'avgwt' => $request['avgwt'],
			]);
			Godawn::where('id', $request['targetgod'])->update([
				'birds_weights' => DB::raw('birds_weights + ' . $request['totalwt']),
				'opening_birds' => DB::raw('opening_birds + ' . $request['livebird']),
			]);
			Godawn::where('id', $request['sourcegod'])->update([
				'birds_weights' => DB::raw('birds_weights - ' . $request['totalwt']),
				'opening_birds' => DB::raw('opening_birds - ' . $request['livebird']),
			]);

			$successcode = 1;
			return redirect()->route('godowntogodown')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$insert = Gtog::where('id', $request->updateid)->update([
				'date' => $request['date'],
				'time' => $request['time'],
				'targetgod' => $request['targetgod'],
				'sourcegod' => $request['sourcegod'],
				'vehicleno' => $request['vehicleno'],
				'drivername' => $request['drivername'],
				'livebird' => $request['livebird'],
				'totalwt' => $request['totalwt'],
				'avgwt' => $request['avgwt'],
			]);
			$successcode = 2;
			return redirect()->route('godowntogodown')->with('successcode', $successcode);
		}
	}
	public function insertshoptoshop(Request $request)
	{
		if ($request['inputmode'] == 'insert') {

			$insert = Stos::create([
				'date' => $request['date'],
				'time' => $request['time'],
				'targetshop' => $request['targetshop'],
				'sourceshop' => $request['sourceshop'],
				'vehicleno' => $request['vehicleno'],
				'drivername' => $request['drivername'],
				'livebird' => $request['livebird'],
				'totalwt' => $request['totalwt'],
				'avgwt' => $request['avgwt'],
				'rawchicken' => $request['rawchicken'],
			]);
			Shop::where('id', $request['targetshop'])->update([
				'birds_weights' => DB::raw('birds_weights + ' . ($request['totalwt'] + $request['rawchicken'])),
				'opening_birds' => DB::raw('opening_birds + ' . $request['livebird']),
			]);
			Shop::where('id', $request['sourceshop'])->update([
				'birds_weights' => DB::raw('birds_weights - ' . ($request['totalwt'] + $request['rawchicken'])),
				'opening_birds' => DB::raw('opening_birds - ' . $request['livebird']),
			]);

			$successcode = 1;
			return redirect()->route('stoss')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$insert = Stos::where('id', $request->updateid)->update([
				'date' => $request['date'],
				'time' => $request['time'],
				'targetshop' => $request['targetshop'],
				'sourceshop' => $request['sourceshop'],
				'vehicleno' => $request['vehicleno'],
				'drivername' => $request['drivername'],
				'livebird' => $request['livebird'],
				'totalwt' => $request['totalwt'],
				'avgwt' => $request['avgwt'],
				'rawchicken' => $request['rawchicken'],
			]);
			$successcode = 2;
			return redirect()->route('stoss')->with('successcode', $successcode);;
		}
	}
	public function insertshoptogodown(Request $request)
	{
		if ($request['inputmode'] == 'insert') {
			$insert = Stog::create([
				'date' => $request['date'],
				'time' => $request['time'],
				'targetgod' => $request['targetgod'],
				'sourceshop' => $request['sourceshop'],
				'vehicleno' => $request['vehicleno'],
				'drivername' => $request['drivername'],
				'livebird' => $request['livebird'],
				'totalwt' => $request['totalwt'],
				'avgwt' => $request['avgwt'],
			]);
			Godawn::where('id', $request['targetgod'])->update([
				'birds_weights' => DB::raw('birds_weights + ' . $request['totalwt']),
				'opening_birds' => DB::raw('opening_birds + ' . $request['livebird']),
			]);
			Shop::where('id', $request['sourceshop'])->update([
				'birds_weights' => DB::raw('birds_weights - ' . $request['totalwt']),
				'opening_birds' => DB::raw('opening_birds - ' . $request['livebird']),
			]);
			$successcode = 1;
			return redirect()->route('shoptogodown')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$insert = Stog::where('id', $request->updateid)->update([
				'date' => $request['date'],
				'time' => $request['time'],
				'targetgod' => $request['targetgod'],
				'sourceshop' => $request['sourceshop'],
				'vehicleno' => $request['vehicleno'],
				'drivername' => $request['drivername'],
				'livebird' => $request['livebird'],
				'totalwt' => $request['totalwt'],
				'avgwt' => $request['avgwt'],
			]);
			$successcode = 2;
			return redirect()->route('shoptogodown')->with('successcode', $successcode);
		}
	}
	//getdata
	public function getpurchaseform()
	{
		$data = DB::table('purchases')->join('vendors', 'purchases.vendor', '=', 'vendors.id')->join('grns', 'grns.id', 'purchases.grn_id')->select('purchases.*', 'vendors.name', 'grns.grnid')
			->get();
		echo json_encode($data);
	}
	public function getgrn()
	{
		$data = DB::table('grns')->join('vendors', 'grns.vendor', '=', 'vendors.id')->join('godawns', 'grns.godawn', '=', 'godawns.id')->select('grns.*', 'vendors.name', 'grns.id as grnuniid', 'godawns.godawnname')
			->get()->GroupBy('grnrefid');
		echo json_encode($data);
	}
	public function get_grn_id()
	{
		return response()->json(DB::table('grns')->select('id', 'grnid')->orderby('id', 'desc')->get());
	}
	public function getgrnrow(Request $request)
	{
		$data = DB::table('grnrows')->join('items', 'grnrows.item', '=', 'items.id')->join('grns', 'grnrows.grnrefid2', '=', 'grns.grnrefid')->where('grnrefid2', $request->grnrefid)->select('grnrows.*', 'items.itemname', 'grns.grnid')
			->get();
		echo json_encode($data);
	}
	public function get_grn_data_by_id(Request $request)
	{
		return response()->json(DB::table('grns')->join('vendors', 'grns.vendor', '=', 'vendors.id')->join('godawns', 'grns.godawn', '=', 'godawns.id')->select('grns.*', 'vendors.name', 'grns.id as grnuniid', 'godawns.godawnname')->where('grns.id', $request->id)->first());
	}

	public function getdailysuper()
	{
		$userdata = Session::get('userdata');
		if ($userdata->role == 1) {
			$data = Dailysuper::orderBy('id', 'desc')->get();
			return response()->json($data);
		} else {
			$data = Dailysuper::orderBy('id', 'desc')->where('user_id', $userdata->id)->get();
			return response()->json($data);
		}
	}
	public function getdistribute()
	{
		$userdata = Session::get('userdata');
		if ($userdata->role == 1) {
			$data = DB::table('distributes')->join('shops', 'distributes.shopcutunit', '=', 'shops.id')
			->select('distributes.*', 'shops.shopname')
			->get();
			return response()->json($data);
		} else {
			$data = DB::table('distributes')->join('shops', 'distributes.shopcutunit', '=', 'shops.id')
			->select('distributes.*', 'shops.shopname')->where('user_id', $userdata->id)
			->get();
			return response()->json($data);
		}
	}
	public function getdailyentry()
	{
		$userdata = Session::get('userdata');
		if ($userdata->role == 1) {

			$data = DB::table('dailyentries')
			->leftjoin('usermanages', 'usermanages.id', '=', 'dailyentries.user_id')
			->leftjoin('shops', 'shops.userid', '=', 'usermanages.id')
			->select('dailyentries.*', 'shops.shopname')
			->orderBy('dailyentries.id', 'desc')
			->get();
			echo json_encode($data);
		} else {
			$data = DB::table('dailyentries')
			->leftjoin('usermanages', 'usermanages.id', '=', 'dailyentries.user_id')
			->leftjoin('shops', 'shops.userid', '=', 'usermanages.id')
			->select('dailyentries.*', 'shops.shopname')
			->where('dailyentries.user_id', $userdata->id)
			->orderBy('dailyentries.id', 'desc')
			->get();
			echo json_encode($data);
		}
	}
	public function getgodowntogodown()
	{
		$data = DB::table('gtogs')->join('godawns as g1', 'gtogs.targetgod', '=', 'g1.id')->join('godawns as g2', 'gtogs.sourcegod', '=', 'g2.id')->select('gtogs.*', 'g1.godawnname as targetgodname', 'g2.godawnname as sourcegodname')->get();
		echo json_encode($data);
	}
	public function getshoptoshop()
	{
		$data = DB::table('stos')->join('shops as s1', 'stos.sourceshop', '=', 's1.id')->join('shops as s2', 'stos.targetshop', '=', 's2.id')->select('stos.*', 's1.shopname as sourceshopname', 's2.shopname as targetshopname')->get();
		echo json_encode($data);
	}
	public function getshoptogodown()
	{
		$data = DB::table('stogs')->join('godawns as g1', 'stogs.targetgod', '=', 'g1.id')->join('shops as s2', 'stogs.sourceshop', '=', 's2.id')->select('stogs.*', 'g1.godawnname', 's2.shopname')->get();
		echo json_encode($data);
	}
	public function getvendornameid()
	{
		$data = Vendor::select('id', 'name')->orderBy('id', 'desc')->get();
		echo json_encode($data);
	}
	public function getgodawnnameid()
	{
		$data = Godawn::select('id', 'godawnname')->orderBy('id', 'desc')->get();
		echo json_encode($data);
	}
	public function getitemnameid()
	{
		$data = Item::select('id', 'itemname')->orderBy('id', 'desc')->get();
		echo json_encode($data);
	}
	public function getshopnameid()
	{
		$data = Shop::select('id', 'shopname')->orderBy('id', 'desc')->get();
		echo json_encode($data);
	}

	//deletedata
	public function deletetpurchaseform(Request $request)
	{
		$data = Purchase::where('id', $request->id)->delete();
		echo json_encode($data);
	}
	public function deletegrn(Request $request)
	{
		$data1 = Grn::where('id', $request->id)->first();
		$data = Grn::where('id', $request->id)->delete();
		$data = Grnrow::where('grnrefid2', $data1['grnrefid'])->delete();
		echo json_encode($data);
	}
	public function deletedailysuper(Request $request)
	{
		$data = Dailysuper::where('id', $request->id)->delete();
		echo json_encode($data);
	}
	public function deletedistribute(Request $request)
	{
		$data = Distribute::where('id', $request->id)->delete();
		echo json_encode($data);
	}
	public function deletedailyentry(Request $request)
	{
		$data = Dailyentry::where('id', $request->id)->delete();
		echo json_encode($data);
	}
	public function deletegodowntogodown(Request $request)
	{
		$data = Gtog::where('id', $request->id)->delete();
		echo json_encode($data);
	}
	public function deleteshoptoshop(Request $request)
	{
		$data = Stos::where('id', $request->id)->delete();
		echo json_encode($data);
	}
	public function deleteshoptogodown(Request $request)
	{
		$data = Stog::where('id', $request->id)->delete();
		echo json_encode($data);
	}
	public function editgrn(Request $request)
	{
		$data = Grn::where('id', $request->id)->first();
		echo json_encode($data);
	}
	public function editpurchaseform(Request $request)
	{
		$data = Purchase::where('id', $request->id)->first();
		echo json_encode($data);
	}
	public function editdailysuper(Request $request)
	{
		$data = Dailysuper::where('id', $request->id)->first();
		echo json_encode($data);
	}
	public function editdistribute(Request $request)
	{
		$data = Distribute::where('id', $request->id)->first();
		echo json_encode($data);
	}
	public function editdailyentry(Request $request)
	{
		$data = Dailyentry::where('id', $request->id)->first();
		echo json_encode($data);
	}
	public function editgtog(Request $request)
	{
		$data = Gtog::where('id', $request->id)->first();
		echo json_encode($data);
	}
	public function editstos(Request $request)
	{
		$data = Stos::where('id', $request->id)->first();
		echo json_encode($data);
	}
	public function editstog(Request $request)
	{
		$data = Stog::where('id', $request->id)->first();
		echo json_encode($data);
	}

	//---------------------
	public function getgrnrefid()
	{
	}
	public function addmorerow(Request $request)
	{
		if ($request->grnrefid == '') {
			$getsingle = Grnrow::select('grnrefid2')->orderBy('id', 'desc')->first();
			if ($getsingle != '') {
				$grnrefid = $getsingle['grnrefid2'] + 1;
			} else {
				$grnrefid = 1;
			}
		} else {
			$grnrefid = $request->grnrefid;
		}
		$x =  Godawn::where('id',$request->godawn)->update([
			'birds_weights' => DB::raw('birds_weights + ' . $request['quantity']),
			'opening_birds' => DB::raw('opening_birds + ' . $request['noofbird']),
		]);
		$insert = Grnrow::create([
			'grnrefid2' => $grnrefid,
			'item' => $request['item'],
			'rate' => $request['rate'],
			'quantity' => $request['quantity'],
			'noofbird' => $request['noofbird'],
			'avgbodywt' => $request['avgbodywt'],
			'amount' => $request['amount'],
			'labor' => $request['labor']
		]);

		$data = DB::table('grnrows')->join('items', 'grnrows.item', '=', 'items.id')->where('grnrefid2', $insert['grnrefid2'])->select('grnrows.*', 'items.itemname')
			->get();
		return response()->json($data);
	}
	public function deletemorerow(Request $request)
	{
		$get = Grnrow::select('quantity','noofbird')->where('id', $request->id)->first();

		$x =  Godawn::where('id',$request->godawn)->update([
			'birds_weights' => DB::raw('birds_weights - ' . $get['quantity']),
			'opening_birds' => DB::raw('opening_birds - ' . $get['noofbird']),
		]);
		$delete = Grnrow::where('id', $request->id)->delete();
		$data = DB::table('grnrows')->join('items', 'grnrows.item', '=', 'items.id')->where('grnrefid2', $request->grnrefid2)->select('grnrows.*', 'items.itemname')
			->get();
		return response()->json($data);
	}

	public function get_source_godawn_nameid()
	{
		$userdata = Session::get('userdata');
		if ($userdata['role'] == 5) {
			$assign_godawnid = DB::table('assign_godawns')->select('godawns')->where('user_id', $userdata->id)->first();
			$assign_godawnid = explode(',', $assign_godawnid->godawns);

			$godawn = DB::table('godawns')->select('godawns.id', 'godawns.godawnname')->wherein('godawns.id', $assign_godawnid)->get();
			return response()->json($godawn);
		} else {
			return response()->json(Godawn::select('id', 'godawnname')->orderBy('id', 'desc')->get());
		}
	}
}
