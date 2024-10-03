<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/home');
})->name('dashboard');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/CustomerList', [App\Http\Controllers\HomeController::class, 'CustomerList'])->name('CustomerList');
Route::get('/MechanicList', [App\Http\Controllers\HomeController::class, 'MechanicList'])->name('MechanicList');
Route::get('/CreateCustomers', [App\Http\Controllers\HomeController::class, 'CreateCustomers'])->name('CreateCustomers');
Route::get('/CreateMechanics', [App\Http\Controllers\HomeController::class, 'CreateMechanics'])->name('CreateMechanics');
Route::post('/SaveCustomer', [App\Http\Controllers\HomeController::class, 'SaveCustomer'])->name('SaveCustomer');
Route::post('/SaveMechanic', [App\Http\Controllers\HomeController::class, 'SaveMechanic'])->name('SaveMechanic');
Route::post('{id}/SaveUtility', [App\Http\Controllers\HomeController::class, 'SaveUtility'])->name('SaveUtility');
Route::get('/{id}/Edit', [App\Http\Controllers\HomeController::class, 'Edit'])->name('Edit');
Route::get('/{id}/editEmployee', [App\Http\Controllers\HomeController::class, 'editEmployee'])->name('editEmployee');
Route::put('/{id}/UpdateCustomer', [App\Http\Controllers\HomeController::class, 'Updatecustomer'])->name('Updatecustomer');
Route::put('/{id}/UpdateMechanic', [App\Http\Controllers\HomeController::class, 'UpdateMechanic'])->name('UpdateMechanic');
Route::get('/{id}/AddVh', [App\Http\Controllers\HomeController::class, 'AddVh'])->name('AddVh');
Route::get('/{id}/Show', [App\Http\Controllers\HomeController::class, 'Show'])->name('Show');
Route::post('/{id}/SaveVehiculo', [App\Http\Controllers\HomeController::class, 'SaveVehiculo'])->name('SaveVehiculo');
Route::get('/VehiculesList', [App\Http\Controllers\HomeController::class, 'VehiculesList'])->name('VehiculesList');
Route::get('/{id}/Editvh', [App\Http\Controllers\HomeController::class, 'Editvh'])->name('Editvh');
Route::put('/{id}/UpdateVehiculo', [App\Http\Controllers\HomeController::class, 'UpdateVehiculo'])->name('UpdateVehiculo');
Route::get('/{id}/AddService', [App\Http\Controllers\HomeController::class, 'AddService'])->name('AddService');
Route::post('/{id}/SaveService', [App\Http\Controllers\HomeController::class, 'SaveService'])->name('SaveService');
Route::get('/{id}/Showsv', [App\Http\Controllers\HomeController::class, 'Showsv'])->name('Showsv');
Route::get('/OrdenesList', [App\Http\Controllers\HomeController::class, 'OrdenesList'])->name('OrdenesList');
Route::get('/{id}/ShowOr', [App\Http\Controllers\HomeController::class, 'ShowOr'])->name('ShowOr');
Route::get('/{id}/{idvh}/EditOr', [App\Http\Controllers\HomeController::class, 'EditOr'])->name('EditOr');
Route::get('/{id}/DeleteOrg', [App\Http\Controllers\HomeController::class, 'DeleteOrg'])->name('DeleteOrg');
Route::post('/{id}/{idvh}/SaveMoreService', [App\Http\Controllers\HomeController::class, 'SaveMoreService'])->name('EdiSaveMoreServicetOr');
Route::get('/CambiosList', [App\Http\Controllers\HomeController::class, 'CambiosList'])->name('CambiosList');
Route::get('/{id}/Addlatoneria', [App\Http\Controllers\HomeController::class, 'Addlatoneria'])->name('Addlatoneria');
Route::post('/{id}/SaveLatoneria', [App\Http\Controllers\HomeController::class, 'SaveLatoneria'])->name('SaveLatoneria');
Route::get('/OrdenesLatonerias', [App\Http\Controllers\HomeController::class, 'OrdenesLatonerias'])->name('OrdenesLatonerias');
Route::get('/OrdenesLatoneriasHistoricas', [App\Http\Controllers\HomeController::class, 'OrdenesLatoneriasHistoricas'])->name('OrdenesLatoneriasHistoricas');
Route::get('/{id}/verlt', [App\Http\Controllers\HomeController::class, 'verlt'])->name('verlt');
Route::get('/{id}/deleteorder', [App\Http\Controllers\HomeController::class, 'deleteorder'])->name('deleteorder');
Route::get('/{id}/deleteEmployee', [App\Http\Controllers\HomeController::class, 'deleteEmployee'])->name('deleteEmployee');
Route::get('/{id}/liquidorder', [App\Http\Controllers\HomeController::class, 'liquidorder'])->name('liquidorder');
Route::get('/{id}/addItems', [App\Http\Controllers\HomeController::class, 'addItems'])->name('addItems');
Route::get('/{id}/agregarLavado', [App\Http\Controllers\HomeController::class, 'agregarLavado'])->name('agregarLavado');
Route::post('/{orden}/SaveNewLatoneria', [App\Http\Controllers\HomeController::class, 'SaveNewLatoneria'])->name('SaveNewLatoneria');
Route::post('/{id}/SaveLavado', [App\Http\Controllers\HomeController::class, 'SaveLavado'])->name('SaveLavado');
Route::get('/{id}/getPdf',[App\Http\Controllers\DomPdfController::class, 'getPdf'])->name('getPdf');
Route::get('/{id}/getliquidationpdf',[App\Http\Controllers\DomPdfController::class, 'getliquidationpdf'])->name('getliquidationpdf');
Route::get('/getliquidations',[App\Http\Controllers\HomeController::class, 'getliquidations'])->name('getliquidations');
Route::get('/buscarTecnico',[App\Http\Controllers\HomeController::class, 'buscarTecnico'])->name('buscarTecnico');
Route::post('/buscarOrders',[App\Http\Controllers\HomeController::class, 'buscarOrders'])->name('buscarOrders');
Route::get('/{id}/deletevehiculo', [App\Http\Controllers\HomeController::class, 'deletevehiculo'])->name('deletevehiculo');
Route::get('/searchSales',[App\Http\Controllers\HomeController::class, 'searchSales'])->name('searchSales');
Route::post('/buscarSales',[App\Http\Controllers\HomeController::class, 'buscarSales'])->name('buscarSales');
Route::get('/{id}/Addorder', [App\Http\Controllers\HomeController::class, 'Addorder'])->name('Addorder');
Route::post('/{id}/SaveOrder', [App\Http\Controllers\HomeController::class, 'SaveOrder'])->name('SaveOrder');
Route::get('/ToolList', [App\Http\Controllers\ToolController::class, 'ToolList'])->name('ToolList');
Route::get('/createTool', [App\Http\Controllers\ToolController::class, 'createTool'])->name('createTool');
Route::post('/SaveTool', [App\Http\Controllers\ToolController::class, 'SaveTool'])->name('SaveTool');
Route::get('/{id}/deleteTool', [App\Http\Controllers\ToolController::class, 'deleteTool'])->name('deleteTool');
Route::get('/{id}/editTool', [App\Http\Controllers\ToolController::class, 'editTool'])->name('editTool');
Route::put('/{id}/UpdateTool', [App\Http\Controllers\ToolController::class, 'UpdateTool'])->name('UpdateTool');




Auth::routes();
