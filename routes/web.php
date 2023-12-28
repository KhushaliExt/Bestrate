<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\IndexController;

use App\Http\Controllers\Admin\KeywordsController;

use App\Http\Controllers\Admin\adminsellerController;

use App\Http\Controllers\Admin\adminbuyercontroller;

use App\Http\Controllers\Admin\admininquirycontroller;

use App\Http\Controllers\Admin\userrolecontroller;

use App\Http\Controllers\Admin\Repoertcontroller;

use App\Http\Controllers\Buyer\buyerinquirycontroller;

use App\Http\Controllers\Buyer\buyerprofilecontroller;

use App\Http\Controllers\Seller\sellercontroller;

use App\Http\Controllers\Seller\sellerbidcontroller;

use App\Http\Controllers\Registercontroller;

use App\Http\Controllers\customRegistercontroller;

use App\Http\Controllers\customlogincontroller;

use App\Http\Controllers\Admin\profilecontroller;

use App\Http\Controllers\switchaccountcontroller;
/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider and all of them will

| be assigned to the "web" middleware group. Make something great!

|

*/





//Clear Cache facade value:

Route::get('/clear-cache', function() {

    $exitCode = Artisan::call('cache:clear');

    return '<h1>Cache facade value cleared</h1>';

});



//Reoptimized class loader:

Route::get('/optimize', function() {

    $exitCode = Artisan::call('optimize');

    return '<h1>Reoptimized class loader</h1>';

});



//Route cache:

Route::get('/route-cache', function() {

    $exitCode = Artisan::call('route:cache');

    return '<h1>Routes cached</h1>';

});



//Clear Route cache:

Route::get('/route-clear', function() {

    $exitCode = Artisan::call('route:clear');

    return '<h1>Route cache cleared</h1>';

});



//Clear View cache:

Route::get('/view-clear', function() {

    $exitCode = Artisan::call('view:clear');

    return '<h1>View cache cleared</h1>';

});



//Clear Config cache:

Route::get('/config-cache', function() {

    $exitCode = Artisan::call('config:cache');

    return '<h1>Clear Config cleared</h1>';

});



Route::get('adminprofile',[profilecontroller::class,'adminprofile'])->name('adminprofile');

Route::post('adminprofileupdate',[profilecontroller::class,'updateprofile'])->name('adminupdateprofile');



Route::get('send-mail', [customRegistercontroller::class, 'mail']);

Route::get('buyerregister',[customRegistercontroller::class,'customregister'])->name('customregister');

Route::post('findpincode',[customRegistercontroller::class,'findpincode'])->name('findpincode');

Route::post('buyerregisted',[customRegistercontroller::class,'buyerregisted'])->name('buyerregisted');

Route::post('sellerregisted',[customRegistercontroller::class,'sellerregisted'])->name('sellerregisted');

Route::post('customlogin',[customlogincontroller::class,'customlogin'])->name('customlogin');

Route::post('otpverify',[customlogincontroller::class,'otpverify'])->name('otpverify');



Route::group(['middleware' => ['auth']], function () { 



Route::get('/',[IndexController::class,'index'])->name('admin.index');

Route::get('switchseller',[switchaccountcontroller::class,'switchseller'])->name('switchseller');
Route::get('switchbuyer',[switchaccountcontroller::class,'switchbuyer'])->name('switchbuyer');


Route::get('admin/product_Request',[KeywordsController::class,'viewkeywordrequest'])->name('admin.viewkeywordrequest');

Route::get('/requestproductstatus/{id}/{status}',[KeywordsController::class,'requestkeywordstatus'])->name('requestkeywordstatus');





Route::post('store/product',[KeywordsController::class,'storekeyword'])->name('store.keyword');

Route::get('admin/product',[KeywordsController::class,'keyword'])->name('admin.keyword');

Route::post('update/product',[KeywordsController::class,'update'])->name('updatekeyword');

Route::get('delete/product/{id}',[KeywordsController::class,'delete'])->name('deletekeyword');

Route::get('/productstatus/{id}/{status}',[KeywordsController::class,'keywordstatus'])->name('keywordstatus');





Route::get('admin/seller',[adminsellerController::class,'adminseller'])->name('admin.seller');

Route::post('store/seller',[adminsellerController::class,'storeseller'])->name('admin.storeseller');

Route::get('adminsellerstatus/{id}/{status}',[adminsellerController::class,'adminsellerstatus'])->name('admin.sellerstatus');

Route::get('adminsellerdelete/{id}',[adminsellerController::class,'delete'])->name('adminsellerdelete');

Route::post('updateseller',[adminsellerController::class,'updateseller'])->name('admin.updateseller');
Route::post('adminselleredit',[adminsellerController::class,'editseller'])->name('admin.editseller');




Route::get('admin/buyer',[adminbuyercontroller::class,'adminbuyer'])->name('admin.buyer');

Route::post('store/buyer',[adminbuyercontroller::class,'storebuyer'])->name('admin.storebuyer');

Route::post('update/buyer',[adminbuyercontroller::class,'update'])->name('admin.updatebuyer');

Route::get('adminbuyerdelete/{id}',[adminbuyercontroller::class,'delete'])->name('admin.buyerdelete');

Route::get('admin/buyerstatus/{id}/{status}',[adminbuyercontroller::class,'buyerstatus'])->name('admin.buyerstatus');



Route::get('admin/inqury',[admininquirycontroller::class,'admininquiry'])->name('admin.inquiry');

Route::get('admin/userrole',[userrolecontroller::class,'index'])->name('userrole');
Route::get('admin/rolepermission/{id}',[userrolecontroller::class,'rolepermission'])->name('rolepermission');
Route::post('admin/updatepermission',[userrolecontroller::class,'updatepermission'])->name('updatepermission');
Route::get('userpermission',[userrolecontroller::class,'userpermission'])->name('userpermission');
Route::post('addpermission',[userrolecontroller::class,'addpermission'])->name('addpermission');

Route::get('admin/keywordrepoert',[Repoertcontroller::class,'keywordrepoert'])->name('keywordrepoert');





Route::get('admin/sellerrepoert',[Repoertcontroller::class,'sellerrepoert'])->name('sellerrepoert');
Route::get('admin/buyerrepoert',[Repoertcontroller::class,'buyerrepoert'])->name('buyerrepoert');
Route::get('admin/inquiryrepoert',[Repoertcontroller::class,'inquieryrepoert'])->name('inquieryrepoert');


Route::get('buyer/inquiry',[buyerinquirycontroller::class,'viewbuyerinquiry'])->name('viewbuyerinquiry');
Route::get('buyer/createinquiry',[buyerinquirycontroller::class,'createinquiry'])->name('createinquiry');
Route::get('buyer/buyerprofile',[buyerprofilecontroller::class,'buyerprofile'])->name('buyerprofile');
Route::post('buyer/postbuyerinquiries' ,[buyerinquirycontroller::class,'postbuyerinquiries'])->name('postbuyerinquiries');
Route::post('buyer/updateprofile',[buyerprofilecontroller::class,'updatebuyerprofile'])->name('updatebuyerprofile');
Route::get('buyer/inquerydelete/{id}',[buyerinquirycontroller::class,'inquerydelete'])->name('inquerydelete');
Route::post('buyer/buyerinqueryfind',[buyerinquirycontroller::class,'buyerinqueryfind'])->name('buyerinqueryfind');
Route::get('sellerquotationaccept/{id}',[buyerinquirycontroller::class,'sellerquotationaccept'])->name('sellerquotationaccept');
Route::get('sellerquotationreject/{id}',[buyerinquirycontroller::class,'sellerquotationreject'])->name('sellerquotationreject');





Route::get('seller/sellerprofile',[sellercontroller::class,'sellerprofile'])->name('sellerprofile');

Route::get('seller/sellerbid',[sellercontroller::class,'sellerbid'])->name('sellerbid');

Route::post('seller/findquotation',[sellercontroller::class,'findquotation'])->name('findquotation');

Route::post('seller/updatequotation',[sellercontroller::class,'updatequotation'])->name('updatequotation');

Route::get('seller/deletesellerquery/{id}',[sellercontroller::class,'deletesellerquery'])->name('deletesellerquery');

Route::get('seller/sellerkeyworddelete/{id}',[sellercontroller::class,'sellerkeyworddelete'])->name('sellerkeyworddelete');

Route::post('seller/sellerkeywordadd',[sellercontroller::class,'sellerkeywordadd'])->name('sellerkeywordadd');

Route::post('seller/store/sellerkeyword',[sellercontroller::class,'storesellerkeyword'])->name('store.sellerkeyword');

Route::post('seller/loadquerymodel',[sellercontroller::class,'loadquerymodel'])->name('loadquerymodel');

Route::post('sellerqueryaccept',[sellercontroller::class,'sellerqueryaccept'])->name('sellerqueryaccept');

Route::post('sellerqueryreject',[sellercontroller::class,'sellerqueryreject'])->name('sellerqueryreject');

Route::post('selfsellerqueryreject',[sellercontroller::class,'selfsellerqueryreject'])->name('selfsellerqueryreject');

});

Route::post('sellerprofileupdate',[sellercontroller::class,'sellerprofileupdate'])->name('sellerprofileupdate');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

