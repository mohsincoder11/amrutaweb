<?php

use App\MeterReading;
use App\Shopbookorder;
use App\Shoporderlist;
use Carbon\Carbon;

function checklogins($routename = null)
{

	$userdata = Session::get('userdata');
	if ($userdata != null) {
		echo view($routename);
	} else {
		echo view('login');
	}
}


if (!function_exists('get_meter_reading')) {
	function get_meter_reading($date, $user_id)
	{
		$date = MeterReading::select('reading')->where('user_id', $user_id)->whereDate('created_at', $date)->orderby('id', 'desc')->get();
		//echo json_encode(count($date));
		$reading = '';
		foreach ($date as $key => $d) {
			if (count($date) != $key + 1)
				$reading .= '<b>' . $d->reading . '</b> - ';
			else
				$reading .= '<b>' . $d->reading . '</b>';
		}
		return $reading;
	}
}

if (!function_exists('get_five_days_record')) {
	function get_five_days_record($date1, $date2)
	{
		// $data=Shopbookorder::
		// whereBetween('shopbookorders.created_at',[ Carbon::today()->addDays($date1),Carbon::today()->addDays($date2)])
		// //->select('shopbookorders.masterid')
		// ->groupby('shopbookorders.masterid')
		// ->get();


		$date = Carbon::today()->addDays($date1);
		$date2 = Carbon::today()->addDays($date2);

		$data = DB::select("select s.masterid,sum(amount) as totalamount,shopname,sum(shoporderlists.weight) as totalweight from shopbookorders as s join shops on shops.userid=s.masterid join shoporderlists on shoporderlists.orderid=s.orderid where s.created_at >= '$date' AND s.created_at<= '$date2' group by s.masterid");


		return $data;
	}
	if (!function_exists('get_Shop_amount')) {
		function get_Shop_amount($newid,$date1, $date2)
		{
			$date = Carbon::today()->addDays($date1);
		$date2 = Carbon::today()->addDays($date2);

			$amount = Shopbookorder::with(['shopOrderLists' => function ($query) {
				$query->select('orderid', 'itemname', 'weight')
					->selectRaw("GROUP_CONCAT(itemname SEPARATOR ', ') as items")
					->selectRaw("GROUP_CONCAT(weight SEPARATOR ' KG, ') as weights")
					->groupBy('orderid');
			}])
				->leftJoin('shops', 'shops.userid', '=', 'shopbookorders.masterid')
				->where('shopbookorders.masterid', $newid)
				->where('shopbookorders.created_at', '>=', $date)
				->where('shopbookorders.created_at', '<=', $date2)
				->orderByDesc('shopbookorders.id')
				->select('shops.shopname', 'orderid', 'orderno', 'shopbookorders.id', 'shopbookorders.created_at', 'amount')
				->sum('amount');
			return $amount;
		}
	}
}
