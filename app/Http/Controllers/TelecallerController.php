<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Shop;
use App\Customer;
use App\Telebookorder;
use App\Teleorderlist;
use App\Deliveryboy;
use Session, DB;
use App\App_order;


class TelecallerController extends Controller
{

	public function bookorder()
	{
		$userdata = session::get('userdata');
		//echo $uniqueprefix;
		//exit();

		if ($userdata['telecaller'] == 1) {
			$uniqueprefix = $userdata['uniqueprefix'];

			$this->data['item'] = Item::where('type',1)->get();
			$this->data['shop'] = Shop::get();
			$this->data['count'] = Telebookorder::where('orderfrom','telecaller')->first();
			// $joindata=DB::table('teleorderlists')->leftjoin('telebookorders','telebookorders.orderid','=','teleorderlists.orderid')->where('telebookorders.orderid','=',null)->delete();


			$data = Telebookorder::orderBy('created_at', 'desc')->where('orderfrom','telecaller')->first();
			//exit();
			if ($this->data['count']) {
				$count = Telebookorder::where('orderfrom','telecaller')->whereRaw('MONTH(created_at) = ?', date('m'))
					->orderBy('id', 'desc')->first();

				//echo $a;
				if ($count == null) {
					$this->data['randno'] = 'AFCT' . '/' . $uniqueprefix . '-' . date('m') . '/' . date('y') . '/' . '001';
				} else {

					$oldorderno = substr($data['orderno'], 15);
					$plusno = $oldorderno + 1;
					$newno = str_pad($plusno, 3, '0', STR_PAD_LEFT);
					$this->data['randno'] = 'AFCT' . '/' . $uniqueprefix . '-' . date('m') . '/' . date('y') . '/' . $newno;
				}
			} else {
				$this->data['randno'] = 'AFCT' . '/' . $uniqueprefix . '-' . date('m') . '/' . date('y') . '/' . '001';
			}
			// echo json_encode($this->data['randno']);
			// exit();
			return view('Telecaller/bookorder', $this->data);
		} else {
			return redirect()->route('login');
		}
	}
	public function teleorder()
	{

		$userdata = session::get('userdata');

		if ($userdata['role'] == 1) {
			$otherdata = DB::table('telebookorders')->leftjoin('shops', 'shops.id', '=', 'telebookorders.shopname')
				->select('telebookorders.*', 'shops.shopname')
				->where('telebookorders.orderfrom','telecaller')
				->whereRaw('DATE(telebookorders.created_at) = ?', date('Y-m-d'))
				->orderby('telebookorders.id', 'desc')->get();
		} else {

			$otherdata = DB::table('telebookorders')->leftjoin('shops', 'shops.id', '=', 'telebookorders.shopname')
				->select('telebookorders.*', 'shops.shopname')
				->where('telebookorders.masterid', $userdata['id'])
				->where('telebookorders.orderfrom','telecaller')
				->whereRaw('DATE(telebookorders.created_at) = ?', date('Y-m-d'))
				->orderby('telebookorders.id', 'desc')->get();
		}
		//exit();
		$currenttime = date('Y-m-d H:i:s');
		$hr = array();
		$min = array();
		$sec = array();
		$i = 0;
		foreach ($otherdata as $o) {
			$a = date('Y-m-d H:i:s', strtotime($o->created_at));
			$diff = date_diff(date_create($currenttime), date_create($a));
			$hr[$i] = $diff->format("%H");
			$min[$i] = $diff->format("%I");
			$sec[$i] = $diff->format("%S");


			$i++;
		}
		$this->data['ordertime_hr'] = $hr;
		$this->data['ordertime_min'] = $min;
		$this->data['ordertime_sec'] = $sec;


		if ($userdata['telecaller'] == 1) {
			if ($userdata['role'] == 1) {

				$this->data['teleorderlist'] = Teleorderlist::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
				
				->get();
			} else {

				$this->data['teleorderlist'] = Teleorderlist::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
				->where('masterid', $userdata['id'])->get();
			}
			$this->data['teleorder'] = $otherdata;
			return view('Telecaller/teleorder', $this->data);
		} else {
			return redirect()->route('login');
		}
	}
	public function getamount(Request $request)
	{
		$this->data['amount'] = Item::where('id', $request->id)->first();
		echo json_encode($this->data['amount']);
	}
	public function getcustomer(Request $request)
	{
		$this->data['customer'] = Customer::where('id', $request->id)->first();
		echo json_encode($this->data['customer']);
	}
	public function getallcustomer()
	{
		$this->data['customer'] = DB::table('customers')->where('custtype', 'Person')->get();
		echo json_encode($this->data['customer']);
	}
	public function getallhotel()
	{
		$this->data['customer'] = Customer::where('custtype', 'Hotel')->get();
		echo json_encode($this->data['customer']);
	}
	public function checkmobileno(Request $request)
	{
		$this->data['customer'] = Customer::where('mobile', $request->mobile)->first();
		echo json_encode($this->data['customer']);
	}
	public function addteleorderrow(Request $request)
	{
		if ($request->orderid == '') {
			$getsingle = Teleorderlist::select('id')->orderBy('id', 'desc')->first();
			if ($getsingle != '') {
				$orderid = $getsingle['id'] + 1;
			} else {
				$orderid = 1;
			}
		} else {
			$orderid = $request->orderid;
		}
		$userdata = Session::get('userdata');
		$insert = Teleorderlist::create([
			'itemname' => $request['itemname'],
			'weight' => $request['weight'],
			'rate' => $request['rate'],
			'masterid' => $userdata['id'],
			'orderid' => $orderid,
			'orderfrom'=>'telecaller',
		]);
		echo json_encode(Teleorderlist::where('orderid', $orderid)->get());
	}
	public function insertteleorder(Request $request)
	{
		$data = session::get('userdata');
		// echo json_encode($orderlistdata);
		// exit();
		if ($request->custpresent != 1) {
			$x =  Customer::create([
				'custtype' => 'Person',
				'masterid' => $data['id'],
				'fullname' => $request['fullname'],
				'mobile' => $request['mobile'],
				'altmobile' => $request['altmobile'],
				'address' => $request['address'],

			]);
		}


		$x =  Telebookorder::create([
			'masterid' => $data['id'],
			'orderdate' => date('Y-m-d'),
			'orderno' => $request['orderno'],
			'orderid' => $request['orderid'],
			'custname' => $request['fullname'],
			'mobile' => $request['mobile'],
			'altmobile' => $request['altmobile'],
			'details' => $request['details'],
			'shopname' => $request['shopname'],
			'address' => $request['address'],
			'mop' => $request['mop'],
			'timetaken' => '00:00:00',
			'paidstatus' => '0',
			'timestatus' => '0',
			'status' => '0',
			'collectedcash' => '0',
			'orderfrom' => 'telecaller',			
			'assignto' => 'null',
			'amount' => $request['amount'],
			'delivery_charge'=>$request['delivery_charge'],

		]);
		echo json_encode(1);
	}
	public function deleteteleorderrow(Request $request)
	{
		$delete = Teleorderlist::where('id', $request->id)->delete();
		echo json_encode(Teleorderlist::where('orderid', $request->orderid)->get());
	}
	public function deleteallteleorderrow(Request $request)
	{
		$delete = Teleorderlist::where('orderid', $request->orderid)->delete();
		echo json_encode(1);
	}
	public function printdemo()
	{
		return view('pdf/printbill3');
	}

	public function tele_app_orders()
	{
		$this->data['delivery_charge']=10;		
		$this->data['apporder'] = Telebookorder::whereRaw('DATE(created_at) = ?', date('Y-m-d'))
		->where('orderfrom','app')->orderby('id', 'desc')->get();
		return view('Telecaller.tele_app_orders', $this->data);
	}
}
