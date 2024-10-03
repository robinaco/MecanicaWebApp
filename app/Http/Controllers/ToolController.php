<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreToolRequest;


class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTool()
    {
        return view('createtool');
    }



    public function SaveTool(StoreToolRequest $request)
    {
        try {
            $tool = new Tool();
            $tool->categoriaherramienta = strtoupper($request->categoriatool);
            $tool->descripcionherramienta = strtolower($request->descripciontool);
            $tool->valorcompraneto = ($request->valorcompratool);
            $tool->cantidad = ($request->cantidadtool);
            $tool->valorventa = ($request->valorventatool);
            $tool->save();
            $mensaje =  "Herramienta Registrada Satisfactoriamente.";
            $tipo = "success";
            DB::commit();
            log::info('Registro Almacenado Correctamente.');
            return redirect('/ToolList')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
     public function ToolList()
     {
         try {
             $tools = DB::table('tools')
                 ->select('tools.*')
                 ->orderBy('tools.id', 'DESC')
                 ->where('tools.estado', '=', 1)
                 ->get();
             log::info('Listado Herramientas Taller  Obtenido Correctamente.');
             return view('toolist', compact('tools'));
         } catch (\Throwable $th) {
             DB::rollback();
             Log::error('se presentó un error al obtener los datos', [$th]);
             return  $th;
         } 
     
     }

     public function deleteTool($id){
        try {
            $tool = Tool::find($id);
            $tool->estado = 0;
            $tool->save();
            $mensajes = "La herramienta ha sido eliminada.";
            $tipos = "danger";
            DB::commit();
            return redirect('/ToolList')->with("mensajes", $mensajes)->with("tipos", $tipos);
         } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al procesar los datos', [$th]);
            return  $th;
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function show(Tool $tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function editTool($id)
    {
        try {
            $tool = Tool::find($id);
            return view('/editTool')->with("tool", $tool);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function UpdateTool(StoreToolRequest $request, $id)
    {
        try {
          
            $tool = Tool::find($id);
            $tool->categoriaherramienta = strtoupper($request->categoriatool);
            $tool->descripcionherramienta = strtolower($request->descripciontool);
            $tool->valorcompraneto = ($request->valorcompratool);
            $tool->cantidad = ($request->cantidadtool);
            $tool->valorventa = ($request->valorventatool);
            $tool->save();
            $mensaje = "Herramienta Actualizada.";
            $tipo = "success";
            DB::commit();
            return redirect('/ToolList')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tool $tool)
    {
        //
    }
}
