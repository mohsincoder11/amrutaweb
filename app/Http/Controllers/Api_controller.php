<?php

namespace App\Http\Controllers;

use App\Usermanage;
use App\Godawn_user;
use App\Godawn;
use App\Vendor;
use App\Grnrow;
use App\Grn;
use App\Purchase;
use App\Dailysuper;
use App\Distribute;
use App\Dailyentry;
use App\Gtog;
use App\Stos;
use App\Stog;
use Illuminate\Http\Request;
use App\App_user;
use App\Area_master;
use App\App_orderlist;
use App\Wallet;
use App\App_cancel_order;
use App\Item;
use App\Shop;
use App\Assign_time;
use App\Deliveryboy;
use App\Telebookorder;
use App\Shoporderlist;
use App\Shopbookorder;
use App\Teleorderlist;
use App\Time_slot;
use AppOrder;
use File, Hash, DB, Http;
use Razorpay\Api\Api;
use App\MeterReading;
use App\Promotional_images;


class Api_controller extends Controller
{
	protected $delivery_charge;
	protected $minimum_cart_value=200;
	public function __construct()
    {
        $this->delivery_charge = env('delivery_charge');
    }

	
	public function get_coupon_api()
	{
		return response()->json(DB::table('coupon-masters')->orderby('id', 'desc')->get());
	}

	public function login_api(Request $request)
	{
		$user_data = App_user::where('mob', $request->mob)->first();
		if ($user_data && Hash::check($request->pass, $user_data->pass)) {
			return response()->json($user_data);
		} else {
			return response()->json('error');
		}
	}

	public function check_mobile_no(Request $request)
	{
		$user_data = App_user::where('mob', $request->mob)->first();
		if ($user_data) {
			return response()->json(1);
		} else {
			return response()->json(0);
		}
	}

	public function send_reguser_otp(Request $request)
	{
		$otp = rand('1000', '9999');
		$msg = "Your OTP verification code for registration is $otp. Amruta Hatcheries & Foods.";
		$msg = urlencode($msg);
		$to = $request->mob;
		$data1 = "uname=habitm1&pwd=habitm1&senderid=AHFPVT&to=" . $to . "&msg=" . $msg . "&route=T&peid=1701170071671948377&tempid=1707170080539227431";
		$ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return response()->json($otp);
	}

	public function forgot_password_otp(Request $request)
	{

		$otp = rand('1000', '9999');
		$msg = "Your OTP verification code for password set or change request is $otp. Amruta Hatcheries & Foods.";
		$msg = urlencode($msg);
		$to = $request->mob;
		$data1 = "uname=habitm1&pwd=habitm1&senderid=AHFPVT&to=" . $to . "&msg=" . $msg . "&route=T&peid=1701170071671948377&tempid=1707170080546502986";
		$ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return response()->json($otp);
	}

	public function update_password_api(Request $request)
	{
		$insert = App_user::where('mob', $request->mob)->update([
			'pass' => Hash::make($request->pass),

		]);
		return response()->json('success');
	}

	public function register_user_api(Request $request)
	{
		if ($request->mob && $request->full_name && $request->email && $request->pass) {

			$insert = App_user::create([
				'mob' => $request->mob,
				'full_name' => $request->full_name,
				'email' => $request->email,
				'pass' => Hash::make($request->pass),
				//	'area_id' => $request->area_id,
				'image' => $request->image,

			]);

			return response()->json(App_user::find($insert->id));
		} else {
			return response()->json('error');
		}
	}

	public function update_user_api(Request $request)
	{
		if ($request->full_name && $request->email && $request->id) {
			$image = App_user::select('image')->where('id', $request->id)->first();
			$new_name = $image['image'];
			if ($image['image'] == 'noimage.png') {
				$new_name = 'noimage.png';
			}
			// if ($request->hasFile('image')) {
			// 	if ($image['image'] != 'noimage.png') {
			// 		File::delete(public_path('register_user_profile/' . $image['image']));
			// 	}
			// 	$image = $request->file('image');
			// 	$new_name = rand() . '.' . $image->getClientOriginalExtension();
			// 	$image->move(public_path('register_user_profile/'), $new_name);
			// }

			if ($request->image != 'null') {
                $extension= explode('/', mime_content_type($request->image))[1];
            $data = base64_decode(substr($request->image, strpos($request->image, ',') + 1));
            $new_name='survey'.rand(000,999). time() . '.' .$extension;
            file_put_contents(public_path('images/') . '/' . $new_name, $data);
            }

			$update = App_user::where('id', $request->id)->update([
				//	'area_id' => $request->area_id,
				//	'address' => $request->address,
				'full_name' => $request->full_name,
				'email' => $request->email,
				'image' => $new_name,
			]);
			return response()->json(App_user::find($request->id));
		} else {
			return response()->json('error');
		}
	}

	public function get_Shop_lat_long()
	{
		return response()->json(Shop::select('id', 'lat_long')->where('lat_long', '!=', null)->get());
	}

	public function get_items_api()
	{
		// $data['regular_product']=Item::select('itemname', 'id', 'retailrate', 'hotelrate', 'image', 'stock')->where('type',1)->orwhere('type',2)->orderby('id', 'asc')->get();
		// $data['offer_product']=Item::select('itemname', 'id', 'retailrate', 'hotelrate', 'image', 'stock')->where('type',2)->orderby('id', 'asc')->get();
		return response()->json(Item::select('itemname', 'id', 'retailrate', 'hotelrate', 'image', 'stock')->where('type', 1)->orderby('id', 'asc')->get());
	}
	
	public function get_items_api_weighing_machine()
	{
		// $data['regular_product']=Item::select('itemname', 'id', 'retailrate', 'hotelrate', 'image', 'stock')->where('type',1)->orwhere('type',2)->orderby('id', 'asc')->get();
		// $data['offer_product']=Item::select('itemname', 'id', 'retailrate', 'hotelrate', 'image', 'stock')->where('type',2)->orderby('id', 'asc')->get();
		return response()->json(
			[
				'items'=>Item::select('itemname', 'id', 'retailrate', 'hotelrate', 'image', 'stock')->where('type', 1)->orderby('id', 'asc')->get(),
				'mobile'=>'7499312963'
			]);
	}
	
	public function get_items_api2()
	{
		$data['regular_product'] = Item::select('itemname', 'id', 'retailrate', 'hotelrate', 'image', 'stock')->where('type', 1)->orwhere('type', 2)->orderby('id', 'asc')->get();
		$data['offer_product'] = Item::select('itemname', 'id', 'retailrate', 'hotelrate', 'image', 'stock')->where('type', 2)->orderby('id', 'asc')->get();
		return response()->json($data);
	}
	public function get_area_api()
	{
		return response()->json(Area_master::select('id', 'area', 'shop_id')->where('shop_id', '>', 0)->orderBy('area', 'ASC')->get());
	}
	public function add_item_to_cart(Request $request)
	{
		$create = Teleorderlist::create([
			'user_id' => $request->user_id,
			'itemname' => $request->item_name,
			'item_id' => $request->item_id,
			'weight' => $request->weight,
			'rate' => round(Item::where('id', $request->item_id)->pluck('retailrate')->first() * $request->weight, 2),
			'orderfrom' => 'app',
			'delivery_status' => 0,
		]);
		$this->data['count'] = Teleorderlist::where('user_id', $request->user_id)
			->where('delivery_status', 0)->count();
		return response()->json($this->data);
	}
	public function add_repeat_order(Request $request)
	{
		$data = DB::table('teleorderlists')->join('items', 'teleorderlists.item_id', '=', 'items.id')
			->select(
				'teleorderlists.item_id',
				'teleorderlists.user_id',
				'teleorderlists.itemname',
				'teleorderlists.weight',
				'teleorderlists.rate',
				'items.image'
			)
			->where('teleorderlists.orderid', $request->order_id)->where('teleorderlists.orderfrom', 'app')
			->orderby('teleorderlists.id', 'desc')->get();
		foreach ($data as $d) {
			$rate = Item::select('retailrate')->where('id', $d->item_id)->first();
			$create = Teleorderlist::create([
				'user_id' => $d->user_id,
				'itemname' => $d->itemname,
				'item_id' => $d->item_id,
				'weight' => $d->weight,
				'rate' => $rate->retailrate * $d->weight,
				'orderfrom' => 'app',
				'delivery_status' => 0,
			]);
		}
		return response()->json(1);
	}

	public function place_order2(Request $request)
	{
		$previous_order = Telebookorder::orderby('id', 'desc')
			->where('orderfrom', 'app')->first();

		if ($previous_order) {
			$monthfirstorder = Telebookorder::whereRaw('MONTH(created_at) = ?', date('m'))
				->where('orderfrom', 'app')->orderBy('id', 'desc')->first();
			if ($monthfirstorder) {
				$oldorderno = substr($previous_order['orderno'], 13);
				$plusno = $oldorderno + 1;
				$newno = str_pad($plusno, 3, '0', STR_PAD_LEFT);
				$order_no = 'AFCAPP' . '-' . date('m') . '/' . date('y') . '/' . $newno;
			} else {
				$order_no = 'AFCAPP-' . date('m') . '/' . date('y') . '/001';
			}
		} else {
			$order_no = 'AFCAPP-' . date('m') . '/' . date('y') . '/001';
		}
		if (
			$request->user_id && $request->cust_name && $request->mobile && $request->address && $request->amount &&
			$request->area_id && $request->mop && $request->time_slot
		) {
			$insert = Telebookorder::create([
				'orderno' => $order_no,
				'orderdate' => date('Y-m-d'),
				'user_id' => $request->user_id,
				'custname' => $request->cust_name,
				'mobile' => $request->mobile,
				'address' => $request->address,
				'lat_long' => $request->lat_long,
				'delivery_charge' => $this->delivery_charge,
				'amount' => $request->amount,
				'area_id' => $request->area_id,
				'mop' => $request->mop,
				'time_slot' => $request->time_slot,
				'status' => '0',
				'orderfrom' => 'app',
				'paidstatus' => $request->paidstatus,
				'details' => $request->details ?? 'NA',
				'timestatus' => '0',
				'collectedcash' => $request->collectedcash,
				'assignto'=>'null'
			]);

			Teleorderlist::where('user_id', $request->user_id)->where('delivery_status', 0)->update([
				'delivery_status' => '1',
				'orderid' => $insert->id,
			]);

			if ($request->usable_wallet_amount > 0 || $request->credit > 0) {
				$total_credit = Wallet::where('user_id', $request->user_id)->select('total_credit')
					->orderby('id', 'desc')->first();

				if ($total_credit) {
					$total_credit = ($total_credit->total_credit - $request->usable_wallet_amount) + $request->credit;
				} else
					$total_credit = 0 + $request->credit;

				//return response()->json(($total_credit['total_credit'] - $request->usable_wallet_amount) + $request->credit);

				Wallet::create([
					'user_id' => $request->user_id,
					'order_id' => $insert->id,
					'credit' => $request->credit ? $request->credit : 0,
					'total_credit' => $total_credit,
					'used_credit' => $request->usable_wallet_amount,
					'status' => 0
				]);
			}

			$msg = "Your order has been successfully placed & will be delivered to you soon. For more details check 'order details' in the app. Amruta Hatcheries & Foods.";
			$msg = urlencode($msg);
			$to = $request->mobile;
			$data1 = "uname=habitm1&pwd=habitm1&senderid=AHFPVT&to=" . $to . "&msg=" . $msg . "&route=T&peid=1701170071671948377&tempid=1707170080554230434";
			$ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);

			return response()->json(1);
		} else {
			return response()->json(0);
		}
	}

	public function place_order(Request $request)
	{
		$previous_order = Telebookorder::orderby('id', 'desc')
			->where('orderfrom', 'app')->first();

		if ($previous_order) {
			$monthfirstorder = Telebookorder::whereRaw('MONTH(created_at) = ?', date('m'))
				->where('orderfrom', 'app')->orderBy('id', 'desc')->first();
			if ($monthfirstorder) {
				$oldorderno = substr($previous_order['orderno'], 13);
				$plusno = $oldorderno + 1;
				$newno = str_pad($plusno, 3, '0', STR_PAD_LEFT);
				$order_no = 'AFCAPP' . '-' . date('m') . '/' . date('y') . '/' . $newno;
			} else {
				$order_no = 'AFCAPP-' . date('m') . '/' . date('y') . '/001';
			}
		} else {
			$order_no = 'AFCAPP-' . date('m') . '/' . date('y') . '/001';
		}
		if (
			$request->user_id && $request->cust_name && $request->mobile && $request->address && $request->amount &&
			$request->area_id && $request->mop && $request->time_slot
		) {
			$insert = Telebookorder::create([
				'orderno' => $order_no,
				'orderdate' => date('Y-m-d'),
				'user_id' => $request->user_id,
				'custname' => $request->cust_name,
				'mobile' => $request->mobile,
				'address' => $request->address,
				'lat_long' => $request->lat_long,
				'delivery_charge' => $this->delivery_charge,
				'amount' => $request->amount,
				'area_id' => $request->area_id,
				'mop' => $request->mop,
				'time_slot' => $request->time_slot,
				'status' => '0',
				'orderfrom' => 'app',
				'paidstatus' => $request->paidstatus,
				'details' => $request->details ?? 'NA',
				'timestatus' => '0',
				'collectedcash' => $request->collectedcash,
				'assignto'=>'null'

			]);
			Teleorderlist::where('user_id', $request->user_id)->where('delivery_status', 0)->update([
				'delivery_status' => '1',
				'orderid' => $insert->id,
			]);


			$msg = "Your order has been successfully placed & will be delivered to you soon. For more details check 'order details' in the app. Amruta Hatcheries & Foods.";
			$msg = urlencode($msg);
			$to = $request->mobile;
			$data1 = "uname=habitm1&pwd=habitm1&senderid=AHFPVT&to=" . $to . "&msg=" . $msg . "&route=T&peid=1701170071671948377&tempid=1707170080554230434";
			$ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);

			return response()->json(1);
		} else {
			return response()->json(0);
		}
	}

	public function place_order3(Request $request)
	{

		$previous_order = Telebookorder::orderby('id', 'desc')
			->where('orderfrom', 'app')->first();

		if ($previous_order) {
			$monthfirstorder = Telebookorder::whereRaw('MONTH(created_at) = ?', date('m'))
				->where('orderfrom', 'app')->orderBy('id', 'desc')->first();
			if ($monthfirstorder) {
				$oldorderno = substr($previous_order['orderno'], 13);
				$plusno = $oldorderno + 1;
				$newno = str_pad($plusno, 3, '0', STR_PAD_LEFT);
				$order_no = 'AFCAPP' . '-' . date('m') . '/' . date('y') . '/' . $newno;
			} else {
				$order_no = 'AFCAPP-' . date('m') . '/' . date('y') . '/001';
			}
		} else {
			$order_no = 'AFCAPP-' . date('m') . '/' . date('y') . '/001';
		}
		if (
			$request->user_id && $request->cust_name && $request->mobile && $request->address && $request->amount && $request->mop && $request->time_slot
		) {
			$check_item = Teleorderlist::where('user_id', $request->user_id)->where('delivery_status', 0)->count();
			if ($check_item > 0) {

				$insert = Telebookorder::create([
					'orderno' => $order_no,
					'orderdate' => date('Y-m-d'),
					'user_id' => $request->user_id,
					'custname' => $request->cust_name,
					'mobile' => $request->mobile,
					'address' => $request->address,
					'lat_long' => $request->lat_lan,
					'delivery_charge' => $this->delivery_charge,
					'amount' => $request->amount,
					'shopname' => $request->shop_id,
					'mop' => $request->mop,
					'time_slot' => $request->time_slot,
					'status' => '0',
					'orderfrom' => 'app',
					'details' => $request->details ?? 'NA',
					'paidstatus' => $request->paidstatus,
					'timestatus' => '0',
					'collectedcash' => $request->collectedcash,
					'assignto'=>'null'

				]);


				Teleorderlist::where('user_id', $request->user_id)->where('delivery_status', 0)->update([
					'delivery_status' => '1',
					'orderid' => $insert->id,
				]);

				if ($request->usable_wallet_amount > 0 || $request->credit > 0) {
					$total_credit = Wallet::where('user_id', $request->user_id)->select('total_credit')
						->orderby('id', 'desc')->first();

					if ($total_credit) {
						$total_credit = ($total_credit->total_credit - $request->usable_wallet_amount) + $request->credit;
					} else
						$total_credit = 0 + $request->credit;

					//return response()->json(($total_credit['total_credit'] - $request->usable_wallet_amount) + $request->credit);

					Wallet::create([
						'user_id' => $request->user_id,
						'order_id' => $insert->id,
						'credit' => $request->credit ? $request->credit : 0,
						'total_credit' => $total_credit,
						'used_credit' => $request->usable_wallet_amount,
						'status' => 0
					]);
				}

				$msg = "Your order has been successfully placed & will be delivered to you soon. For more details check 'order details' in the app. Amruta Hatcheries & Foods.";
				$msg = urlencode($msg);
				$to = $request->mobile;
				$data1 = "uname=habitm1&pwd=habitm1&senderid=AHFPVT&to=" . $to . "&msg=" . $msg . "&route=T&peid=1701170071671948377&tempid=1707170080554230434";
				$ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($ch);
				curl_close($ch);

				return response()->json(1);
			}
		} else {
			return response()->json(0);
		}
	}


	public function remove_item_from_cart(Request $request)
	{
		Teleorderlist::where('id', $request->item_id)->where('orderfrom', 'app')->delete();
		return response()->json(1);
	}

	public function update_item_of_cart(Request $request)
	{
		Teleorderlist::where('id', $request->item_id)->where('orderfrom', 'app')->update([
			'weight' => $request->weight,
			'rate' => $request->rate,
		]);
		return response()->json(1);
	}

	public function view_cart2(Request $request)
	{
		$get = DB::table('teleorderlists')->where('user_id', $request->user_id)->where('delivery_status', 0)->get();
		foreach ($get as $a) {
			$value = Item::select('retailrate', 'id')->where('id', $a->item_id)->first();
			if (!empty($value) && isset($value)) {
				$value2 = $value['retailrate'] * $a->weight;
				Teleorderlist::where('id', $a->id)->where('user_id', $request->user_id)->where('item_id', $value['id'])->where('delivery_status', 0)
					->update([
						'rate' => $value2
					]);
			} else {
				Teleorderlist::where('id', $a->id)->delete();
			}
		}
		$wallet_credit = DB::table('wallets')->select('total_credit')->where('user_id', $request->user_id)
		->where('status',1)->orderby('id', 'desc')->first();
		$data = [
			'cart_item' => DB::table('teleorderlists')
				->join('items', 'teleorderlists.item_id', '=', 'items.id')
				->where('user_id', $request->user_id)->where('delivery_status', 0)
				->where('orderfrom', 'app')
				->select('teleorderlists.*', 'items.image')->orderby('teleorderlists.id', 'desc')->get(),
			'wallet_credit' => $wallet_credit ? $wallet_credit->total_credit : 0,
			'minimum_cart_value'=>$this->minimum_cart_value,
			'delivery_charge'=>$this->delivery_charge,
		];

		return response()->json($data);
	}

	public function view_cart(Request $request)
	{
		$get = DB::table('teleorderlists')->where('user_id', $request->user_id)->where('delivery_status', 0)->get();
		foreach ($get as $a) {
			$value = Item::select('retailrate', 'id')->where('id', $a->item_id)->first();
			$value2 = $value['retailrate'] * $a->weight;
			Teleorderlist::where('user_id', $request->user_id)->where('item_id', $value['id'])->where('delivery_status', 0)
				->update([
					'rate' => $value2
				]);
		}

		$data = DB::table('teleorderlists')
			->join('items', 'teleorderlists.item_id', '=', 'items.id')
			->where('user_id', $request->user_id)->where('delivery_status', 0)
			->where('orderfrom', 'app')
			->select('teleorderlists.*', 'items.image')->orderby('teleorderlists.id', 'desc')->get();


		return response()->json($data);
	}

	public function check_cart_count(Request $request)
	{
		return response()->json(Teleorderlist::where('user_id', $request->user_id)
			->where('delivery_status', 0)->where('orderfrom', 'app')->count());
	}

	public function get_previous_order(Request $request)
	{
		$data = DB::table('telebookorders as t')
			->leftjoin('deliveryboys', 'deliveryboys.id', '=', 't.deliveryboyid')
			->select('t.id', 't.orderno', 't.amount', 't.mobile', 't.address', 't.status', 't.mop', 't.created_at', 'deliveryboys.mobile as delivery_mobile', 't.delivery_charge')
			->where('t.user_id', $request->user_id)
			->where('t.orderfrom', 'app')
			->orderby('t.id', 'desc')
			->get();
		return response()->json($data);
	}

	public function get_previous_order_list(Request $request)
	{
		$data = DB::table('teleorderlists')->join('items', 'teleorderlists.item_id', '=', 'items.id')
			->select(
				'teleorderlists.item_id',
				'teleorderlists.itemname',
				'teleorderlists.weight',
				'teleorderlists.rate',
				'items.image'
			)
			->where('teleorderlists.orderid', $request->order_id)->where('teleorderlists.orderfrom', 'app')
			->orderby('teleorderlists.id', 'desc')->get();

		return response()->json($data);
	}

	public function get_previous_order_list2(Request $request)
	{
		$data = [
			'data' => DB::table('teleorderlists')->join('items', 'teleorderlists.item_id', '=', 'items.id')
				->select(
					'teleorderlists.item_id',
					'teleorderlists.itemname',
					'teleorderlists.weight',
					'teleorderlists.rate',
					'items.image'
				)
				->where('teleorderlists.orderid', $request->order_id)->where('teleorderlists.orderfrom', 'app')
				->orderby('teleorderlists.id', 'desc')->get(),
			'credit_used' => DB::table('wallets')->where('order_id', $request->order_id)->select('credit', 'used_credit')->first()
		];

		return response()->json($data);
	}

	public function cancel_app_orders(Request $request)
	{
		$check = DB::table('telebookorders')->where('id', $request->cancelid)->where('orderfrom', 'app')->first();
		if ($check->status == 1) {
			return response()->json('0');
		} else {
			DB::table('telebookorders')->where('id', $request->cancelid)->where('orderfrom', 'app')->update([
				'status' => '-1',
				'paidstatus' => '-1',
				'timestatus' => '1',
			]);
			Wallet::where('order_id', $request->cancelid)->delete();
			App_cancel_order::create([
				'app_order_id' => $request->cancelid,
				'reason' => $request->reason,
			]);
			return response()->json(1);
		}
	}


	public function pay_online(Request $request)
	{
		$pay_amount = Telebookorder::select('amount')->where('id', $request->id)->first();
		$update = Telebookorder::where('id', $request->id)->where('orderfrom', 'app')->update([
			'paidstatus' => '1',
			'collectedcash' => $pay_amount['amount'],
		]);
		return response()->json(1);
	}
	public function get_time_slot(Request $request)
	{
		$min = date('i');
		$hr = date('H');
		// if ($min > 30) {
		// 	$hr = $hr + 1;
		// }

		$check_day = DB::table('time_slots')->select('status')->where('day', $request->day)->first();
		if ($check_day->status == 0) {
			return response()->json('we are closed today');
		} else {
			$data = DB::table('assign_times')->leftjoin('serve_time', 'serve_time.id', 'assign_times.time')
				->select('serve_time.start_time as time')
				->where('assign_times.day', $request->day)
				->where('serve_time.id', '>', $hr)
				->orderby('assign_times.id', 'asc')
				->get();
			return response()->json($data);
		}
	}

	public function get_track_details(Request $request)
	{
		$user_lat = Telebookorder::select('lat_long', 'shopname', 'deliveryboyid')->where('id', $request->order_id)->first();
		$deliveryboy_lat = Deliveryboy::select('lat_long')->where('id', $user_lat->deliveryboyid)->first();
		$data = ['user_lat' => $user_lat->lat_long, 'deliveryboy_lat' => $deliveryboy_lat->lat_long];
		return response()->json($data);
	}

	public function save_delivery_boy_location(Request $request)
	{
		Deliveryboy::where('id', $request->id)->update(['lat_long' => $request->lat_long]);
		return response()->json(1);
	}

	// More API Start
	public function checklogins(Request $request)
	{
		$user = Usermanage::where('username', $request->username)->where('role', 5)->first();
		if ($user && Hash::check($request->password, $user->password)) {
			$this->data['grole'] = Godawn_user::where('user_id', $user['id'])->first();
			$this->data['user'] = $user;
			return response()->json($this->data);
		} else {
			return response()->json(0);
		}
	}
	public function getgodawnnameids()
	{
		$data = Godawn::select('id', 'godawnname')->orderBy('id', 'desc')->get();
		echo json_encode($data);
	}

	public function getvendornameids()
	{
		$data = Vendor::select('id', 'name')->orderBy('id', 'desc')->get();
		echo json_encode($data);
	}
	public function getitemnameids()
	{
		$data = Item::select('id', 'itemname')->where('type', 1)->orderBy('id', 'desc')->get();
		echo json_encode($data);
	}
	public function getamounts(Request $request)
	{
		$this->data['amount'] = Item::where('id', $request->id)->first();
		echo json_encode($this->data['amount']);
	}
	public function addmorerows(Request $request)
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
		return json_encode($data);
	}

	public function deletemorerows(Request $request)
	{
		$delete = Grnrow::where('id', $request->id)->delete();
		$data = DB::table('grnrows')->join('items', 'grnrows.item', '=', 'items.id')->where('grnrefid2', $request->grnrefid2)->select('grnrows.*', 'items.itemname')
			->get();
		echo json_encode($data);
	}


	public function insertgrns(Request $request)
	{

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
		return json_encode(1);
	}
	public function insertpurchaseforms(Request $request)
	{

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
			'date' => $request['date'],
			'time' => $request['time'],
			'vehicleno' => $request['vehicleno'],
			'vendor' => $request['vendor'],
			'refno' => $request['refno'],
		]);
		return json_encode(1);
	}

	public function insertdailysupers(Request $request)
	{

		$insert = Dailysuper::create([
			'date' => $request['date'],
			'time' => $request['time'],
			'openingbirds' => $request['openingbirds'],
			'feedconsumption' => $request['feedconsumption'],
			'avgbirdwt' => $request['avgbirdwt'],
			'mortality' => $request['mortality'],
			'closingbird' => $request['closingbird']
		]);
		return json_encode(1);
	}

	public function getshopnameids()
	{
		$data = Shop::select('id', 'shopname')->orderBy('id', 'desc')->get();
		return json_encode($data);
	}


	public function insertdistributes(Request $request)
	{

		$insert = Distribute::create([
			'date' => $request['date'],
			'time' => $request['time'],
			'vehno' => $request['vehno'],
			'drivername' => $request['drivername'],
			'noofbirds' => $request['noofbirds'],
			'totalwt' => $request['totalwt'],
			'avgbirdwt' => $request['avgbirdwt'],
			'shopcutunit' => $request['shopcutunit'],
		]);
		return json_encode(1);
	}

	public function insertdailyentrys(Request $request)
	{

		// $userdata=Session::get('userdata');				
		$insert = Dailyentry::create([
			// 'user_id'=>$userdata['id'],
			'user_id' => 1, //Static Id
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
			'salablechick' => $request['salablechick'],
		]);
		return json_encode(1);
	}

	public function insertgodowntogodowns(Request $request)
	{

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
		return json_encode(1);
	}

	public function insertshoptoshops(Request $request)
	{

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
		return json_encode(1);
	}
	public function insertshoptogodowns(Request $request)
	{
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
		return json_encode(1);
	}

	// More API End

	//Delivery App start



	public function deliveryboy_login(Request $request)
	{

		$check = Deliveryboy::where('mobile', $request->mobile)->first();
		if ($check && Hash::check($request->password, $check->password)) {
			return response()->json($check);
		} else {
			return response()->json('error');
		}
	}


	public function set_or_forgot_password(Request $request)
	{

		$check = Deliveryboy::where('mobile', $request->mobile)->first();
		if ($check) {
			$otp = rand('1000', '9999');
			$msg = "Your OTP verification code for password set or change request is $otp. Amruta Hatcheries & Foods.";
			$msg = urlencode($msg);
			$to = $request->mobile;
			$data1 = "uname=habitm1&pwd=habitm1&senderid=AHFPVT&to=" . $to . "&msg=" . $msg . "&route=T&peid=1701170071671948377&tempid=1707170080546502986";
			$ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);
			return response()->json($otp);
		} else {
			return response()->json(0);
		}
	}


	public function set_or_update_password(Request $request)
	{
		Deliveryboy::where('mobile', $request->mobile)->update([
			'password' => Hash::make($request->password),
		]);
		return response()->json(1);
	}

	public function get_delivery_boy_order(Request $request)
	{
		$orders = Telebookorder::where('deliveryboyid', $request->user_id)
			->whereRaw('DATE(created_at) = ?', date('Y-m-d'))->where(function ($query) {
				$query->where('status', '=', 2)
					->orWhere('status', '=', 1);
			})->orderby('id', 'desc')->get();
		return response()->json($orders);
	}
	public function get_delivery_boy_order_details_fromapp(Request $request)
	{
		$order_details = Teleorderlist::where('orderid', $request->orderid)->where('user_id', $request->user_id)
			->orderby('id', 'desc')->where('orderfrom', 'app')->get();
		return response()->json($order_details);
	}

	public function get_delivery_boy_order_details_fromtelecaller(Request $request)
	{
		$order_details = Teleorderlist::where('orderid', $request->orderid)
			->orderby('id', 'desc')->where('orderfrom', 'telecaller')->get();
		return response()->json($order_details);
	}


	public function get_delivery_boy_cancelorder(Request $request)
	{
		$orders = DB::table('telebookorders')->leftjoin(
			'app_cancel_orders',
			'app_cancel_orders.app_order_id',
			'=',
			'telebookorders.id'
		)
			->where('telebookorders.deliveryboyid', $request->user_id)
			->whereRaw('DATE(telebookorders.created_at) = ?', date('Y-m-d'))
			->where('telebookorders.status', -1)->orderby('telebookorders.id', 'desc')
			->select('telebookorders.*', 'app_cancel_orders.reason')->get();
		return response()->json($orders);
	}
	public function get_delivery_boy_deliveredorder(Request $request)
	{
		$orders = DB::table('telebookorders')->where('deliveryboyid', $request->user_id)
			->whereRaw('DATE(created_at) = ?', date('Y-m-d'))
			->where('paidstatus', 1)->orderby('id', 'desc')->get();
		return response()->json($orders);
	}

	public function collect_amount_by_deliveryboy(Request $request)
	{
		if ($request->collectedcash && $request->id) {
			$currenttime = date('Y-m-d H:i:s');
			$time1 = Telebookorder::find($request->id);
			$a = date('Y-m-d H:i:s', strtotime($time1['created_at']));
			$diff = date_diff(date_create($currenttime), date_create($a));
			$time = $diff->format("%H") . ':' . $diff->format("%I") . ':' . $diff->format("%S");
			$x =  Telebookorder::where('id', $request->id)->update([
				'collectedcash' => $request->collectedcash,
				'paidstatus' => '1',
				'timestatus' => '1',
				'timetaken' => $time,
				'status' => '3',
			]);
			Wallet::where('order_id', $request->id)->update(['status' => 1]);

			$mode = 'Rate';
			if ($time1['orderfrom'] == "telecaller") {
				$mode = "Download";
			}
			
			$msg='Your order of '.$time1['amount'].' rupees including'.$time1['delivery_charge'].' rupees of delivery charges has been successfully delivered. Amruta Hatcheries & Foods. '.$mode.' the app now https://play.google.com/store/apps/details?id=com.ffc.www';
			$msg = urlencode($msg);
			$to = $time1['mobile'];
			$data1 = "uname=habitm1&pwd=habitm1&senderid=AHFPVT&to=" . $to . "&msg=" . $msg . "&route=T&peid=1701170071671948377&tempid=1707170080576884135";
			$ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);

			return response()->json(1);
		} else {
			return response()->json(0);
		}
	}
	
	public function pick_order_by_deliveryboy(Request $request)
	{
		if ($request->id) {
			$x =  Telebookorder::where('id', $request->id)->update([
				'status' => '2',
			]);
			return response()->json(1);
		} else {
			return response()->json(0);
		}
	}

	public function drop_order_by_deliveryboy(Request $request)
	{
		if ($request->id) {
			$x =  Telebookorder::where('id', $request->id)->update([
				'status' => '1',
			]);
			return response()->json(1);
		} else {
			return response()->json(0);
		}
	}

	public function cancel_order_by_deliveryboy(Request $request)
	{
		DB::table('telebookorders')->where('id', $request->cancelid)->update([
			'status' => '-1',
			'paidstatus' => '-1',
			'timestatus' => '1',


		]);

		App_cancel_order::create([
			'app_order_id' => $request->cancelid,
			'reason' => $request->reason,
		]);
		return response()->json(1);
	}

	public function get_meter_reading_history(Request $request)
	{
		$data = DB::table('meter_reading')->where('user_id', $request->user_id)->orderby('id', 'desc')->get();
		return response()->json($data);
	}

	public function add_meter_report(Request $request)
	{
		if ($request->reading_file != 'null') {
			$file = base64_decode($request['reading_file']);
			$safeName = time() . '.' . $request->ext1;
			file_put_contents(public_path() . '/uploads/meter_reading/' . $safeName, $file);

			$image = $safeName;
			MeterReading::create([
				'user_id' => $request->user_id,
				'vehicle_no' => $request->vehicle_no,
				'reading' => $request->reading,
				'file' => $image,
				'status' => 1,
				'type' => 1
			]);
			return response()->json(1);
		} else
			return response()->json(0);
	}
	//Delivery App end

	//razorpay
	public function create_order_api(Request $request)
	{
		$api = new Api('rzp_live_g1Sll3odWJSXzp', 'graETPaOiLlS4F9lQ4ScEG9c');
		$order  = $api->order->create([
			'receipt' => 'order_rcptid_11',
			'amount'  => $request->amount * 100,
			'currency' => 'INR',
			'payment_capture' => 1,
		]);
		return response()->json($order->id);
	}

	//generate shop order from machine
	public function generate_shop_order(Request $request)
	{
		$insert_data = collect(json_decode($request->formData, TRUE));

		//return response()->json(date('Y-m-d'));
		$getsingle = Shoporderlist::select('orderid')->orderBy('id', 'desc')->first();
		$orderid = $getsingle['orderid'] + 1;
		$master_id = 1;
		foreach ($insert_data['data'] as $d) {
			$insert = Shoporderlist::create([
				'itemname' => $d['name'],
				'weight' => $d['weight'],
				'rate' => $d['rate'],
				'masterid' => $d['masterid'],
				'orderid' => $orderid,
			]);
			$master_id = $d['masterid'];
		}

		$uniqueprefix = Usermanage::select('uniqueprefix')->where('id', $master_id)->first();
		$uniqueprefix = $uniqueprefix->uniqueprefix;
		$data = Shopbookorder::orderBy('created_at', 'desc')->first();

		$count = Shopbookorder::whereRaw('MONTH(created_at) = ?', date('m'))
			->orderBy('id', 'desc')->first();

		if ($count == null) {
			$orderno = 'AFCS' . '/' . $uniqueprefix . '-' . date('m') . '/' . date('y') . '/' . '001';
		} else {
			$oldorderno = substr($data['orderno'], 15);
			$plusno = $oldorderno + 1;
			$newno = str_pad($plusno, 3, '0', STR_PAD_LEFT);
			$orderno = 'AFCS' . '/' . $uniqueprefix . '-' . date('m') . '/' . date('y') . '/' . $newno;
		}


		$x =  Shopbookorder::create([
			'masterid' => $master_id,
			'orderdate' => date('Y-m-d'),
			'orderid' => $orderid,
			'orderno' => $orderno,
			'mobile' => $insert_data['mobile'],
			'details' => $insert_data['spec'],
			'address' => $insert_data['address'],
			'round_of' => $insert_data['round_of'],
			'discount' => $insert_data['disc'],
			'mop' => $insert_data['mop'],
			'amount' => $insert_data['totalamount'],
		]);
		if ($x->id) {
			$response = ([
				'status' => true, 'id' => $x->id
			]);
			return response()->json($response);
		} else {
			$response = ([
				'status' => false, 'id' => 0
			]);
			return response()->json($response);
		}
	}

	function getallpromotion()
	{
		return response()->json(Promotional_images::get());
	}

	public function get_google_api_key(){
	$api_key='AIzaSyC1Cz13aBYAbBYJL0oABZ8KZnd7imiWwA4';
	//$api_key='AIzaSyC1kU2qPwMsA-VTbi1fm6kb9M8d7utT0rI';
		return response()->json(['status'=>true,'api_key'=>$api_key]);
	}
}
