<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Método privado para verificar si el usuario está autenticado.
     * Si no lo está, lo redirige automáticamente al formulario de Login real.
     */
    private function checkAuth()
    {
        if (!session()->has('autenticado')) {
            // Detiene el flujo actual y fuerza la redirección a la ruta /login
            redirect()->route('login')->send();
            exit;
        }
    }

    /**
     * Inicializa los productos en la sesión si no existen.
     */
    private function getProducts()
    {
        if (!session()->has('products')) {
            session(['products' => []]);
        }
        return session('products');
    }

    /**
     * Guarda la lista actualizada de productos en la sesión.
     */
    private function saveProducts($products)
    {
        session(['products' => $products]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuth(); // Redirige si no está logueado
        $products = $this->getProducts();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->checkAuth(); // Redirige si no está logueado
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkAuth(); // Protege la acción
        
        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string',
        ]);

        $products = $this->getProducts();

        foreach ($products as $product) {
            if ($product['code'] === $request->code) {
                return redirect()->back()->withErrors(['code' => 'El código de producto ya existe.'])->withInput();
            }
        }

        $products[] = [
            'code' => $request->code,
            'name' => $request->name,
            'price' => (float) $request->price,
            'quantity' => (int) $request->quantity,
            'category' => $request->category,
        ];

        $this->saveProducts($products);

        return redirect()->route('products.index')->with('success', 'Producto creado con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $code)
    {
        $this->checkAuth(); // Redirige si no está logueado
        
        $products = $this->getProducts();
        $product = null;

        foreach ($products as $p) {
            if ($p['code'] === $code) {
                $product = $p;
                break;
            }
        }

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Producto no encontrado.');
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code)
    {
        $this->checkAuth(); // Protege la acción
        
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string',
        ]);

        $products = $this->getProducts();
        $found = false;

        foreach ($products as $key => $product) {
            if ($product['code'] === $code) {
                $products[$key]['name'] = $request->name;
                $products[$key]['price'] = (float) $request->price;
                $products[$key]['quantity'] = (int) $request->quantity;
                $products[$key]['category'] = $request->category;
                $found = true;
                break;
            }
        }

        if (!$found) {
            return redirect()->route('products.index')->with('error', 'Producto no encontrado.');
        }

        $this->saveProducts($products);

        return redirect()->route('products.index')->with('success', 'Producto actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        $this->checkAuth(); // Protege la acción
        
        $products = $this->getProducts();
        
        foreach ($products as $key => $product) {
            if ($product['code'] === $code) {
                unset($products[$key]);
                break;
            }
        }

        $this->saveProducts(array_values($products));

        return redirect()->route('products.index')->with('success', 'Producto eliminado con éxito.');
    }
}