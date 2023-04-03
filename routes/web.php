<?php

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StripeController;

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

Route::get('/', fn () => auth()->check() ? redirect('/home') : view('welcome'));


// ? EJEMPLO DE UNA RUTA POST MANUAL (NO RECOMENDADO, USAR CONTROLADOR)
// Route::post('/contact', function (Request $request) {
//     $data = $request->all();
//
// !   //  INSERTAR DATOS (USO NO ESTANDARIZADO)
// ?   //  $contact = new Contact();
// ?   //  $contact->name = $data["name"];
// ?   //  $contact->phone_number = $data["phone_number"];
// ?   //  $contact->save();
//
// *   //  INSERTAR DATOS (FORMA CORRECTA, MÁS SENCILLO)
// ?    Contact::create($data);
//     return "Contact stored";
// });

Auth::routes();

Route::get('/billing-portal', [StripeController::class, 'billingPortal'])->name('billing-portal');
Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::get('/free-trial-end', [StripeController::class, 'freeTrialEnd'])->name('free-trial-end');

Route::middleware(['auth', 'subscription'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('contacts', ContactController::class);

});

// CONTACTS CRUD MANUAL
// Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
// Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
// Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
// Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
// Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
// Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
// Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');