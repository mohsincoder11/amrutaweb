<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('getitemarray','AdminController@getitemarray')->name('getitemarray');
Route::group(['middleware' => ['Session_check']], function () {
	//Admin
	Route::get('home','AdminController@home')->name('home');
Route::get('changepassword','AdminController@changepassword')->name('changepassword');
Route::get('assign_godawn','AdminController@assign_godawn')->name('assign_godawn');
Route::get('godawn_user','AdminController@godawn_user')->name('godawn_user');
Route::get('usermanage','AdminController@usermanage')->name('usermanage');
Route::get('editusermanage/{id}','AdminController@editusermanage')->name('editusermanage');


//Master
Route::get('addcustomer','MasterController@addcustomer')->name('addcustomer');
Route::get('additem','MasterController@additem')->name('additem');
Route::get('addshop','MasterController@addshop')->name('addshop');
Route::get('deliveryboy','MasterController@deliveryboy')->name('deliveryboy');
Route::get('addgodawn','MasterController@addgodawn')->name('addgodawn');
Route::get('addunit','MasterController@addunit')->name('addunit');
Route::get('addvendor','MasterController@addvendor')->name('addvendor');
Route::get('addarea','MasterController@addarea')->name('addarea');
Route::get('time_slot','MasterController@time_slot')->name('time_slot');
Route::get('assign_area','MasterController@assign_area')->name('assign_area');
Route::get('addpromotional_image','MasterController@addpromotional_image')->name('addpromotional_image');
Route::post('insert_promo_image','MasterController@insert_promo_image')->name('insert_promo_image');
Route::get('delete_promo_image','MasterController@delete_promo_image')->name('delete_promo_image');
Route::get('coupon_master','MasterController@coupon_master')->name('coupon_master');
Route::post('insert_coupon','MasterController@insert_coupon')->name('insert_coupon');
Route::get('delete_coupon','MasterController@delete_coupon')->name('delete_coupon');
Route::get('edit_coupon','MasterController@edit_coupon')->name('edit_coupon');
Route::get('update_coupon_status','MasterController@update_coupon_status')->name('update_coupon_status');
Route::get('view_meter_report/{user_id}','MasterController@view_meter_report')->name('view_meter_report');
Route::post('get_meter_report','MasterController@get_meter_report')->name('get_meter_report');


//More
Route::get('grn','MoreController@grn')->name('grn');
Route::get('purchaseform','MoreController@purchaseform')->name('purchaseform');
Route::get('dailysuper','MoreController@dailysuper')->name('dailysuper');
Route::get('distribute','MoreController@distribute')->name('distribute');
Route::get('dailyentry','MoreController@dailyentry')->name('dailyentry');
Route::get('gtog','MoreController@godowntogodown')->name('godowntogodown');
Route::get('stos','MoreController@shoptoshop')->name('shoptoshop');


//Report
Route::get('allorderreport','Report@allorderreport')->name('allorderreport');
Route::get('telecallerorderreport','Report@telecallerorderreport')->name('telecallerorderreport');
Route::get('shoporderreport','Report@shoporderreport')->name('shoporderreport');
Route::get('shopdiscountreport','Report@shopdiscountreport')->name('shopdiscountreport');
Route::get('telecallerdiscountreport','Report@telecallerdiscountreport')->name('telecallerdiscountreport');
Route::get('deliveryboyreport','Report@deliveryboyreport')->name('deliveryboyreport');
Route::get('cashcollectionshopreport','Report@cashcollectionshopreport')->name('cashcollectionshopreport');
Route::get('cashcollectiontelecallerreport','Report@cashcollectiontelecallerreport')->name('cashcollectiontelecallerreport');
Route::get('cancelorderreport','Report@cancelorderreport')->name('cancelorderreport');
Route::get('itemreport','Report@itemreport')->name('itemreport');

//shop
Route::get('distributes','ShopController@distributes')->name('distributes');
Route::get('dailyentrys','ShopController@dailyentrys')->name('dailyentrys');
Route::get('stoss','ShopController@stoss')->name('stoss');
Route::get('stog','ShopController@shoptogodown')->name('shoptogodown');
Route::get('apporders','ShopController@apporders')->name('apporders');
Route::get('generateorder','ShopController@generateorder')->name('generateorder');
Route::get('shoporder','ShopController@shoporder')->name('shoporder');
Route::get('shopteleorder','ShopController@shopteleorder')->name('shopteleorder');


//Telecaller
Route::get('bookorder','TelecallerController@bookorder')->name('bookorder');
Route::get('teleorder','TelecallerController@teleorder')->name('teleorder');
Route::get('tele_app_orders','TelecallerController@tele_app_orders')->name('tele_app_orders');

Route::get('item-master','MasterController@additem2')->name('item-master');

});

//login

Route::get('/','AdminController@login')->name('login');
Route::post('checklogin','AdminController@checklogin')->name('checklogin');
Route::get('logout','AdminController@logout')->name('logout');
Route::post('updatepassword','AdminController@updatepassword')->name('updatepassword');
Route::get('databackup', 'AdminController@databackup')->name('databackup');
Route::get('databackup2', 'Amrutabackup@index')->name('databackup');



//Admin Route
Route::post('addusermanagement','AdminController@addusermanagement')->name('addusermanagement');
Route::get('deleteusermanage','AdminController@deleteusermanage')->name('deleteusermanage');
Route::post('updateusermanage','AdminController@updateusermanage')->name('updateusermanage');
Route::get('checkuniqueprefixuser','AdminController@checkuniqueprefixuser')->name('checkuniqueprefixuser');
Route::get('add_assign_godawn','AdminController@add_assign_godawn')->name('add_assign_godawn');
Route::get('get_grn_purchase_data','AdminController@get_grn_purchase_data')->name('get_grn_purchase_data');
Route::get('delete_assign_godawn','AdminController@delete_assign_godawn')->name('delete_assign_godawn');
Route::get('get_edit_assign_godawn','AdminController@get_edit_assign_godawn')->name('get_edit_assign_godawn');
Route::get('edit_godawn_user','AdminController@edit_godawn_user')->name('edit_godawn_user');
Route::get('add_godawn_user','AdminController@add_godawn_user')->name('add_godawn_user');
Route::get('delete_godawn_user','AdminController@delete_godawn_user')->name('delete_godawn_user');



//Master Route
Route::post('insertitem','MasterController@insertitem')->name('insertitem');
Route::get('deleteitem','MasterController@deleteitem')->name('deleteitem');
Route::get('edititem','MasterController@edititem')->name('edititem');
Route::get('getallitemlist','MasterController@getallitemlist')->name('getallitemlist');
Route::get('update_stock','MasterController@update_stock')->name('update_stock');

Route::post('insertshop','MasterController@insertshop')->name('insertshop');
Route::get('deleteshop','MasterController@deleteshop')->name('deleteshop');
Route::get('editshop','MasterController@editshop')->name('editshop');
Route::get('getallshop','MasterController@getallshop')->name('getallshop');
Route::post('updateshop','MasterController@updateshop')->name('updateshop');
Route::get('checkuniqueprefix','MasterController@checkuniqueprefix')->name('checkuniqueprefix');

Route::post('insertcustomer','MasterController@insertcustomer')->name('insertcustomer');
Route::get('deletecustomer','MasterController@deletecustomer')->name('deletecustomer');
Route::get('editcustomer','MasterController@editcustomer')->name('editcustomer');
Route::get('getallcustomerlist','MasterController@getallcustomerlist')->name('getallcustomerlist');

Route::post('insertdeliveryboy','MasterController@insertdeliveryboy')->name('insertdeliveryboy');
Route::get('deletedeliveryboy','MasterController@deletedeliveryboy')->name('deletedeliveryboy');
Route::get('editdeliveryboy','MasterController@editdeliveryboy')->name('editdeliveryboy');
Route::get('getalldeliveryboylist','MasterController@getalldeliveryboylist')->name('getalldeliveryboylist');

Route::get('editgodawn','MasterController@editgodawn')->name('editgodawn');
Route::post('insertgodawn','MasterController@insertgodawn')->name('insertgodawn');
Route::get('deletegodawn','MasterController@deletegodawn')->name('deletegodawn');
Route::get('getgodawn','MasterController@getgodawn')->name('getgodawn');

Route::get('editunit','MasterController@editunit')->name('editunit');
Route::post('insertunit','MasterController@insertunit')->name('insertunit');
Route::get('deleteunit','MasterController@deleteunit')->name('deleteunit');
Route::get('getunit','MasterController@getunit')->name('getunit');

Route::get('editvendor','MasterController@editvendor')->name('editvendor');
Route::post('insertvendor','MasterController@insertvendor')->name('insertvendor');
Route::get('deletevendor','MasterController@deletevendor')->name('deletevendor');
Route::get('getvendor','MasterController@getvendor')->name('getvendor');
Route::get('get_all_area','MasterController@get_all_area')->name('get_all_area');
Route::get('get_single_area','MasterController@get_single_area')->name('get_single_area');
Route::get('delete_area','MasterController@delete_area')->name('delete_area');
Route::post('insert_area','MasterController@insert_area')->name('insert_area');
Route::get('insert_assign_area','MasterController@insert_assign_area')->name('insert_assign_area');
Route::get('get_assign_area','MasterController@get_assign_area')->name('get_assign_area');
Route::get('get_single_assign_area','MasterController@get_single_assign_area')->name('get_single_assign_area');
Route::get('delete_assign_area','MasterController@delete_assign_area')->name('delete_assign_area');
Route::get('check_area_assign','MasterController@check_area_assign')->name('check_area_assign');
Route::get('add_time_slot','MasterController@add_time_slot')->name('add_time_slot');
Route::get('get_all_time_Slot','MasterController@get_all_time_Slot')->name('get_all_time_Slot');
Route::get('delete_time_slot','MasterController@delete_time_slot')->name('delete_time_slot');
Route::get('edit_time_slot','MasterController@edit_time_slot')->name('edit_time_slot');
Route::get('day_status','MasterController@day_status')->name('day_status');
Route::get('check_deliveryboy_no','MasterController@check_deliveryboy_no')->name('check_deliveryboy_no');





//Shop Route
Route::get('insertshoporder','ShopController@insertshoporder')->name('insertshoporder');
Route::get('printtelepdf/{id}','ShopController@printtelepdf')->name('printtelepdf');
Route::get('printapppdf/{id}','ShopController@printapppdf')->name('printapppdf');
Route::get('printshoppdf/{id}','ShopController@printshoppdf')->name('printshoppdf');

Route::post('printmultitelepdf','ShopController@printmultitelepdf')->name('printmultitelepdf');
Route::post('printmultiapppdf','ShopController@printmultiapppdf')->name('printmultiapppdf');
Route::get('deleteorderrow','ShopController@deleteorderrow')->name('deleteorderrow');


Route::get('deleteshoporder','ShopController@deleteshoporder')->name('deleteshoporder');
Route::get('editshoporder/{id}','ShopController@editshoporder')->name('editshoporder');
Route::post('updateshoporder','ShopController@updateshoporder')->name('updateshoporder');
Route::post('updatemoney','ShopController@updatemoney')->name('updatemoney');
Route::post('cancelorder','ShopController@cancelorder')->name('cancelorder');
Route::get('sendmsg','ShopController@sendmsg')->name('sendmsg');
Route::get('printreceipt','ShopController@printreceipt')->name('printreceipt');
Route::get('printreceiptpdf/{id}','ShopController@printreceiptpdf')->name('printreceiptpdf');
Route::get('lastid','ShopController@lastid')->name('lastid');
Route::get('getalldeliveryboy','ShopController@getalldeliveryboy')->name('getalldeliveryboy');

Route::get('addshoporderrow','ShopController@addshoporderrow')->name('addshoporderrow');
Route::post('cancel_app_order','ShopController@cancel_app_order')->name('cancel_app_order');
Route::get('stock_and_dispose','ShopController@stock_and_dispose')->name('stock_and_dispose');
Route::get('get_total_weight_shop','ShopController@get_total_weight_shop')->name('get_total_weight_shop');
Route::post('insert_s_d_entry','ShopController@insert_s_d_entry')->name('insert_s_d_entry');


// Telecaller Route
Route::get('addteleorderrow','TelecallerController@addteleorderrow')->name('addteleorderrow');

Route::get('insertteleorder','TelecallerController@insertteleorder')->name('insertteleorder');
Route::get('deleteteleorderrow','TelecallerController@deleteteleorderrow')->name('deleteteleorderrow');
Route::get('deleteallteleorderrow','TelecallerController@deleteallteleorderrow')->name('deleteallteleorderrow');

Route::get('getamount/{id}','TelecallerController@getamount')->name('getamount');
Route::get('getcustomer/{id}','TelecallerController@getcustomer')->name('getcustomer');
Route::get('getallcustomer','TelecallerController@getallcustomer')->name('getallcustomer');
Route::get('getallhotel','TelecallerController@getallhotel')->name('getallhotel');
Route::get('checkmobileno','TelecallerController@checkmobileno')->name('checkmobileno');



Route::get('printdemo','TelecallerController@printdemo')->name('printdemo');

//Report
Route::post('printallorder','Report@printallorder')->name('printallorder');
Route::post('allorderreports','Report@allorderreports')->name('allorderreports');
//-------------------
Route::post('printtelecallerorder','Report@printtelecallerorder')->name('printtelecallerorder');
Route::post('telecallerorderreports','Report@telecallerorderreports')->name('telecallerorderreports');
//-------------------
Route::get('apporderreport','Report@apporderreport')->name('apporderreport');
Route::post('apporderreports','Report@apporderreports')->name('apporderreports');
Route::post('printapporder','Report@printapporderreports')->name('printapporderreports');


//---------

Route::post('printshoporder','Report@printshoporder')->name('printshoporder');
Route::post('shoporderreports','Report@shoporderreports')->name('shoporderreports');

//-------------------
Route::post('printshopdiscount','Report@printshopdiscount')->name('printshopdiscount');
Route::post('shopdiscountreports','Report@shopdiscountreports')->name('shopdiscountreports');

//--------------------
//-------------------
Route::post('printtelecallerdiscount','Report@printtelecallerdiscount')->name('printtelecallerdiscount');
Route::post('telecallerdiscountreports','Report@telecallerdiscountreports')->name('telecallerdiscountreports');

//--------------------
Route::post('printdeliveryboy','Report@printdeliveryboy')->name('printdeliveryboy');
Route::post('deliveryboyreports','Report@deliveryboyreports')->name('deliveryboyreports');

//--------------------

Route::post('printcashcollectionshop','Report@printcashcollectionshop')->name('printcashcollectionshop');
Route::post('cashcollectionshopreports','Report@cashcollectionshopreports')->name('cashcollectionshopreports');

//---------------------------------
Route::post('printcashcollectiontelecaller','Report@printcashcollectiontelecaller')->name('printcashcollectiontelecaller');
Route::post('cashcollectiontelecallerreports','Report@cashcollectiontelecallerreports')->name('cashcollectiontelecallerreports');

//-----------------------------------
Route::post('printcancelorder','Report@printcancelorder')->name('printcancelorder');
Route::post('cancelorderreports','Report@cancelorderreports')->name('cancelorderreports');
//--------
Route::post('printitemreport','Report@printitemreport')->name('printitemreport');
Route::post('itemreports','Report@itemreports')->name('itemreports');
//-------------------------------More

Route::get('get_godawn_opening_birds','MoreController@get_godawn_opening_birds')->name('get_godawn_opening_birds');
Route::get('get_shop_opening_birds','MoreController@get_shop_opening_birds')->name('get_shop_opening_birds');
Route::get('get_source_godawn_nameid','MoreController@get_source_godawn_nameid')->name('get_source_godawn_nameid');


//post
Route::post('insertgrn','MoreController@insertgrn')->name('insertgrn');
Route::get('addmorerow','MoreController@addmorerow')->name('addmorerow');
Route::get('deletemorerow','MoreController@deletemorerow')->name('deletemorerow');

Route::post('insertpurchaseform','MoreController@insertpurchaseform')->name('insertpurchaseform');
Route::post('insertdailysuper','MoreController@insertdailysuper')->name('insertdailysuper');
Route::post('insertdistribute','MoreController@insertdistribute')->name('insertdistribute');
Route::post('insertdailyentry','MoreController@insertdailyentry')->name('insertdailyentry');
Route::post('insertgtog','MoreController@insertgodowntogodown')->name('insertgodowntogodown');
Route::post('insertstos','MoreController@insertshoptoshop')->name('insertshoptoshop');
Route::post('insertstog','MoreController@insertshoptogodown')->name('insertshoptogodown');
 //getdata
Route::get('getgrn','MoreController@getgrn')->name('getgrn');
Route::get('getgrnrow','MoreController@getgrnrow')->name('getgrnrow');
Route::get('getpurchaseform','MoreController@getpurchaseform')->name('getpurchaseform');
Route::get('getdailysuper','MoreController@getdailysuper')->name('getdailysuper');
Route::get('getdistribute','MoreController@getdistribute')->name('getdistribute');
Route::get('getdailyentry','MoreController@getdailyentry')->name('getdailyentry');
Route::get('getgtog','MoreController@getgodowntogodown')->name('getgodowntogodown');
Route::get('getstos','MoreController@getshoptoshop')->name('getshoptoshop');
Route::get('getstog','MoreController@getshoptogodown')->name('getshoptogodown');

Route::get('getvendornameid','MoreController@getvendornameid')->name('getvendornameid');
Route::get('getgodawnnameid','MoreController@getgodawnnameid')->name('getgodawnnameid');
Route::get('getitemnameid','MoreController@getitemnameid')->name('getitemnameid');
Route::get('getshopnameid','MoreController@getshopnameid')->name('getshopnameid');
Route::get('get_grn_id','MoreController@get_grn_id')->name('get_grn_id');
Route::get('get_grn_data_by_id','MoreController@get_grn_data_by_id')->name('get_grn_data_by_id');

//delete
Route::get('deletegrn','MoreController@deletegrn')->name('deletegrn');
Route::get('deletetpurchaseform','MoreController@deletetpurchaseform')->name('deletetpurchaseform');
Route::get('deletedailysuper','MoreController@deletedailysuper')->name('deletedailysuper');
Route::get('deletedistribute','MoreController@deletedistribute')->name('deletedistribute');
Route::get('deletedailyentry','MoreController@deletedailyentry')->name('deletedailyentry');
Route::get('deletegtog','MoreController@deletegodowntogodown')->name('deletegodowntogodown');
Route::get('deletestos','MoreController@deleteshoptoshop')->name('deleteshoptoshop');
Route::get('deletestog','MoreController@deleteshoptogodown')->name('deleteshoptogodown');
////edit 
Route::get('editgrn','MoreController@editgrn')->name('editgrn');
Route::get('editpurchaseform','MoreController@editpurchaseform')->name('editpurchaseform');
Route::get('editdailysuper','MoreController@editdailysuper')->name('editdailysuper');
Route::get('editdistribute','MoreController@editdistribute')->name('editdistribute');
Route::get('editdailyentry','MoreController@editdailyentry')->name('editdailyentry');
Route::get('editstos','MoreController@editstos')->name('editstos');
Route::get('editstog','MoreController@editstog')->name('editstog');
Route::get('editgtog','MoreController@editgtog')->name('editgtog');

//LIve Bird Transfer



Route::get('gtognew','Live_bird_transfer@gtognew')->name('gtognew');
Route::get('stognew','Live_bird_transfer@stognew')->name('stognew');
Route::get('stosnew','Live_bird_transfer@stosnew')->name('stosnew');

Route::get('get_shop_dashboard_data','AdminController@get_shop_dashboard_data')->name('get_shop_dashboard_data');



Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return redirect()->back();
    //return "All cache cleared!";
});

