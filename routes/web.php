<?php

use App\Http\Controllers\ContactController;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

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

Route::get('/', function () {
    return view('welcome');
});


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');