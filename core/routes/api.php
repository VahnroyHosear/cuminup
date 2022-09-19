<?php

//$request_headers        = apache_request_headers();
//$http_origin            = @$request_headers['Origin'];
/*$allowed_http_origins   = array(
                            "https://www.cuminup.com/vcard/",
                            "https://www.cuminup.com/vcard/"
                          );*/
/*if (in_array($http_origin, $allowed_http_origins)){ 
header('Access-Control-Allow-Origin:'.$http_origin);
} */
header('Access-Control-Allow-Origin: *');


header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

use Illuminate\Http\Request;

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
Route::get('webHook_url2','VirtualCardController@webHook_forPrivacy2')->name('webHook_url2');

Route::post('webHook_url','VirtualCardController@webHook_forPrivacy')->name('webHook_url');



/*
Route::get('fromaddress', 'EasypostController@fromaddress');
Route::get('toaddress', 'EasypostController@toaddress');
Route::get('parcel', 'EasypostController@parcel');
Route::get('predefinedparcel', 'EasypostController@predefinedparcel');
Route::get('getaddress', 'EasypostController@getaddress');
Route::get('getparcel', 'EasypostController@getparcel');
Route::get('shipment', 'EasypostController@shipment');
Route::get('buyshipment', 'EasypostController@buyshipment');
Route::get('listshipment', 'EasypostController@listshipment');
Route::get('getshipment', 'EasypostController@getshipment');
Route::get('insurance', 'EasypostController@insurance');
Route::get('carriertype', 'EasypostController@carriertype');
Route::get('tracking', 'EasypostController@tracking');
*/
//FOR APPLICATION ROUTE START
//Route::group([ 'middleware' => ['cors']], function ()//bug-fixed-pm-v2.7
//{

Route::post('register', 'Api\ApiUserController@submitregister')->name('register');
Route::post('signup_with_phone', 'Api\ApiUserController@signupbyPhone');
Route::post('check_registered_user', 'Api\ApiUserController@checkRegisteredUser');
Route::post('login', 'Api\ApiUserController@submitlogin')->name('login');
Route::post('email_code_verify', 'Api\ApiUserController@postEmailVerify')->name('email_code_verify');
Route::post('forget_password', 'Api\ApiUserController@sendResetLinkEmail')->name('forget_password');


//Route::middleware('auth:api')->get('/user', function(Request $request) {
//Route::group(['middleware' => 'auth:api'], function () {
    //return $request->user();
 
//Route::middleware('auth:api')->get('/user', function(Request $request) {
//Route::post('update_profile', 'Api\ApiUserController@account')->name('update_profile');
Route::post('update_profile', 'Api\ApiUserController@account')->name('update_profile');
Route::post('upload-kyc-document', 'Api\ApiUserController@uploadKycDocument');
Route::post('add_fund', 'Api\UserController@addFund');
Route::post('transaction_list', 'Api\ApiUserController@fetchTrxList');
Route::get('vcard_plan_list', 'Api\ApiUserController@fetchvCardPalnList');
Route::post('create_vcard_subscription', 'Api\UserController@vcardPurchasedPlan');
Route::post('create_vcard_subscription_bywallet', 'Api\UserController@vcardPurchasedPlanbyWallet');


Route::post('vcard_list', 'Api\ApiUserController@vcardList');
Route::get('product_type_list', 'Api\ApiUserController@fetchProductTypeList');
Route::get('vcard_design_list', 'Api\ApiUserController@fetchVcardDesignList');

Route::post('add_fund_stripe_token', 'Api\UserController@AddFundStripeToken');



Route::get('get_country_list', 'Api\ApiUserController@fetchvCountryList');
Route::get('currency_list', 'Api\ApiUserController@fetchCurrencyList');
Route::post('vcard_orders_list', 'Api\ApiUserController@vcardOrdersList');
Route::post('check_gateway_charge', 'Api\ApiUserController@chargeCheck');
Route::post('check_wallet_balance', 'Api\ApiUserController@walletBalance');
Route::post('get_user_details', 'Api\ApiUserController@userDetails');//->middleware('auth');
Route::get('banners', 'Api\ApiUserController@banners');
Route::post('notification', 'Api\ApiUserController@notification');
Route::post('multi_language','Api\ApiUserController@multiLanguage');

Route::post('get_card_transactions', 'Api\VirtualCardController@getTransactionsList');
Route::post('get_card_limits', 'Api\VirtualCardController@getCardLimits');
Route::post('update_vcard', 'Api\VirtualCardController@updateVirtualCard');
Route::post('pause_vcard', 'Api\VirtualCardController@pausedVirtualCard');
Route::post('unpause_vcard', 'Api\VirtualCardController@openVirtualCard');
Route::post('close_vcard', 'Api\VirtualCardController@closeVirtualCard');
Route::post('create_vcard', 'Api\VirtualCardController@createCard');
Route::post('money_transfer_member_to_member','Api\UserController@submitownbank');
Route::get('admin_settings','Api\ApiUserController@settings');
Route::post('loggedin_user_change_password','Api\UserController@submitPassword');
Route::post('reset_pwd_by_phone','Api\UserController@submitPasswordByPhone');

Route::post('update_profile_image','Api\UserController@avatar');

Route::post('create_support_ticket','Api\UserController@submitticket');
Route::post('reply_support_ticket','Api\UserController@submitreply');
Route::post('support_ticket_reply_list','Api\UserController@ticketReplyListing');
Route::post('ticket_listing','Api\UserController@ticketListing');
Route::post('transfer_user_contact','Api\UserController@transferUserContact');


//});
Route::group([ 'middleware' => ['cors']], function ()//bug-fixed-pm-v2.7
{


});







