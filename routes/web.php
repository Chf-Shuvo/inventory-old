<?php

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

/**
 * group routes which includes resources start
 */
                    /** Admin Panel */
Route::group(['prefix' => 'admin'], function () {
    Route::get('user/{id}','UserController@delete')->name('user.delete');
    Route::resource('user', 'UserController');
    Route::get('acl','UserController@acl_index')->name('acl.index');
    Route::post('acl','UserController@acl_store')->name('acl.store');
    // roles
    Route::get('acl-role-edit/{id}','UserController@role_edit')->name('role.edit');
    Route::match(['put','patch'],'acl-role-update/{id}','UserController@role_update')->name('role.update');
    Route::get('acl-role-delete/{id}','UserController@role_delete')->name('role.delete');
    // permission
    Route::get('acl-permission-edit/{id}','UserController@permission_edit')->name('permission.edit');
    Route::match(['put','patch'],'acl-permission-update/{id}','UserController@permission_update')->name('permission.update');
    Route::get('acl-permission-delete/{id}','UserController@permission_delete')->name('permission.delete');
    // user acl manage
    Route::get('acl-manage/{id}','UserController@acl_manage')->name('acl.manage');
    Route::post('acl-add/{id}','UserController@acl_add')->name('acl.add');
    // user departments
    Route::get('department-remove/{id}', 'DepartmentController@delete')->name('department.delete');
    Route::resource('department', 'DepartmentController');
});
                    /** Product Management */
Route::group(['prefix' => 'product-manage'], function () {
    // vendor
    Route::get('vendor/delete/{id}','VendorController@delete')->name('vendor.delete');
    Route::resource('vendor', 'VendorController'); 
    // category
    Route::get('category/delete/{id}','CategoryController@delete')->name('category.delete');
    Route::resource('category', 'CategoryController');
    // product
    Route::get('product/delete/{id}','ProductController@delete')->name('product.delete');
    Route::resource('product', 'ProductController');
    // storage
    Route::get('storage/delete/{id}','StorageController@delete')->name('storage.delete');
    Route::resource('storage', 'StorageController');
});
                    /** Stock Management */
Route::group(['prefix' => 'stock-management'], function () {
    //stock routes
    Route::get('product/{id}','StockController@product_stock')->name('product.stock');
    // stock resource controller
    Route::get('stock/{id}','StockController@delete')->name('stock.delete');
    Route::resource('stock', 'StockController');
    // internal transfer part
    Route::get('delivered-list','Transfer@index')->name('transfer.index');
    Route::get('transfer-process/{id}','Transfer@transfer_process')->name('transfer.process');
    Route::match(['put','patch'],'transfer-execute/{id}','Transfer@transfer_execute')->name('transfer.execute');
});
                    /** Requisition Part */
Route::group(['prefix' => 'requisition'], function () {
    //submit in
    Route::get('submit/delete/{id}','StockController@delete')->name('stock.delete');
    // routes of Submission of the requisition
    Route::resource('submit', 'RequisitionTempController'); 
    // route that fetches all the Pending and Approved requisitions
    Route::get('approve','RequisitionTempController@approve_index')->name('submit.approve_index');
    // route that takes the requisition for confirmation
    Route::get('approve-confirm/{id}','RequisitionTempController@approve_confirm')->name('submit.approve_confirm');
    // in the time of checking remove products if necessary
    Route::get('product-remove/{id}','RequisitionTempController@approve_product_remove')->name('submit.approve_product_remove');
    // in the time of checking add products if necessary
    Route::post('product-add','RequisitionTempController@approve_product_add')->name('submit.approve_product_add');
    // routes that confirms the requisition from the head
    Route::get('approve-head/{id}','RequisitionTempController@approve_head')->name('submit.approve_head');
    // route that gives approval of the deputy registrar
    Route::get('approve-deputy/{id}','RequisitionTempController@approve_deputy')->name('submit.approve_deputy');
    // route that gives approval of the registrar
    Route::get('approve-registrar/{id}','RequisitionTempController@approve_registrar')->name('submit.approve_registrar');
    // route that grabs all final approved requisitions 
    Route::get('final-approved','RequisitionTempController@final')->name('approved.final');
    // route that picks single requisition to show the products
    Route::get('final-view/{id}','RequisitionTempController@req_view')->name('approved.view');
    // route that delivers and generates the invoice the products
    Route::get('final-deliver/{id}','RequisitionTempController@req_deliver')->name('approved.deliver');
    // route that confirms the receiving of the requisition
    Route::get('final-receive/{id}','RequisitionTempController@final_receive')->name('final.receive');
});
                                        /** Invoice Part */
// create
Route::get('invoice-create/{id}','InvoiceController@create')->name('invoice.create');
// check before print
Route::get('invoice-check/{id}','InvoiceController@check')->name('invoice.check');
// print
Route::match(['put','patch'],'invoice-print/{id}','InvoiceController@print')->name('invoice.print');
Route::resource('invoice', 'InvoiceController',['only' => ['index','update','edit','store']]); 
                                        /** Report Part */
Route::group(['prefix' => 'report'], function () {
    // by department
    Route::get('byDept', 'ReportController@dept_index')->name('r_by_dept.index');
    Route::get('byDept-view/{id}', 'ReportController@dept_view')->name('r_by_dept.view');
    Route::get('byDept-products/{id}', 'ReportController@dept_product_view')->name('r_by_dept_product.view');
    // by lab
    Route::get('byLab', 'ReportController@lab_index')->name('r_by_lab.index');
    Route::get('byLab-view/{id}', 'ReportController@lab_view')->name('r_by_lab.view');
    Route::get('byLab-products/{id}', 'ReportController@lab_product_view')->name('r_by_lab_product.view');
});
                                            // importer routes
Route::group(['prefix' => 'import'], function () {
   Route::post('import-requisitions', 'Import_Controller@requisition_import')->name('requisition.import');
});
                                        /**
                                         * Ajax routes
                                         */
Route::get('product-fetch', 'AjaxController@product_fetch')->name('product_fetch');  
Route::get('color-fetch', 'AjaxController@color_fetch')->name('color_fetch');  
/*
|here all the group routes are crated which only returns views not any data
*/
/**
 * group routs end here
 */

Route::get('/', function () {
            // $user = "baiustict";
            // $pass = "20baiustictw";
            // //$mobile = "01912442281";
            // $sms_content = "hello ICT";
            // $msg=urlencode($sms_content);
            // $numbers=['01521211335','01575067411'];
            
                
            // function curl($url) {
            //     $ch = curl_init();
            //     curl_setopt($ch, CURLOPT_URL, $url);
            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            //     $data = curl_exec($ch);
            //     curl_close($ch);

            //     return $data;
            // }
            // foreach($numbers as $number){
            //     $feed = "http://developer.muthofun.com/sms.php?username=$user&password=$pass&mobiles=$number&sms=$msg&uniccode=1";
            //     $tweets = curl($feed);
            // }
            return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/calendar', 'HomeController@calendar')->name('calendar');
