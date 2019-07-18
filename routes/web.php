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

Auth::routes(['reset' => false]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/articles', 'HomeController@view_articles');
Route::get('/about_us', 'HomeController@view_about_us');
Route::get('/contact_us', 'HomeController@view_contact_us');

Route::get('/change_personal_info/{id}', 'ServiceController@show_change_info')->name('change_personal_info.show');
Route::patch('/change_personal_info/update/{id}', 'ServiceController@update_change_info')->name('change_personal_info.update');

Route::get('/my_dog_lists','ServiceController@index_my_list')->name('my_lists.index');
Route::get('/my_dog_lists/show','ServiceController@show_my_list')->name('my_lists.show');
Route::patch('/my_dog_lists/add/{id}', 'ServiceController@add_my_list')->name('my_lists.add');
Route::delete('/my_dog_lists/delete/{id}', 'ServiceController@delete_my_list')->name('my_lists.delete');

Route::get('/search', 'ServiceController@microchip_no_search')->name('microchip_no.search');
Route::get('/install_search', 'ServiceController@microchip_install_search')->name('microchip_no.install_search');

Route::post('/request_change_owner', 'ServiceController@store_request_change_owner')->name('request_change_owners.store');

Route::post('/request_install', 'ServiceController@request_install')->name('request_install.store');

// Dynamic Dropdown
Route::post('orders/dropdown_province','ManageOrderController@dropdown_province')->name('orders.dropdown_province');
Route::post('orders/dropdown_amphures','ManageOrderController@dropdown_amphures')->name('orders.dropdown_amphures');
Route::post('orders/delivery_fee','ManageOrderController@delivery_fee')->name('orders.delivery_fee');

//Route for admin
Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => ['is_admin']], function(){
        Route::get('/dashboard', 'RoleController@dashboard_admin')->name('dashboard.admin');

        Route::resource('manage_articles','ManageArticleController', ['except' => ['show']]);

        Route::resource('manage_users','ManageUserController', ['except' => ['show']]);

        Route::get('manage_home', 'ManageWebController@view_manage_home')->name('home.manage');
        Route::patch('manage_home/{id}', 'ManageWebController@manage_home')->name('home.update');
        Route::get('manage_about_us', 'ManageWebController@view_manage_about_us')->name('about_us.manage');
        Route::patch('manage_about_us/{id}', 'ManageWebController@manage_about_us')->name('about_us.update');
        Route::get('manage_contact_us', 'ManageWebController@view_manage_contact_us')->name('contact_us.manage');
        Route::patch('manage_contact_us/{id}', 'ManageWebController@manage_contact_us')->name('contact_us.update');

        Route::resource('manage_dog_farms', 'ManageDogFarmController', ['except' => ['create','show','edit']]);
        Route::get('manage_dog_farms/{id}/{dog_farm_name}', 'ManageDogFarmController@show')->name('manage_dog_farms.show');
        Route::get('manage_dog_farms/{id}/{dog_farm_name}/ตัวผู้', 'ManageDogFarmController@show_male')->name('manage_dog_farms.show_male');
        Route::get('manage_dog_farms/{id}/{dog_farm_name}/ตัวเมีย', 'ManageDogFarmController@show_female')->name('manage_dog_farms.show_female');
        Route::get('manage_dog_farms/{id}/{dog_farm_name}/{dog_breed}', 'ManageDogFarmController@sort_breed')->name('manage_dog_farms.sort_breed');

        Route::resource('manage_dog_breeds', 'ManageDogBreedController', ['except' => ['create','show','edit']]);
        Route::get('manage_dog_breeds/{id}/{dog_breed}', 'ManageDogBreedController@show')->name('manage_dog_breeds.show');
        Route::get('manage_dog_breeds/{id}/{dog_breed}/ตัวผู้', 'ManageDogBreedController@show_male')->name('manage_dog_breeds.show_male');
        Route::get('manage_dog_breeds/{id}/{dog_breed}/ตัวเมีย', 'ManageDogBreedController@show_female')->name('manage_dog_breeds.show_female');
        Route::get('manage_dog_breeds/{id}/{dog_breed}/{dog_farm_name}', 'ManageDogBreedController@sort_farm')->name('manage_dog_breeds.sort_farm');

        Route::resource('manage_dogs', 'ManageDogController');
        Route::get('manage_dogs/sort_breed/{dog_breed}', 'ManageDogController@index_sort_breed')->name('manage_dogs.index_sort_breed');
        Route::get('manage_dogs/sort_farm/{dog_farm_name}', 'ManageDogController@index_sort_farm')->name('manage_dogs.index_sort_farm');
        Route::get('manage_dogs/sort_sex/{dog_sex}', 'ManageDogController@index_sort_sex')->name('manage_dogs.index_sort_sex');
        Route::get('manage_dogs/sort_status/{dog_status}', 'ManageDogController@index_sort_status')->name('manage_dogs.index_sort_status');
        Route::get('manage_dogs/show_install/{id}', 'ManageDogController@show_install')->name('manage_dogs.show_install');

        Route::resource('manage_microchips', 'ManageMicrochipController', ['except' => ['create','edit']]);
        Route::get('manage_microchips/sort_status/{microchip_status}', 'ManageMicrochipController@index_sort_status')->name('manage_microchips.index_sort_status');
        Route::get('manage_microchips/show_install/{id}', 'ManageMicrochipController@show_install')->name('manage_microchips.show_install');
        
        Route::resource('manage_orders', 'ManageOrderController', ['except' => ['create','edit','update']]);
        Route::get('manage_orders/sort_deliveryman/{name}', 'ManageOrderController@index_sort_deliveryman')->name('manage_orders.index_sort_deliveryman');
        Route::get('manage_orders/sort_status/{order_status}', 'ManageOrderController@index_sort_status')->name('manage_orders.index_sort_status');
        Route::get('manage_orders/create_dog_order/{manage_order}', 'ManageOrderController@create_dog')->name('manage_orders.create_dog');
        Route::get('manage_orders/create_microchip_order/{manage_order}', 'ManageOrderController@create_microchip')->name('manage_orders.create_microchip');
        Route::get('manage_orders/create_install_order/{manage_order}', 'ManageOrderController@create_install')->name('manage_orders.create_install');
        Route::patch('manage_orders/{manage_order}', 'ManageOrderController@confirm')->name('manage_orders.confirm');
        Route::patch('manage_orders/resend/{manage_order}', 'ManageOrderController@resend')->name('manage_orders.resend');
        
        Route::get('sells','SellController@index')->name('sells.index');
        Route::get('sells/{id}', 'SellController@show')->name('sells.show');
        
        Route::get('manage_request_change_owners','ServiceController@index_request_change_owner')->name('request_change_owners.index');
        Route::put('manage_request_change_owners/{id}','ServiceController@confirm_request_change_owner')->name('request_change_owners.confirm');
        Route::delete('manage_request_change_owners/{id}','ServiceController@delete_request_change_owner')->name('request_change_owners.delete');
        
        Route::get('manage_request_installs','ServiceController@index_request_install')->name('request_install.index');
        Route::patch('manage_request_installs/{id}', 'ServiceController@confirm_request_install')->name('request_install.confirm');
        Route::delete('manage_request_installs/{id}','ServiceController@delete_request_install')->name('request_install.delete');

        // Report
        Route::get('install_microchip/report','ReportController@report_install')->name('report_install.index');
        Route::get('install_microchip/report_search','ReportController@search_report_install')->name('report_install.search');
        Route::get('pdf_install_microchip/{id}','ReportController@pdf_install_microchip')->name('pdf_install_microchip');
        Route::get('pdf_sell/{id}','ReportController@pdf_sell')->name('pdf_sell');
        Route::get('total_sell','ReportController@total_sell')->name('total_sell.index');
        Route::get('total_sell/sort','ReportController@total_sell_sort')->name('total_sell.sort');
    });
});

//Route for deliveryman
Route::group(['prefix' => 'deliveryman'], function(){
    Route::group(['middleware' => ['is_deliveryman']], function(){
        Route::get('/dashboard', 'RoleController@dashboard_deliveryman')->name('dashboard.deliveryman');

        Route::get('manage_orders', 'ManageOrderController@index_deliveryman')->name('manage_orders.index_deliveryman');
        Route::get('manage_orders/{id}', 'ManageOrderController@show_deliveryman')->name('manage_orders.show_deliveryman');
        Route::patch('manage_orders/{manage_order}', 'ManageOrderController@confirm_deliveryman')->name('manage_orders.confirm_deliveryman');
        Route::get('manage_orders/sort_status/{order_status}', 'ManageOrderController@index_deliveryman_sort_status')->name('manage_orders.index_deliveryman_sort_status');

        Route::resource('manage_transports', 'ManageTransportController');

        Route::get('pdf_order/{id}','ReportController@pdf_order')->name('pdf_order');
    });
});
