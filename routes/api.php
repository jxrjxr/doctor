<?php

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

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');



Route::group(['prefix' => 'wechat'], function () {

    Route::get('jsoption',['uses' => 'Api\Wechat@jsOption']);

    Route::get('serverauth',['uses' => 'Api\Wechat@serverAuth']);

    Route::get('userauth',['uses' => 'Api\Wechat@userAuth']);

    Route::get('addorfinduser',['uses' => 'Api\Wechat@addOrFindUser']);

    Route::get('getmedia',['uses' => 'Api\Wechat@getMedia']);

});

Route::group(['prefix' => 'common'], function () {

    Route::post('upload',['uses' => 'Api\Common@uploadFiles']);
});

Route::group(['prefix' => 'login'], function () {

    Route::post('sms',['uses' => 'Api\Login@sms']);

    Route::post('index',['uses' => 'Api\Login@index']);

});

Route::group(['prefix' => 'tag'], function () {

    Route::get('lists',['uses' => 'Api\Tag@lists']);

    Route::post('add',['uses' => 'Api\Tag@add']);

});

Route::group(['prefix' => 'comment'], function () {

    Route::get('lists',['uses' => 'Api\Comment@lists']);

    Route::post('add',['uses' => 'Api\Comment@add']);

    Route::post('delete',['uses' => 'Api\Comment@delete']);

});

Route::group(['prefix' => 'user'], function () {

    Route::get('index',['uses' => 'Api\User@index']);

    Route::get('weichatauth',['uses' => 'Api\User@weichatAuth','as' => 'user.wechat.auth']);

    Route::get('lists',['uses' => 'Api\User@lists']);

    Route::get('detail',['uses' => 'Api\User@detail']);

    Route::post('update',['uses' => 'Api\User@update']);

    Route::get('orderlists',['uses' => 'Api\User@orderList']);

    Route::get('search',['uses' => 'Api\User@search']);

});

Route::group(['prefix' => 'hospital'], function () {

    Route::get('index',['uses' => 'Api\Hospital@index']);

    Route::get('lists',['uses' => 'Api\Hospital@lists']);

    Route::get('detail',['uses' => 'Api\Hospital@detail']);

    Route::get('orderlists',['uses' => 'Api\Hospital@orderList']);

});

Route::group(['prefix' => 'searchhistory'], function () {

    Route::get('lists',['uses' => 'Api\SearchHistory@lists']);

});

Route::group(['prefix' => 'message'], function () {

    Route::get('lists',['uses' => 'Api\Message@lists']);

    Route::get('detail',['uses' => 'Api\Message@detail']);
});

Route::group(['prefix' => 'wallet'], function () {

    Route::get('amount',['uses' => 'Api\Wallet@amount']);

    Route::get('lists',['uses' => 'Api\Wallet@lists']);

});

Route::group(['prefix' => 'score'], function () {

    Route::get('amount',['uses' => 'Api\Score@amount']);

    Route::get('lists',['uses' => 'Api\Score@lists']);

});

Route::group(['prefix' => 'order'], function () {

    Route::post('add',['uses' => 'Api\Order@add']);

    Route::get('accept/lists',['uses' => 'Api\Order@acceptLists']);

    Route::get('send/lists',['uses' => 'Api\Order@sendLists']);

});

Route::group(['prefix' => 'like'], function () {

    Route::post('add',['uses' => 'Api\Like@add']);

    Route::post('cancel',['uses' => 'Api\Like@cancel']);

    Route::get('lists',['uses' => 'Api\Like@lists']);

});

Route::group(['prefix' => 'flower'], function () {

    Route::post('add',['uses' => 'Api\Flower@add']);

    Route::post('cancel',['uses' => 'Api\Flower@cancel']);

    Route::get('lists',['uses' => 'Api\Flower@lists']);

    Route::post('payment',['uses' => 'Api\Flower@payment']);

    Route::post('paymentCallBack',['uses' => 'Api\Flower@payment','as' => 'flower.payment.callback']);
});

Route::group(['prefix' => 'follow'], function () {

    Route::get('index',['uses' => 'Api\Follow@index']);

    Route::get('search',['uses' => 'Api\Follow@search']);

    Route::post('add',['uses' => 'Api\Follow@add']);

    Route::post('cancel',['uses' => 'Api\Follow@cancel']);

    Route::get('lists',['uses' => 'Api\Follow@lists']);

});

Route::group(['prefix' => 'garden'], function () {

    Route::post('update',['uses' => 'Api\Garden@update']);

    Route::get('detail',['uses' => 'Api\Garden@detail']);

});




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
