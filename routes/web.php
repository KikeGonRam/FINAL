<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AContactController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\User\ServicioController;


Route::get('/', function () {
    return view('welcome');  // Muestra la vista welcome.blade.php
});

// Rutas de autenticación de usuarios
Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

// Rutas de autenticación de administradores
Route::prefix('admin')->name('admin.')->group(function () {
    // Mostrar formulario de login del administrador
    Route::get('login', [AdministradorController::class, 'mostrarFormularioLogin'])->name('login');

    // Procesar login del administrador
    Route::post('login', [AdministradorController::class, 'login']);

    // Panel de administración, protegido con 'auth:admin' middleware
    Route::middleware('auth:admin')->get('panel', [AdministradorController::class, 'mostrarPanel'])->name('panel');

    // Cerrar sesión del administrador
    Route::post('logout', [AdministradorController::class, 'cerrarSesion'])->name('logout');


    // CRUD de usuarios (gestión de usuarios)
    Route::middleware('auth:admin')->resource('users', UserController::class);

    // Exportar usuarios a PDF
    Route::get('users/export-pdf', [UserController::class, 'exportPDF'])->name('users.export-pdf');

    Route::resource('users', UserController::class)->except(['show']);
});

// Rutas del usuario autenticado
Route::middleware('auth')->group(function () {
    // Dashboard del usuario
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // Perfil del usuario (mostrar y actualizar)
    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('user.profile');
    Route::post('/user/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::post('/user/profile/delete-photo', [UserProfileController::class, 'deletePhoto'])->name('user.profile.deletePhoto');
    Route::get('/user/barbers', [UserProfileController::class, 'showBarbers'])->name('user.barbers');
    Route::get('/services', [ServicioController::class, 'index'])->name('user.services.index');
    Route::get('/services/{service}', [ServicioController::class, 'show'])->name('user.services.show');
    Route::get('/services/{service}/download', [ServicioController::class, 'downloadPDF'])->name('user.services.downloadPDF');

});

// Ruta de acceso al perfil del usuario sin middleware (si no se requiere autenticación)
Route::get('/perfil', [UserProfileController::class, 'show'])->name('user.profile');

Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    // Rutas de gestión de barberos
    Route::resource('barbers', App\Http\Controllers\Admin\BarberController::class);
});

use App\Http\Controllers\BarberController;

Route::prefix('barber')->name('barber.')->group(function () {
    // Mostrar formulario de login
    Route::get('login', [BarberController::class, 'showLoginForm'])->name('login');
    // Procesar login
    Route::post('login', [BarberController::class, 'login']);
    // Ruta para el panel del barbero (solo accesible si está autenticado)
    Route::middleware('auth:barber')->get('dashboard', [BarberController::class, 'dashboard'])->name('dashboard');
    // Ruta para logout
    Route::post('/barber/logout', [BarberController::class, 'logout'])->name('barber.logout');

});

Route::prefix('barber')->name('barber.')->group(function () {
    // Mostrar perfil
    Route::get('profile', [BarberController::class, 'showProfile'])->name('profile');

    // Actualizar perfil
    Route::put('profile', [BarberController::class, 'updateProfile'])->name('profile.update');
});


use App\Http\Controllers\Admin\CitaController;

Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    // Mostrar listado de citas
    Route::get('citas', [App\Http\Controllers\Admin\CitaController::class, 'index'])->name('citas.index');

    // Formulario para crear cita
    Route::get('citas/create', [App\Http\Controllers\Admin\CitaController::class, 'create'])->name('citas.create');

    // Guardar nueva cita
    Route::post('citas', [App\Http\Controllers\Admin\CitaController::class, 'store'])->name('citas.store');

    // Formulario para editar cita
    Route::get('citas/{cita}/edit', [App\Http\Controllers\Admin\CitaController::class, 'edit'])->name('citas.edit');

    // Actualizar cita existente
    Route::put('citas/{cita}', [App\Http\Controllers\Admin\CitaController::class, 'update'])->name('citas.update');

    // Eliminar cita
    Route::delete('citas/{cita}', [App\Http\Controllers\Admin\CitaController::class, 'destroy'])->name('citas.destroy');

    // Ruta para ver la lista de productos
    Route::resource('admin/products', App\Http\Controllers\Admin\ProductController::class);

    // Lista de contactos
    Route::get('contacts', [AContactController::class, 'index'])->name('contact.index');

    // Detalles de un contacto
    Route::get('contact/{id}', [AContactController::class, 'show'])->name('contact.show');

    // Eliminar contacto
    Route::delete('contact/{id}', [AContactController::class, 'destroy'])->name('contact.destroy');

    Route::resource('categories', CategoryController::class);

    Route::resource('services', ServiceController::class);

    Route::resource('promotions', PromotionController::class); // Rutas de CRUD para promociones

});


use App\Http\Controllers\Barber\BarberCitaController;
use App\Http\Controllers\Barber\BarberProductController;

Route::middleware(['auth:barber'])->group(function () {
    // Ruta para ver todas las citas del barbero
    Route::get('/barbero/citas', [BarberCitaController::class, 'index'])->name('barber.citas.index');
    Route::get('barber/citas/download-pdf', [BarberCitaController::class, 'downloadPDF'])->name('barber.citas.downloadPDF');


    // Ruta para actualizar el estado de la cita
    Route::put('/barbero/citas/{cita}/estado', [BarberCitaController::class, 'updateStatus'])->name('barber.citas.updateStatus');

    // Rutas para gestionar productos
    Route::get('/barbero/productos', [BarberProductController::class, 'index'])->name('barber.products.index');
    Route::get('/barbero/productos/crear', [BarberProductController::class, 'create'])->name('barber.products.create');
    Route::post('/barbero/productos', [BarberProductController::class, 'store'])->name('barber.products.store');
    Route::get('/barbero/productos/{id}', [BarberProductController::class, 'show'])->name('barber.products.show');
    Route::get('/barbero/productos/{id}/editar', [BarberProductController::class, 'edit'])->name('barber.products.edit');
    Route::put('/barbero/productos/{id}', [BarberProductController::class, 'update'])->name('barber.products.update');
    Route::delete('/barbero/productos/{id}', [BarberProductController::class, 'destroy'])->name('barber.products.destroy');
});

use App\Http\Controllers\User\ProductoController;

Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    // Mostrar los productos en el panel del usuario
    Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');
});

Route::middleware(['auth'])->group(function () {
    // Rutas para las citas del usuario
    Route::get('/user/citas/create', [App\Http\Controllers\User\CitaController::class, 'create'])->name('user.citas.create');
    Route::post('/user/citas', [App\Http\Controllers\User\CitaController::class, 'store'])->name('user.citas.store');
    Route::get('/user/citas', [App\Http\Controllers\User\CitaController::class, 'index'])->name('user.citas.index');
    // Rutas para editar y actualizar una cita
    Route::get('/user/citas/edit/{id}', [App\Http\Controllers\User\CitaController::class, 'edit'])->name('user.citas.edit');
    Route::put('/user/citas/update/{id}', [App\Http\Controllers\User\CitaController::class, 'update'])->name('user.citas.update');

    // Ruta para ver detalles de la cita
    Route::get('/user/citas/{id}', [App\Http\Controllers\User\CitaController::class, 'show'])->name('user.citas.show');

    // Ruta para eliminar una cita
    Route::delete('/user/citas/{id}', [App\Http\Controllers\User\CitaController::class, 'destroy'])->name('user.citas.destroy');
});

use App\Http\Controllers\Admin\TableExportController;

Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    // Ruta para ver la lista de tablas y exportarlas
    Route::get('tables', [TableExportController::class, 'index'])->name('tables.index');

    // Rutas de exportación
    Route::get('export/{format}', [TableExportController::class, 'export'])->name('export');
});

Route::get('/admin/tables/export/{format}', [TableExportController::class, 'export'])->name('admin.tables.export');


Route::get('/admin/tables/export/{format}/{table}', [TableExportController::class, 'export'])
    ->name('admin.tables.export');

use App\Http\Controllers\PageController;

Route::get('/politica-de-privacidad', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terminos-y-condiciones', [PageController::class, 'termsAndConditions'])->name('terms-and-conditions');
Route::get('/contactanos', [PageController::class, 'contactUs'])->name('contact-us');

use App\Http\Controllers\ContactController;

Route::post('/contact', [ContactController::class, 'store'])->name('contacts.store');

use App\Http\Controllers\CartController;

Route::middleware('auth')->group(function () {
    Route::post('cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('cart/view', [CartController::class, 'viewCart'])->name('cart.view');
    Route::get('cart/paypal/{cart}', [CartController::class, 'payWithPaypal'])->name('cart.paypal');
    Route::get('cart/cash/{cart}', [CartController::class, 'payWithCash'])->name('cart.cash');
});

Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::put('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

use App\Http\Controllers\PDFController;

Route::get('/download-pdf', [PDFController::class, 'download'])->name('download.pdf');


Route::get('admin/users/pdf', [UserController::class, 'exportPdf'])->name('admin.users.pdf');

use App\Http\Controllers\ChartController;

Route::get('/admin/charts/index', [ChartController::class, 'index'])->name('admin.charts.index');
Route::get('/admin/charts/cita', [ChartController::class, 'cita'])->name('admin.chats.cita');


Route::get('/admin/charts/asignacion', [ChartController::class, 'getAppointmentsByBarber'])->name('admin.chats.barber');


Route::get('/admin/charts/user', [ChartController::class, 'showUsersChart'])->name('admin.chats.user');

Route::get('/admin/charts/product', [ChartController::class, 'showPricesChart'])->name('admin.chats.product');


Route::get('/admin/charts/galeria', [ChartController::class, 'galeria'])->name('admin.charts.galeria');


Route::get('/admin/charts/price', [ChartController::class, 'showPriceDistribution'])->name('admin.charts.price');

Route::get('/admin/charts/promo', [ChartController::class, 'showPromotionsCharts'])->name('admin.charts.promo');


use App\Http\Controllers\PayPalController;


Route::get('/paypal/payment', [PayPalController::class, 'createPayment'])->name('paypal.payment');
Route::get('/paypal/capture', [PayPalController::class, 'capturePayment'])->name('paypal.capture');
Route::get('/paypal/payment/{cartId}', [PayPalController::class, 'createPayment'])->name('cart.paypala');
Route::get('/cart/paypal/{cartId}', [PayPalController::class, 'createPayment'])->name('cart.paypala');


Route::get('/cart/paypal-unavailable', function () {
    return view('cart.paypal_unavailable');
})->name('cart.paypal_unavailable');


use App\Http\Controllers\User\PromotionsController; // Importa el controlador de promociones del cliente

Route::get('user/promotions', [PromotionsController::class, 'index'])->name('user.promotions.index');
Route::get('user/promotions/{promotion}/download', [PromotionsController::class, 'download'])->name('user.promotions.download');