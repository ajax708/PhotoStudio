
 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\DetectController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome.index');

Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
})->name('offline.index');

Route::get('/register', [RegisterController::class, 'create'])->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [SessionController::class, 'create'])->name('login.index');

Route::post('/login', [SessionController::class, 'login'])->name('login.auth');

Route::get('/gallery/photos/event', [PhotoController::class, 'gallery'])->name('photo.gallery');

Route::middleware(['auth'])->group(function () {
    //logout
    Route::get('/logout', [SessionController::class, 'destroy'])->name('login.destroy');

    //portal principal
    Route::get('/dashboard', function(){
        return view('admin.main');
    })->name('main.index');

    //rutas de usuario
    Route::get('/dashboard/edituser', [RegisterController::class, 'edit'])->name('user.edit');
    Route::put('/upduser/{id}', [RegisterController::class, 'update'])->name('user.update');
    Route::put('/upduserpass/{id}', [RegisterController::class, 'updatepassword'])->name('pass.update');

    //rutas de eventos
    Route::get('/dashboard/event/addevent', [EventController::class, 'create'])->name('event.create');
    Route::get('/dashboard/event/calendar', [EventController::class, 'calendar'])->name('event.calendar');
    Route::post('/event/createvent', [EventController::class, 'store'])->name('event.store');
    Route::get('/dashboard/event/show-events', [EventController::class, 'show'])->name('event.show');
    Route::get('/dashboard/events/{id}/event', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/dashboard/updevent/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/dashboard/delevent/{id}', [EventController::class, 'destroy'])->name('event.destroy');

    //rutas de asignaciones
    Route::get('/dashboard/assignment/addphotographer', [AssignmentController::class, 'create'])->name('assign.create');
    Route::post('/assignment/createassignment', [AssignmentController::class, 'store'])->name('assign.store');
    Route::get('/dashboard/assignment/show-assignments', [AssignmentController::class, 'show'])->name('assign.show');
    Route::get('/dashboard/assignment/show-photographers/{id}', [AssignmentController::class, 'showprofile'])->name('assign.profile');
    Route::delete('/dashboard/delassignment/{id}', [AssignmentController::class, 'destroy'])->name('assign.destroy');

    //rutas de imagenes
    Route::get('/dashboard/photo/addphoto', [PhotoController::class, 'create'])->name('photo.create');
    Route::post('/photo/createphoto', [PhotoController::class, 'store'])->name('photo.store');
    Route::get('/dashboard/photo/show-photos', [PhotoController::class, 'show'])->name('photo.show');
    Route::get('/dashboard/photo/show-photos-all', [PhotoController::class, 'showtoadmin'])->name('photo.showtoadmin');

    //rutas de deteccion de imagenes
    Route::get('/dashboard/detect/show-photos', [DetectController::class, 'create'])->name('detect.create');
    Route::post('/detect/post-data', [DetectController::class, 'store'])->name('detect.store');
    Route::get('/dashboard/detect/show-photos-detects', [DetectController::class, 'show'])->name('detect.show');

    //rutas de ecommerce
    Route::get('/dashboard/ecommerce/addsale', [SaleController::class, 'create'])->name('sale.create');
    Route::get('/dashboard/ecommerce/{id}/shop-photo', [SaleController::class, 'cart'])->name('sale.cart');
    Route::get('/dashboard/ecommerce/{id}/pay-photo', [SaleController::class, 'pay'])->name('sale.pay');
    Route::get('/dashboard/ecommerce/download-photo/{id}', [SaleController::class, 'download'])->name('sale.download');
    Route::get('/dashboard/ecommerce/show-invoice', [SaleController::class, 'invoice'])->name('sale.invoice');

});
