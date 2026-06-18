<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicomputo S.A.S - Catálogo Comercial</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen flex flex-col antialiased">

    <header class="bg-gray-900 shadow-md sticky top-0 z-50 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="text-2xl">🛒</span>
                <span class="text-xl font-black text-white tracking-tight">Unicomputo S.A.S</span>
            </div>

            <div>
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2 rounded-lg font-bold text-sm shadow-md transition duration-150 ease-in-out flex items-center space-x-1">
                    <span>Ingresar al Sistema</span>
                    <span>➜</span>
                </a>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        
        <div class="mb-8 text-center sm:text-left bg-gradient-to-r from-blue-700 to-indigo-950 text-white p-6 rounded-2xl shadow-lg border border-blue-900/50">
            <h1 class="text-3xl font-extrabold tracking-tight">Catálogo de Productos</h1>
            <p class="text-blue-200 mt-1 text-sm sm:text-base">Bienvenidos a nuestra tienda oficial. Explora la mejor tecnología, portátiles de última generación y accesorios con disponibilidad garantizada.</p>
        </div>

        @foreach($categorias as $categoria)
            <div class="mb-12">
                <div class="flex items-center space-x-2 border-b border-gray-800 pb-2 mb-6">
                    <span class="w-2.5 h-6 bg-blue-500 rounded-sm shadow-[0_0_10px_rgba(59,130,246,0.5)]"></span>
                    <h2 class="text-xl font-black text-gray-200 uppercase tracking-wide">{{ $categoria['nombre'] }}</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($categoria['productos'] as $producto)
                        <div class="bg-gray-900 rounded-xl shadow-lg border border-gray-800/80 overflow-hidden flex flex-col hover:border-gray-700 transition duration-200 group">
                            
                            <div class="relative h-48 bg-gray-950 overflow-hidden">
                                <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300 opacity-90 group-hover:opacity-100">
                                @if($producto['disponible'])
                                    <span class="absolute top-3 right-3 bg-green-500/90 backdrop-blur-xs text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">Disponible</span>
                                @else
                                    <span class="absolute top-3 right-3 bg-red-500/90 backdrop-blur-xs text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">Agotado</span>
                                @endif
                            </div>

                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <span class="text-xs font-mono text-gray-500 block mb-1">CÓD: #ID-{{ $producto['id_prod'] }}</span>
                                    <h3 class="font-bold text-gray-200 text-lg leading-tight group-hover:text-blue-400 transition">{{ $producto['nombre'] }}</h3>
                                </div>
                                <div class="mt-4 pt-3 border-t border-gray-800/60 flex items-center justify-between">
                                    <span class="text-2xl font-black text-white">${{ number_format($producto['precio'], 0, ',', '.') }}</span>
                                    <span class="text-xs text-gray-500 font-medium">COP</span>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </main>

    <footer class="bg-gray-900 border-t border-gray-800 py-6 mt-12 text-center text-xs text-gray-500 font-medium">
        &copy; {{ date('Y') }} Unicomputo S.A.S - Proyecto de Evidencia Tecnológica SENA
    </footer>

</body>
</html>