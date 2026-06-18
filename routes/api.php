<?php

use Illuminate\Support\Facades\Route;

// Esta ruta ahora es 100% pública y libre del bloqueo de sesión web
Route::get('/catalogo-categorias', function () {
    return response()->json([
        'empresa' => 'Unicomputo S.A.S',
        'fecha_actualizacion' => date('Y-m-d'),
        'categorias' => [
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
        ]
    ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
});