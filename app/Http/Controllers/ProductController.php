<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
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

    public function ProductList()
    {
        try {
            $products = DB::table('products')
                ->select('products.*')
                ->orderBy('products.id', 'DESC')
                ->where('products.estado', '=', 1)
                ->get();
            log::info('Listado Productos Taller  Obtenido Correctamente.');
            return view('productslist', compact('products'));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        } 
    
    }

    public function createProduct()
    {
        return view('createproduct');
    }

    public function SaveProduct(StoreProductRequest $request)
    {
        try {
            $product = new Product();
            $product->categoriaproducto = strtoupper($request->categoriaproduct);
            $product->codigoproducto = strtoupper($request->codigo);
            $product->descripcionproducto = strtoupper($request->descripcionproducto);
            $product->valornetounidad = ($request->valorcompraproducto);
            $product->cantidadproducto = ($request->cantidadproducto);
            $product->valorventacomercial = ($request->valorventaproducto);
            $product->save();
            $mensaje =  "Producto Inventario Registrado Satisfactoriamente.";
            $tipo = "success";
            DB::commit();
            log::info('Registro Almacenado Correctamente.');
            return redirect('/ProductList')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function deleteProduct($id){
        try {
            $product = Product::find($id);
            $product->estado = 0;
            $product->save();
            $mensajes = "La herramienta ha sido eliminada.";
            $tipos = "danger";
            DB::commit();
            return redirect('/ProductList')->with("mensajes", $mensajes)->with("tipos", $tipos);
         } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al procesar los datos', [$th]);
            return  $th;
        }
    }

    public function editProduct($id)
    {
        try {
            $product = Product::find($id);
            return view('/editProduct')->with("product", $product);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }
    public function getProductos()
    {
        $productos = product::where('estado', 1)->where('cantidadproducto', '>', 0)->orderBy('descripcionproducto', 'desc')->get(); // Obtener productos de la base de datos
        return response()->json($productos); // Retornar en formato JSON
    }

    public function getProductoValor($id)
    {
        // Buscar el producto por su ID
        $producto = Product::find($id);
        // Si el producto no existe, retornar un error
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        // Retornar el valor del producto
        return response()->json(['valorventacomercial' => $producto->valorventacomercial]); // Cambia 'valor' por el campo que necesites
    }


    public function UpdateProduct(StoreProductRequest $request, $id)
    {
        try {
          
            $product = product::find($id);
            $product->categoriaproducto = strtoupper($request->categoriaproduct);
            $product->descripcionproducto= strtoupper($request->descripcionproducto);
            $product->valornetounidad = ($request->valorcompraproducto);
            $product->cantidadproducto = ($request->cantidadproducto);
            $product->valorventacomercial= ($request->valorventaproducto);
            $product->codigoproducto= ($request->codigo);
            $product->save();
            $mensaje = "Producto del Inventario se ha  Actualizado.";
            $tipo = "success";
            DB::commit();
            return redirect('/ProductList')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
