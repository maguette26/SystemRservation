<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AproposController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisterController;


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





    // routes client
    Route::get('/page', [PageController::class , 'index'])->name('indexx') ;
    Route::get('/ap', [AproposController::class , 'index'])->name('index') ;
    // Route::get('/reservation', [ReservationController::class  , 'index'])->name('reservation') ;
    Route::get('/contact', [ContactController::class , 'index'])->name('contact') ;
    Route::post('contact', [ContactController::class, 'submit'])->name('contact.submit');
    Route::get('/recherche', [EventController::class, 'search'])->name('recherche');
    Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
   // Routes pour les types d'événements
Route::prefix('categorie')->group(function () {
    Route::get('concert', [EventTypeController::class, 'concert'])->name('categorie.concert');
    Route::get('conference', [EventTypeController::class, 'conference'])->name('categorie.conference');
    Route::get('exposition', [EventTypeController::class, 'exposition'])->name('categorie.exposition');
});


//    route user
    Route::prefix('user')->middleware('auth')->group(function () {
        Route::get('/admin/_menu', [UserController::class, 'adminDashboard']);
        Route::get('/reservations', [UserController::class, 'showReservations'])->name('user.reservations');
        // Route::get('/user/reservations', [UserController::class, 'showReservations'])->name('user.reservations');
    });
    // Routes user publiques
Route::get('/auth/login', [UserController::class, 'showLoginForm'])->name('auth.login');
Route::post('/auth/login', [UserController::class, 'login']);
Route::post('/auth/logout', [UserController::class, 'logout'])->name('auth.logout');



// Routes pour l'authentification des administrateurs
Route::prefix('admin' )->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashbord');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.dashboard');
    Route::get('register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('register', [AdminAuthController::class, 'register']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
// Routes admin pour la gestion des evenements
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/create', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/{event}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/{event}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/{event}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/reservations', [AdminController::class, 'showReservations'])->name('admin.reservations');
    Route::get('/utilisateurs', [AdminController::class, 'showUsers'])->name('admin.utilisateurs');
    Route::put('/reservations/{id}', [AdminController::class, 'updateReservationStatus'])->name('admin.reservations.update');
    Route::get('/_menu', [AdminController::class, 'index'])->name('admin._menu');
});




Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// route cart
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');





//   route payement
Route::middleware('auth')->group(function () {
    Route::get('checkout/{id}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('confirmation', [CheckoutController::class, 'confirmation'])->name('confirmation');
});

// Route pour récupérer toutes les réservations
Route::middleware(['auth:api'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::delete('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::post('/reservations/confirm', [ReservationController::class, 'confirm']);
});

// Routes pour l'authentification du user

Route::get('login', [AuthController::class, 'showLoginForm']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('register', [RegisterController::class, 'register'])->name('register.client');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');







