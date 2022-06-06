<?php



use App\Http\Controllers\AdminEventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*app\Http\Livewire\Admin\Event\Show.php
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
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'roleCheck'
])->group(function () {
    Route::get('/dashboard', function () {
        // dd(auth()->user());
        return view('pages.admin.dashboard', [
            'user' => Auth::user(),
        ]);
    })->name('dashboard_admin');

    /* Event Route */
    Route::get('/admin/events/checkslug', [AdminEventController::class, 'checkSlug'])->name('admin_events_checkslug');
    
    Route::resource('/admin/events', AdminEventController::class)->names([
        'index' => 'admin_events_index',
        'create' => 'admin_events_create',
        'store' => 'admin_events_store',
    ]);

    /*  Route::get('/admin/events/create', [AdminEventController::class, 'createPage'])->name('admin_events_create'); */
});


/* 
Route::group(["middleware" => ['auth:sanctum', '']], function () {
    Route::view('/dashboard', "dashboard")->name('dashboard');
}); */
