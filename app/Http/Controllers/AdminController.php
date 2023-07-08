<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usermanage;
use App\Shop;
use App\Item;
use App\Telebookorder;
use App\Shopbookorder;
use App\Teleorderlist;
use App\Shoporderlist;
use App\Assign_godawn;
use App\Godawn_user;
use App\Godawn;
use App\Assign_area;
use App\Area_master;

use App\App_cancel_order;
use Hash, DB, Session;
use Carbon\Carbon;


class AdminController extends Controller
{
	//
	public function login()
	{
		//Usermanage::find(1)->update(['password'=>Hash::make('12345')]);
		// Usermanage::create([
		// 	'email'=>'testuser@gmail.com',
		// 	'username'=>'testuser',
		// 	'role'=>6,
		// 	'master'=>0,
		// 	'shop'=>0,
		// 	'telecaller'=>0,
		// 	'report'=>0,
		// 	'uniqueprefix'=>'abc',

		// 	'password'=>Hash::make(123456)
		// ]);
		return view('login');
	}
	
	public function checklogin(Request $request)
	{
		$user = Usermanage::where(['username' => $request->username])->first();
		if ($user && Hash::check($request->password, $user->password)) {
			$request->session()->put('userdata', $user);
			$roledata = Session::get('userdata');
			if ($roledata['role'] == 2) {
				$shopinfo = Shop::where('userid', $roledata['id'])->first();
				session::put('shopinfo', $shopinfo);
			}
			if ($roledata['role'] == 1) {
				return redirect()->route('home');
			}
			if ($roledata['role'] == 2 && $roledata['shop'] == 1 || $roledata['role'] == 1) {
				return redirect()->route('generateorder');
			}
			if ($roledata['role'] == 3 && $roledata['telecaller'] == 1 || $roledata['role'] == 1) {
				return redirect()->route('bookorder');
			}
			if ($roledata['role'] == 5 || $roledata['role'] == 1) {
				return redirect()->route('godowntogodown');
			} 
			if ($roledata['role'] == 6 || $roledata['role'] == 1) {
				return redirect()->route('item-master');
			} 
			else {
				return redirect()->route('login');
			}
		} else {
			return redirect()->route('login')->with('error', 1);
		}
	}
	public function logout(Request $request)
	{
		session()->forget('userdata');
		session()->forget('shopinfo');

		return redirect()->route('login');
	}

	public function usermanage()
	{

		$user = Session::get('userdata');
		if ($user['role'] == 1) {
			$this->data['user'] = Usermanage::where('role', '>', '1')->where('role', '<', '4')->get();
			return view('Admin/usermanage', $this->data);
		} else {
			return redirect()->route('generateorder');
		}
	}
	public function addusermanagement(Request $request)
	{

		$x =  Usermanage::create([
			'username' => $request['username'],
			'uniqueprefix' => $request['uniqueprefix'],
			'password' => Hash::make($request->password),
			'email' => $request['email'],
			'shop' => $request['shop'],
			'telecaller' => $request['telecaller'],
			'report' => $request['report'],
			'master' => $request['master'],
			'role' => $request['usertype'],

		]);
		if ($request->usertype == '2') {

			$y =  Shop::create([
				'shopname' => $request['shopname'],
				'masterid' => 1,
				'userid' => $x['id'],
				'address' => $request['address'],
				'opening_birds' => $request['opening_birds'],
				'birds_weights' => $request['birds_weights'],
			]);
		}
		$successcode = 'success';
		return redirect()->route('usermanage')->with('successcode', $successcode);
	}
	public function editusermanage(Request $request)
	{
		$this->data['user'] = Usermanage::where('role', '>', '1')->where('role', '<', '4')->get();
		$this->data['singleuser'] = Usermanage::where('id', $request->id)->first();
		return view('Admin/editusermanage', $this->data);
	}
	public function updateusermanage(Request $request)
	{
		// echo json_encode($request);
		// exit();

		$x =  Usermanage::where('id', $request->id)->update([
			'username' => $request['username'],
			'email' => $request['email'],
			'uniqueprefix' => $request['uniqueprefix'],

			'shop' => $request['shop'],
			'telecaller' => $request['telecaller'],
			'report' => $request['report'],
			'master' => $request['master'],

		]);
		$successcode = 'update';
		return redirect()->route('usermanage')->with('successcode', $successcode);
	}
	public function deleteusermanage(Request $request)
	{
		$y = Shop::where('userid', $request->id)->first();
		$x = Usermanage::where('id', $request->id)->delete();
		Shop::where('userid', $request->id)->delete();
		Assign_area::where('shop_id', $y['id'])->delete();
		Area_master::where('shop_id', $y['id'])->update(['shop_id' => 0]);
		echo json_encode($request->id);
	}
	public function home()
	{
		$user = Session::get('userdata');
		if ($user['role'] == 1) {
			$this->data['totalteleorder'] = Telebookorder::where('orderfrom', 'telecaller')->count();
			$this->data['apporder'] = Telebookorder::where('orderfrom', 'app')->count();
			$this->data['totalshoporder'] = DB::table('shopbookorders')->count();
			$this->data['totalcancelorder'] = App_cancel_order::count();
			$this->data['totalordercomplete'] = Telebookorder::where('collectedcash', '>', '0')->count();

			$shopdiscount = Shopbookorder::select('discount')->sum('discount');
			$teleamount = Telebookorder::select('amount')->where('paidstatus', '1')
				->where('user_id', null)->sum('amount');
			$telecashcollected = Telebookorder::select('collectedcash')->where('user_id', null)->where('collectedcash', '>', 0)
				->get()->sum('collectedcash');
			$this->data['shopdiscount'] = $shopdiscount;
			$this->data['telediscount'] = $teleamount - $telecashcollected;
			$this->data['discount'] = ($teleamount - $telecashcollected) + $shopdiscount;
			

			$averagetime = Telebookorder::select('timetaken')->where('user_id', null)->where('assignto', '!=', 'null')->orderby('id','desc')->take(200)->get();
			
			$totaldeliverorder = Telebookorder::select('timetaken')->where('user_id', null)->where('assignto', '!=', 'null')->where('timestatus', 1)->count();
			//$totaldeliverorder=count($totaldeliverorder);
			//echo $totaldeliverorder;
			// echo json_encode($this->data['averagetime']);
			// exit();
			$h = 0;
			$m = 0;
			$s = 0;
			foreach ($averagetime as $t) {
				$a = explode(':', $t['timetaken']);
				$h = $h + $a[0];
				$m = $m + $a[1];
				$s = $s + $a[2];
			}
			
			$this->data['shoptotalcollection'] = Shopbookorder::select('amount')->sum('amount');
			$this->data['teletotalcollection'] = Telebookorder::select('amount')->where('paidstatus', 1)
				->where('user_id', null)->sum('amount');
			$totaltimeinsec = ($h * 3600) + ($m * 60) + $s;
			if ($totaltimeinsec > 0) {
				$this->data['totalaveragetime'] = gmdate('H:i:s', $totaltimeinsec / $totaldeliverorder);
			} else {
				$this->data['totalaveragetime'] = 0;
			}
			
				return view('home', $this->data);
		}
		if ($user['role'] == 2) {
			return redirect()->route('generateorder');
		}
		if ($user['role'] == 3) {
			return redirect()->route('bookorder');
		} else {
			return redirect()->route('login');
		}
	}
	public function getitemarray()
	{
		$this->data['totalitem'] = Item::select('itemname')->get();
		$itemdataarray = array();
		$n = 0;
		foreach ($this->data['totalitem'] as $item) {

			//echo $item['itemname'];
			$itemdataarray[$n] =
				([
					'itemname' => $item['itemname'],
					'weight' => (Shoporderlist::select('weight')->where('itemname', $item['itemname'])->sum('weight')) + (Teleorderlist::select('weight')->where('itemname', $item['itemname'])->sum('weight'))
				]);

			$n++;
		}
		$this->data['itemdataarray'] = $itemdataarray;
		echo json_encode($this->data['itemdataarray']);
	}
	public function checkuniqueprefixuser(Request $request)
	{
		$data = Usermanage::select('uniqueprefix')->where('uniqueprefix', $request->value)->first();
		if ($data != null) {

			echo json_encode($data);
		} else {
			echo json_encode(1);
		}
	}
	public function changepassword()
	{
		return view('changepassword');
	}
	public function updatepassword(Request $request)
	{
		$session = Session::get('userdata');
		$data = Usermanage::where('id', $session['id'])->first();
		if (Hash::check($request->oldpassword, $data['password'])) {

			$update = Usermanage::where('id', $data['id'])->update([
				'password' => Hash::make($request->password)

			]);
			$successcode = 'success';

			return redirect()->route('changepassword')->with('successcode', $successcode);
		} else {

			$successcode = 'error';
			return redirect()->route('changepassword')->with('successcode', $successcode);
		}
	}
	public function databackup()
	{
		$con = mysqli_connect('localhost', 'amrutah_amruta', 'TVBvdYshdH0G', 'amrutah_amruta');

		$tables = array();

		$result = mysqli_query($con, "SHOW TABLES");
		while ($row = mysqli_fetch_row($result)) {
			$tables[] = $row[0];
		}

		$return = '';

		foreach ($tables as $table) {
			$result = mysqli_query($con, "SELECT * FROM " . $table);
			$num_fields = mysqli_num_fields($result);

			$return .= 'DROP TABLE ' . $table . ';';
			$row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE ' . $table));
			$return .= "\n\n" . $row2[1] . ";\n\n";

			for ($i = 0; $i < $num_fields; $i++) {
				while ($row = mysqli_fetch_row($result)) {
					$return .= 'INSERT INTO ' . $table . ' VALUES(';
					for ($j = 0; $j < $num_fields; $j++) {
						$row[$j] = addslashes($row[$j]);
						if (isset($row[$j])) {
							$return .= '"' . $row[$j] . '"';
						} else {
							$return .= '""';
						}
						if ($j < $num_fields - 1) {
							$return .= ',';
						}
					}
					$return .= ");\n";
				}
			}
			$return .= "\n\n\n";
		}

		$date = date('d-m-y-h-i-s');
		$handle = fopen('databasebackup/amrutabackup-' . $date . '.sql', 'w+');
		$a = fwrite($handle, $return);

		fclose($handle);
		$file = "databasebackup/amrutabackup-$date.sql";

		$headers = array(
			'Content-Type: application/sql',
		);

		return response()->download($file, 'amrutbackup-' . $date . '.sql', $headers);

		//return redirect()->back()->with('databasemsg','1');

	}

	public function assign_godawn()
	{

		$this->data['data'] = DB::table('usermanages')->join('assign_godawns', 'assign_godawns.user_id', '=', 'usermanages.id')->where('usermanages.role', 5)->select('usermanages.id', 'usermanages.username', 'assign_godawns.godawns')->get();
		// echo json_encode($this->data['data']);
		// exit();

		$this->data['godawn_user'] = Usermanage::where('role', 5)->select('username', 'id')->get();
		return view('Admin.assign_godawn', $this->data);
	}
	public function add_assign_godawn(Request $request)
	{
		if ($request->updateid > 0) {

			$get = Assign_godawn::select('godawns')->where('user_id', $request->updateid)->first();

			$godawnarray = explode(',', $get->godawns);
			foreach ($godawnarray as $gd) {
				Godawn::where('id', $gd)->update(['assign_status' => 0]);
			}
			$godawnarray = explode(',', $request->idarray);
			foreach ($godawnarray as $gd) {
				$update = Godawn::where('id', $gd)->update(['assign_status' => 1,]);
			}

			Assign_godawn::where('user_id', $request->updateid)->update([
				'godawns' => $request->idarray,
				'user_id' => $request->user_id,
			]);
			return response()->json(2);
		} else {

			$godawnarray = explode(',', $request->idarray);
			foreach ($godawnarray as $gd) {
				$update = Godawn::where('id', $gd)->update(['assign_status' => 1,]);
			}

			Assign_godawn::create([
				'user_id' => $request->user_id,
				'godawns' => $request->idarray,
			]);
			echo json_encode(1);
		}
	}

	public function delete_assign_godawn(Request $request)
	{
		$get = Assign_godawn::select('godawns')->where('user_id', $request->id)->first();
		$godawnarray = explode(',', $get['godawns']);
		foreach ($godawnarray as $gd) {
			Godawn::where('id', $gd)->update(['assign_status' => 0]);
		}
		Assign_godawn::where('user_id', $request->id)->delete();
		echo json_encode(1);
	}

	public function get_edit_assign_godawn(Request $request)
	{
		$getuser = DB::table('usermanages')->join('assign_godawns', 'assign_godawns.user_id', '=', 'usermanages.id')
			->where('usermanages.role', 5)
			->where('usermanages.id', $request->id)
			->select('usermanages.id', 'usermanages.username', 'assign_godawns.godawns')
			->first();
		echo json_encode($getuser);
	}


	public function godawn_user()
	{
		$this->data['godawn_user'] = DB::table('usermanages')->join('godawn_users', 'godawn_users.user_id', '=', 'usermanages.id')->where('usermanages.role', 5)->select('usermanages.id as user_id', 'usermanages.username', 'godawn_users.*')->get();
		return view('Admin.godawn_user', $this->data);
	}

	public function add_godawn_user(Request $request)
	{
		if ($request->updateid > 0) {
			$update = Usermanage::where('id', $request->updateid)->update([
				'username' => $request->username,
				'email' => $request->email,

			]);
			Godawn_user::where('user_id', $request->updateid)->update([
				'gtog' => $request->gtog,
				'stos' => $request->stos,
				'stog' => $request->stog,
				'purchase' => $request->purchase,
				'dailyentry' => $request->dailyentry,
				'distribute' => $request->distribute,
				'grn' => $request->grn,
				'daily_supervision' => $request->daily_supervision,
			]);
			return response()->json(2);
		} else {
			$insert = Usermanage::create([
				'username' => $request->username,
				'password' => Hash::make($request->password),
				'email' => $request->email,
				'role' => 5,
			]);
			Godawn_user::create([
				'user_id' => $insert['id'],
				'gtog' => $request->gtog,
				'stos' => $request->stos,
				'stog' => $request->stog,
				'purchase' => $request->purchase,
				'dailyentry' => $request->dailyentry,
				'distribute' => $request->distribute,
				'grn' => $request->grn,
				'daily_supervision' => $request->daily_supervision,
			]);
			return response()->json(1);
		}
	}




	public function delete_godawn_user(Request $request)
	{
		Usermanage::where('id', $request->id)->where('role', 5)->delete();
		Godawn_user::where('user_id', $request->id)->delete();
		return response()->json(1);
	}

	public function edit_godawn_user(Request $request)
	{
		$getuser = DB::table('usermanages')->join('godawn_users', 'godawn_users.user_id', '=', 'usermanages.id')
			->where('usermanages.role', 5)
			->where('usermanages.id', $request->id)
			->select('usermanages.id', 'usermanages.username', 'usermanages.email', 'godawn_users.*')
			->first();
		echo json_encode($getuser);
	}

	public function send_sms(Request $request){		
		$msg = urlencode($request->msg);
		$to = $request->mobile;
		$template_id=$request->template_id;
		 $data1 = "uname=habitm1&pwd=habitm1&senderid=AMFOOD&to=" . $to . "&msg=" . $msg . "&route=T&peid=1001880907683289176&tempid=".$template_id;				
		$ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);					
		return response()->json($result);			
			
}

public function get_shop_dashboard_data(Request $request){
	$producthtml = view('two_day_sale')->render();
	if($request->days==3){
		$producthtml = view('three_day_sale')->render();
	}
		return $producthtml;
	}

}
