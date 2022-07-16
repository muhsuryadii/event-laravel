<?php



use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MyEventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

/* Route::get('/', function () {
    return view('pages.customer.homepage', [
        'events' => Event::orderBy('waktu_acara')
            ->where('waktu_acara', '>=', now())
            ->limit(5)->get(),
    ]);
})->name('home'); */

/* Auth Root */

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

    /* Transaction Route */
    Route::resource('/admin/transaksi', AdminTransaksiController::class)->names([
        'index' => 'admin_transaksi_index',
        'show' => 'admin_transaksi_show',
        'update' => 'admin_transaksi_update',
    ]);

    Route::resource('/admin/report', AdminReportController::class)->names([
        'index' => 'admin_report_index',
        'show' => 'admin_report_show',
        'update' => 'admin_report_update',
        'exportPDF' => 'admin_report_cetak',
    ]);
    Route::post('/admin/report/{uuid}/exportpdf', [AdminReportController::class, 'exportPDF'])->name('admin_report_cetak');

    /*  Route::get('/admin/events/create', [AdminEventController::class, 'createPage'])->name('admin_events_create'); */
});


/* Guest Root */
Route::group([], function () {
    /* Homepage User */
    Route::get('/', function () {
        // Session::flash('errorFeedback', 'Selamat Datang di Website Kami');
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

/* Login Root */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session')
])->group(function () {

    Route::resource('/transaksi', TransactionController::class)->names([
        'index' => 'checkout_index',
        'create' => 'checkout_create',
        'store' => 'checkout_store',
        'show' => 'checkout_show',
        'edit' => 'checkout_edit',
        'update' => 'checkout_update',
        'destroy' => 'checkout_destroy'
    ]);

    Route::resource('/profile', ProfileController::class)->names([
        'show' => 'profile_show',
        'edit' => 'profile_edit',
        'update' => 'profile_update',
        'destroy' => 'profile_destroy'
    ]);


    Route::get('/my-events', [MyEventController::class, 'index'])->name('my-events_index');
    Route::get('/my-events/{uuid}', [MyEventController::class, 'show'])->name('my-events_show');
    Route::post('/my-events/{uuid}', [MyEventController::class, 'absent'])->name('my-events_absent');
});
