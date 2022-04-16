<?php


use App\Http\Controllers\Auth\ActivationAccountController;
use App\Http\Controllers\Client\Auth\RegisteredClientController;
use App\Http\Controllers\Client\ClinetController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
// Route::post('dashboard/setCookies', 'CookiesController@setCookies');
Route::group(['middleware' => 'auth', 'prefix' => 'activation'], function(){
    Route::get('check', [ActivationAccountController::class, 'check'])->name('activation.check');
    Route::post('verify', [ActivationAccountController::class, 'verify'])->name('activation.verify');
    Route::post('resendCode', [ActivationAccountController::class, 'resendCode'])->name('resendCode');

});


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard')->middleware('isActive');

require __DIR__.'/auth.php';
