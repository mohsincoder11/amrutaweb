<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//register and login
Route::post('login_api', 'Api_controller@login_api')->name('login_api');
Route::post('register_user_api', 'Api_controller@register_user_api')->name('register_user_api');
Route::get('send_reguser_otp', 'Api_controller@send_reguser_otp')->name('send_reguser_otp');
Route::get('forgot_password_otp', 'Api_controller@forgot_password_otp')->name('forgot_password_otp');
Route::post('update_user_api', 'Api_controller@update_user_api')->name('update_user_api');
Route::post('check_mobile_no', 'Api_controller@check_mobile_no')->name('check_mobile_no');

Route::get('get_items_api', 'Api_controller@get_items_api')->name('get_items_api');
Route::get('get_items_api_weighing_machine', 'Api_controller@get_items_api_weighing_machine')->name('get_items_api_weighing_machine');
Route::get('get_google_api_key', 'Api_controller@get_google_api_key')->name('get_google_api_key');

Route::get('get_items_api2', 'Api_controller@get_items_api2')->name('get_items_api2');
Route::get('get_Shop_lat_long', 'Api_controller@get_Shop_lat_long')->name('get_Shop_lat_long');

Route::get('get_area_api', 'Api_controller@get_area_api')->name('get_area_api');
Route::post('add_item_to_cart', 'Api_controller@add_item_to_cart')->name('add_item_to_cart');
Route::get('add_repeat_order', 'Api_controller@add_repeat_order')->name('add_repeat_order');

Route::post('view_cart', 'Api_controller@view_cart')->name('view_cart');
Route::post('view_cart2', 'Api_controller@view_cart2')->name('view_cart2');
Route::post('remove_item_from_cart', 'Api_controller@remove_item_from_cart')->name('remove_item_from_cart');
Route::post('update_item_of_cart', 'Api_controller@update_item_of_cart')->name('update_item_of_cart');
Route::post('place_order', 'Api_controller@place_order')->name('place_order');
Route::post('place_order2', 'Api_controller@place_order2')->name('place_order2');
Route::post('place_order3', 'Api_controller@place_order3')->name('place_order3');
Route::get('get_track_details', 'Api_controller@get_track_details')->name('get_track_details');
Route::get('save_delivery_boy_location', 'Api_controller@save_delivery_boy_location')->name('save_delivery_boy_location');
Route::get('get_meter_reading_history', 'Api_controller@get_meter_reading_history')->name('get_meter_reading_history');
Route::post('add_meter_report', 'Api_controller@add_meter_report')->name('add_meter_report');

Route::get('get_previous_order', 'Api_controller@get_previous_order')->name('get_previous_order');
Route::get('get_previous_order_list', 'Api_controller@get_previous_order_list')->name('get_previous_order_list');
Route::get('get_previous_order_list2', 'Api_controller@get_previous_order_list2')->name('get_previous_order_list2');
Route::get('get_time_slot', 'Api_controller@get_time_slot')->name('get_time_slot');
Route::post('cancel_app_orders', 'Api_controller@cancel_app_orders')->name('cancel_app_orders');
Route::get('check_cart_count', 'Api_controller@check_cart_count')->name('check_cart_count');
Route::get('update_password_api', 'Api_controller@update_password_api')->name('update_password_api');

Route::get('getallpromotion_api', 'Api_controller@getallpromotion')->name('getallpromotion');

Route::get('get_coupon_api', 'Api_controller@get_coupon_api')->name('get_coupon_api');


//More API Adress Start

Route::get('getgodawnnameids', 'Api_controller@getgodawnnameids')->name('getgodawnnameids');
Route::get('getvendornameids', 'Api_controller@getvendornameids')->name('getvendornameids');
Route::get('getitemnameids', 'Api_controller@getitemnameids')->name('getitemnameids');
Route::get('getamounts', 'Api_controller@getamounts')->name('getamounts');
Route::POST('addmorerows', 'Api_controller@addmorerows')->name('addmorerows');
Route::get('deletemorerows', 'Api_controller@deletemorerows')->name('deletemorerows');
Route::post('insertgrns', 'Api_controller@insertgrns')->name('insertgrns');

Route::post('insertpurchaseforms', 'Api_controller@insertpurchaseforms')->name('insertpurchaseforms');
Route::post('insertdailysupers', 'Api_controller@insertdailysupers')->name('insertdailysupers');
Route::get('getshopnameids', 'Api_controller@getshopnameids')->name('getshopnameids');
Route::post('insertdistributes', 'Api_controller@insertdistributes')->name('insertdistributes');
Route::post('insertdailyentrys', 'Api_controller@insertdailyentrys')->name('insertdailyentrys');
Route::post('insertgtogs', 'Api_controller@insertgodowntogodowns')->name('insertgodowntogodowns');
Route::post('insertstoss', 'Api_controller@insertshoptoshops')->name('insertshoptoshops');
Route::post('insertstogs', 'Api_controller@insertshoptogodowns')->name('insertshoptogodowns');
Route::post('checklogins', 'Api_controller@checklogins')->name('checklogins');
//More API Adress End

//delivery boy api start

Route::get('deliveryboy_login', 'Api_controller@deliveryboy_login')->name('deliveryboy_login');
Route::get('set_or_forgot_password', 'Api_controller@set_or_forgot_password')->name('set_or_forgot_password');
Route::get('set_or_update_password', 'Api_controller@set_or_update_password')->name('set_or_update_password');
Route::get('get_delivery_boy_order', 'Api_controller@get_delivery_boy_order')->name('get_delivery_boy_order');

Route::get('pick_order_by_deliveryboy', 'Api_controller@pick_order_by_deliveryboy')->name('pick_order_by_deliveryboy');
Route::get('drop_order_by_deliveryboy', 'Api_controller@drop_order_by_deliveryboy')->name('drop_order_by_deliveryboy');
Route::get('collect_amount_by_deliveryboy', 'Api_controller@collect_amount_by_deliveryboy')->name('collect_amount_by_deliveryboy');
Route::get('cancel_order_by_deliveryboy', 'Api_controller@cancel_order_by_deliveryboy')->name('cancel_order_by_deliveryboy');
Route::get('get_delivery_boy_cancelorder', 'Api_controller@get_delivery_boy_cancelorder')->name('get_delivery_boy_cancelorder');
Route::get('get_delivery_boy_deliveredorder', 'Api_controller@get_delivery_boy_deliveredorder')->name('get_delivery_boy_deliveredorder');
Route::get('get_delivery_boy_order_details_fromapp', 'Api_controller@get_delivery_boy_order_details_fromapp')->name('get_delivery_boy_order_details_fromapp');
Route::get('get_delivery_boy_order_details_fromtelecaller', 'Api_controller@get_delivery_boy_order_details_fromtelecaller')->name('get_delivery_boy_order_details_fromtelecaller');
Route::get('pay_online', 'Api_controller@pay_online')->name('pay_online');



//delivery boy api end

//razorpay

Route::get('create_order_api', 'Api_controller@create_order_api')->name('create_order_api');


//shopoporder using machine

Route::post('generate_shop_order', 'Api_controller@generate_shop_order')->name('generate_shop_order');

Route::post('send-sms','AdminController@send_sms');

