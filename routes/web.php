<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return redirect('backend');
});

// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

// Logout
Route::get('logout', 'Auth\LoginController@logout');
Route::post('logout', 'Auth\LoginController@logout');

// Register
// Route::get('register', 'Auth\RegisterController@showRegisterForm')->name('register');

// // Setting
// Route::resource('settings', 'SetupController');

// // Config
Route::get('/getConfig', 'Controller@getConfig');
// Route::post('/checkQuota', 'Controller@checkQuota');
// Route::post('/checkRoomBookable', 'Controller@checkRoomBookable');

// // Booking
// Route::post('getRoomGroupBookable', 'BookingController@getRoomGroupBookable');
// Route::get('getroomstatus', 'BookingController@getrooms');

// This should be under 'auth' middleware group
Route::post('/mark-as-read', 'NotificationController@markNotification')->name('markNotification');
Route::get('/send-notification', 'NotificationController@sendActivityNotification');
Route::post('/get-all-notification', 'NotificationController@getAllActivityNotification')->name('notification.get-all');

// Administrator section
Route::group([
    'prefix' => 'backend',
    'middleware' => ['auth'],
    'namespace' => 'Backend'
], function () {

    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    //history
    Route::resource('historytype', 'HistoryTypeController', ['except' => ['show']]);
    Route::post('historytype/delete', 'HistoryTypeController@delete')->name('historytype.delete');

    //animal
    Route::get('animal/profile/{id}', 'AnimalController@profile');
    Route::post('animal/profile', 'AnimalController@history')->name('animal.history');
    Route::get('animal/timeline/{id}', 'AnimalController@timeline');
    Route::get('animal/deleteHistory/{id}', 'AnimalController@deleteHistory');
    Route::get('animal/deleteHistoryImage/{id}', 'AnimalController@deleteHistoryImage');
    

    Route::resource('animalall', 'AnimalController', ['except' => ['show']]);
    Route::get('show',[AnimalController::class, 'show'])->name('animal.show');
    Route::group(['prefix' => 'animalall'], function () {
        Route::post('get_attribute', 'AnimalController@get_attribute')->name('animal.get_attribute');
        // Route::get('show/{id}', 'AnimalController@show')->name('animal.show');
        Route::get('get_attribute_value', 'AnimalController@get_attribute_value')->name('animal.get_attribute_value');
        
    });
    Route::resource('animal-type', 'AnimaltypeController', ['except' => ['show']]);
    // Route::get('animalall/create', 'AnimalController@indexForm')->name('animal-all.indexForm');
    Route::post('animalall/delete', 'AnimalController@delete')->name('animalall.delete');
    Route::post('animal-type/delete', 'AnimaltypeController@delete')->name('animal-type.delete');
    Route::resource('animalattribute', 'AnimalattributeController', ['except' => ['show']]);
    Route::resource('typeattribute', 'TypeAttributeController', ['except' => ['show']]);
    Route::post('animalattribute/delete', 'AnimalattributeController@delete')->name('animalattribute.delete');

    //Home Assistant
    Route::resource('home-assistant', 'HomeAssistantController', ['except' => ['show']]);
    Route::group(['prefix' => 'home-assistant'], function () {
        Route::post('destroy', 'HomeAssistantController@destroy')->name('home-assistant.destroy');
        Route::get('{id}/device', 'HomeAssistantController@device')->name('home-assistant.device');
    });



    // Area
    Route::resource('area', 'AreaController', ['except' => ['show']]);
    Route::group(['prefix' => 'area'], function () {
        Route::get('{id}/device', 'AreaController@device')->name('area.device');
        Route::get('{id}/booking', 'AreaController@booking')->name('area.booking');
        Route::get('{id}/floor-plan', 'AreaController@floor_plan')->name('area.floor-plan');
        Route::get('{id}/permission', 'AreaController@permission')->name('area.permission');
        Route::post('delete', 'AreaController@delete')->name('area.delete');
        Route::post('item-position', 'AreaController@item_position')->name('area.item-position');
        Route::post('update_visible', 'AreaController@updateVisible')->name('area.update-visible');
        Route::post('update_display_status', 'AreaController@updateDisplayStatus')->name('area.update-display-status');
    });

    //Home Assistant
    Route::resource('home-assistant', 'HomeAssistantController', ['except' => ['show']]);
    Route::group(['prefix' => 'home-assistant'], function () {
        Route::post('destroy', 'HomeAssistantController@destroy')->name('home-assistant.destroy');
        Route::get('{id}/device', 'HomeAssistantController@device')->name('home-assistant.device');
    });
    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::resource('datacode', 'DatacodeController', ['except' => ['show']]);

    // Booking Request
    Route::resource('booking-request', 'BookingRequestController', ['except' => ['show']]);
    Route::group(['prefix' => 'booking-request'], function () {
        Route::post('action', 'BookingRequestController@action')->name('booking-request.action');
        Route::post('check_booking_permission', 'BookingRequestController@check_booking_permission')->name('booking-request.check-booking-permission');
    });

    // Building
    Route::resource('farm', 'BuildingController', ['except' => ['show']]);
    Route::group(['prefix' => 'farm'], function () {
        Route::get('{id}/room', 'BuildingController@room')->name('farm.room');
        Route::get('{id}/permission', 'BuildingController@permission')->name('farm.permission');
        Route::get('{id}/floor-plan', 'BuildingController@floor_plan')->name('farm.floor-plan');
        Route::get('reject', 'BuildingController@reject')->name('farm.reject');
        Route::post('update', 'BuildingController@update')->name('farm.update');
        Route::post('item-position', 'BuildingController@item_position')->name('farm.item-position');
    });

    Route::resource('datacode', 'DatacodeController', ['except' => ['show']]);
    Route::group(['prefix' => 'datacode'], function () {
        Route::post('getCondition', 'DatacodeController@getCondition')->name('datacode.getCondition');
    });
    Route::resource('datatcode-condition', 'DatacodeConditionController', ['except' => ['show']]);

    // Device
    Route::resource('device', 'DeviceController', ['except' => ['show']]);
    Route::group(['prefix' => 'device'], function () {
        Route::post('storeCondition', 'DeviceController@storeCondition')->name('device.storeCondition');
        Route::post('destroy', 'DeviceController@destroy')->name('device.destroy');
        Route::get('remove/{id}', 'DeviceController@remove');
        Route::post('getDevice', 'DeviceController@getDevice')->name('device.getDevice');
        Route::post('getDatacode', 'DeviceController@getDatacode')->name('device.getDatacode');
        Route::post('getCondition', 'DeviceController@getCondition')->name('device.getCondition');
        Route::get('getdeviceinit/{id}', 'DeviceController@getdeviceinit');
        Route::post('adddeviceinit', 'DeviceController@adddeviceinit');
        Route::post('update_visible', 'DeviceController@updateVisible')->name('device.update-visible');
        Route::post('update_display_status', 'DeviceController@updateDisplayStatus')->name('device.update-display-status');
    });

    // Device Type
    Route::resource('device-type', 'DeviceTypeController', ['except' => ['show']]);
    Route::group(['prefix' => 'device-type'], function () {
        Route::get('command/{id}', 'DeviceTypeController@command')->name('device-type.command');
        Route::post('commandstore', 'DeviceTypeController@commandstore')->name('device-type.commandstore');
        Route::post('command/commanddelete', 'DeviceTypeController@commanddelete')->name('device-type.commanddelete');

        Route::get('datacode/{id}', 'DeviceTypeController@datacode')->name('device-type.datacode');
        Route::post('datacode/store', 'DeviceTypeController@datacode_store')->name('device-type.datacode_store');
    });

    // Device Type Status
    Route::resource('device-type-status', 'DeviceTypeStatusController', ['except' => ['show']]);
    Route::group(['prefix' => 'device-type-status'], function () {
        Route::post('delete', 'DeviceTypeStatusController@delete')->name('device-type-status.delete');
    });

    Route::resource('chart', 'ChartController', ['except' => ['show']]);

    // Group
    Route::resource('group', 'GroupController', ['except' => ['show']]);
    Route::group(['prefix' => 'group'], function () {
    });

    // Map
    Route::resource('map', 'MapController', ['except' => ['show']]);

    // Permission
    Route::resource('permission', 'PermissionController', ['except' => ['show']]);
    Route::group(['prefix' => 'permission'], function () {
        Route::post('destroy', 'PermissionController@destroy')->name('permission.destroy');
        // Route::get('{id}/building', 'PermissionController@showbuild');
        // Route::get('{id}/room', 'PermissionController@showroom');
    });

    // Room
    Route::resource('house', 'RoomController', ['except' => ['show']]);
    Route::group(['prefix' => 'house'], function () {
        Route::get('{id}/chart', 'RoomController@chart')->name('house.chart');
        Route::post('{id}/chart', 'RoomController@chart')->name('house.chart');
        Route::get('{id}/floor-plan', 'RoomController@floor_plan')->name('house.floor-plan');
        Route::post('disable', 'RoomController@disable')->name('house.disable');
        Route::get('{id}/booking', 'RoomController@booking')->name('house.booking');
        Route::post('{id}/booking', 'RoomController@booking')->name('house.booking');
        Route::get('{id}/device', 'RoomController@device')->name('house.device');
        Route::get('{id}/permission', 'RoomController@permission')->name('house.permission');
        Route::get('{id}/floor-plan', 'RoomController@floor_plan')->name('house.floor-plan');
        Route::post('delete', 'RoomController@delete')->name('house.delete');
        Route::post('update', 'RoomController@update')->name('house.update');
        Route::post('getRoomSeat', 'RoomController@getRoomSeat');
        Route::post('item-position', 'RoomController@item_position')->name('house.item-position');
        Route::post('update_visible', 'RoomController@updateVisible')->name('house.update-visible');
        Route::post('update_display_status', 'RoomController@updateDisplayStatus')->name('house.update-display-status');
    });

    // Room Type
    Route::resource('house-type', 'RoomTypeController', ['except' => ['show']]);
    Route::group(['prefix' => 'house-type'], function () {
        Route::get('reject', 'RoomTypeController@reject')->name('house-type.reject');
        Route::post('update', 'RoomTypeController@update')->name('house-type.update');
    });

    // Setting
    Route::resource('configuration', 'ConfigurationController', ['except' => ['show']]);
    Route::group(['prefix' => 'configuration'], function () {
        Route::get('reject', 'ConfigurationController@reject')->name('configuration.reject');
        Route::post('update', 'ConfigurationController@update')->name('configuration.update');
    });


    Route::get('notification', 'NotificationController@index')->name('notification.index');
    Route::post('notification/update', 'NotificationController@update')->name('notification.update');
    // User
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::group(['prefix' => 'user'], function () {
        Route::post('update_role', 'UserController@update_role')->name('user.update-role');
    });

    // Role
    Route::get('roles', 'PermitController@Permit');

    Route::group(['prefix' => 'power'], function () {

        // Historical view
        Route::group(['prefix' => 'historical'], function () {
            //Route::resource('Historical', 'HistoricalController');
            Route::get('/recently', 'HistoricalController@recently')->name('historical.recently');
            Route::get('/hour', 'HistoricalController@hour')->name('historical.hour');
            Route::get('/day', 'HistoricalController@day')->name('historical.day');
            Route::get('/week', 'HistoricalController@week')->name('historical.week');
            Route::get('/month', 'HistoricalController@month')->name('historical.month');
            Route::post('/recently', 'HistoricalController@recently')->name('historical.recently');
            Route::post('/hour', 'HistoricalController@hour')->name('historical.hour');
            Route::post('/day', 'HistoricalController@day')->name('historical.day');
            Route::post('/week', 'HistoricalController@week')->name('historical.week');
            Route::post('/month', 'HistoricalController@month')->name('historical.month');
            Route::post('recentlyData', 'HistoricalController@getData')->name('recently.data');
        });

        // Meter view
        Route::group(['prefix' => 'meter'], function () {
            Route::get('/dashboard', 'MeterController@dashboard')->name('meter.dashboard');
            Route::get('/', 'MeterController@index')->name('Meter');
            Route::get('/add', 'MeterController@add');
            Route::post('/create', 'MeterController@create')->name('meter.create');
            Route::get('/{id}/edit', 'MeterController@edit');
            Route::get('/{id}/delete', 'MeterController@destroy');
            Route::post('/update_license', 'MeterController@updateLicenseStatus');
            Route::post('/update_loop_time', 'MeterController@updateLoopTime');
        });
    });
    Route::resource('report', 'ReportController', ['except' => ['show']]);
    Route::group(['prefix' => 'report'], function () {
        Route::post('getChartData', 'ReportController@getChartData')->name('report.getChartData');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
