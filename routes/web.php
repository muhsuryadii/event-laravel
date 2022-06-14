<?php



use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\EventController;
use App\Models\Event;
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
    return view('pages.customer.homepage', [
        'events' => Event::orderBy('waktu_acara')
            ->where('waktu_acara', '>=', now())
            ->limit(5)->get(),
    ]);
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

    /* Event Admin Route */
    Route::resource('/admin/events', AdminEventController::class)->names([
        'index' => 'admin_events_index',
        'create' => 'admin_events_create',
        'store' => 'admin_events_store',
        'edit' => 'admin_events_edit',
        'update' => 'admin_events_update',
        'destroy' => 'admin_events_destroy',
    ]);

    /*  Route::get('/admin/events/create', [AdminEventController::class, 'createPage'])->name('admin_events_create'); */
});



Route::group(["middleware" => ['auth:sanctum']], function () {
    /* Homepage User */
    Route::get('/', function () {
        return view('pages.customer.homepage', [
            'events' => Event::orderBy('waktu_acara')
                ->where('waktu_acara', '>=', now())
                ->limit(5)->get(),
        ]);
    })->name('home');

    /* Event User */
    Route::resource('/event', EventController::class)->names([
        'index' => 'event_index',
        'create' => 'event_create',
        'store' => 'event_store',
        'show' => 'event_show',
        'edit' => 'event_edit',
        'update' => 'event_update',
        'destroy' => 'event_destroy',
    
    ]);
});
