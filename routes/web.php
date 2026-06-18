<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;

// Función con los datos del catálogo e imágenes para la API y la Vista Pública
$getCatalogoData = function () {
    return [
        [
            'id' => 1,
            'nombre' => 'Portátiles y Laptops',
            'productos' => [
                [
                    'id_prod' => 101,
                    'nombre' => 'MacBook Air M2',
                    'precio' => 4500000,
                    'imagen' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500&auto=format&fit=crop&q=60',
                    'disponible' => true
                ],
                [
                    'id_prod' => 102,
                    'nombre' => 'Asus ROG Strix',
                    'precio' => 5200000,
                    'imagen' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=500&auto=format&fit=crop&q=60',
                    'disponible' => true
                ]
            ]
        ],
        [
            'id' => 2,
            'nombre' => 'Periféricos y Accesorios',
            'productos' => [
                [
                    'id_prod' => 201,
                    'nombre' => 'Teclado Mecánico Logitech G Pro',
                    'precio' => 450000,
                    'imagen' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=500&auto=format&fit=crop&q=60',
                    'disponible' => true
                ],
                [
                    'id_prod' => 202,
                    'nombre' => 'Mouse Gamer Razer DeathAdder',
                    'precio' => 280000,
                    'imagen' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=500&auto=format&fit=crop&q=60',
                    'disponible' => false
                ]
            ]
        ],
        [
            'id' => 3,
            'nombre' => 'Monitores y Pantallas',
            'productos' => [
                [
                    'id_prod' => 301,
                    'nombre' => 'Monitor LG UltraWide 29"',
                    'precio' => 1100000,
                    'imagen' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500&auto=format&fit=crop&q=60',
                    'disponible' => true
                ]
            ]
        ]
    ];
};

// 🌟 PÁGINA PRINCIPAL: Muestra el catálogo comercial público
Route::get('/', function () use ($getCatalogoData) {
    if (session('autenticado')) {
        return redirect()->route('products.index');
    }
    $categorias = $getCatalogoData();
    return view('catalogo', compact('categorias')); 
});

// MOSTRAR LOGIN: Tu vista clásica de acceso (resources/views/auth/login.blade.php)
Route::get('/login', function () {
    if (session('autenticado')) {
        return redirect()->route('products.index');
    }
    return view('auth.login'); 
})->name('login');

// PROCESAR INICIO DE SESIÓN
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required', 
        'password' => 'required',
    ]);

    $userValido = 'Christian';
    $passwordValida = 'Sena123';

    if ($request->email === $userValido && $request->password === $passwordValida) {
        session(['autenticado' => true]);
        return redirect()->route('products.index');
    }

    return back()->withErrors([
        'email' => 'El usuario o la contraseña ingresados son incorrectos.',
    ]);
})->name('login.store');

// CERRAR SESIÓN (🌟 Redirección modificada al catálogo público)
Route::post('/logout', function (Request $request) {
    session()->forget('autenticado');
    return redirect('/'); 
})->name('logout');

// CRUD CONTROLADO DE PRODUCTOS
Route::resource('products', ProductController::class)->parameters([
    'products' => 'code'
]);

// ENDPOINT JSON DE LA API PÚBLICA
Route::get('/api/catalogo-categorias', function () use ($getCatalogoData) {
    return response()->json([
        'empresa' => 'Unicomputo S.A.S',
        'fecha_actualizacion' => date('Y-m-d'),
        'categorias' => $getCatalogoData()
    ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
});