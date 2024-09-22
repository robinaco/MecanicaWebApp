<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\File;
use App\Models\Service;
use App\Models\vehicule;
use App\Models\Mechanic;
use App\Models\clean;
use App\Models\Customer;
use App\Models\imagenes;
use App\Models\inventario;
use App\Models\latonerias;
use App\Models\Liquidation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class DomPdfController extends Controller
{
    public function getPdf ($id){
        try {
            $inventario = inventario::find($id);
            $orden = $inventario ->ordenlatoneria;
            $numorden=$orden;
            $empleado=$inventario ->operario;
            $mechanic = Mechanic::find($empleado);
            $vehiculo=$inventario ->pkvehiculo;
            $vh=vehicule::find($vehiculo);
            $idclient=$vh->idcliente;
            $infocustomer=Customer::find($idclient);
            $imagenes = imagenes::where('ordenlatoneria', '=', $orden)->get();
            $latonerias = latonerias::where('ordenl', '=', $orden)->get();
            $cleans = clean::where('orden', '=', $orden)->get();
            log::info('PDF Orden Descargado.');
            $pdf= FacadePdf::loadView('resumenOrden',compact('inventario','imagenes','numorden','latonerias','vh','cleans','infocustomer','mechanic'))
            ->setPaper('a4')
            ->setOptions(['margin-bottom', 0]);
            return $pdf->download('Informe_Orden.pdf');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }


    public function getliquidationpdf($id){
        try {
            $inventario=inventario::find($id);
            $idmecanico=$inventario->operario;
            $empleado=Mechanic::find($idmecanico);
            $idvehiculo=$inventario->pkvehiculo;
            $vehiculo=vehicule::find($idvehiculo);
            $idcliente=$vehiculo->idcliente;
            $cliente=Customer::find($idcliente);
            $liquidation=Liquidation::where('pkorden','=',$id)->first();
            log::info('PDF Mano de Obra Descargado.');
            $pdf= FacadePdf::loadView('liquidationsPdf',compact('inventario','empleado','vehiculo','cliente','liquidation'))
            ->setPaper('a4')
            ->setOptions(['margin-bottom', 0]);
            return $pdf->download('Mano_de_Obra.pdf');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }
}
