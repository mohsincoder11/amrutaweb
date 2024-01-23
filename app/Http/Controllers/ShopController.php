<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telebookorder;
use App\Shopbookorder;
use App\Shoporderlist;
use App\Teleorderlist;
use App\Cancelorder;
use App\Deliveryboyorder;
use App\Item;
use App\Deliveryboy;
use App\Shop;
use App\Lastidtable;
use App\App_order;
use App\App_orderlist;
use App\App_cancel_order;
use App\Assign_area;
use App\StockDispose;
use Session;
use PDF, DB, Http;

class ShopController extends Controller
{

	public function generateorder()
	{
		$userdata = Session::get('userdata');
		$uniqueprefix = $userdata['uniqueprefix'];

		if ($userdata['shop'] == 1) {
			$this->data['item'] = DB::table('items')->select('id', 'itemname', 'type')->get();

			$this->data['count'] = DB::table('shopbookorders')->orderby('id', 'desc')->first();

			// $joindata=DB::table('shoporderlists')->leftjoin('shopbookorders','shopbookorders.orderid','=','shoporderlists.orderid')->where('shopbookorders.orderid','=',null)->delete();
			$data = Shopbookorder::orderBy('id', 'desc')->first();

			$count = Shopbookorder::whereRaw('MONTH(created_at) = ?', date('m'))
				->orderBy('id', 'desc')->first();

			if ($count == null) {
				$this->data['randno'] = 'AFCS' . '/' . $uniqueprefix . '-' . date('m') . '/' . date('y') . '/' . '001';
			} else {
				$oldorderno = substr($data['orderno'], 15);
				$plusno = $oldorderno + 1;
				$newno = str_pad($plusno, 3, '0', STR_PAD_LEFT);
				$this->data['randno'] = 'AFCS' . '/' . $uniqueprefix . '-' . date('m') . '/' . date('y') . '/' . $newno;
			}


			return view('Shop/generateorder', $this->data);
		} else {
			return redirect()->route('login');
		}
	}

	public function insertshoporder(Request $request)
	{
		$data = session::get('userdata');
		$x =  Shopbookorder::create([
			'masterid' => $data['id'],
			'orderdate' => date('Y-m-d'),
			'orderid' => $request['orderid'],
			'orderno' => $request['orderno'],
			'mobile' => $request['mobile'],
			'details' => $request['details'],
			'address' => $request['address'],
			'discount' => $request['discount'],
			'mop' => $request['mop'],
			'amount' => $request['amount'],
		]);
		echo json_encode(1);
	}

	public function deleteshoporder(Request $request)
	{

		$get = Shopbookorder::where('id', $request->id)->first();
		$this->data['records'] = Shopbookorder::where('id', $request->id)->delete();
		$this->data['records'] = Shoporderlist::where('orderid', $get['orderid'])->delete();
		echo json_encode($request->id);
	}

	public function shoporder(Request $request)
	{
		$date=date('Y-m-d');
if(isset($request->date) && $request->date!=null){
	$date= date('Y-m-d',strtotime($request->date));
}

		$userdata = Session::get('userdata');
		if ($userdata['shop'] == 1) {
			if ($userdata['role'] == 1 || $userdata['role'] == 3) {
				$this->data['shop'] = Shopbookorder::whereRaw('DATE(created_at) = ?',$date)
					->orderby('id', 'desc')->get();
				// echo json_encode($this->data['shop']);
				// exit();
				$this->data['orderlist'] = Shoporderlist::whereRaw('DATE(created_at) = ?',$date)
					->get();
			} else {
				$this->data['shop'] = Shopbookorder::where('masterid', $userdata['id'])->whereRaw('DATE(created_at) = ?',$date)
					->orderby('id', 'desc')->get();
				// echo json_encode($this->data['shop']);
				// exit();
				$this->data['orderlist'] = Shoporderlist::whereRaw('DATE(created_at) = ?',$date)
					->get();
			}

			return view('Shop/shoporder', $this->data);
		} else {
			return redirect()->route('login');
		}
	}

	public function lastid()
	{
		$this->data['teleorder'] = Telebookorder::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
			->where('orderfrom', 'telecaller')
			->where('view_status', '=', NULL)
			->count();

		$this->data['apporder'] = Telebookorder::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
			->where('orderfrom', 'app')
			->where('view_status', '=', NULL)
			->count();
		return $this->data;
	}


	public function shopteleorder()
	{
		$userdata = Session::get('userdata');
		$shopinfo = Session::get('shopinfo');
		Telebookorder::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
			->where('orderfrom', 'telecaller')
			->update(['view_status' => 1]);


		if ($shopinfo) {
			$otherdata = Telebookorder::where('shopname', $shopinfo['id'])
				->where('orderfrom', 'telecaller')
				->whereRaw('DATE(created_at) = ?', date('Y-m-d'))
				->orderby('id', 'desc')->get();
		} else {
			$otherdata = Telebookorder::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
				->where('orderfrom', 'telecaller')
				->orderby('id', 'desc')->get();
		}

		$currenttime = date('Y-m-d H:i:s');
		$time = array();
		$i = 0;
		foreach ($otherdata as $o) {
			$a = date('Y-m-d H:i:s', strtotime($o['created_at']));
			$diff = date_diff(date_create($currenttime), date_create($a));
			$time[$i] = $diff->format("%H") . ':' . $diff->format("%I") . ':' . $diff->format("%S");


			$i++;
		}
		$this->data['ordertime'] = $time;

		if ($userdata['shop'] == 1) {
			if ($shopinfo != null) {
				$this->data['shop'] = Telebookorder::where('orderfrom', 'telecaller')->where('shopname', $shopinfo['id'])->whereRaw('DATE(created_at) = ?', date('Y-m-d'))
					->orderby('id', 'desc')->get();
			} else {
				$this->data['shop'] = Telebookorder::where('orderfrom', 'telecaller')->whereRaw('DATE(created_at) = ?', date('Y-m-d'))
					->orderby('id', 'desc')->get();
			}
			$this->data['teleorderlist'] = Teleorderlist::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
				->get();
			// echo json_encode($this->data['shop']);
			// exit();
			return view('Shop/shopteleorder', $this->data);
		} else {
			return redirect()->route('login');
		}
	}
	public function getalldeliveryboy()
	{
		$this->data['deliveryboy'] = Deliveryboy::get();
		echo json_encode($this->data['deliveryboy']);
	}
	public function printtelepdf(Request $request)
	{
		$this->data['shoporder'] = DB::table('telebookorders')
			->leftjoin('shops', 'shops.id', '=', 'telebookorders.shopname')->where('telebookorders.orderfrom', 'telecaller')
			->where('telebookorders.id', $request->id)->select('telebookorders.*', 'shops.shopname')->first();

		$this->data['itemlist'] = Teleorderlist::where('orderid', $this->data['shoporder']->orderid)->get();
		$sdata = $this->data['shoporder'];

		return View('pdf/printbill', $this->data);
	}
	public function printshoppdf(Request $request)
	{
		$this->data['shoporder'] = DB::table('shopbookorders')
			->leftjoin('shops', 'shops.userid', '=', 'shopbookorders.masterid')
			->where('shopbookorders.id', $request->id)->select('shopbookorders.*', 'shops.shopname', 'shops.address')->first();
		$this->data['itemlist'] = Shoporderlist::where('orderid', $this->data['shoporder']->orderid)->get();
		$sdata = $this->data['shoporder'];

		return View('pdf/printshopbill', $this->data);
	}
	public function printapppdf(Request $request)
	{
		$this->data['shoporder'] = DB::table('telebookorders')
			->leftjoin('shops', 'shops.id', '=', 'telebookorders.shopname')->where('telebookorders.orderfrom', 'app')
			->where('telebookorders.id', $request->id)->select('telebookorders.*', 'shops.shopname')->first();

		$this->data['itemlist'] = Teleorderlist::where('orderid', $this->data['shoporder']->id)->where('orderfrom', 'app')->get();
		$sdata = $this->data['shoporder'];
		$this->data['credit_used']=DB::table('wallets')->where('order_id',$request->id)->select('used_credit')->first();
		return View('pdf/printappbill2', $this->data);
	}


	public function printmultitelepdf(Request $request)
	{

		$string = $request->checkboxids;

		$assign = $request->assignno;
		$y = Deliveryboy::where('id', $request->assignto)->first();

		if ($string != null && $assign == 1) {
			$new = explode(',', $string);
			//$olddata;

			$i = 0;
			$this->data['shop'] = array();
			$ordernofor=array();
			foreach ($new as $n) {
				if ($n != "") {


					$x = Telebookorder::where('orderfrom', 'telecaller')->where('id', $n)->update([
						'assignto' => $y['name'],
						'deliveryboyid' => $request['assignto'],
						'status' => '1',

					]);
					$z = Teleorderlist::where('orderfrom', 'telecaller')->where('orderid', $n)->update([
						'deliveryboyid' => $request->assignto,
					]);




					$olddata = Telebookorder::where('orderfrom', 'telecaller')->where('id', $n)->first();

					$usermobileno = Telebookorder::where('orderfrom', 'telecaller')->select('mobile')->where('id', $n)->first();
					$mode = "Download";
					$msg='Your order is out for delivery and it will be delivered to you in a while. The delivery master is '.$y['name'].' and his mobile no is '.$y['mobile'].'. Amruta Hatcheries & Foods. '.$mode.' the app now https://play.google.com/store/apps/details?id=com.ffc.www';
					$msg = urlencode($msg);
					$data1 = "uname=habitm1&pwd=habitm1&senderid=AHFPVT&to=" . $usermobileno['mobile'] . "&msg=" . $msg . "&route=T&peid=1701170071671948377&tempid=1707170080589215606";
					$ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					curl_close($ch);


					$ordernofor[$i] = Telebookorder::where('orderfrom', 'telecaller')->select('orderno')->where('id', $n)->first();

					$this->data['shop'][$i] = $olddata;
					$i++;
				}
				//echo json_encode($ordernofor).'<br>';
				$x = 0;
				$newno=[];
				foreach ($ordernofor as $o) {
					$newno[$x] = $o['orderno'];
					$x++;
				}
				$a = json_encode($newno);
				$b = str_replace("[", "", $a);
				$c = str_replace("]", "", $b);
				$d = stripslashes($c);

				// echo $d;
				// exit();
				$deliveryorder = Deliveryboyorder::create([
					'name' => $request->assignto,
					'orderno' => $d,
					'ordernostring' => $string,

				]);

				//	Session::put('pdfmobileno', $usermobileno);
				Session::put('deliveryboydata', $y);


				$date = \Carbon\Carbon::today()->subDays(2);

				$this->data['orderlist'] = Teleorderlist::orderby('id', 'desc')->where('created_at', '>=', $date)->get();
			}
			return View('pdf/printbill2', $this->data);
		} else {
			return redirect()->route('shopteleorder');
		}
	}
	public function sendmsg()
	{
		// $mobileno = Session::get('pdfmobileno');
		// $y = Session::get('deliveryboydata');
		// foreach ($mobileno as $m) {
		//   		$msg='Your order is out for delivery. The delivery master is '.$y['name'].' and his mobile no is '.$y['mobile'].'.\nAmruta Hatcheries & Foods.';
		// 	$msg=urlencode($msg);
		// 	$to=$m['mobile'];  
		// 	$data1="uname=habitm1&pwd=habitm1&senderid=AHFPVT&to=".$to."&msg=".$msg."&route=T&peid=1701170071671948377&tempid=1007949744049917032";
		// 	$ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
		// 	curl_setopt($ch, CURLOPT_POST, true);
		// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
		// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// 	$result = curl_exec($ch);
		// 	curl_close($ch);
		// }
		// echo json_encode(1);
	}




	public function updatemoney(Request $request)
	{
		$x =  Telebookorder::where('id', $request->id)->update([
			'collectedcash' => $request['collectedcash'],
			'paidstatus' => $request['paidstatus'],
			'timetaken' => $request['timetaken'],
			'status' => '3',
			'timestatus' => '1',

		]);
		return redirect()->route($request->routname);
	}

	public function deleteorderrow(Request $request)
	{
		$get_first = Shoporderlist::select('itemname', 'weight')->where('id', $request->id)->first();
		$check_type = Item::select('type')->where('itemname', $get_first['itemname'])->first();
		$delete = Shoporderlist::where('id', $request->id)->delete();
		if ($check_type['type'] == 3) {
			$shop_session = Session::get('shopinfo');
			StockDispose::orderBy('id', 'desc')
				->take(1)->where('shop_id', $shop_session->id)->update([
					'total_salable_g_k' => DB::raw('total_salable_g_k + ' . $get_first['weight']),
				]);
		}
		echo json_encode(DB::table('shoporderlists')->where('orderid', $request->orderid)->get());
	}
	public function cancelorder(Request $request)
	{

		$x =  Telebookorder::where('id', $request->cancelid)->update([
			'paidstatus' => '-1',
			'timetaken' => $request['canceltimetaken'],
			'timestatus' => '1',
			'status' => '-1',

		]);
		App_cancel_order::create([
			'app_order_id' => $request->cancelid,
			'reason' => $request->reason,
		]);
		return redirect()->route($request->routename);
	}
	public function printreceipt()
	{

		$this->data['deliveryboyorder'] = Deliveryboyorder::orderBy('id', 'desc')->whereRaw('DATE(created_at) = ?', date('Y-m-d'))->get();
		$this->data['deliveryboy'] = Deliveryboy::orderBy('id', 'desc')->get();
		return view('Shop/printreceipt', $this->data);
	}
	public function printreceiptpdf(Request $request)
	{
		$data = Deliveryboyorder::select('ordernostring')->where('id', $request->id)->first();

		$new = explode(',', $data['ordernostring']);


		$olddata;
		$i = 0;
		$this->data['shop'] = array();
		foreach ($new as $n) {
			if ($n != "") {

				$olddata = Telebookorder::where('orderfrom', 'telecaller')->where('id', $n)->first();
				$this->data['shop'][$i] = $olddata;
				$i++;
			}
		}

		$date = \Carbon\Carbon::today()->subDays(3);

		$this->data['orderlist'] = Teleorderlist::orderby('id', 'desc')->where('created_at', '>=', $date)->get();



		return view('pdf/printbill2', $this->data);
	}

	public function addshoporderrow(Request $request)
	{
		if ($request->type == 3) {
			$shop_session = Session::get('shopinfo');
			StockDispose::orderBy('id', 'desc')
				->take(1)->where('shop_id', $shop_session->id)->update([
					'total_salable_g_k' => DB::raw('total_salable_g_k - ' . $request['weight']),
				]);
		}
		if ($request->orderid == '') {
			$getsingle = Shoporderlist::select('orderid')->orderBy('id', 'desc')->first();
			if ($getsingle != '') {
				$orderid = $getsingle['orderid'] + 1;
			} else {
				$orderid = 1;
			}
		} else {
			$orderid = $request->orderid;
		}
		$userdata = Session::get('userdata');
		$insert = Shoporderlist::create([
			'itemname' => $request['itemname'],
			'weight' => $request['weight'],
			'rate' => $request['rate'],
			'masterid' => $userdata['id'],
			'orderid' => $orderid,
		]);
		echo json_encode(Shoporderlist::where('orderid', $orderid)->get());
	}

	public function distributes()
	{
		return view('Shop.distributes');
	}
	public function dailyentrys()
	{
		$shops = DB::table('shops')->select('id', 'userid', 'shopname', 'birds_weights', 'opening_birds')->get();
		return view('Shop.dailyentrys', compact('shops'));
	}

	public function get_total_weight_shop(Request $request)
	{
		$totalweight = DB::table('shoporderlists')
			->join('shopbookorders', function ($join) use ($request) {
				$join->on('shopbookorders.orderid', '=', 'shoporderlists.orderid')
					->where('shopbookorders.masterid', '=', $request->shop_id);
			})
			->whereDate('shoporderlists.created_at', '>=', date('Y-m-d', strtotime($request->date)))->whereDate('shoporderlists.created_at', '<=', date('Y-m-d', strtotime($request->date)))->select('shoporderlists.orderid', 'weight')
			->sum('weight');
		$petfood_id = Item::select('itemname')->where('type', 4)->first();
		$petfood_weight=0;
		if($petfood_id)
		{
			$petfood_weight = DB::table('shoporderlists')
			->join('shopbookorders', function ($join) use ($request) {
				$join->on('shopbookorders.orderid', '=', 'shoporderlists.orderid')
					->where('shopbookorders.masterid', '=', $request->shop_id);
			})
			->where('shoporderlists.itemname', $petfood_id['itemname'])
			->whereDate('shoporderlists.created_at', '>=', date('Y-m-d', strtotime($request->date)))->whereDate('shoporderlists.created_at', '<=', date('Y-m-d', strtotime($request->date)))->select('shoporderlists.orderid', 'weight')
			->sum('weight');
		}
		
		$shop_id = Shop::select('masterid')->where('userid', $request->shop_id)->first();
		$ck_and_gk = StockDispose::select('salable_chicken', 'salable_g_k')->where('shop_id', $shop_id->masterid)
			->WhereDate('created_at', \Carbon\Carbon::today())
			->first();
			$opening_amount=\App\Dailyentry::select('closing_amount')->where('user_id',$request->shop_id)->orderby('id','desc')->first();
			
		if ($ck_and_gk) {
			$data = [
				'weight' => $totalweight - $petfood_weight,
				'salable_chicken' => $ck_and_gk['salable_chicken'],
				'salable_kaleji' => $ck_and_gk['salable_g_k'],
				'opening_amount'=>$opening_amount ? $opening_amount['closing_amount'] : 0
			];
		} else {
			$data = [
				'weight' => $totalweight - $petfood_weight,
				'salable_chicken' => 0,
				'salable_kaleji' => 0,
				'opening_amount'=>$opening_amount ? $opening_amount['closing_amount'] : 0
			];
		}

		return response()->json($data);
	}
	public function stoss()
	{
		return view('Shop.stoss');
	}
	public function shoptogodown()
	{
		return view('Shop.stogg');
	}

	public function apporders2()
	{
		Telebookorder::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
			->where('orderfrom', 'app')
			->update(['view_status' => 1]);

		$userdata = Session::get('userdata');
		if ($userdata['role'] == 1 || $userdata['role'] == 3) {
			$this->data['apporder'] = Telebookorder::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
				->where('orderfrom', 'app')->orderby('id', 'desc')->get();
		} else {
			$shop_session = Session::get('shopinfo');
			if ($shop_session) {
				$assign_area = Assign_area::select('assign_area')->where('shop_id', $shop_session['id'])->first();
				if ($assign_area) {
					$assign_area = explode(',', $assign_area['assign_area']);
					$this->data['apporder'] = Telebookorder::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
						->whereIn('area_id', $assign_area)
						->where('orderfrom', 'app')->orderby('id', 'desc')->get();
				} else {
					$this->data['apporder'] = Telebookorder::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
						->where('area_id', 000)
						->where('orderfrom', 'app')->orderby('id', 'desc')->get();;
				}
			} else {
				$this->data['apporder'] = Telebookorder::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
					->where('area_id', 000)
					->where('orderfrom', 'app')->orderby('id', 'desc')->get();
			}
		}
		$this->data['delivery_charge'] = env('delivery_charge');
		return view('Shop.apporders', $this->data);
	}

	public function apporders(Request $request)
	{
		$date=date('Y-m-d');
if(isset($request->date) && $request->date!=null){
	$date= date('Y-m-d',strtotime($request->date));
}
		Telebookorder::whereRaw('DATE(created_at) = ?', $date)
			->where('orderfrom', 'app')
			->update(['view_status' => 1]);

		$userdata = Session::get('userdata');
		if ($userdata['role'] == 1 || $userdata['role'] == 3) {
			$this->data['apporder'] = Telebookorder::whereRaw('DATE(created_at) = ?', $date)
				->where('orderfrom', 'app')->orderby('id', 'desc')->get();
		} else {
			$shop_session = Session::get('shopinfo');
			if ($shop_session) {
				$assign_area = Assign_area::select('assign_area')->where('shop_id', $shop_session['id'])->first();
				if ($assign_area) {
					$assign_area = explode(',', $assign_area['assign_area']);
					$this->data['apporder'] = Telebookorder::whereRaw('DATE(created_at) = ?', $date)
						->where('shopname', $shop_session['id'])
						->where('orderfrom', 'app')->orderby('id', 'desc')->get();
				} else {
					$this->data['apporder'] = Telebookorder::whereRaw('DATE(created_at) = ?', $date)
						->where('area_id', 000)
						->where('orderfrom', 'app')->orderby('id', 'desc')->get();;
				}
			} else {
				$this->data['apporder'] = Telebookorder::whereRaw('DATE(created_at) = ?', $date)
					->where('area_id', 000)
					->where('orderfrom', 'app')->orderby('id', 'desc')->get();
			}
		}
		$this->data['delivery_charge'] = env('delivery_charge');
		return view('Shop.apporders', $this->data);
	}


	public function cancel_app_order(Request $request)
	{
		Telebookorder::where('id', $request->cancelid)->update([
			'status' => '-1'
		]);
		App_cancel_order::create([
			'app_order_id' => $request->cancelid,
			'reason' => $request->reason,
		]);
		return redirect()->route('apporders');
	}

	public function printmultiapppdf(Request $request)
	{

		$string = $request->checkboxids;
		$assign = $request->assignno;
		$y = Deliveryboy::find($request->assignto);
		$date = \Carbon\Carbon::today()->subDays(2);

		if ($string != null && $assign == 1) {

			$new = explode(',', $string);

			$this->data['app_order'] = Telebookorder::whereIn('id', $new)->orderby('id', 'desc')
				->where('orderfrom', 'app')
				->get();

			foreach ($this->data['app_order'] as $n) {
				if ($n != "") {


					$x = Telebookorder::where('id', $n['id'])->update([
						'assignto' => $y['name'],
						'deliveryboyid' => $request['assignto'],
						'status' => '1',
					]);
					$mode = "Rate";
					$msg = 'Your order is out for delivery and it will be delivered to you in a while. The delivery master is '.$y['name'].' and his mobile no is '.$y['mobile'].'. Amruta Hatcheries & Foods. '.$mode.' the app now https://play.google.com/store/apps/details?id=com.ffc.www';
					$msg = urlencode($msg);
					$to = $n['mobile'];
					$data1 = "uname=habitm1&pwd=habitm1&senderid=AHFPVT&to=" . $n['mobile'] . "&msg=" . $msg . "&route=T&peid=1701170071671948377&tempid=1707170080589215606";

					$ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					curl_close($ch);
				}
			}


			$this->data['app_ordelist'] = Teleorderlist::whereIn('orderid', $new)->orderby('id', 'desc')
				->where('orderfrom', 'app')->get();


			return View('pdf/printappbill', $this->data);
		} else {
			return redirect()->route('apporders');
		}
	}
	//-----------------------------

	public function stock_and_dispose(Request $request)
	{
		$shop_info = Session::get('shopinfo');
		if ($shop_info) {
			$this->data['role'] = 'shop';
			$this->data['shop_id'] = $shop_info->id;
		} else {
			$this->data['role'] = 'admin';
			$this->data['shop_id'] = null;
		}
		$this->data['shops'] = DB::table('shops')->select('id', 'shopname')->get();

		if ($request->ajax()) {
			$data = DB::table('stock_disposes')->join('shops', 'shops.id', '=', 'stock_disposes.shop_id')->select('stock_disposes.*', 'shops.shopname')->orderby('stock_disposes.id')->get();
			return response()->json($data);
		}

		return view('Shop.stock_and_dispose', $this->data);
	}
	public function insert_s_d_entry(Request $request)
	{
		if($request->shop_id){

		$last_record = ['total_salable_chicken' => 0, 'total_salable_g_k' => 0];
		$last_record = StockDispose::select('total_salable_chicken', 'total_salable_g_k')
			->where('shop_id', $request->shop_id)->orderby('id', 'desc')->first();
		if (!$last_record) {
			$last_record = [
				'total_salable_chicken' => 0,
				'total_salable_g_k' => 0
			];
		}

		StockDispose::create([
			'shop_id' => $request->shop_id,
			'date' => $request->date,
			'time' => $request->time,
			'salable_chicken' => $request->salable_chicken,
			'salable_g_k' => $request->salable_g_k,
			'dispose_chicken' => $request->dispose_chicken,
			'dispose_g_k' => $request->dispose_g_k,
			'total_salable_chicken' => $last_record['total_salable_chicken'] + $request->salable_chicken - $request->dispose_chicken,
			'total_salable_g_k' => $last_record['total_salable_g_k'] + $request->salable_g_k - $request->dispose_g_k,
		]);		
		return redirect()->route('stock_and_dispose')->with('successcode', 1);
	}else{
		return redirect()->back()->with('successcode', 0);

	}

	}
}
