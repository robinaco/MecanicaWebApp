<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomers;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\StorePostServiceLatoneria;
use App\Http\Requests\createservice;
use App\Http\Requests\JobsPostRequest;
use App\Http\Requests\vehiculorequest;
use App\Models\Customer;
use App\Models\Mechanic;
use App\Models\Job;
use App\Models\marcas;
use App\Models\Service;
use App\Models\vehicule;
use App\Models\clean;
use App\Models\Ods;
use App\Http\Requests\searchSalesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Mail\Send;
use Barryvdh\DomPDF\PDF;
use phpDocumentor\Reflection\Types\This;
use PhpParser\Node\Stmt\TryCatch;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;
use App\Http\Requests\CleanStoreRequest;
use App\Http\Requests\LiquidationCreateRequest;
use App\Models\imagenes;
use App\Models\inventario;
use App\Models\latonerias;
use App\Models\Liquidation;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\searchTecnico;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index()
        {
            $clientes = Customer::where('estado', '=', 1) ->get()->count();
            $vehicules = vehicule::where('estado', '=', 1)->get()->count();
            $liquidadas = inventario::where('liquidacion', '=', 'Liquidada')->get()->count();
            $Noliquidadas = inventario::where('liquidacion', '=', 'Sin Liquidar')->where('estado', '=', '1')->get()->count();
            $inventario=inventario::whereDate('created_at', date('Y-m-d'))->get()->sum('valorcosto');
            $liquidation=liquidation::whereDate('created_at', date('Y-m-d'))->get()->sum('valorempleado');
            $liquidations=liquidation::whereDate('created_at', date('Y-m-d'))->get()->sum('valorutilidad');
            $ordens = DB::table('inventarios')->distinct()->count('ordenlatoneria');
            return view('home')->with(compact('clientes', 'vehicules', 'ordens','inventario','liquidation','liquidations','liquidadas','Noliquidadas'));
        }


    public function EditOr($orden, $idvh)
    {
        try {
            $numorden = $orden;
            $fkvehiculo = $idvh;
            $ordenes = Service::where('ordenservicio', '=', $numorden)->get();
            log::info('Listado Ordenes Obtenido Correctamente.');
            return view('ordenedit', compact('ordenes', 'numorden', 'fkvehiculo'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }


    public function DeleteOrg($id)
    {
        try {
            $model = Service::where('id', $id)->delete();
            $mensaje =  " Registrado Eliminado.";
            $tipo = "success";
            DB::commit();
            log::info('Registro Eliminado.');
            return back()->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al realizar el proceso', [$th]);
            return  $th;
        }
    }


    public function CustomerList()
    {
        try {
            $clientes = DB::table('customers')
                ->select('customers.*')
                ->orderBy('customers.id', 'DESC')
                ->get();
            log::info('Listado Clientes Obtenido Correctamente.');
            return view('customers', compact('clientes'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }

    public function MechanicList()
    {
        try {
            $mechanics = DB::table('mechanics')
                ->select('mechanics.*')
                ->where('mechanics.estado', '=', 1)
                ->orderBy('mechanics.id', 'DESC')
                ->get();
            log::info('Listado Mecanicos Obtenido Correctamente.');
            return view('mechanics', compact('mechanics'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }

    public function VehiculesList()
    {
        try {
            $vehiculos = DB::table('vehicules')
                ->join('marcas', 'marcas.id', '=', 'vehicules.idmarca')
                ->select(
                    'vehicules.id',
                    'marcas.description',
                    'vehicules.placa',
                    'vehicules.referencia',
                    'vehicules.kilometraje'
                )
                ->where('vehicules.estado', '=', 1)
                ->orderBy('vehicules.id', 'DESC')
                ->get();
            DB::commit();
            log::info('Listado Vehiculos Obtenido Correctamente.');
            return view('vehiculos', compact('vehiculos'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }

    public function OrdenesList()
    {
        
        try {
            $services = DB::select('SELECT DISTINCT ordenservicio, placa,idvehiculo FROM `services` INNER JOIN `vehicules` on services.idvehiculo = vehicules.id ORDER BY services.id desc');
            log::info('Listado Ordenes Obtenido Correctamente.');
            return view('ordenes', compact('services'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }


 public function buscarTecnico(){
        $empleados=Mechanic::all();
        return view('buscarTecnico', compact('empleados'));
    }



   public function buscarOrders(searchTecnico $request){
        try {
            $dateIni=$request->dateini;
            $dateEnd=$request->dateend;
            $mecanico=$request->tecnico;
            $getLiquidations = DB::select("SELECT vehicules.placa,vehicules.referencia,liquidations.pkorden,liquidations.created_at,inventarios.pkvehiculo,mechanics.nombremecanico, liquidations.porcentaje,liquidations.valorempleado
             FROM `liquidations` 
             INNER JOIN `mechanics` on mechanics.id = liquidations.pkempleado
             inner join `inventarios` on liquidations.pkorden = inventarios.id
             inner join `vehicules` on vehicules.id = inventarios.pkvehiculo
             where liquidations.pkempleado='$mecanico' and inventarios.fechaorden between '$dateIni' and '$dateEnd' and inventarios.liquidacion='Liquidada'");
            $pdf= FacadePdf::loadView('resumenTecnico',compact('getLiquidations'))
            ->setPaper('a4')
            ->setOptions(['margin-bottom', 0]);
            return $pdf->download('DetalleTecnico.pdf');
        } catch (\Throwable $th) {
                DB::rollback();
                Log::error('se presentó un error al obtener los datos', [$th]);
                return  $th;
        }
     }

    public function searchSales(){
        return view('buscarVentas');
    }


    public function buscarSales(searchSalesRequest $searchSalesRequest){
        try {
            $dateIni=$searchSalesRequest->dateini;
            $dateEnd=$searchSalesRequest->dateend;
            $getSales=DB::select("SELECT inventarios.valorcosto, inventarios.id, inventarios.created_at,inventarios.ordenlatoneria, vehicules.placa, vehicules.referencia from inventarios inner join vehicules on vehicules.id = inventarios.pkvehiculo where inventarios.fechaorden between '$dateIni' and '$dateEnd' and inventarios.estado = '1' and inventarios.liquidacion='Liquidada'");
          
            $pdf= FacadePdf::loadView('resumenVentasTaller',compact('getSales'))
            ->setPaper('a4')
            ->setOptions(['margin-bottom', 0]);
            return $pdf->download('ResumenVentas.pdf');

        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
    }
}
    public function OrdenesLatonerias()
    {
        try {
           
            $services = DB::select('SELECT  inventarios.id,inventarios.pkvehiculo, inventarios.ordenlatoneria,vehicules.placa,inventarios.created_at, inventarios.liquidacion
             FROM `inventarios` INNER JOIN `vehicules` on inventarios.pkvehiculo = vehicules.id where inventarios.estado="1"  and inventarios.liquidacion="Sin Liquidar"   ORDER BY inventarios.id desc');
            log::info('Listado Ordenes Latoneria Obtenidas Correctamente.');
            return view('latonerias', compact('services'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }

    public function OrdenesLatoneriasHistoricas()
    {
        try {
            $services = DB::select('SELECT  inventarios.id,inventarios.pkvehiculo, inventarios.ordenlatoneria,vehicules.placa,inventarios.created_at, inventarios.liquidacion
             FROM `inventarios` INNER JOIN `vehicules` on inventarios.pkvehiculo = vehicules.id where inventarios.estado="1"  and inventarios.liquidacion="Liquidada"  ORDER BY inventarios.id desc');
            log::info('Listado Ordenes Latoneria Obtenidas Correctamente.');
            return view('latoneriasHistoricas', compact('services'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }


    public function verlt($id)
    {
        try {
            $inventario = inventario::find($id);
           
            $orden = $inventario ->ordenlatoneria;
       //     $kms=$inventario ->kilometraje;
            $empleado=$inventario ->operario;
            $mechanic = Mechanic::find($empleado);
            $numorden=$orden;
            $vehiculo=$inventario ->pkvehiculo;
            $vh=vehicule::find($vehiculo);
            $imagenes = imagenes::where('ordenlatoneria', '=', $orden)->get();
            $latonerias = latonerias::where('ordenl', '=', $orden)->get();
            $cleans = clean::where('orden', '=', $orden)->get();
            log::info('Información de Orden Obtenida Satisfactoriamente.');
            return view('Ordenl', compact('inventario','imagenes','numorden','latonerias','vh','cleans','mechanic'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }



    public function deleteorder($id)
    {
        try {
            $inventario = inventario::find($id);
            $inventario->estado = 0;
            $inventario->save();
            $mensajes = "Registro ha sido Eliminado.";
            $tipos = "danger";
            DB::commit();
            return redirect('/OrdenesLatonerias')->with("mensajes", $mensajes)->with("tipos", $tipos);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al procesar los datos', [$th]);
            return  $th;
        }
    }

public function deletevehiculo($id)
    {
        try {
            $vehiculo = vehicule::find($id);
            $vehiculo->estado = 0;
            $vehiculo->save();
            $mensajes = "Registro ha sido Eliminado.";
            $tipos = "danger";
            DB::commit();
            return redirect('/VehiculesList')->with("mensajes", $mensajes)->with("tipos", $tipos);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al procesar los datos', [$th]);
            return  $th;
        }
    }
    
    public function deleteEmployee($id){
        try {
            $mecanico = Mechanic::find($id);
            $mecanico->estado = 0;
            $mecanico->save();
            $mensajes = "El Empleado ha sido eliminado.";
            $tipos = "danger";
            DB::commit();
            return redirect('/MechanicList')->with("mensajes", $mensajes)->with("tipos", $tipos);
         } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al procesar los datos', [$th]);
            return  $th;
        }
    }

    public function liquidOrder($id){
        try {
            $inventario = inventario::find($id);
            $estado=$inventario->liquidacion;
            if($estado=="Liquidada"){
                $mensajex = "La orden seleccionada ya fue previamente liquidada.";
                $tipox = "danger";
                return redirect('/OrdenesLatonerias')->with("mensajes", $mensajex)->with("tipos", $tipox);
            }else{
                $operario = $inventario->operario;
                $employee = Mechanic::find( $operario);
                log::info('Informacion Orden Latoneria Obtenida Correctamente.');
                return view('liquidOrder',compact('inventario','employee'));
            }
           
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }




    public function agregarLavado($id)
    {
        try {
            $inventario = inventario::find($id);
            log::info('Información Obtenida Satisfactoriamente.');
            return view('addlavado', compact('inventario'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al procesar los datos', [$th]);
            return  $th;
        }
    }


public function Addorder($id)
    {
        try {
           
            $empleados=DB::select('SELECT * FROM `mechanics`  WHERE estado ="1" ORDER BY mechanics.id desc');
             $modelos = collect(range(0, 80))->map(function ($item) {
                return (string) date('Y') - $item;
            });
            $existen =count($empleados);
            if ($existen <1) {
                $mensajex = "Debe registrar almenos un técnico para poder registrar la orden; vaya a la opción administración - crear empleado.";
                $tipox = "warning";
                return redirect('/VehiculesList')->with("mensajei", $mensajex)->with("tipoi", $tipox);
            } else {
            $vehiculo = vehicule::find($id);
            $datouser = $vehiculo->idcliente;
            $datomarca = $vehiculo->idmarca;
            $user = Customer::find($datouser);
            $marca = Marcas::find($datomarca);
            $uuid = (string) Str::uuid();
            $orden = $uuid;
            return view('Addorder', compact('vehiculo', 'user', 'orden', 'marca','empleados','modelos'));
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }
   

    public function ShowOr($id)
    {
        try {
            $servicios = DB::table('services')
                ->join('vehicules', 'vehicules.id', '=', 'services.idvehiculo')
                ->join('customers', 'customers.id', '=', 'vehicules.idcliente')
                ->select('services.*', 'vehicules.placa', 'vehicules.referencia', 'vehicules.kilometraje', 'customers.nombrecliente')
                ->where('ordenservicio', '=', $id)
                ->get();
            return view('detailorder', compact('servicios'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }




    public function CreateCustomers()
    {
        return view('createcustomer');
    }

    public function CreateMechanics()
    {
        return view('createmechanic');
    }


    public function SaveLavado(CleanStoreRequest $request)
    {
        try {
            $lavado = new clean();
            $lavado->descripcionlavado = strtoupper($request->tipolavado);
            $lavado->valorlavado = ($request->valor);
            $lavado->orden = ($request->orden);
            $lavado->save();
            $mensaje =  "Lavado Registrado Satisfactoriamente.";
            $tipo = "success";
            DB::commit();
            log::info('Registro Almacenado Correctamente.');
            return redirect('/OrdenesLatonerias')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }

    public function SaveCustomer(CreateCustomers $request)
    {
        try {
            $doctouser = $request->numerocedula;
            $existe = Customer::select('customers.numcedula')
                ->where('customers.numcedula', '=', $doctouser)
                ->get();
            $exist = count($existe);
            if ($exist >= 1) {
                $mensajex = "La cédula que intenta almacenar ya existe, revise el listado clientes.";
                $tipox = "warning";
                return back()->with("mensajex", $mensajex)->with("tipox", $tipox);
            } else {
                $cliente = new Customer();
                $cliente->nombrecliente = strtoupper($request->name);
                $cliente->tipodocumento = ($request->tdocto);
                $cliente->numcedula = ($request->numerocedula);
                $cliente->email = strtolower($request->email);
                $cliente->numerocel = ($request->numerocel);
                $cliente->save();
                // foreach([$cliente->email ] as $recipiet){
                //     Mail::to($recipiet)->send(new Send());
                // }
                $mensaje = $cliente->nombrecliente . " Registrado Satisfactoriamente.";
                $tipo = "success";
                DB::commit();
                log::info('Registro Almacenado Correctamente.');
                return redirect('/CustomerList')->with("mensaje", $mensaje)->with("tipo", $tipo);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }

    public function SaveUtility(LiquidationCreateRequest $request){
        try {
           $liquidation = new Liquidation();
           $liquidation->pkempleado=$request->employee;
           $liquidation->porcentaje=$request->porcentaje;
           $liquidation->pkorden=$request->order;
           $liquidation->valorutilidad= intval(str_replace(".", "", $request->utilidad));
           $liquidation->valorempleado= intval(str_replace(".", "", $request->valormecanico));
           $liquidation->save();
           $mensaje = "Orden Liquidada y Registrada Satisfactoriamente.";
           $tipo = "success";
           log::info('Registro Almacenado Correctamente.');
           DB::commit();
           if($liquidation){
           $inventario=inventario::find($request->order);
           $inventario->liquidacion="Liquidada";
           $inventario->save();
           DB::commit();
           }
           return redirect('/OrdenesLatoneriasHistoricas')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }


    public function getliquidations(){
        try 
        {
            $liquidations=DB::table('liquidations')
                ->join('mechanics', 'mechanics.id', '=', 'liquidations.pkempleado')
                ->join('inventarios', 'inventarios.id', '=', 'liquidations.pkorden')
                ->join('vehicules', 'vehicules.id', '=', 'inventarios.pkvehiculo')
                ->select('liquidations.porcentaje','liquidations.valorutilidad','liquidations.valorempleado','liquidations.created_at as date','inventarios.valorcosto','inventarios.id as idInventario','inventarios.ordenlatoneria','vehicules.placa','vehicules.referencia','mechanics.*')
                ->orderBy('mechanics.id', 'desc')
                ->get();
            return view('liquidations', compact('liquidations'));
        } catch (\Throwable $th) {
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }

    


    public function SaveMechanic(EmployeeCreateRequest $request)
    {
        try {
            $doctouser = $request->numerocedulaempleado;
            $existe = Mechanic::select('mechanics.numerodocumento')
                ->where('mechanics.numerodocumento', '=', $doctouser)
                ->get();
            $exist = count($existe);
            if ($exist >= 1) {
                $mensajex = "El empleado que intenta almacenar ya existe, revise el listado de empleados.";
                $tipox = "warning";
                return back()->with("mensajex", $mensajex)->with("tipox", $tipox);
            } else {
                $empleado = new Mechanic();
                $empleado->nombremecanico = strtoupper($request->nameempleado);
                $empleado->tipodocumentoempleado = ($request->tdoctoempleado);
                $empleado->numerodocumento = ($request->numerocedulaempleado);
                $empleado->numerocelmecanico = ($request->numerocelempleado);
                $empleado->tipousuario = strtoupper($request->rolempleado);
                $empleado->save();
                $mensaje = $empleado->nombremecanico . " Registrado Satisfactoriamente.";
                $tipo = "success";
                DB::commit();
                log::info('Registro Almacenado Correctamente.');
                return redirect('/MechanicList')->with("mensaje", $mensaje)->with("tipo", $tipo);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }

    public function editEmployee($id)
    {
        try {
            $mechanic = Mechanic::find($id);
            return view('/editMechanic')->with("mechanic", $mechanic);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }

    public function edit($id)
    {
        try {
            $cliente = Customer::find($id);
            return view('/editcustomer')->with("cliente", $cliente);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }


    public function EditVh($id)
    {
         try {
            $vehiculo = vehicule::find($id);
            $marcasvh = marcas::all();
            $modelos = collect(range(0, 80))->map(function ($item) {
                return (string) date('Y') - $item;
            });
            return view('/editvehiculo', compact('vehiculo', 'marcasvh','modelos'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }



    public function UpdateCustomer(CreateCustomers $request, $id)
    {
        try {
            $cliente = Customer::find($id);
            $cliente->nombrecliente = strtoupper($request->name);
            $cliente->tipodocumento = ($request->tdocto);
            $cliente->numcedula = ($request->numerocedula);
            $cliente->email = strtolower($request->email);
            $cliente->numerocel = ($request->numerocel);
            $cliente->save();
            $mensaje = $cliente->nombrecliente . " ha sido Actualizado.";
            $tipo = "success";
            DB::commit();
            return redirect('/CustomerList')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }

    public function UpdateMechanic(EmployeeCreateRequest $request, $id)
    {
        try {
          
            $mechanic = Mechanic::find($id);
            $mechanic->nombremecanico = strtoupper($request->nameempleado);
            $mechanic->tipodocumentoempleado = ($request->tdoctoempleado);
            $mechanic->numerodocumento = ($request->numerocedulaempleado);
            $mechanic->numerocelmecanico = ($request->numerocelempleado);
            $mechanic->tipousuario = strtoupper($request->rolempleado);
            $mechanic->save();
            $mensaje = $mechanic->nombremecanico . " ha sido Actualizado.";
            $tipo = "success";
            DB::commit();
            return redirect('/MechanicList')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }

    public function AddVh($id)
    {
         try {
            $cliente = Customer::find($id);
            $modelos = collect(range(0, 80))->map(function ($item) {
                return (string) date('Y') - $item;
            });
            $marcasvh = marcas::all();
            return view('createvh', compact('cliente', 'marcasvh','modelos'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }



    public function Show($id)
    {
        try {
            $cliente = Customer::find($id);
            $vehiculos = Vehicule::join('customers', 'customers.id', '=', 'vehicules.idcliente')
                ->join('marcas', 'marcas.id', '=', 'vehicules.idmarca')
                ->where('customers.estado', '=', 1)
                ->where('vehicules.idcliente', '=', $id)
                ->where('vehicules.estado', '=', 1)
                ->get(['vehicules.*', 'marcas.description']);
            return view('detailcustomer', compact('cliente', 'vehiculos'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }



    public function SaveVehiculo(vehiculorequest $request)
    {
        try {
            $vehiculo = new vehicule();
            $vehiculo->idcliente = ($request->idcliente);
            $vehiculo->idmarca = ($request->marca);
            $vehiculo->referencia = strtoupper($request->ref);
            $vehiculo->placa = strtoupper($request->placa);
            $vehiculo->kilometraje = ($request->kms);
            $vehiculo->color = strtoupper($request->color);
            $vehiculo->observaciones = strtoupper($request->obs);
            $vehiculo->modelo = ($request->modelvh);
            $vehiculo->save();
            $mensaje =  $vehiculo->placa . " Registrado Satisfactoriamente.";
            $tipo = "success";
            DB::commit();
            log::info('Registro Almacenado Correctamente.');
            return redirect('/VehiculesList')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }



    public function UpdateVehiculo(vehiculorequest $request, $id)
    {
        try {
            $vehiculo = vehicule::find($id);
            $vehiculo->idmarca = ($request->marca);
            $vehiculo->referencia = strtoupper($request->ref);
            $vehiculo->placa = strtoupper($request->placa);
            $vehiculo->kilometraje = ($request->kms);
            $vehiculo->observaciones = strtoupper($request->obs);
             $vehiculo->modelo = ($request->modelvh);
            $vehiculo->color = strtoupper($request->color);
            $vehiculo->save();
            $mensaje =  $vehiculo->placa . " ha sido Actualizado.";
            $tipo = "success";
            DB::commit();
            log::info('Registro Actualizado Correctamente.');
            return redirect('/VehiculesList')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }



    public function AddService($id)
    {
        try {

            $vehiculo = vehicule::find($id);
            $uuid = (string) Str::uuid();
            $ordens = $uuid;
            return view('addservice', compact('vehiculo', 'ordens'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }



    public function Addlatoneria($id)
    {
        try {
           
            $empleados=DB::select('SELECT * FROM `mechanics`  WHERE estado ="1" ORDER BY mechanics.id desc');
             $modelos = collect(range(0, 80))->map(function ($item) {
                return (string) date('Y') - $item;
            });
            $existen =count($empleados);
            if ($existen <1) {
                $mensajex = "Debe registrar almenos un técnico para poder registrar la orden; vaya a la opción administración - crear empleado.";
                $tipox = "warning";
                return redirect('/VehiculesList')->with("mensajei", $mensajex)->with("tipoi", $tipox);
            } else {
            $vehiculo = vehicule::find($id);
            $datouser = $vehiculo->idcliente;
            $datomarca = $vehiculo->idmarca;
            $user = Customer::find($datouser);
            $marca = Marcas::find($datomarca);
            $uuid = (string) Str::uuid();
            $orden = $uuid;
            return view('addlatoneria', compact('vehiculo', 'user', 'orden', 'marca','empleados','modelos'));
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }

    public function SaveOrder(StorePostServiceLatoneria $request)
    {
       
        $servicios = $request->all();
        $items = array();
        $queryFotos="";
        try {
            $urlImagenes = [];
            $countimages = count($request->fotos);
            if ($request->hasFile('fotos') &&  $countimages <=6 ) {
                $images = $request->file('fotos');
                foreach ($images as $imagen) {
                $imagenescarro=date('YmdHis').".". $imagen->getClientOriginalName();
                $imagen->storeAs('images',$imagenescarro,'public');
                    $urlImagenes[] = $imagenescarro;
                }
                $c = count($urlImagenes);
                    for ($i = 0; $i < $c; $i++) {
                        $queryFotos=imagenes::create([
                            'namefile' => $urlImagenes[$i],
                            'pkvehiculo' => $request->pkvehiculo,
                            'ordenlatoneria'=> $request->ordens,
                     ]);
                    }
                if($queryFotos)
                {
                    $inventario = new inventario();
                    $inventario->pkvehiculo = ($request->pkvehiculo);
                    $inventario->ordenlatoneria = ($request->ordens);
                    $inventario->modelo = ($request->modelvh);
                    $inventario->kilometraje = ($request->kms);
                    $inventario->fechaorden = ($request->fechaorden);
                    $inventario->color = strtoupper($request->color);
                    $inventario->nivelfuel = ($request->nivel);
                    $inventario->antena = strtoupper($request->antena);
                    $inventario->extintor = strtoupper($request->extintor);
                    $inventario->gato = strtoupper($request->gato);
                    $inventario->llanta = strtoupper($request->llanta);
                    $inventario->herramientas = strtoupper($request->herramienta);
                    $inventario->kit = strtoupper($request->kit);
                    $inventario->documentos = strtoupper($request->documentos);
                    $inventario->radio = strtoupper($request->radio);
                    $inventario->parlantes = strtoupper($request->parlantes);
                    $inventario->tapetes = strtoupper($request->tapetes);
                    $inventario->encendedor = strtoupper($request->encendedor);
                    $inventario->espejos = strtoupper($request->espejos);
                    $inventario->parasoles = strtoupper($request->parasoles);
                    $inventario->limpiabrisas = strtoupper($request->limpiabrisas);
                    $inventario->bateria = strtoupper($request->bateria);
                    $inventario->pinturafogueada = strtoupper($request->pintura);
                    $inventario->suciedad = strtoupper($request->suciedad);
                    $text = preg_replace( "/<br>|\n/", "", $request->descripcion );
                    $inventario->Descripcionactividad= $text;
                    $inventario->valorcosto = strtoupper($request->cost);
                   
                    if(is_null($request->abono)){
                        $abono="0";
                        $inventario->valorabono = $abono;
                    }
                    $inventario->valorabono = strtoupper($request->abono);
                    $inventario->valorrestante = strtoupper($request->resta);
                    $inventario->operario = strtoupper($request->receptor);
                    $inventario->usuario = strtoupper($request->nombreclentrega);
                }
                $inventario->save();
                DB::commit();
                $mensaje = "Orden Registrada Correctamente.";
                $tipo = "success";
                log::info('Orden Registrada Correctamente.');
                return redirect('/OrdenesLatonerias')->with("mensaje", $mensaje)->with("tipo", $tipo);
            } else {
                $mensajes = "Error realizando el proceso. verifique la información ingresada, maximo 6 fotos.";
                $tipos = "danger";
                return back()
                ->with("mensajes", $mensajes)
                ->with("tipos", $tipos);
            }
        } catch (\Throwable $th) {
            Log::info('se presentó un error al grabar los datos', [$th]);
            DB::rollback();
            return  $th;
        }
    }

    public function addItems($id)
    {
        try {
            $inventario = inventario::find($id);
            $orden= $inventario->ordenlatoneria;
            $car=$inventario->pkvehiculo;
            return view('additem', compact('orden','car','inventario'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }


    public function SaveNewLatoneria(Request $request, $id){
        try {
            $inventario = inventario::find($id);
            $vractual=$inventario ->valorcosto;
            $vradd=$request->costo;
            $acumulado=$vractual+$vradd;
            $inventario->valorcosto=$acumulado;
            $vabonoactual=$inventario->valorabono;
            if($vabonoactual!=""){
                $inventario->valorrestante=$acumulado-$vabonoactual;
            }else{
                $inventario->valorrestante=$acumulado-0;
            }
            $ndescripcion=$request->descripcion;
            $text = preg_replace( "/<br>|\n/", "", $ndescripcion );
            $inventario->Descripcionactividad=$text;
           
            $inventario->save();
            
            if($inventario){
                $i = 0;
                foreach ($request['idvehiculo'] as $vh) {
                    $items[$i]['idvehiculo'] = $vh;
                    $i++;
                }
                $j = 0;
                foreach ($request['odsl'] as $orden) {
                    $items[$j]['ordenl'] = $orden;
                    $j++;
                }
                $s = 0;
                foreach ($request['pro_id'] as $serv) {
                    $items[$s]['descripcionservicio'] = $serv;
                    $s++;
                }
                $c = 0;
                foreach ($request['cantidad'] as $cant) {
                    $items[$c]['cantidad'] = $cant;
                    $c++;
                }
                $pu = 0;
                foreach($request['precunit'] as $price) {
                    $items[$pu]['preciounidad'] = $price;
                    $pu++;
                }
                $st = 0;
                foreach ($request['totalitem'] as $stotal) {
                    $items[$st]['subtotal'] = $stotal;
                    $st++;
                }
                $cs=0;
                foreach ($request['concept'] as $conceptoservicios) {
                    $items[$cs]['conceptoservicio'] = strtoupper($conceptoservicios);
                    $cs++;
                }
                latonerias::insert(
                    $items
                );
            }
            $mensaje =  "La orden ha sido Actualizada.";
            $tipo = "success";
            DB::commit();
            log::info('Registro Actualizado Correctamente.');
            return redirect('/OrdenesLatonerias')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
        
    }


    public function SaveLatoneria(StorePostServiceLatoneria $request)
    {
       
        $servicios = $request->all();
        $items = array();
        $queryFotos="";
        try {
            $urlImagenes = [];
            $countimages = count($request->fotos);
            if ($request->hasFile('fotos') &&  $countimages <=6 ) {
                $images = $request->file('fotos');
                foreach ($images as $imagen) {
                $imagenescarro=date('YmdHis').".". $imagen->getClientOriginalName();
                $imagen->storeAs('images',$imagenescarro,'public');
                    $urlImagenes[] = $imagenescarro;
                }
                $c = count($urlImagenes);
                    for ($i = 0; $i < $c; $i++) {
                        $queryFotos=imagenes::create([
                            'namefile' => $urlImagenes[$i],
                            'pkvehiculo' => $request->pkvehiculo,
                            'ordenlatoneria'=> $request->ordens,
                     ]);
                    }
                if($queryFotos)
                {
                    $inventario = new inventario();
                    $inventario->pkvehiculo = ($request->pkvehiculo);
                    $inventario->ordenlatoneria = ($request->ordens);
                    $inventario->modelo = ($request->modelvh);
                    $inventario->kilometraje = ($request->kms);
                    $inventario->fechaorden = ($request->fechaorden);
                    $inventario->color = strtoupper($request->color);
                    $inventario->nivelfuel = ($request->nivel);
                    $inventario->antena = strtoupper($request->antena);
                    $inventario->extintor = strtoupper($request->extintor);
                    $inventario->gato = strtoupper($request->gato);
                    $inventario->llanta = strtoupper($request->llanta);
                    $inventario->herramientas = strtoupper($request->herramienta);
                    $inventario->kit = strtoupper($request->kit);
                    $inventario->documentos = strtoupper($request->documentos);
                    $inventario->radio = strtoupper($request->radio);
                    $inventario->parlantes = strtoupper($request->parlantes);
                    $inventario->tapetes = strtoupper($request->tapetes);
                    $inventario->encendedor = strtoupper($request->encendedor);
                    $inventario->espejos = strtoupper($request->espejos);
                    $inventario->parasoles = strtoupper($request->parasoles);
                    $inventario->limpiabrisas = strtoupper($request->limpiabrisas);
                    $inventario->bateria = strtoupper($request->bateria);
                    $inventario->pinturafogueada = strtoupper($request->pintura);
                    $inventario->suciedad = strtoupper($request->suciedad);
                    $text = preg_replace( "/<br>|\n/", "", $request->descripcion );
                    $inventario->Descripcionactividad= $text;
                    $inventario->valorcosto = strtoupper($request->cost);
                   
                    if(is_null($request->abono)){
                        $abono="0";
                        $inventario->valorabono = $abono;
                    }
                    $inventario->valorabono = strtoupper($request->abono);
                    $inventario->valorrestante = strtoupper($request->resta);
                    $inventario->operario = strtoupper($request->receptor);
                    $inventario->usuario = strtoupper($request->nombreclentrega);
                }
                $inventario->save();
                if($inventario){
                    $i = 0;
                    foreach ($servicios['idvehiculo'] as $vh) {
                        $items[$i]['idvehiculo'] = $vh;
                        $i++;
                    }
                    $j = 0;
                    foreach ($servicios['odsl'] as $orden) {
                        $items[$j]['ordenl'] = $orden;
                        $j++;
                    }
                    $s = 0;
                    foreach ($servicios['pro_id'] as $serv) {
                        $items[$s]['descripcionservicio'] = $serv;
                        $s++;
                    }
                    $c = 0;
                    foreach ($servicios['cantidad'] as $cant) {
                        $items[$c]['cantidad'] = $cant;
                        $c++;
                    }
                    $pu = 0;
                    foreach ($servicios['precunit'] as $price) {
                        $items[$pu]['preciounidad'] = $price;
                        $pu++;
                    }
                    $st = 0;
                    foreach ($servicios['totalitem'] as $stotal) {
                        $items[$st]['subtotal'] = $stotal;
                        $st++;
                    }
                    $cs = 0;
                    foreach ($servicios['concept'] as $conceptoservicios) {
                        $items[$cs]['conceptoservicio'] = strtoupper($conceptoservicios);
                        $cs++;
                    }
                    latonerias::insert(
                        $items
                    );
                }
                DB::commit();
                $mensaje = "Orden Registrada Correctamente.";
                $tipo = "success";
                log::info('Orden Registrada Correctamente.');
                return redirect('/OrdenesLatonerias')->with("mensaje", $mensaje)->with("tipo", $tipo);
            } else {
                $mensajes = "Error realizando el proceso. verifique la información ingresada, maximo 6 fotos.";
                $tipos = "danger";
                return back()
                ->with("mensajes", $mensajes)
                ->with("tipos", $tipos);
            }
        } catch (\Throwable $th) {
            Log::info('se presentó un error al grabar los datos', [$th]);
            DB::rollback();
            return  $th;
        }
    }





    public function SaveService(createservice  $request)
    {
        try {
            $servicios = $request->all();
            if (
                $servicios['operario'] == [null]
                || $servicios['operario'] == " "
                || $servicios['conceptomo'] == [null]
                || $servicios['conceptomo'] == " "
                || $servicios['concepto'] == [null]
                || $servicios['concepto'] == " "
                || $servicios['descmo'] == [null]
                || $servicios['descmo'] == " "
                || $servicios['cantidad'] == [null]
                || $servicios['cantidad'] == " "
                || $servicios['valor1'] == [null]
                || $servicios['valor1'] == " "
            ) {
                $mensajes = "Por favor ingrese la información correctamente.";
                $tipos = "danger";
                return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
            } else {
                $items = array();
                $j = 0;
                foreach ($servicios['ods'] as $orden) {
                    $items[$j]['ordenservicio'] = $orden;
                    $j++;
                }
                $k = 0;
                foreach ($servicios['idvehiculo'] as $idvh) {
                    $items[$k]['idvehiculo'] = $idvh;
                    $k++;
                }
                $i = 0;
                foreach ($servicios['operario'] as $oper) {
                    $items[$i]['mecanico'] = $oper;
                    if ($items[$i]['mecanico'] == null || $items[$i]['mecanico'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $i++;
                }
                $c = 0;
                foreach ($servicios['conceptomo'] as $sirver) {
                    $items[$c]['conceptomano'] = $sirver;
                    if ($items[$c]['conceptomano'] == null || $items[$c]['conceptomano'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $c++;
                }
                $z = 0;
                foreach ($servicios['concepto'] as $concep) {
                    $items[$z]['conceptotipo'] = $concep;
                    if ($items[$z]['conceptotipo'] == null || $items[$z]['conceptotipo'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $z++;
                }
                $y = 0;
                foreach ($servicios['cantidad'] as $cuantiti) {
                    $items[$y]['cantidad'] = $cuantiti;
                    if ($items[$y]['cantidad'] == null || $items[$y]['cantidad'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $y++;
                }
                $t = 0;
                foreach ($servicios['descmo'] as $dm) {
                    $items[$t]['describemano'] = $dm;
                    if ($items[$t]['describemano'] == null || $items[$t]['describemano'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $t++;
                }
                $n = 0;
                foreach ($servicios['valor1'] as $v) {
                    $items[$n]['valormano'] = $v;
                    if ($items[$n]['valormano'] == null || $items[$n]['valormano'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $n++;
                }
            }
            Service::insert(
                $items
            );
            DB::commit();
            $mensaje =  "Registro almacenado correctamente.";
            $tipo = "success";
            log::info('Registro Almacenado Correctamente.');
            return redirect('/OrdenesList')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al registrar los datos', [$th]);
            return  $th;
        }
    }

    public function SaveMoreService(createservice  $request)
    {
        try {
            $servicios = $request->all();

            if (
                $servicios['operario'] == [null]
                || $servicios['operario'] == " "
                || $servicios['conceptomo'] == [null]
                || $servicios['conceptomo'] == " "
                || $servicios['concepto'] == [null]
                || $servicios['concepto'] == " "
                || $servicios['descmo'] == [null]
                || $servicios['descmo'] == " "
                || $servicios['cantidad'] == [null]
                || $servicios['cantidad'] == " "
                || $servicios['valor1'] == [null]
                || $servicios['valor1'] == " "
            ) {
                $mensajes = "Por favor ingrese la información correctamente.";
                $tipos = "danger";
                return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
            } else {
                $items = array();
                $j = 0;
                foreach ($servicios['ods'] as $orden) {
                    $items[$j]['ordenservicio'] = $orden;
                    $j++;
                }
                $k = 0;
                foreach ($servicios['idvehiculo'] as $idvh) {
                    $items[$k]['idvehiculo'] = $idvh;
                    $k++;
                }
                $i = 0;
                foreach ($servicios['operario'] as $oper) {
                    $items[$i]['mecanico'] = $oper;
                    if ($items[$i]['mecanico'] == null || $items[$i]['mecanico'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $i++;
                }
                $c = 0;
                foreach ($servicios['conceptomo'] as $sirver) {
                    $items[$c]['conceptomano'] = $sirver;
                    if ($items[$c]['conceptomano'] == null || $items[$c]['conceptomano'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $c++;
                }
                $z = 0;
                foreach ($servicios['concepto'] as $concep) {
                    $items[$z]['conceptotipo'] = $concep;
                    if ($items[$z]['conceptotipo'] == null || $items[$z]['conceptotipo'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $z++;
                }
                $y = 0;
                foreach ($servicios['cantidad'] as $cuantiti) {
                    $items[$y]['cantidad'] = $cuantiti;
                    if ($items[$y]['cantidad'] == null || $items[$y]['cantidad'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $y++;
                }
                $t = 0;
                foreach ($servicios['descmo'] as $dm) {
                    $items[$t]['describemano'] = $dm;
                    if ($items[$t]['describemano'] == null || $items[$t]['describemano'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $t++;
                }
                $n = 0;
                foreach ($servicios['valor1'] as $v) {
                    $items[$n]['valormano'] = $v;
                    if ($items[$n]['valormano'] == null || $items[$n]['valormano'] == " ") {
                        $mensajes = "Por favor ingrese la información correctamente.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $n++;
                }
            }
            Service::insert(
                $items
            );
            DB::commit();
            $mensaje =  "Registro almacenado correctamente.";
            $tipo = "success";
            log::info('Registro Almacenado Correctamente.');
            return back()->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al registrar los datos', [$th]);
            return  $th;
        }
    }




    public function Showsv($id)
    {
        try {
            $vehicule = vehicule::find($id);
            $datocl = $vehicule->idcliente;
            $cliente = Customer::find($datocl);
            $servicios = DB::table('services')
                ->where('idvehiculo', '=', $id)
                ->get();
            $wordCount = count($servicios);
            $jobs = DB::table('jobs')
                ->where('idvehicule', '=', $id)
                ->get();
            $jobCount = count($jobs);
            if ($wordCount > 0 || $jobCount > 0) {
                return view('detailservice', compact('cliente', 'vehicule', 'servicios', 'jobs'));
            } else {
                $mensajes = "El vehiculo seleccionado aún no tiene servicios ó trabajos registrados.";
                $tipos = "danger";
                return redirect('/VehiculesList')->with("mensajes", $mensajes)->with("tipos", $tipos);
            };
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }





    public function AddMano($id)
    {
        try {
            $vehiculo = vehicule::find($id);
            return view('addmano')->with("vehiculo", $vehiculo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }


    public function SaveJobs(JobsPostRequest $request)
    {
        try {
            $trabajos = $request->all();
            if (
                $trabajos['concepto'] == [null]
                || $trabajos['concepto'] == " "
                || $trabajos['describework'] == [null]
                || $trabajos['describework'] == " "
                || $trabajos['cantidad'] == [null]
                || $trabajos['cantidad'] == " "
                || $trabajos['valor2'] == [null]
                || $trabajos['valor2'] == " "
            ) {
                $mensajes = "Por favor ingrese la información de Trabajos y Repuestos.";
                $tipos = "danger";
                return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
            } else {
                $items = array();
                $k = 0;
                foreach ($trabajos['idvehiculo'] as $idvh) {
                    $items[$k]['idvehicule'] = $idvh;
                    $k++;
                }
                $i = 0;
                foreach ($trabajos['concepto'] as $oper) {
                    $items[$i]['conceptowork'] = $oper;
                    if ($items[$i]['conceptowork'] == null || $items[$i]['conceptowork'] == " ") {
                        $mensajes = "Por favor ingrese la información de Trabajos y Repuestos.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $i++;
                }
                $c = 0;
                foreach ($trabajos['describework'] as $sirver) {
                    $items[$c]['describework'] = $sirver;
                    if ($items[$c]['describework'] == null || $items[$c]['describework'] == " ") {
                        $mensajes = "Por favor ingrese la información de Trabajos y Repuestos.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $c++;
                }
                $t = 0;
                foreach ($trabajos['cantidad'] as $dm) {
                    $items[$t]['cantidadwork'] = $dm;
                    if ($items[$t]['cantidadwork'] == null || $items[$t]['cantidadwork'] == " ") {
                        $mensajes = "Por favor ingrese la información de Trabajos y Repuestos.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $t++;
                }
                $n = 0;
                foreach ($trabajos['valor2'] as $v) {
                    $items[$n]['valorwork'] = $v;
                    if ($items[$n]['valorwork'] == null || $items[$n]['valorwork'] == " ") {
                        $mensajes = "Por favor ingrese la información de Trabajos y Repuestos.";
                        $tipos = "danger";
                        return back()->with("mensajes", $mensajes)->with("tipos", $tipos);
                    }
                    $n++;
                }
            }
            Job::insert(
                $items
            );
            DB::commit();
            $mensaje =  "Registro almacenado correctamente.";
            $tipo = "success";
            log::info('Registro Almacenado Correctamente.');
            return redirect('/VehiculesList')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al registrar los datos', [$th]);
            return  $th;
        }
    }


    public function CambiosList()
    {
        try {
            $services = DB::select('SELECT DISTINCT services.ordenservicio, vehicules.placa,services.idvehiculo, 
            services.id,customers.nombrecliente, customers.numerocel, customers.email,services.created_at,services.conceptomano
            FROM `services` INNER JOIN `vehicules` on services.idvehiculo = vehicules.id INNER JOIN `customers` on customers.id = vehicules.idcliente 
            WHERE services.conceptomano ="Cambio Aceite" 
            ORDER BY services.id desc');
            log::info('Listado Cambios Aceite Obtenido Correctamente.');
            return view('cambios', compact('services'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }



}
