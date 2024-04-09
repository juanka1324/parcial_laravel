<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Verificar si se proporcionó un parámetro de búsqueda en la solicitud
        $searchQuery = $request->input('search');

        // Obtener todos los productos si no hay consulta de búsqueda
        if (!$searchQuery) {
            $products = Product::all();
        } else {
            // Filtrar productos que coincidan parcialmente con la consulta de búsqueda del nombre
            $products = Product::where('name', 'like', '%' . $searchQuery . '%')->get();
        }

        // Devolver la vista con los productos
        return view('products.index', compact('products'));}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(CreateProductRequest $request)
     {
         // Validar los datos del formulario utilizando el Request
         $validatedData = $request->validated();
     
         // Crear un nuevo objeto Product con los datos validados
         $product = new Product();
         $product->name = $validatedData['name'];
         $product->description = $validatedData['description'];
         $product->price = $validatedData['price'];
         $product->quantity_available = $validatedData['quantity_available'];
     
         // Guardar el producto en la base de datos
         $product->save();
     
         // Redireccionar al usuario a la página de índice de productos con un mensaje de éxito
         return redirect()->route('product.index')->with('success', 'Producto creado exitosamente.');
     }
     
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
{
    return view('products.edit', compact('product'));
}


    /**
     * Update the specified resource in storage.
     */
   
     public function update(UpdateProductRequest $request, Product $product)
     {
         $validatedData = $request->validated();
 
         $product->update([
             'name' => $validatedData['name'],
             'description' => $validatedData['description'],
             'price' => $validatedData['price'],
             'quantity_available' => $validatedData['quantity_available'],
         ]);
 
         return redirect()->route('product.index')->with('success', 'Producto actualizado correctamente');
     }

    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect()->route('product.index')->with('success', 'Producto eliminado correctamente');
    }
}
