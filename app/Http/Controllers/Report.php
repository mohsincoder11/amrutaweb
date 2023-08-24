<?php

namespace App\Http\Controllers;

use App\App_cancel_order;
use Illuminate\Http\Request;
use App\Telebookorder;
use App\Shopbookorder;
use App\Shoporderlist;
use App\Teleorderlist;
use App\Usermanage;
use App\Shop;
use App\Item;
use App\Deliveryboy;
use App\Cancelorder;
use DB, PDF, Session;
use Carbon\Carbon;

ini_set('max_execution_time', 600);

class Report extends Controller
{
	//-------------all order 

	public function allorderreport()
	{
		$this->data['teleorder'] = null;
		$this->data['teleorderlist'] = null;
		$this->data['shoporder'] = null;
		$this->data['shoporderlist'] = null;
		$this->data['allordercount'] = 0;
		$this->data['totalweight'] = 0;

		return view('reports/allorderreport', $this->data);
	}
	public function allorderreports(Request $request)
	{
		$fromdate = date('Y-m-d', strtotime($request->fromdate));
		$todate = date('Y-m-d', strtotime($request->todate));
		$fromdatepage = $request->fromdate;
		$todatepage = $request->todate;
		$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

		$this->data['fromdatepage'] = $fromdatepage;
		$this->data['todatepage'] = $todatepage;

		$this->data['teleorder'] = DB::table('telebookorders')
		->select('telebookorders.orderno', 'telebookorders.custname', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount')
		->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ',  ') as items")
		->selectRaw("GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg,') as weights")
		->selectRaw('SUM(amount) AS totalAmount')

		->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
		->where('telebookorders.created_at', '>=', $fromdate)
		->where('telebookorders.created_at', '<=', $newtodate)
		->where('telebookorders.orderfrom', 'telecaller')
		->where('telebookorders.status', '!=', '-1')
		->groupBy('telebookorders.id')
		->get();

	
		$this->data['apporder'] = Telebookorder::with(['teleorderlists' => function ($query) {
			$query->select('orderid', 'itemname', 'weight')
				->selectRaw("GROUP_CONCAT(itemname SEPARATOR ', ') as items")
				->selectRaw("GROUP_CONCAT(weight SEPARATOR ' KG, ') as weights")
				->groupBy('orderid');
		}])
			->where('created_at', '>=', $fromdate)
			->where('created_at', '<=', $newtodate)
			->where('orderfrom', 'app')
			->where('status', '3')
			->orderByDesc('id')
			->select('orderno', 'id', 'custname', 'created_at', 'amount')
			->get();


		$this->data['shoporder'] = Shopbookorder::with(['shopOrderLists' => function ($query) {
			$query->select('orderid', 'itemname', 'weight')
				->selectRaw("GROUP_CONCAT(itemname SEPARATOR ', ') as items")
				->selectRaw("GROUP_CONCAT(weight SEPARATOR ' KG, ') as weights")
				->groupBy('orderid');
		}])
			->leftJoin('shops', 'shops.userid', '=', 'shopbookorders.masterid')
			->where('shopbookorders.created_at', '>=', $fromdate)
			->where('shopbookorders.created_at', '<=', $newtodate)
			->orderByDesc('shopbookorders.id')
			->select('shops.shopname', 'orderid', 'orderno', 'shopbookorders.id', 'shopbookorders.created_at', 'amount')
			->get();

			$this->data['totalAmount']=$this->data['apporder']->sum('amount')+$this->data['teleorder']->sum('amount')+$this->data['shoporder']->sum('amount');

	$this->data['teleorderweight'] = DB::table('teleorderlists')
		->join('telebookorders', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
		->whereDate('teleorderlists.created_at', '>=', $fromdate)
		->whereDate('teleorderlists.created_at', '<=', $todate)
		->where('teleorderlists.orderfrom', 'telecaller')
		->sum('teleorderlists.weight');

		$this->data['apporderweight'] = DB::table('teleorderlists')
		->join('telebookorders', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
		->whereDate('teleorderlists.created_at', '>=', $fromdate)
		->whereDate('teleorderlists.created_at', '<=', $todate)
		->where('teleorderlists.orderfrom', 'app')
		->where('teleorderlists.orderid', '>', '0')
		->sum('weight');


		$this->data['totalshopweight'] = DB::table('shoporderlists')
		->join('shopbookorders', function ($join) use ($request) {
			$join->on('shopbookorders.orderid', '=', 'shoporderlists.orderid');
			$join->whereDate('shoporderlists.created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))
				->whereDate('shoporderlists.created_at', '<=', date('Y-m-d', strtotime($request->todate)));
		})
		->select('shoporderlists.orderid', 'weight')
		->sum('weight');


		$this->data['totalweight'] = $this->data['teleorderweight'] + $this->data['totalshopweight'] + $this->data['apporderweight'];
		$this->data['allordercount'] = count($this->data['teleorder']) + count($this->data['shoporder']) + count($this->data['apporder']);




		return view('reports.allorderreport', $this->data);
	}
	public function printallorder(Request $request)
	{
		if ($request->allordercount > 0) {


			$fromdate = date('Y-m-d', strtotime($request->printfromdate));
			$todate = date('Y-m-d', strtotime($request->printtodate));
			$this->data['fromdate'] = $request->printfromdate;
			$this->data['todate'] = $request->printtodate;

			$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

			$this->data['teleorder'] = DB::table('telebookorders')
		->select('telebookorders.orderno', 'telebookorders.custname', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount')
		->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ',  ') as items")
		->selectRaw("GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg,') as weights")
		->selectRaw('SUM(amount) AS totalAmount')

		->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
		->where('telebookorders.created_at', '>=', $fromdate)
		->where('telebookorders.created_at', '<=', $newtodate)
		->where('telebookorders.orderfrom', 'telecaller')
		->where('telebookorders.status', '!=', '-1')
		->groupBy('telebookorders.id')
		->get();

	
		$this->data['apporder'] = Telebookorder::with(['teleorderlists' => function ($query) {
			$query->select('orderid', 'itemname', 'weight')
				->selectRaw("GROUP_CONCAT(itemname SEPARATOR ', ') as items")
				->selectRaw("GROUP_CONCAT(weight SEPARATOR ' KG, ') as weights")
				->groupBy('orderid');
		}])
			->where('created_at', '>=', $fromdate)
			->where('created_at', '<=', $newtodate)
			->where('orderfrom', 'app')
			->where('status', '3')
			->orderByDesc('id')
			->select('orderno', 'id', 'custname', 'created_at', 'amount')
			->get();


		$this->data['shoporder'] = Shopbookorder::with(['shopOrderLists' => function ($query) {
			$query->select('orderid', 'itemname', 'weight')
				->selectRaw("GROUP_CONCAT(itemname SEPARATOR ', ') as items")
				->selectRaw("GROUP_CONCAT(weight SEPARATOR ' KG, ') as weights")
				->groupBy('orderid');
		}])
			->leftJoin('shops', 'shops.userid', '=', 'shopbookorders.masterid')
			->where('shopbookorders.created_at', '>=', $fromdate)
			->where('shopbookorders.created_at', '<=', $newtodate)
			->orderByDesc('shopbookorders.id')
			->select('shops.shopname', 'orderid', 'orderno', 'shopbookorders.id', 'shopbookorders.created_at', 'amount')
			->get();
			$this->data['totalAmount'] = $request->totalAmount;
			$this->data['allordercount'] = $request->allordercount;
			$this->data['totalweight'] = $request->totalweight;
			return view('pdf.report.allorderreport', $this->data);
		} else {
			return redirect()->route('allorderreport');
		}
	}
	//-------------all order end
	//-------------teleorder
	public function telecallerorderreport()
	{
		$this->data['teleorder'] = null;
		$this->data['teleorderlist'] = null;
		$this->data['telecallerid'] = null;
		$this->data['shopname'] = null;
		$this->data['telecallername'] = null;
		$this->data['shopnametitle'] = null;
		
		$this->data['teleordercount'] = 0;
		$this->data['teleorderweight'] = 0;

		$this->data['telecaller'] = Usermanage::where('role', '3')->get();
		$this->data['shops'] = Shop::get();

		return view('reports.teleorderreport', $this->data);
	}

	public function telecallerorderreports(Request $request)
	{

		$fromdate = date('Y-m-d', strtotime($request->fromdate));
		$todate = date('Y-m-d', strtotime($request->todate));
		$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

		$fromdatepage = $request->fromdate;
		$todatepage = $request->todate;
		$this->data['telecaller'] = Usermanage::where('role', '3')->get();
		$this->data['shops'] = Shop::get();


		$this->data['fromdatepage'] = $fromdatepage;
		$this->data['todatepage'] = $todatepage;
		$this->data['telecallerid'] = $request->telecallerid;
		$this->data['shopname'] = $request->shopname;
		$shopname=$request->shopname;
		$this->data['shopnametitle']='All';
		if($request->shopname!='all'){
				$name2 = Shop::where('id', $request->shopname)->first();
		$this->data['shopnametitle'] = $name2['shopname'];
		}
	

		if ($request->telecallerid == 'all') {

			// $this->data['teleorder'] = DB::select("select telebookorders.orderno,telebookorders.custname,telebookorders.id,telebookorders.created_at,telebookorders.amount,GROUP_CONCAT(teleorderlists.itemname SEPARATOR',  ') as items,GROUP_CONCAT(teleorderlists.weight SEPARATOR' Kg,') as weights from telebookorders  left join teleorderlists on teleorderlists.orderid=telebookorders.orderid where telebookorders.created_at>='$fromdate' AND telebookorders.status!='-1' AND telebookorders.orderfrom='telecaller' AND telebookorders.created_at <= '$newtodate' group by telebookorders.id ");

			$this->data['teleorder'] = DB::table('telebookorders')
				->select('telebookorders.orderno', 'telebookorders.custname', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount','shops.shopname')
				->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ',  ') as items")
				->selectRaw("GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg,') as weights")
				->selectRaw('SUM(amount) AS totalAmount')

				->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
				->leftJoin('shops', 'shops.id', '=', 'telebookorders.shopname')
				->where('telebookorders.created_at', '>=', $fromdate)
				->where('telebookorders.created_at', '<=', $newtodate)
				->where('telebookorders.orderfrom', 'telecaller')
				->where('telebookorders.status', '!=', '-1')
				->when($shopname && $shopname!='all',function($q) use($shopname){
					$q->where('telebookorders.shopname',$shopname);
				})
				->groupBy('telebookorders.id')
				->get();



			$this->data['telecallername'] = "All";
			$this->data['teleorderweight'] = DB::table('teleorderlists')->join('telebookorders', 'telebookorders.orderid', '=', 'teleorderlists.orderid')
			->where('teleorderlists.orderfrom', 'telecaller')
			->whereDate('teleorderlists.created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))
			->whereDate('teleorderlists.created_at', '<=', date('Y-m-d', strtotime($request->todate)))
			->when($shopname && $shopname!='all',function($q) use($shopname){
				$q->where('telebookorders.shopname',$shopname);
			})
			->sum('teleorderlists.weight');
		} else {
			$name = Usermanage::where('id', $request->telecallerid)->first();
			$this->data['telecallername'] = $name['username'];

			$this->data['teleorder'] = DB::table('telebookorders')
				->select('telebookorders.orderno', 'telebookorders.custname', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount','shops.shopname')
				->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ',  ') as items")
				->selectRaw("GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg,') as weights")
				->selectRaw('SUM(amount) AS totalAmount')

				->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
				->leftJoin('shops', 'shops.id', '=', 'telebookorders.shopname')

				->where('telebookorders.created_at', '>=', $fromdate)
				->where('telebookorders.created_at', '<=', $newtodate)
				->where('telebookorders.orderfrom', 'telecaller')
				->where('telebookorders.masterid', $request->telecallerid)
				->where('telebookorders.status', '!=', '-1')
				->when($shopname && $shopname!='all',function($q) use($shopname){
					$q->where('telebookorders.shopname',$shopname);
				})
				->groupBy('telebookorders.id')
				->get();

		

			$this->data['teleorderweight'] = DB::table('teleorderlists')
			->join('telebookorders', 'telebookorders.orderid', '=', 'teleorderlists.orderid')
			->where('teleorderlists.masterid', $request->telecallerid)->where('teleorderlists.orderfrom', 'telecaller')->whereDate('teleorderlists.created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))
			->whereDate('teleorderlists.created_at', '<=', date('Y-m-d', strtotime($request->todate)))
			->when($shopname && $shopname!='all',function($q) use($shopname){
				$q->where('telebookorders.shopname',$shopname);
			})
			->sum('teleorderlists.weight');
		}

		
		$this->data['totalAmount'] =$this->data['teleorder']->sum('amount');

		$this->data['teleordercount'] = count($this->data['teleorder']);
		return view('reports.teleorderreport', $this->data);
	}

	public function printtelecallerorder(Request $request)
	{
		if ($request->teleordercount > 0) {


			$fromdate = date('Y-m-d', strtotime($request->printfromdate));
			$todate = date('Y-m-d', strtotime($request->printtodate));
			$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

			$this->data['fromdate'] = $request->printfromdate;
			$this->data['todate'] = $request->printtodate;
			$this->data['totalAmount'] = $request->totalAmount;
			$this->data['shopnametitle']='All';
			if($request->shopname!='all'){
					$name2 = Shop::where('id', $request->shopname)->first();
			$this->data['shopnametitle'] = $name2['shopname'];
			}
		$shopname=$request->shopname;

			if ($request->telecallerid == 'all') {
				$this->data['teleorder'] = DB::table('telebookorders')
					->select('telebookorders.orderno', 'telebookorders.custname', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount','shops.shopname')
					->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ',  ') as items")
					->selectRaw("GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg,') as weights")
					->selectRaw('SUM(amount) AS totalAmount')

					->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
					->leftJoin('shops', 'shops.id', '=', 'telebookorders.shopname')
					->where('telebookorders.created_at', '<=', $newtodate)
					->where('telebookorders.orderfrom', 'telecaller')
					->where('telebookorders.status', '!=', '-1')
					->when($shopname && $shopname!='all',function($q) use($shopname){
					$q->where('telebookorders.shopname',$shopname);
				})
				->groupBy('telebookorders.id')
					->get();
				$this->data['telecallername'] = 'All';
			} else {
				$this->data['teleorder'] = DB::table('telebookorders')
					->select('telebookorders.orderno', 'telebookorders.custname', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount','shops.shopname')
					->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ',  ') as items")
					->selectRaw("GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg,') as weights")
					->selectRaw('SUM(amount) AS totalAmount')

					->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
					->leftJoin('shops', 'shops.id', '=', 'telebookorders.shopname')

					->where('telebookorders.created_at', '>=', $fromdate)
					->where('telebookorders.created_at', '<=', $newtodate)
					->where('telebookorders.orderfrom', 'telecaller')
					->where('telebookorders.masterid', $request->telecallerid)
					->where('telebookorders.status', '!=', '-1')
					->when($shopname && $shopname!='all',function($q) use($shopname){
						$q->where('telebookorders.shopname',$shopname);
					})
					->groupBy('telebookorders.id')
					->get();
				$name = Usermanage::where('id', $request->telecallerid)->first();

				$this->data['telecallername'] = $name['username'] ?? '';
			}


			$this->data['teleorderweight'] = $request->teleorderweight;
			$this->data['totalteleorder'] = $request->teleordercount;
			return view('pdf.report.telecallerorderreport', $this->data);
		} else {
			return redirect()->route('telecallerorderreport');
		}
	}


	//----------telecaller end
	//Apporder
	public function apporderreport()
	{
		$fromdate = Carbon::today();
		$newtodate = Carbon::now()->format('Y-m-d') . ' 23:59:59';
		$this->data['fromdatepage'] = $fromdate;
		$this->data['todatepage'] = $newtodate;
		$this->data['apporder'] = [];
		$this->data['apporderweight'] = 0;
		$this->data['appordercount'] = 0;
		return view('reports/apporderreport', $this->data);
	}

	public function apporderreports(Request $request)
	{
		$fromdate = date('Y-m-d', strtotime($request->fromdate)) . ' 00:00:00';
		$newtodate = date('Y-m-d', strtotime($request->todate)) . ' 23:59:59';
		$this->data['fromdatepage'] = $fromdate;
		$this->data['todatepage'] = $newtodate;

		// $this->data['apporder'] = DB::select("select telebookorders.orderno,telebookorders.id,telebookorders.custname,telebookorders.created_at,telebookorders.amount,GROUP_CONCAT(teleorderlists.itemname SEPARATOR',  ') as items,GROUP_CONCAT(teleorderlists.weight SEPARATOR' Kg,  ') as weights from telebookorders  left join teleorderlists on teleorderlists.orderid=telebookorders.id where telebookorders.created_at >= '$fromdate' AND telebookorders.created_at <= '$newtodate' AND telebookorders.orderfrom='app' group by telebookorders.id order by telebookorders.id desc");

		$this->data['apporder'] = Telebookorder::with(['teleorderlists' => function ($query) {
			$query->select('orderid', 'itemname', 'weight')
				->selectRaw("GROUP_CONCAT(itemname SEPARATOR ', ') as items")
				->selectRaw("GROUP_CONCAT(weight SEPARATOR ' KG, ') as weights")
				->groupBy('orderid');
		}])
			->where('created_at', '>=', $fromdate)
			->where('created_at', '<=', $newtodate)
			->where('orderfrom', 'app')
			->where('status', '3')
			->orderByDesc('id')
			->select('orderno', 'id', 'custname', 'created_at', 'amount')
			->get();

		$this->data['totalAmount'] = Telebookorder::with(['teleorderlists' => function ($query) {
			$query->select('orderid', 'itemname', 'weight')
				->groupBy('orderid');
		}])
			->where('created_at', '>=', $fromdate)
			->where('created_at', '<=', $newtodate)
			->where('orderfrom', 'app')
			->where('status', '3')

			->sum('amount');

		// echo json_encode($this->data['apporder']);
		// exit();


		$this->data['apporderweight'] = DB::table('teleorderlists')->leftjoin('telebookorders', 'telebookorders.id', '=', 'teleorderlists.orderid')->where('teleorderlists.orderfrom', 'app')->whereDate('teleorderlists.created_at', '>=', $fromdate)->whereDate('teleorderlists.created_at', '<=', $newtodate)->where('teleorderlists.orderid', '!=', '0')->sum('teleorderlists.weight');
		$this->data['appordercount'] = count($this->data['apporder']);
		return view('reports.apporderreport', $this->data);
	}

	public function printapporderreports(Request $request)
	{
		if ($request->appordercount > 0) {


			$fromdate = date('Y-m-d', strtotime($request->fromdate)) . ' 00:00:00';
			$newtodate = date('Y-m-d', strtotime($request->todate)) . ' 23:59:59';
			$this->data['fromdate'] = $fromdate;
			$this->data['todate'] = $newtodate;
			$this->data['apporder'] = Telebookorder::with(['teleorderlists' => function ($query) {
				$query->select('orderid', 'itemname', 'weight')
					->selectRaw("GROUP_CONCAT(itemname SEPARATOR ', ') as items")
					->selectRaw("GROUP_CONCAT(weight SEPARATOR ' KG, ') as weights")
					->groupBy('orderid');
			}])
				->where('created_at', '>=', $fromdate)
				->where('created_at', '<=', $newtodate)
				->where('orderfrom', 'app')
				->where('status', '3')
				->orderByDesc('id')
				->select('orderno', 'id', 'custname', 'created_at', 'amount')
				->get();
			$this->data['apporderweight'] = $request->apporderweight;
			$this->data['appordercount'] = $request->appordercount;
			$this->data['totalAmount'] = $request->totalAmount;

			return view('pdf/report/apporder', $this->data);
		} else
			return redirect()->route('apporderreport');
	}

	//End
	//----------shop

	public function shoporderreport()
	{

		$this->data['shoporder'] = null;
		$this->data['shoporderlist'] = null;
		$this->data['shopid'] = null;
		$this->data['shopname'] = null;
		$this->data['shop'] = Shop::get();
		$this->data['shopordercount'] = 0;
		$this->data['totalweight'] = 0;


		return view('reports.shoporderreport', $this->data);
	}

	public function shoporderreports(Request $request)
	{
		$fromdate = date('Y-m-d', strtotime($request->fromdate));
		$todate = date('Y-m-d', strtotime($request->todate));
		$this->data['shop'] = Shop::get();
		$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));
		$fromdatepage = $request->fromdate;
		$todatepage = $request->todate;

		$this->data['fromdatepage'] = $fromdatepage;
		$this->data['todatepage'] = $todatepage;
		$this->data['shopid'] = $request->shopid;
		$this->data['totalweight'] = 0;

		if ($request->shopid == 'all') {
			$this->data['shopname'] = ['shopname' => 'All'];
			//return $this->data['shopname']['shopname'];
			$this->data['shoporder'] = Shopbookorder::with(['shopOrderLists' => function ($query) {
				$query->select('orderid', 'itemname', 'weight')
					->selectRaw("GROUP_CONCAT(itemname SEPARATOR ', ') as items")
					->selectRaw("GROUP_CONCAT(weight SEPARATOR ' KG, ') as weights")
					->groupBy('orderid');
			}])
				->leftJoin('shops', 'shops.userid', '=', 'shopbookorders.masterid')
				->where('shopbookorders.created_at', '>=', $fromdate)
				->where('shopbookorders.created_at', '<=', $newtodate)
				->orderByDesc('shopbookorders.id')
				->select('shops.shopname', 'orderid', 'orderno', 'shopbookorders.id', 'shopbookorders.created_at', 'amount')
				->get();

			$this->data['totalweight'] = DB::table('shoporderlists')
				->join('shopbookorders', function ($join) use ($request) {
					$join->on('shopbookorders.orderid', '=', 'shoporderlists.orderid');
					$join->whereDate('shoporderlists.created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))
						->whereDate('shoporderlists.created_at', '<=', date('Y-m-d', strtotime($request->todate)));
				})
				->select('shoporderlists.orderid', 'weight')
				->sum('weight');
		
		} else {
			$this->data['shopname'] = Shop::select('shopname')->where('id', $request->shopid)->first();


			$masterid = Shop::where('id', $request->shopid)->first();
			$newid = $masterid['userid'];
			$this->data['totalweight'] = DB::table('shoporderlists')
				->join('shopbookorders', function ($join) use ($request, $newid) {
					$join->on('shopbookorders.orderid', '=', 'shoporderlists.orderid');
					$join->whereDate('shoporderlists.created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))
						->whereDate('shoporderlists.created_at', '<=', date('Y-m-d', strtotime($request->todate)))
						->where('shopbookorders.masterid', '=', $newid);
				})
				->select('shoporderlists.orderid', 'weight')
				->sum('weight');


			$this->data['shoporder'] = Shopbookorder::with(['shopOrderLists' => function ($query) {
				$query->select('orderid', 'itemname', 'weight')
					->selectRaw("GROUP_CONCAT(itemname SEPARATOR ', ') as items")
					->selectRaw("GROUP_CONCAT(weight SEPARATOR ' KG, ') as weights")
					->groupBy('orderid');
			}])
				->leftJoin('shops', 'shops.userid', '=', 'shopbookorders.masterid')
				->where('shopbookorders.masterid', $newid)
				->where('shopbookorders.created_at', '>=', $fromdate)
				->where('shopbookorders.created_at', '<=', $newtodate)
				->orderByDesc('shopbookorders.id')
				->select('shops.shopname', 'orderid', 'orderno', 'shopbookorders.id', 'shopbookorders.created_at', 'amount')
				->get();

		}
		$this->data['totalAmount'] = $this->data['shoporder']->sum('amount');

		$this->data['shopordercount'] = count($this->data['shoporder']);
		return view('reports.shoporderreport', $this->data);
	}
	public function printshoporder(Request $request)
	{
		if ($request->shopordercount > 0) {

			$fromdate = date('Y-m-d', strtotime($request->printfromdate));
			$todate = date('Y-m-d', strtotime($request->printtodate));
			$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

			$this->data['fromdate'] = $request->printfromdate;
			$this->data['todate'] = $request->printtodate;
			$this->data['shopid'] = $request->shopid;
			$this->data['totalAmount'] = $request->totalAmount;


			if ($request->shopid == 'all') {
				$this->data['shopname'] = 'All';

				$this->data['shoporder'] = Shopbookorder::with(['shopOrderLists' => function ($query) {
					$query->select('orderid', 'itemname', 'weight')
						->selectRaw("GROUP_CONCAT(itemname SEPARATOR ', ') as items")
						->selectRaw("GROUP_CONCAT(weight SEPARATOR ' KG, ') as weights")
						->groupBy('orderid');
				}])
					->leftJoin('shops', 'shops.userid', '=', 'shopbookorders.masterid')
					->where('shopbookorders.created_at', '>=', $fromdate)
					->where('shopbookorders.created_at', '<=', $newtodate)
					->orderByDesc('shopbookorders.id')
					->select('shops.shopname', 'orderid', 'orderno', 'shopbookorders.id', 'shopbookorders.created_at', 'amount')
					->get();

				$this->data['totalAmount'] = DB::table('shopbookorders')

					->whereBetween('created_at', [$fromdate, $newtodate])
					->sum('amount');
			} else {


				$masterid = Shop::where('id', $request->shopid)->first();
				$newid = $masterid['userid'];
				$this->data['shopname'] = $request->shopname;

				$this->data['shoporder'] = Shopbookorder::with(['shopOrderLists' => function ($query) {
					$query->select('orderid', 'itemname', 'weight')
						->selectRaw("GROUP_CONCAT(itemname SEPARATOR ', ') as items")
						->selectRaw("GROUP_CONCAT(weight SEPARATOR ' KG, ') as weights")
						->groupBy('orderid');
				}])
					->leftJoin('shops', 'shops.userid', '=', 'shopbookorders.masterid')
					->where('shopbookorders.masterid', $newid)
					->where('shopbookorders.created_at', '>=', $fromdate)
					->where('shopbookorders.created_at', '<=', $newtodate)
					->orderByDesc('shopbookorders.id')
					->select('shops.shopname', 'orderid', 'orderno', 'shopbookorders.id', 'shopbookorders.created_at', 'amount')
					->get();
			}

			$this->data['totalAmount'] = $request->totalAmount;
			$this->data['totalshoporder'] = $request->shopordercount;
			$this->data['totalweight'] = $request->totalweight;

			return view('pdf.report.shoporderreport', $this->data);
		} else {
			return redirect()->route('shoporderreport');
		}
	}
	//-----------shop end

	//-------------shop discount start

	public function shopdiscountreport()
	{
		$this->data['shoporder'] = null;
		$this->data['shoporderlist'] = null;
		$this->data['shopid'] = null;
		$this->data['shop'] = Shop::get();
		$this->data['shopordercount'] = 0;
		$this->data['totaldiscount'] = 0;


		return view('reports/shopdiscountreport', $this->data);
	}

	public function shopdiscountreports(Request $request)
	{
		$fromdate = date('Y-m-d', strtotime($request->fromdate));
		$todate = date('Y-m-d', strtotime($request->todate));
		$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));
		$this->data['shop'] = Shop::get();

		$fromdatepage = $request->fromdate;
		$todatepage = $request->todate;

		$this->data['fromdatepage'] = $fromdatepage;
		$this->data['todatepage'] = $todatepage;

		$this->data['shopid'] = $request->shopid;
		if ($request->shopid == 'all') {
			$this->data['shoporder'] = DB::select("select shopbookorders.orderno,shopbookorders.id,shopbookorders.discount,shopbookorders.created_at,shopbookorders.amount,GROUP_CONCAT(shoporderlists.itemname) as items from shopbookorders  left join shoporderlists on shoporderlists.orderid=shopbookorders.orderid where shopbookorders.created_at between '$fromdate' AND '$newtodate' AND shopbookorders.discount>0 group by shopbookorders.id ");
			$this->data['shopordercount'] = count($this->data['shoporder']);
			$this->data['totaldiscount'] = DB::table("shopbookorders")->orderby('id', 'desc')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get()->sum("discount");
		} else {
			$masterid = Shop::where('shopname', $request->shopid)->first();
			$newid = $masterid['userid'];
			$this->data['shoporder'] = $this->data['shoporder'] = DB::select("select shopbookorders.orderno,shopbookorders.id,shopbookorders.discount,shopbookorders.created_at,shopbookorders.amount,GROUP_CONCAT(shoporderlists.itemname) as items from shopbookorders  left join shoporderlists on shoporderlists.orderid=shopbookorders.orderid where shopbookorders.created_at between '$fromdate' AND '$newtodate' AND shopbookorders.discount>0 AND shopbookorders.masterid='$newid' group by shopbookorders.id ");
			$this->data['shopordercount'] = count($this->data['shoporder']);

			$this->data['totaldiscount'] = DB::table("shopbookorders")->orderby('id', 'desc')->where('masterid', $newid)->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get()->sum("discount");
		}

		return view('reports/shopdiscountreport', $this->data);
	}
	public function printshopdiscount(Request $request)
	{
		if ($request->shopordercount > 0) {
			$fromdate = date('Y-m-d', strtotime($request->printfromdate));
			$todate = date('Y-m-d', strtotime($request->printtodate));
			$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($request->printtodate)));
			$this->data['fromdate'] = $request->printfromdate;
			$this->data['todate'] = $request->printtodate;
			$this->data['shopid'] = $request->shopid;
			$this->data['shopname'] = $request->shopid;

			if ($request->shopid == 'all') {
				$this->data['shoporder'] = DB::select("select shopbookorders.orderno,shopbookorders.id,shopbookorders.discount,shopbookorders.created_at,shopbookorders.amount,GROUP_CONCAT(shoporderlists.itemname) as items from shopbookorders  left join shoporderlists on shoporderlists.orderid=shopbookorders.orderid where shopbookorders.created_at between '$fromdate' AND '$newtodate' AND shopbookorders.discount>0 group by shopbookorders.id ");
			} else {


				$masterid = Shop::where('shopname', $request->shopid)->first();
				$newid = $masterid['userid'];
				$this->data['shoporder'] = $this->data['shoporder'] = DB::select("select shopbookorders.orderno,shopbookorders.id,shopbookorders.discount,shopbookorders.created_at,shopbookorders.amount,GROUP_CONCAT(shoporderlists.itemname) as items from shopbookorders  left join shoporderlists on shoporderlists.orderid=shopbookorders.orderid where shopbookorders.created_at between '$fromdate' AND '$newtodate' AND shopbookorders.discount>0 AND shopbookorders.masterid='$newid' group by shopbookorders.id ");
				$this->data['shopordercount'] = count($this->data['shoporder']);
			}
			$this->data['totaldiscount'] = $request->totaldiscount;
			return view('pdf/report/shopdiscountreport', $this->data);
		} else {
			return redirect()->route('shopdiscountreport');
		}
	}

	//--------------shop discount end

	//------------------Telecaller discount
	public function telecallerdiscountreport()
	{
		$this->data['teleorder'] = null;
		$this->data['telecallerorderlist'] = null;
		$this->data['telecallerid'] = null;
		$this->data['telecaller'] = Usermanage::where('role', 3)->get();
		$this->data['telecallerordercount'] = 0;
		$this->data['totaldiscount'] = 0;
		return view('reports/telecallerdiscountreport', $this->data);
	}

	public function telecallerdiscountreports(Request $request)
	{
		$fromdate = date('Y-m-d', strtotime($request->fromdate));
		$todate = date('Y-m-d', strtotime($request->todate));
		$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));
		$this->data['telecaller'] = Usermanage::where('role', 3)->get();
		$this->data['totaldiscount'] = 0;
		$fromdatepage = $request->fromdate;
		$todatepage = $request->todate;

		$this->data['fromdatepage'] = $fromdatepage;
		$this->data['todatepage'] = $todatepage;
		$this->data['telecallerid'] = $request->telecallerid;
		if ($request->telecallerid == 'all') {

			$this->data['teleorder'] = DB::select("select telebookorders.orderno,telebookorders.id,telebookorders.created_at,telebookorders.amount,telebookorders.collectedcash,GROUP_CONCAT(teleorderlists.itemname SEPARATOR',  ') as items,GROUP_CONCAT(teleorderlists.weight SEPARATOR' Kg,') as weights from telebookorders  left join teleorderlists on teleorderlists.orderid=telebookorders.orderid where telebookorders.created_at>='$fromdate' AND telebookorders.status!='-1' AND telebookorders.orderfrom='telecaller' AND telebookorders.created_at <= '$newtodate' group by telebookorders.id ");

			$this->data['telecallerordercount'] = count($this->data['teleorder']);
		} else {
			$masterid = Usermanage::where('username', $request->telecallerid)->first();
			$newid = $masterid['id'];
			//echo $newid;
			$this->data['teleorder'] = DB::select("select telebookorders.orderno,telebookorders.id,telebookorders.created_at,telebookorders.amount,telebookorders.collectedcash,GROUP_CONCAT(teleorderlists.itemname SEPARATOR',  ') as items,GROUP_CONCAT(teleorderlists.weight SEPARATOR' Kg,') as weights from telebookorders  left join teleorderlists on teleorderlists.orderid=telebookorders.orderid where telebookorders.created_at>='$fromdate' AND telebookorders.status!='-1' AND telebookorders.orderfrom='telecaller' AND telebookorders.created_at <= '$newtodate' AND telebookorders.masterid='$newid' group by telebookorders.id ");

			$this->data['telecallerordercount'] = count($this->data['teleorder']);
		}
		return view('reports/telecallerdiscountreport', $this->data);
	}
	public function printtelecallerdiscount(Request $request)
	{
		if ($request->telecallerordercount > 0) {
			$fromdate = date('Y-m-d', strtotime($request->printfromdate));
			$todate = date('Y-m-d', strtotime($request->printtodate));
			$this->data['fromdate'] = $request->printfromdate;
			$this->data['todate'] = $request->printtodate;
			$this->data['telecallerid'] = $request->telecallerid;
			$this->data['telecallername'] = $request->telecallerid;
			$this->data['totaldiscount'] = $request->totaldiscountss;
			if ($request->telecallerid == 'all') {
				$this->data['telecallerorder'] = Telebookorder::orderby('id', 'desc')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();
				$this->data['telecallerorderlist'] = Teleorderlist::orderby('id', 'desc')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();
			} else {

				$masterid = Usermanage::where('username', $request->telecallerid)->first();
				$newid = $masterid['id'];

				$this->data['telecallerorder'] = Telebookorder::orderby('id', 'desc')->where('masterid', $newid)->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();

				$this->data['telecallerorderlist'] = Teleorderlist::orderby('id', 'desc')->where('masterid', $newid)->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();
			}

			return view('pdf/report/telecallerdiscountreport', $this->data);
		} else {
			return redirect()->route('telecallerdiscountreport');
		}
	}

	//--------------------------------Delivery boy start
	public function deliveryboyreport()
	{
		$this->data['apporder'] = null;
		$this->data['deliveryboyorder'] = null;
		$this->data['deliveryboyorderlist'] = null;
		$this->data['deliveryboyid'] = null;
		$this->data['deliveryboy'] = Deliveryboy::get();
		$this->data['deliveryboyordercount'] = 0;
		$this->data['deliveryboyidname'] = null;


		return view('reports/deliveryboyreport', $this->data);
	}

	public function deliveryboyreports(Request $request)
	{
		$fromdate = date('Y-m-d', strtotime($request->fromdate));
		$todate = date('Y-m-d', strtotime($request->todate));
		$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

		$this->data['deliveryboy'] = Deliveryboy::get();
		$this->data['totaldiscount'] = 0;

		$fromdatepage = $request->fromdate;
		$todatepage = $request->todate;

		$this->data['fromdatepage'] = $fromdatepage;
		$this->data['todatepage'] = $todatepage;
		$this->data['deliveryboyid'] = $request->deliveryboyid;
		if ($request->deliveryboyid == 'all') {
			$this->data['deliveryboyidname'] = $request->deliveryboyid;

			$deliveryBoyOrders = TeleBookOrder::select('telebookorders.orderno', 'telebookorders.assignto', 'telebookorders.timetaken', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount')
				->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ', ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg, ') as weights")
				->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
				->where('telebookorders.created_at', '>=', $fromdate)
				->where('telebookorders.status', '!=', '-1')
				->where('telebookorders.assignto', '!=', 'null')
				->where('telebookorders.orderfrom', 'telecaller')
				->where('telebookorders.created_at', '<=', $newtodate)
				->groupBy('telebookorders.id')
				->get();

			$appOrders = TeleBookOrder::select('telebookorders.orderno', 'telebookorders.assignto', 'telebookorders.timetaken', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount')
				->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ', ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg, ') as weights")
				->leftJoin('teleorderlists', function ($join) use ($fromdate) {
					$join->on('teleorderlists.orderid', '=', 'telebookorders.id')
						->where('teleorderlists.created_at', '>=', $fromdate);
				})
				->where('telebookorders.orderfrom', 'app')
				->where('telebookorders.created_at', '>=', $fromdate)
				->where('telebookorders.created_at', '<=', $newtodate)
				->groupBy('telebookorders.id')
				->get();

			$this->data['deliveryboyorder'] = $deliveryBoyOrders;
			$this->data['apporder'] = $appOrders;
			$this->data['totalAmount'] = $appOrders->sum('amount') + $deliveryBoyOrders->sum('amount');
		} else {
			$name = Deliveryboy::where('id', $request->deliveryboyid)->first();

			$this->data['deliveryboyid'] = $name['name'];
			$this->data['deliveryboyidname'] = $request->deliveryboyid;

			$deliveryBoyOrders = TeleBookOrder::select('telebookorders.orderno', 'telebookorders.assignto', 'telebookorders.timetaken', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount')
				->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ', ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg, ') as weights")
				->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
				->where('telebookorders.created_at', '>=', $fromdate)
				->where('telebookorders.status', '!=', '-1')
				->where('telebookorders.assignto', '!=', 'null')
				->where('telebookorders.deliveryboyid', $name->id)
				->where('telebookorders.orderfrom', 'telecaller')
				->where('telebookorders.created_at', '<=', $newtodate)
				->groupBy('telebookorders.id')
				->get();

			$appOrders = TeleBookOrder::select('telebookorders.orderno', 'telebookorders.assignto', 'telebookorders.timetaken', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount')
				->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ', ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg, ') as weights")
				->leftJoin('teleorderlists', function ($join) use ($fromdate) {
					$join->on('teleorderlists.orderid', '=', 'telebookorders.id')
						->where('teleorderlists.created_at', '>=', $fromdate);
				})
				->where('telebookorders.orderfrom', 'app')
				->where('telebookorders.created_at', '>=', $fromdate)
				->where('telebookorders.deliveryboyid', $name->id)
				->where('telebookorders.created_at', '<=', $newtodate)
				->groupBy('telebookorders.id')
				->get();

			$this->data['deliveryboyorder'] = $deliveryBoyOrders;
			$this->data['apporder'] = $appOrders;
			$this->data['totalAmount'] = $appOrders->sum('amount') + $deliveryBoyOrders->sum('amount');
		}
		$this->data['deliveryboyordercount'] = count($this->data['deliveryboyorder']) + count($this->data['apporder']);

		return view('reports.deliveryboyreport', $this->data);
	}


	public function printdeliveryboy(Request $request)
	{
		if ($request->deliveryboyordercount > 0) {

			$fromdate = date('Y-m-d', strtotime($request->printfromdate));
			$todate = date('Y-m-d', strtotime($request->printtodate));
			$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

			$this->data['fromdate'] = $request->printfromdate;
			$this->data['todate'] = $request->printtodate;
			$this->data['deliveryboyid'] = $request->deliveryboyid;

			if ($request->deliveryboyidname == 'all') {
				$deliveryBoyOrders = TeleBookOrder::select('telebookorders.orderno', 'telebookorders.assignto', 'telebookorders.timetaken', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount')
					->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ', ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg, ') as weights")
					->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
					->where('telebookorders.created_at', '>=', $fromdate)
					->where('telebookorders.status', '!=', '-1')
					->where('telebookorders.assignto', '!=', 'null')
					->where('telebookorders.orderfrom', 'telecaller')
					->where('telebookorders.created_at', '<=', $newtodate)
					->groupBy('telebookorders.id')
					->get();

				$appOrders = TeleBookOrder::select('telebookorders.orderno', 'telebookorders.assignto', 'telebookorders.timetaken', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount')
					->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ', ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg, ') as weights")
					->leftJoin('teleorderlists', function ($join) use ($fromdate) {
						$join->on('teleorderlists.orderid', '=', 'telebookorders.id')
							->where('teleorderlists.created_at', '>=', $fromdate);
					})
					->where('telebookorders.orderfrom', 'app')
					->where('telebookorders.created_at', '>=', $fromdate)
					->where('telebookorders.created_at', '<=', $newtodate)
					->groupBy('telebookorders.id')
					->get();

				$this->data['deliveryboyorder'] = $deliveryBoyOrders;
				$this->data['apporder'] = $appOrders;
				$this->data['totalAmount'] = $appOrders->sum('amount') + $deliveryBoyOrders->sum('amount');
			} else {

				$name = Deliveryboy::where('id', $request->deliveryboyidname)->first();
				$this->data['deliveryboyid'] = $name['name'];
				$deliveryBoyOrders = TeleBookOrder::select('telebookorders.orderno', 'telebookorders.assignto', 'telebookorders.timetaken', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount')
					->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ', ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg, ') as weights")
					->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
					->where('telebookorders.created_at', '>=', $fromdate)
					->where('telebookorders.status', '!=', '-1')
					->where('telebookorders.assignto', '!=', 'null')
					->where('telebookorders.deliveryboyid', $name->id)
					->where('telebookorders.orderfrom', 'telecaller')
					->where('telebookorders.created_at', '<=', $newtodate)
					->groupBy('telebookorders.id')
					->get();

				$appOrders = TeleBookOrder::select('telebookorders.orderno', 'telebookorders.assignto', 'telebookorders.timetaken', 'telebookorders.id', 'telebookorders.created_at', 'telebookorders.amount')
					->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ', ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg, ') as weights")
					->leftJoin('teleorderlists', function ($join) use ($fromdate) {
						$join->on('teleorderlists.orderid', '=', 'telebookorders.id')
							->where('teleorderlists.created_at', '>=', $fromdate);
					})
					->where('telebookorders.orderfrom', 'app')
					->where('telebookorders.created_at', '>=', $fromdate)
					->where('telebookorders.deliveryboyid', $name->id)
					->where('telebookorders.created_at', '<=', $newtodate)
					->groupBy('telebookorders.id')
					->get();

				$this->data['deliveryboyorder'] = $deliveryBoyOrders;
				$this->data['apporder'] = $appOrders;
				$this->data['totalAmount'] = $appOrders->sum('amount') + $deliveryBoyOrders->sum('amount');
			}
			$this->data['deliveryboyordercount'] = count($this->data['deliveryboyorder']) + count($this->data['apporder']);
			return view('pdf.report.deliveryboyreport', $this->data);
		} else {
			return redirect()->route('deliveryboyreport');
		}
	}

	//----------------------------Delivery boy end

	//------------------shop Start

	public function cashcollectionshopreport()
	{
		$this->data['shop'] = DB::table('shops')->select('id', 'userid', 'shopname')->get();
		$this->data['shopname'] = null;
		$this->data['shoporder'] = null;
		$this->data['mop'] = null;
		$this->data['totalcashcollected'] = null;
		return view('reports/cashcollectionshopreport', $this->data);
	}
	public function cashcollectionshopreports(Request $request)
	{
		$this->data['shop'] = Shop::get();
		$this->data['shoporder'] = null;
		$this->data['shoplist'] = Shop::get();
		$this->data['fromdate'] = $request->fromdate;
		$this->data['todate'] = $request->todate;
		$fromdate = date('Y-m-d', strtotime($request->fromdate));
		$todate = date('Y-m-d', strtotime($request->todate));
		$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

		if ($request->shopid == 'all') {
			if ($request->mop == 'all') {
				$this->data['shoporder'] = DB::select("select shopbookorders.id,shopbookorders.orderno,shopbookorders.created_at,shopbookorders.amount,shops.shopname from shopbookorders left join shops on shopbookorders.masterid=shops.userid where shopbookorders.created_at between '$fromdate' AND '$newtodate' group by shopbookorders.id order by shopbookorders.id desc");

				$this->data['totalcashcollected'] = DB::table('shopbookorders')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get()->sum('amount');
			} else {
				$this->data['shoporder'] = DB::select("select shopbookorders.id,shopbookorders.orderno,shopbookorders.created_at,shopbookorders.amount,shops.shopname from shopbookorders left join shops on shopbookorders.masterid=shops.userid where shopbookorders.mop='$request->mop' AND shopbookorders.created_at between '$fromdate' AND '$newtodate' group by shopbookorders.id order by shopbookorders.id desc");

				$this->data['totalcashcollected'] = DB::table('shopbookorders')->where('mop', $request->mop)->whereDate('created_at', '>=', date('Y-m-d', strtotime($fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($todate)))->get()->sum('amount');
			}
			$this->data['shopname'] = "All";
		} else {
			if ($request->mop == 'all') {
				$this->data['shoporder'] = DB::select("select shopbookorders.id,shopbookorders.orderno,shopbookorders.created_at,shopbookorders.amount,shops.shopname from shopbookorders left join shops on shopbookorders.masterid=shops.userid where shopbookorders.masterid='$request->shopid' AND shopbookorders.created_at between '$fromdate' AND '$newtodate' group by shopbookorders.id order by shopbookorders.id desc");

				$this->data['totalcashcollected'] = Shopbookorder::orderby('id', 'desc')->where('masterid', $request->shopid)->whereDate('created_at', '>=', date('Y-m-d', strtotime($fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($todate)))->get()->sum('amount');
			} else {
				$this->data['shoporder'] = DB::select("select shopbookorders.id,shopbookorders.orderno,shopbookorders.created_at,shopbookorders.amount,shops.shopname from shopbookorders left join shops on shopbookorders.masterid=shops.userid where shopbookorders.masterid='$request->shopid' AND shopbookorders.mop='$request->mop' AND shopbookorders.created_at between '$fromdate' AND '$newtodate' group by shopbookorders.id order by shopbookorders.id desc");

				$this->data['totalcashcollected'] = Shopbookorder::orderby('id', 'desc')->where('masterid', $request->shopid)->where('mop', $request->mop)->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get()->sum('amount');
			}
			$name = Shop::where('userid', $request->shopid)->first();
			$this->data['shopname'] = $name['shopname'];
		}
		$this->data['collectionshopcount'] = count($this->data['shoporder']);
		$this->data['shopid'] = $request->shopid;
		$this->data['mop'] = $request->mop;

		return view('reports/cashcollectionshopreport', $this->data);
	}


	public function printcashcollectionshop(Request $request)
	{
		$printfromdate = date('Y-m-d', strtotime($request->printfromdate));
		$printtodate = date('Y-m-d', strtotime("+1 day", strtotime($request->printtodate)));

		if ($request->collectionshopcount > 0) {
			if ($request->printshopid == 'all') {
				if ($request->printmop == 'all') {
					$this->data['shoporder'] = DB::select("select shopbookorders.id,shopbookorders.orderno,shopbookorders.created_at,shopbookorders.amount,shops.shopname from shopbookorders left join shops on shopbookorders.masterid=shops.userid where shopbookorders.created_at between '$printfromdate' AND '$printtodate' group by shopbookorders.id order by shopbookorders.id desc");

					$this->data['totalcashcollected'] = DB::table('shopbookorders')->whereDate('created_at', '>=', $printfromdate)->whereDate('created_at', '<=', $printtodate)->get()->sum('amount');
				} else {
					$this->data['shoporder'] = DB::select("select shopbookorders.id,shopbookorders.orderno,shopbookorders.created_at,shopbookorders.amount,shops.shopname from shopbookorders left join shops on shopbookorders.masterid=shops.userid where shopbookorders.mop='$request->mop' AND shopbookorders.created_at between '$printfromdate' AND '$printtodate' group by shopbookorders.id order by shopbookorders.id desc");

					$this->data['totalcashcollected'] = DB::table('shopbookorders')->where('mop', $request->mop)->whereDate('created_at', '>=', date('Y-m-d', strtotime($printfromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($printtodate)))->get()->sum('amount');
				}
				$this->data['shopname'] = "All";
			} else {
				if ($request->printmop == 'all') {
					$this->data['shoporder'] = DB::select("select shopbookorders.id,shopbookorders.orderno,shopbookorders.created_at,shopbookorders.amount,shops.shopname from shopbookorders left join shops on shopbookorders.masterid=shops.userid where shopbookorders.masterid='$request->printshopid' AND shopbookorders.created_at between '$printfromdate' AND '$printtodate' group by shopbookorders.id order by shopbookorders.id desc");

					$this->data['totalcashcollected'] = Shopbookorder::orderby('id', 'desc')->where('masterid', $request->printshopid)->whereDate('created_at', '>=', date('Y-m-d', strtotime($printfromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($printtodate)))->get()->sum('amount');
				} else {
					$this->data['shoporder'] = DB::select("select shopbookorders.id,shopbookorders.orderno,shopbookorders.created_at,shopbookorders.amount,shops.shopname from shopbookorders left join shops on shopbookorders.masterid=shops.userid where shopbookorders.masterid='$request->printshopid' AND shopbookorders.mop='$request->mop' AND shopbookorders.created_at between '$printfromdate' AND '$printtodate' group by shopbookorders.id order by shopbookorders.id desc");

					$this->data['totalcashcollected'] = Shopbookorder::orderby('id', 'desc')->where('masterid', $request->printshopid)->where('mop', $request->mop)->whereDate('created_at', '>=', date('Y-m-d', strtotime($printfromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($printtodate)))->get()->sum('amount');
				}
				$name = Shop::where('userid', $request->printshopid)->first();
				$this->data['shopname'] = $name['shopname'];
			}

			$this->data['fromdate'] = $request->printfromdate;
			$this->data['todate'] = $request->printtodate;
			$this->data['totalcash'] = $request->totalcash;
			$this->data['shoplist'] = Shop::get();


			$this->data['mop'] = $request->printmop;
			return view('pdf/report/cashcollectionshopreport', $this->data);
		} else {
			return redirect()->route('cashcollectionshopreport');
		}
	}

	//----------------Shop end
	//-------------telecaller cash collection

	public function cashcollectiontelecallerreport()
	{
		$this->data['telecaller'] = Usermanage::where('role', 3)->get();
		$this->data['telecallername'] = null;
		$this->data['teleorder'] = null;
		$this->data['mop'] = null;
		$this->data['totalcashcollected'] = null;

		return view('reports/cashcollectiontelecallerreport', $this->data);
	}
	public function cashcollectiontelecallerreports(Request $request)
	{
		$this->data['telecaller'] = Usermanage::where('role', 3)->get();
		$this->data['fromdate'] = $request->fromdate;
		$this->data['todate'] = $request->todate;
		$fromdate = date('Y-m-d', strtotime($request->fromdate));
		$todate = date('Y-m-d', strtotime($request->todate));
		$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

		if ($request->telecallerid == 'all') {
			if ($request->mop == 'all') {

				$this->data['teleorder'] = DB::select("select telebookorders.id,telebookorders.collectedcash,telebookorders.orderno,telebookorders.created_at,telebookorders.amount,usermanages.username from telebookorders left join usermanages on telebookorders.masterid=usermanages.id where telebookorders.created_at between '$fromdate' AND '$newtodate' group by telebookorders.id order by telebookorders.id desc");

				$this->data['totalcashcollected'] = DB::table('telebookorders')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get()->sum('collectedcash');
			} else {
				$this->data['teleorder'] = DB::select("select telebookorders.id,telebookorders.collectedcash,telebookorders.orderno,telebookorders.created_at,telebookorders.amount,usermanages.username from telebookorders left join usermanages on telebookorders.masterid=usermanages.id where telebookorders.mop='$request->mop' AND telebookorders.created_at between '$fromdate' AND '$newtodate' group by telebookorders.id order by telebookorders.id desc");

				$this->data['totalcashcollected'] = DB::table('telebookorders')->where('mop', $request->mop)->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get()->sum('collectedcash');
			}
			$this->data['telecallername'] = "All";
		} else {
			if ($request->mop == 'all') {
				$this->data['teleorder'] = DB::select("select telebookorders.id,telebookorders.collectedcash,telebookorders.orderno,telebookorders.created_at,telebookorders.amount,usermanages.username from telebookorders left join usermanages on telebookorders.masterid=usermanages.id where telebookorders.masterid='$request->telecallerid' AND telebookorders.created_at between '$fromdate' AND '$newtodate' group by telebookorders.id order by telebookorders.id desc");

				$this->data['totalcashcollected'] = DB::table('telebookorders')->where('masterid', $request->telecallerid)->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get()->sum('collectedcash');
			} else {
				$this->data['teleorder'] = DB::select("select telebookorders.id,telebookorders.collectedcash,telebookorders.orderno,telebookorders.created_at,telebookorders.amount,usermanages.username from telebookorders left join usermanages on telebookorders.masterid=usermanages.id where telebookorders.masterid='$request->telecallerid' AND telebookorders.mop='$request->mop' AND telebookorders.created_at between '$fromdate' AND '$newtodate' group by telebookorders.id order by telebookorders.id desc");

				$this->data['totalcashcollected'] = DB::table('telebookorders')->where('masterid', $request->telecallerid)->where('mop', $request->mop)->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get()->sum('collectedcash');
			}
			$name = Usermanage::where('id', $request->telecallerid)->first();
			$this->data['telecallername'] = $name['username'];
		}
		$this->data['collectiontelecallercount'] = count($this->data['teleorder']);
		$this->data['telecallerid'] = $request->telecallerid;
		$this->data['mop'] = $request->mop;

		return view('reports/cashcollectiontelecallerreport', $this->data);
	}
	public function printcashcollectiontelecaller(Request $request)
	{

		if ($request->collectiontelecallercount > 0) {
			$fromdate = date('Y-m-d', strtotime($request->printfromdate));
			$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($request->printtodate)));


			if ($request->printtelecallerid == 'all') {
				if ($request->printmop == 'all') {
					$this->data['teleorder'] = DB::select("select telebookorders.id,telebookorders.collectedcash,telebookorders.orderno,telebookorders.created_at,telebookorders.amount,usermanages.username from telebookorders left join usermanages on telebookorders.masterid=usermanages.id where telebookorders.created_at between '$fromdate' AND '$newtodate' group by telebookorders.id order by telebookorders.id desc");

					$this->data['totalcashcollected'] = $request->totalcash;
				} else {
					$this->data['teleorder'] = DB::select("select telebookorders.id,telebookorders.collectedcash,telebookorders.orderno,telebookorders.created_at,telebookorders.amount,usermanages.username from telebookorders left join usermanages on telebookorders.masterid=usermanages.id where telebookorders.mop='$request->printmop' AND telebookorders.created_at between '$fromdate' AND '$newtodate' group by telebookorders.id order by telebookorders.id desc");

					$this->data['totalcashcollected'] = $request->totalcash;
				}
				$this->data['telecallername'] = "All";
			} else {
				if ($request->printmop == 'all') {
					$this->data['teleorder'] = DB::select("select telebookorders.id,telebookorders.collectedcash,telebookorders.orderno,telebookorders.created_at,telebookorders.amount,usermanages.username from telebookorders left join usermanages on telebookorders.masterid=usermanages.id where telebookorders.masterid='$request->printtelecallerid' AND telebookorders.created_at between '$fromdate' AND '$newtodate' group by telebookorders.id order by telebookorders.id desc");
					$this->data['totalcashcollected'] = $request->totalcash;
				} else {
					$this->data['teleorder'] = DB::select("select telebookorders.id,telebookorders.collectedcash,telebookorders.orderno,telebookorders.created_at,telebookorders.amount,usermanages.username from telebookorders left join usermanages on telebookorders.masterid=usermanages.id where telebookorders.masterid='$request->printtelecallerid' AND telebookorders.mop='$request->printmop' AND telebookorders.created_at between '$fromdate' AND '$newtodate' group by telebookorders.id order by telebookorders.id desc");
					$this->data['totalcashcollected'] = $request->totalcash;
				}
				$name = Usermanage::where('id', $request->printtelecallerid)->first();
				$this->data['telecallername'] = $name['username'];
			}

			$this->data['collectiontelecallercount'] = count($this->data['teleorder']);
			$this->data['fromdate'] = $request->printfromdate;
			$this->data['todate'] = $request->printtodate;
			$this->data['mop'] = $request->printmop;
			$this->data['telecaller'] = Usermanage::where('role', 3)->get();

			return view('pdf/report/cashcollectiontelecallerreport', $this->data);
		} else {
			return redirect()->route('cashcollectiontelecallerreport');
		}
	}
	//----------------------------------------------------------

	public function cancelorderreport()
	{
		$this->data['teleorder'] = null;
		$this->data['teleorderlist'] = null;
		$this->data['telecallerid'] = null;
		$this->data['telecallername'] = null;
		$this->data['teleordercount'] = 0;
		$this->data['telecaller'] = Usermanage::where('role', '3')->get();
		return view('reports/cancelorderreport', $this->data);
	}

	public function cancelorderreports(Request $request)
	{
		$fromdate = date('Y-m-d', strtotime($request->fromdate));
		$todate = date('Y-m-d', strtotime($request->todate));
		$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

		$fromdatepage = $request->fromdate;
		$todatepage = $request->todate;
		$this->data['telecaller'] = Usermanage::where('role', '3')->get();

		$this->data['fromdatepage'] = $fromdatepage;
		$this->data['todatepage'] = $todatepage;
		$this->data['telecallerid'] = $request->telecallerid;
		if ($request->telecallerid == 'all') {

			$this->data['telecallername'] = "All";

			$teleOrders = App_cancel_order::select('telebookorders.orderno', 'telebookorders.amount', 'app_cancel_orders.id', 'app_cancel_orders.app_order_id', 'app_cancel_orders.created_at', 'app_cancel_orders.reason')
				->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ',  ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg,  ') as weights")
				->join('telebookorders', 'app_cancel_orders.app_order_id', '=', 'telebookorders.id')
				->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
				->where('telebookorders.orderfrom', 'telecaller')
				->where('app_cancel_orders.created_at', '>=', $fromdate)
				->where('app_cancel_orders.created_at', '<=', $newtodate)
				->groupBy('app_cancel_orders.id')
				->get();

			$this->data['teleorder'] = $teleOrders;
			$this->data['totalAmount'] = $teleOrders->sum('amount');
		} else {
			$name = Usermanage::where('id', $request->telecallerid)->first();
			$this->data['telecallername'] = $name['username'];

			$teleOrders = App_cancel_order::select('telebookorders.orderno', 'telebookorders.amount', 'app_cancel_orders.id', 'app_cancel_orders.app_order_id', 'app_cancel_orders.created_at', 'app_cancel_orders.reason')
				->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ',  ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg,  ') as weights")
				->join('telebookorders', 'app_cancel_orders.app_order_id', '=', 'telebookorders.id')
				->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
				->where('telebookorders.orderfrom', 'telecaller')
				->where('telebookorders.masterid', $request->telecallerid)
				->where('app_cancel_orders.created_at', '>=', $fromdate)
				->where('app_cancel_orders.created_at', '<=', $newtodate)
				->groupBy('app_cancel_orders.id')
				->get();

			$this->data['teleorder'] = $teleOrders;
			$this->data['totalAmount'] = $teleOrders->sum('amount');
		}
		$this->data['teleordercount'] = count($this->data['teleorder']);





		return view('reports.cancelorderreport', $this->data);
	}
	public function printcancelorder(Request $request)
	{
		if ($request->teleordercount > 0) {


			$fromdate = date('Y-m-d', strtotime($request->printfromdate));
			$todate = date('Y-m-d', strtotime($request->printtodate));
			$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

			$this->data['fromdate'] = $request->printfromdate;
			$this->data['todate'] = $request->printtodate;
			if ($request->teleid == 'all') {
				$teleOrders = App_cancel_order::select('telebookorders.orderno', 'telebookorders.amount', 'app_cancel_orders.id', 'app_cancel_orders.app_order_id', 'app_cancel_orders.created_at', 'app_cancel_orders.reason')
				->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ',  ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg,  ') as weights")
				->join('telebookorders', 'app_cancel_orders.app_order_id', '=', 'telebookorders.id')
				->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
				->where('telebookorders.orderfrom', 'telecaller')
				->where('app_cancel_orders.created_at', '>=', $fromdate)
				->where('app_cancel_orders.created_at', '<=', $newtodate)
				->groupBy('app_cancel_orders.id')
				->get();

			$this->data['teleorder'] = $teleOrders;

				$this->data['telecallername'] = 'All';
			} else {

				$teleOrders = App_cancel_order::select('telebookorders.orderno', 'telebookorders.amount', 'app_cancel_orders.id', 'app_cancel_orders.app_order_id', 'app_cancel_orders.created_at', 'app_cancel_orders.reason')
				->selectRaw("GROUP_CONCAT(teleorderlists.itemname SEPARATOR ',  ') as items, GROUP_CONCAT(teleorderlists.weight SEPARATOR ' Kg,  ') as weights")
				->join('telebookorders', 'app_cancel_orders.app_order_id', '=', 'telebookorders.id')
				->leftJoin('teleorderlists', 'teleorderlists.orderid', '=', 'telebookorders.orderid')
				->where('telebookorders.orderfrom', 'telecaller')
				->where('telebookorders.masterid', $request->teleid)
				->where('app_cancel_orders.created_at', '>=', $fromdate)
				->where('app_cancel_orders.created_at', '<=', $newtodate)
				->groupBy('app_cancel_orders.id')
				->get();

			$this->data['teleorder'] = $teleOrders;

				$name = Usermanage::where('id', $request->teleid)->first();
				$this->data['telecallername'] = $name['username'];
			}
			$this->data['totalAmount'] = $request->totalAmount;

			$this->data['totalteleorder'] = $request->teleordercount;
			return view('pdf.report.cancelorderreport', $this->data);
		} else {
			return redirect()->route('cancelorderreport');
		}
	}
	//------------------------------------------------------

	public function itemreport()
	{
		$this->data['items'] = Item::get();
		$this->data['shopitem'] = null;
		$this->data['teleitem'] = null;
		$this->data['totalkg'] = 0;
		return view('reports/itemreport', $this->data);
	}

	public function itemreports(Request $request)
	{
		$this->data['items'] = Item::get();

		$fromdate = date('Y-m-d', strtotime($request->fromdate));
		$todate = date('Y-m-d', strtotime($request->todate));
		$newtodate = date('Y-m-d', strtotime("+1 day", strtotime($todate)));

		$fromdatepage = $request->fromdate;
		$todatepage = $request->todate;

		$this->data['fromdatepage'] = $fromdatepage;
		$this->data['todatepage'] = $todatepage;

		if ($request->itemname == 'all') {
			$this->data['shopitem'] = DB::table('shoporderlists')->orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get();

			$this->data['shopkg'] = DB::table('shoporderlists')->select('weight')->orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get()->sum('weight');
			$this->data['shoptotalrate'] = DB::table('shoporderlists')->select('rate')->orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get()->sum('rate');
			$this->data['teleitem'] = Teleorderlist::orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get();
			$this->data['telekg'] = Teleorderlist::select('weight')->orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get()->sum('weight');
			$this->data['teletotalrate'] = Teleorderlist::select('rate')->orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get()->sum('rate');
			$this->data['itemname'] = "All";
			$this->data['totalkg'] = $this->data['shopkg'] + $this->data['telekg'];
			$this->data['totalrate'] = $this->data['shoptotalrate'] + $this->data['teletotalrate'];
		} else {
			$this->data['shopitem'] = DB::table('shoporderlists')->where('itemname', $request->itemname)->orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get();
			$this->data['shopkg'] = DB::table('shoporderlists')->where('itemname', $request->itemname)->select('weight')->orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get()->sum('weight');
			$this->data['teleitem'] = Teleorderlist::where('itemname', $request->itemname)->orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get();
			$this->data['telekg'] = Teleorderlist::where('itemname', $request->itemname)->select('weight')->orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get()->sum('weight');
			$this->data['shoptotalrate'] = DB::table('shoporderlists')->where('itemname', $request->itemname)->select('rate')->orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get()->sum('rate');

			$this->data['teletotalrate'] = Teleorderlist::where('itemname', $request->itemname)->select('rate')->orderby('id', 'desc')->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->fromdate)))->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->todate)))->get()->sum('rate');

			$this->data['totalrate'] = $this->data['shoptotalrate'] + $this->data['teletotalrate'];

			$this->data['itemname'] = $request->itemname;
			$this->data['totalkg'] = $this->data['shopkg'] + $this->data['telekg'];
		}
		$this->data['itemcount'] = count($this->data['shopitem']) + count($this->data['teleitem']);

		return view('reports.itemreport', $this->data);
	}
	public function printitemreport(Request $request)
	{

		if ($request->itemcount2 > 0) {


			$fromdate = date('Y-m-d', strtotime($request->printfromdate));
			$todate = date('Y-m-d', strtotime($request->printtodate));
			$this->data['fromdate'] = $request->printfromdate;
			$this->data['todate'] = $request->printtodate;
			$this->data['totalrate'] = $request->totalrate;

			if ($request->itemname2 == 'All') {

				$this->data['shopitem'] = Shoporderlist::orderby('id', 'desc')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();
				$this->data['shopkg'] = Shoporderlist::select('weight')->orderby('id', 'desc')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get()->sum('weight');
				$this->data['teleitem'] = Teleorderlist::orderby('id', 'desc')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();
				$this->data['telekg'] = Teleorderlist::select('weight')->orderby('id', 'desc')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get()->sum('weight');
				$this->data['itemname'] = $request->itemname2;
				$this->data['totalkg'] = $this->data['shopkg'] + $this->data['telekg'];
			} else {

				$this->data['shopitem'] = Shoporderlist::where('itemname', $request->itemname2)->orderby('id', 'desc')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();
				$this->data['shopkg'] = Shoporderlist::where('itemname', $request->itemname2)->select('weight')->orderby('id', 'desc')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get()->sum('weight');
				$this->data['teleitem'] = Teleorderlist::where('itemname', $request->itemname2)->orderby('id', 'desc')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();
				$this->data['telekg'] = Teleorderlist::where('itemname', $request->itemname2)->select('weight')->orderby('id', 'desc')->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get()->sum('weight');
				$this->data['itemname'] = $request->itemname2;
				$this->data['totalkg'] = $this->data['shopkg'] + $this->data['telekg'];
			}
			$this->data['itemcount'] = $request->itemcount2;
			return view('pdf.report.itempdf', $this->data);
		} else {
			return redirect()->route('itemreport');
		}
	}

	//--------------------------------------------------------

}
