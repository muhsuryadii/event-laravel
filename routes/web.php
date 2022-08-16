<?php



use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminEventJSController;
use App\Http\Controllers\AdminPanitiacontroller;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MyEventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
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

    Route::post('/admin/events/create/information', [AdminEventJSController::class, 'storeInformation'])->name('admin_events_store_info');

    Route::post('/admin/events/create/description', [AdminEventJSController::class, 'storeDescription'])->name('admin_events_store_desc');
    Route::post('/admin/events/create/updateHumas', [AdminEventJSController::class, 'storeHumas'])->name('admin_events_store_humas');
    Route::post('/admin/events/create/media', [AdminEventJSController::class, 'storeMedia'])->name('admin_events_store_media');
    Route::post('/admin/events/create/pamflet', [AdminEventJSController::class, 'storePamflet'])->name('admin_events_store_pamflet');
    Route::post('/admin/events/create/certificate', [AdminEventJSController::class, 'storeCertificate'])->name('admin_events_store_certificate');


    Route::put('/admin/events/{uuid}/edit/information', [AdminEventJSController::class, 'updateInformation'])->name('admin_events_update_info');

    Route::put('/admin/events/{uuid}/edit/description', [AdminEventJSController::class, 'updateDescription'])->name('admin_events_update_desc');

    Route::put('/admin/events/{uuid}/edit/updateHumas', [AdminEventJSController::class, 'updateHumas'])->name('admin_events_update_humas');

    Route::post('/admin/events/{uuid}/edit/media', [AdminEventJSController::class, 'updateMedia'])->name('admin_events_update_media');
    Route::put('/admin/events/{uuid}/edit/pamflet', [AdminEventJSController::class, 'updatePamflet'])->name('admin_events_update_pamflet');
    Route::put('/admin/events/{uuid}/edit/certificate', [AdminEventJSController::class, 'updateCertificate'])->name('admin_events_update_certificate');


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
        'exportPDF' => 'admin_report_cetak'
    ]);
    Route::post('/admin/report/{uuid}/exportpdf', [AdminReportController::class, 'exportDomPDF'])->name('admin_report_dom_pdf');

    Route::resource('/admin/panitia', AdminPanitiacontroller::class)->names([
        'index' => 'admin_panitia_index',
        'create' => 'admin_panitia_create',
        'store' => 'admin_panitia_store',
        'show' => 'admin_panitia_show',
        'edit' => 'admin_panitia_edit',
        'destroy' => 'admin_panitia_destroy',
        'update' => 'admin_panitia_update',
        'exportPDF' => 'admin_panitia_cetak'
    ]);
});


/* Guest Root */
Route::group([], function () {
    /* Homepage User */
    Route::get('/', function () {
        // Session::flash('errorFeedback', 'Selamat Datang di Website Kami');
        return view('pages.customer.homepage', [
            'events' => Event::join('users', 'events.id_panitia', '=', 'users.id')
                ->orderBy('waktu_acara')
                ->select('events.*', 'users.nama_user as nama_panitia')
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

    


    /* Search event */
    Route::get('/search', [EventController::class, 'search'])->name('event_search');


    Route::get('/event-by/{uuid}', [EventController::class, 'event_by'])->name('event_by_search');
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


    /* My Event Route */

    Route::get('/my-events', [MyEventController::class, 'index'])->name('my-events_index');
    Route::get('/my-events/{uuid}', [MyEventController::class, 'show'])->name('my-events_show');
    Route::post('/my-events/{uuid}', [MyEventController::class, 'absent'])->name('my_events_absent');
    Route::get('/my-events/{uuid}/certificate', [MyEventController::class, 'grenateCertificate'])->name('my_events_certificate');
});
