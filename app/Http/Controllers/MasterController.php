<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash, DB, Session;
use App\Customer;
use App\Item;
use App\Shop;
use App\Deliveryboy;
use App\Usermanage;
use App\Godawn;
use App\Vendor;
use App\Unit;
use App\Area_master;
use App\Assign_area;
use App\Time_slot;
use App\Assign_time;
use Helper, File;
use DataTables;
use App\Promotional_images;
use App\CoupanMaster;

class MasterController extends Controller
{
	//
	public function addpromotional_image()
	{
		return view('master.addpromotionalimage');
	}

	public function insert_promo_image(Request $request)
	{
		if ($request->hasFile('image')) {
			$image = $request->file('image');
			$new_name = rand() . '.' . $image->getClientOriginalExtension();
			$image->move(public_path('images/promoimage/'), $new_name);
		}

		$x =  Promotional_images::create([
			'name' => $request['name'],
			'image' => $new_name,


		]);
		$successcode = 'insert';

		return redirect()->route('addpromotional_image')->with('successcode', $successcode);
	}

	public function delete_promo_image(Request $request)
	{
		$data = Promotional_images::find($request->id);
		if ($data) {
			File::delete(public_path('images/promoimage/' . $data['image']));
		}
		Promotional_images::where('id', $request->id)->delete();
		return 1;
	}


	public function addcustomer()
	{
		return view('master/addcustomer');
	}
	public function insertcustomer(Request $request)
	{
		$userdata = Session::get('userdata');
		if ($request['inputmode'] == 'insert') {

			$x =  Customer::create([
				'custtype' => $request['custtype'],
				'masterid' => $userdata['id'],
				'fullname' => $request['fullname'],
				'mobile' => $request['mobile'],
				'altmobile' => $request['altmobile'],
				'address' => $request['address'],

			]);
			$successcode = 'insert';
			return redirect()->route('addcustomer')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$x =  Customer::where('id', $request->updateid)->update([
				'custtype' => $request['custtype'],
				'masterid' => $userdata['id'],
				'fullname' => $request['fullname'],
				'mobile' => $request['mobile'],
				'altmobile' => $request['altmobile'],
				'address' => $request['address'],

			]);
			$successcode = 'update';
			return redirect()->route('addcustomer')->with('successcode', $successcode);
		}
	}
	public function deletecustomer(Request $request)
	{
		$this->data['records'] = Customer::where('id', $request->id)->delete();
		echo json_encode($request->id);
	}
	public function editcustomer(Request $request)
	{
		echo json_encode(Customer::where('id', $request->id)->first());
	}

	public function getallcustomerlist()
	{
		$i = 0;
		$data = DB::table('customers')->select('*');
		return Datatables::of($data)
			->addIndexColumn()

			->addColumn('action', function ($row) {

				$btn = ' <button class="btn btn-primary btn-xs rounded-circle editrecord" id=' . $row->id . ' data-toggle="tooltip-primary" data-placement="top"  title="Edit Record" ><i class="fa fa-edit"></i></button>&nbsp;<a  class="modal-effect btn btn-danger btn-xs rounded-circle delete" data-toggle="modal" data-effect="effect-sign" id=' . $row->id . ' data-toggle="tooltip-danger" title="Delete Record" data-placement="top"><i class="fa fa-trash"></i></a>';

				return $btn;
			})

			->rawColumns(['action'])
			->make(true);
	}
	public function edititem(Request $request)
	{
		echo json_encode(Item::where('id', $request->id)->first());
	}
	public function additem()
	{

		return view('master/additem');
	}
	public function insertitem(Request $request)
	{
		$userdata = Session::get('userdata');

		if ($request['inputmode'] == 'insert') {
			$new_name = 'noimage.jpg';
			if ($request->hasFile('image')) {
				$image = $request->file('image');
				$new_name = rand() . '.' . $image->getClientOriginalExtension();
				$image->move(public_path('images/itemimage/'), $new_name);
			}

			$x =  Item::create([
				'masterid' => $userdata['id'],
				'itemname' => strtoupper($request['itemname']),
				'retailrate' => $request['retailrate'],
				'hotelrate' => $request['hotelrate'],
				'type' => $request['type'],
				'stock' => 1,
				'image' => $new_name,


			]);
			$successcode = 'insert';

			return redirect()->route('additem')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$data = Item::find($request->updateid);
			$new_name = $data['image'];
			if ($request->hasFile('image')) {
				if ($data['image'] != 'noimage.jpg') {
					File::delete(public_path('images/itemimage/' . $data['image']));
				}

				$image = $request->file('image');
				$new_name = rand() . '.' . $image->getClientOriginalExtension();
				$image->move(public_path('images/itemimage/'), $new_name);
			}


			$x =  Item::where('id', $request->updateid)->update([
				'masterid' => $userdata['id'],
				'itemname' => strtoupper($request['itemname']),
				'retailrate' => $request['retailrate'],
				'hotelrate' => $request['hotelrate'],
				'type' => $request['type'],
				'image' => $new_name,

			]);
			$successcode = 'update';

			return redirect()->route('additem')->with('successcode', $successcode);
		}
	}
	public function update_stock(Request $request)
	{
		$x =  Item::where('id', $request->id)->update([
			'stock' => $request['stock'],
		]);
		return response()->json(1);
	}
	public function deleteitem(Request $request)
	{
		$data = Item::find($request->id);
		File::delete(public_path('images/itemimage/' . $data['image']));

		$this->data['records'] = Item::where('id', $request->id)->delete();
		echo json_encode($request->id);
	}
	public function getallitemlist()
	{
		return response()->json(DB::table('items')->get());
	}

	public function getallshop()
	{
		return response()->json(DB::table('shops')->get());
	}
	public function addshop()
	{
		return view('master/addshop');
	}


	public function editshop(Request $request)
	{
		echo json_encode(shop::where('id', $request->id)->first());
	}
	public function updateshop(Request $request)
	{
		$x =  Shop::where('id', $request->updateid)->update([
			'shopname' => $request['shopname'],
			'address' => $request['address'],
			'lat_long' => $request['lat_long'],
			'opening_birds' => $request['opening_birds'],
			'birds_weights' => $request['birds_weights'],


		]);
		$successcode = 'update';

		return redirect()->route('addshop')->with('successcode', $successcode);
	}

	//delivery boy


	public function deliveryboy()
	{
		return view('master/deliveryboy');
	}
	public function check_deliveryboy_no(Request $request)
	{
		$exist = DB::table('deliveryboys')->where('mobile', $request->mobile)->first();
		if ($exist) {
			return response()->json(1);
		} else {
			return response()->json(0);
		}
	}
	public function insertdeliveryboy(Request $request)
	{
		$userdata = Session::get('userdata');
		if ($request['inputmode'] == 'insert') {
			$x =  Deliveryboy::create([
				'masterid' => $userdata['id'],
				'name' => $request['name'],
				'mobile' => $request['mobile'],
				'address' => $request['address'],

			]);
			$successcode = 'insert';

			return redirect()->route('deliveryboy')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$x =  Deliveryboy::where('id', $request->updateid)->update([
				'name' => $request['name'],
				'mobile' => $request['mobile'],
				'address' => $request['address'],
			]);
			$successcode = 'update';

			return redirect()->route('deliveryboy')->with('successcode', $successcode);
		}
	}
	public function getalldeliveryboylist()
	{
		return response()->json(DB::table('deliveryboys')->get());
	}
	public function deletedeliveryboy(Request $request)
	{
		$this->data['records'] = Deliveryboy::where('id', $request->id)->delete();
		echo json_encode($request->id);
	}
	public function editdeliveryboy(Request $request)
	{
		$data = Deliveryboy::where('id', $request->id)->first();
		echo json_encode($data);
	}
	public function view_meter_report(Request $request)
	{
		$name=Deliveryboy::where('id', $request->user_id)->pluck('name')->first();
		
	
		return view('master.meter_report',compact('name'));
	}

	public function get_meter_report(Request $request){
		$report = DB::table('meter_reading')->select(DB::raw('DATE(created_at) as date'),'id','vehicle_no','reading','created_at','file','user_id')->where('user_id', $request->user_id)->orderby('id','desc')
		->groupBy('date')->get();

		$result = [
            "draw"            => $params['draw'],
            "recordsTotal"    => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ];

        return response()->json($result);
	}

	public function checkuniqueprefix(Request $request)
	{
		$data = Shop::select('uniqueprefix')->where('uniqueprefix', $request->value)->first();
		if ($data != null) {

			echo json_encode($data);
		} else {
			echo json_encode(1);
		}
	}
	//-----------------
	public function addgodawn()
	{
		return view('master/addgodown');
	}
	public function getgodawn()
	{
		return response()->json(DB::table('godawns')->get());
	}
	public function insertgodawn(Request $request)
	{
		if ($request['inputmode'] == 'insert') {
			$x =  Godawn::create([
				'pername' => $request['pername'],
				'godawnname' => $request['godawnname'],
				'geolocation' => $request['geolocation'],
				'capacity' => $request['capacity'],
				'address' => $request['address'],
				'birds_weights' => $request['birds_weights'],
				'opening_birds' => $request['opening_birds'],
				'mobno' => $request['mobno'],
				'assign_status' => 0,

			]);
			$successcode = 'insert';

			return redirect()->route('addgodawn')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$x =  Godawn::where('id', $request->updateid)->update([
				'pername' => $request['pername'],
				'godawnname' => $request['godawnname'],
				'geolocation' => $request['geolocation'],
				'capacity' => $request['capacity'],
				'birds_weights' => $request['birds_weights'],
				'opening_birds' => $request['opening_birds'],
				'address' => $request['address'],
				'mobno' => $request['mobno'],

			]);
			$successcode = 'update';

			return redirect()->route('addgodawn')->with('successcode', $successcode);
		}
	}
	public function editgodawn(Request $request)
	{
		echo json_encode(Godawn::where('id', $request->id)->first());
	}
	public function deletegodawn(Request $request)
	{
		$data = Godawn::where('id', $request->id)->delete();
		echo json_encode($data);
	}
	//----------------
	public function addvendor()
	{
		return view('master/addvendor');
	}
	public function getvendor()
	{
		return response()->json(DB::table('vendors')->get());
	}
	public function insertvendor(Request $request)
	{
		if ($request['inputmode'] == 'insert') {
			$x =  Vendor::create([
				'name' => $request['name'],
				'geolocation' => $request['geolocation'],
				'capacity' => $request['capacity'],
				'address' => $request['address'],
				'mobno' => $request['mobno'],
				'email' => $request['email'],
				'pan' => $request['pan'],
				'bankname' => $request['bankname'],
				'accno' => $request['accno'],
				'ifsccode' => $request['ifsccode'],
				'shedsize' => $request['shedsize'],
				'distance' => $request['distance'],

			]);
			$successcode = 'insert';

			return redirect()->route('addvendor')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$x =  Vendor::where('id', $request->updateid)->update([
				'name' => $request['name'],
				'geolocation' => $request['geolocation'],
				'capacity' => $request['capacity'],
				'address' => $request['address'],
				'mobno' => $request['mobno'],
				'email' => $request['email'],
				'pan' => $request['pan'],
				'bankname' => $request['bankname'],
				'accno' => $request['accno'],
				'ifsccode' => $request['ifsccode'],
				'shedsize' => $request['shedsize'],
				'distance' => $request['distance'],

			]);
			$successcode = 'update';

			return redirect()->route('addvendor')->with('successcode', $successcode);
		}
	}
	public function editvendor(Request $request)
	{
		echo json_encode(Vendor::where('id', $request->id)->first());
	}
	public function deletevendor(Request $request)
	{
		$data = Vendor::where('id', $request->id)->delete();
		echo json_encode($data);
	}
	//-----------------
	public function addunit()
	{
		return view('master/addunit');
	}
	public function getunit()
	{
		return response()->json(DB::table('units')->select('id', 'unittype')->get());
	}
	public function insertunit(Request $request)
	{
		if ($request['inputmode'] == 'insert') {
			$x =  Unit::create([
				'unittype' => $request['unittype'],
			]);
			$successcode = 'success';

			return redirect()->route('addunit')->with('successcode', $successcode);
		}
		if ($request['inputmode'] == 'update') {
			$x =  Unit::where('id', $request->updateid)->update([
				'unittype' => $request['unittype'],
			]);
			$successcode = 'update';

			return redirect()->route('addunit')->with('successcode', $successcode);
		}
	}
	public function editunit(Request $request)
	{
		$data = Unit::where('id', $request->id)->first();
		echo json_encode($data);
	}
	public function deleteunit(Request $request)
	{
		$data = Unit::where('id', $request->id)->delete();
		echo json_encode($data);
	}
	//----------------- Api
	//item type 1 for regular,2 for offer,3 for bgrade,4 for pet food
	public function getallitem()
	{
		$data = Item::get();
		echo json_encode($data);
	}
	public function addarea()
	{
		return view('master/addarea');
	}
	public function insert_area(Request $request)
	{
		if ($request->updateid > 0) {
			$get = Area_master::select('shop_id')->where('id', $request->updateid)->first();
			Area_master::where('shop_id', $request->shop_id)->update(['shop_id' => 0]);
			Shop::where('id', $get['shop_id'])->update(['assign_status' => 0]);
			Shop::where('id', $request->shop_id)->update(['assign_status' => 1]);
			Area_master::where('id', $request->updateid)
				->update([
					'area' => strtoupper($request->area),
					'shop_id' => $request->shop_id,
				]);
			return redirect()->route('addarea')->with('successcode', 2);
		} else {

			$create = Area_master::create([
				'area' => strtoupper($request->area),
				'shop_id' => 0,

			]);
			return redirect()->route('addarea')->with('successcode', 1);
		}
	}
	public function get_all_area()
	{
		$data = DB::table('area_masters')
			->leftjoin('shops', 'shops.id', '=', 'area_masters.shop_id')
			->select('shops.shopname', 'area_masters.*')
			->get();
		return response()->json($data);
	}
	public function get_single_area(Request $request)
	{
		return response()->json(Area_master::find($request->id));
	}
	public function delete_area(Request $request)
	{
		return response()->json(DB::table('area_masters')->delete($request->id));
	}

	public function assign_area()
	{
		$this->data['assign_areas_data'] = DB::table('assign_areas')->join('shops', 'assign_areas.shop_id', '=', 'shops.id')
			->select('shops.shopname', 'assign_areas.id', 'assign_areas.assign_area')->get();
		return view('master/assign_area', $this->data);
	}
	public function get_single_assign_area(Request $request)
	{
		return response()->json(Assign_area::find($request->id));
	}

	public function delete_assign_area(Request $request)
	{
		$data = Assign_area::select('shop_id')->find($request->id);
		Area_master::where('shop_id', $data->shop_id)->update(['shop_id' => 0]);
		Shop::where('id', $data->shop_id)->update(['assign_status' => 0]);

		return response()->json(DB::table('assign_areas')->delete($request->id));
	}


	public function insert_assign_area(Request $request)
	{
		if ($request->updateid > 0) {
			$get = Assign_area::find($request->updateid);
			Shop::where('id', $get->shop_id)->update(['assign_status' => 0]);

			Area_master::where('shop_id', $request->shop_id)->update(['shop_id' => 0]);
			Shop::where('id', $request->shop_id)->update(['assign_status' => 1]);

			Assign_area::where('id', $request->updateid)->update([
				'shop_id' => $request->shop_id,
				'assign_area' => $request->assign_area,
			]);
			$assign_area = explode(',', $request->assign_area);
			foreach ($assign_area as $aa) {
				$update = Area_master::where('id', $aa)->update(['shop_id' => $request->shop_id]);
			}
			echo json_encode(2);
		} else {
			Shop::where('id', $request->shop_id)->update(['assign_status' => 1]);
			Assign_area::create([
				'shop_id' => $request->shop_id,
				'assign_area' => $request->assign_area,
			]);
			$assign_area = explode(',', $request->assign_area);
			foreach ($assign_area as $aa) {
				$update = Area_master::where('id', $aa)->update(['shop_id' => $request->shop_id]);
			}
			echo json_encode(1);
		}
	}
	public function check_area_assign(Request $request)
	{
		$shop_id = Area_master::select('shop_id')->where('id', $request->id)->first();
		echo json_encode($shop_id['shop_id']);
	}
	public function time_slot(Request $request)
	{
		return view('master.time_slot');
	}

	public function add_time_slot(Request $request)
	{
		$time = explode(',', $request->time_assign);
		Assign_time::where('day', $request->day)->delete();
		foreach ($time as $t) {
			Assign_time::create([
				'time' => $t,
				'day' => $request->day,
			]);
		}
		return response()->json(1);
	}
	public function delete_time_slot(Request $request)
	{
		Assign_time::where('time_slot_id', $request->id)->delete();
		return response()->json(1);
	}
	public function edit_time_slot(Request $request)
	{

		return response()->json(Assign_time::where('day', $request->day)->get());
	}
	public function day_status(Request $request)
	{
		Time_slot::where('id', $request->id)->update(['status' => $request->status,]);
		return response()->json(1);
	}

	//-Master controller

	public function coupon_master()
	{
		$data['coupon'] = CoupanMaster::orderby('id', 'desc')->get();
		return view('master.coupon_master', $data);
	}
	public function insert_coupon(Request $request)
	{
		$request->updateid ? $successcode = "update" : $successcode = "insert";
		$x = CoupanMaster::updateorcreate([
			'id' => $request->updateid
		], [
			'title' => $request->title,
			'min_amount' => $request->min_amount,
			'max_discount' => $request->max_discount,
			'coupon_code' => strtoupper($request->coupon_code),
			'discount_percent' => $request->discount_percent,
			'status' => 1,
		]);
		return redirect()->route('coupon_master')->with('successcode', $successcode);
	}

	public function delete_coupon(Request $request)
	{
		$x = CoupanMaster::where('id', $request->id)->delete();
		return response()->json(1);
	}
	public function edit_coupon(Request $request)
	{
		return response()->json(CoupanMaster::find($request->id));
	}
	public function update_coupon_status(Request $request)
	{
		$x =  CoupanMaster::where('id', $request->id)->update([
			'status' => $request['status'],
		]);
		return response()->json(1);
	}
}
