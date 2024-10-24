<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth','check.access'])->as('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('zones', App\Http\Controllers\ZoneController::class);
    Route::resource('offers', App\Http\Controllers\OfferController::class);
    Route::resource('campaigns', App\Http\Controllers\CampaignController::class);
    Route::get('/campaigns/{funnelId}/filters', [App\Http\Controllers\CampaignController::class, 'getSelectedFilters']);
    Route::get('test/{id}', [App\Http\Controllers\CampaignController::class, 'test'])->name('campaigns.test');
    Route::resource('websites', App\Http\Controllers\WebsiteController::class);
    Route::get('list-offers', [App\Http\Controllers\OfferController::class, 'listOffers'])->name('offers.list');
    Route::get('list-devices', [App\Http\Controllers\DeviceController::class, 'listDevices'])->name('devices.list');
    Route::get('list-browsers', [App\Http\Controllers\BrowserController::class, 'listBrowsers'])->name('browsers.list');
    Route::get('list-countries', [App\Http\Controllers\CountryController::class, 'listCountries'])->name('countries.list');
    Route::get('list-websites', [App\Http\Controllers\WebsiteController::class, 'listWebsites'])->name('websites.list');

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::match(['get', 'post'], 'update-profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('users.update-profile');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

