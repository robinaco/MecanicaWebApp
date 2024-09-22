<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\Saludos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class MailController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest');
    }

    
    public function send(Request $request)
    {
        // Mail::to($request->email)->send(new Send($request));

    }



    public function showPlacas($placa){
        try {
         
            $services = DB::select("SELECT distinct inventarios.id,inventarios.pkvehiculo,inventarios.ordenlatoneria,vehicules.placa,inventarios.created_at, customers.nombrecliente,customers.email,  latonerias.descripcionservicio,latonerias.conceptoservicio
            FROM `inventarios` 
            INNER JOIN `vehicules` on inventarios.pkvehiculo = vehicules.id  
            inner join `customers` on customers.id = vehicules.idcliente   
            inner join `latonerias` on latonerias.idvehiculo= vehicules.id
            where inventarios.estado = '1'
            and vehicules.placa= '$placa' and inventarios.liquidacion='liquidada'");
            if($services!=null){
                $sendToEmail=strtolower($services[0]->email); 
                Mail::to($sendToEmail)->send(new Saludos($services));
                return response()->json("OK");
            }
            else{
                return response()->json("Sin Informacion");
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presento un error al obtener los datos', [$th]);
            return  $th;
        }
    
    }


    
}
