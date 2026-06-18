<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicomputo - Administración de Productos</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-950 text-gray-100 p-8 min-h-screen antialiased">
    
    <div class="max-w-6xl mx-auto bg-gray-900 p-6 rounded-xl shadow-xl border border-gray-800">
        
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <h1 class="text-2xl font-bold text-white tracking-tight">Panel de Productos - Unicomputo</h1>
            
            <div class="flex items-center space-x-2 w-full sm:w-auto justify-end">
                <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-500 shadow-md shadow-blue-900/20 transition duration-150">
                    + Nuevo Producto
                </a>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-gray-800 text-gray-300 px-4 py-2 rounded-lg font-semibold border border-gray-700 hover:bg-gray-700 hover:text-white transition duration-150 cursor-pointer">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-950/40 border border-green-800 text-green-400 px-4 py-3 rounded-lg mb-4 text-sm backdrop-blur-xs">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg border border-gray-800/60">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-950 text-gray-400 font-semibold text-sm border-b border-gray-800">
                        <th class="p-4">Código</th>
                        <th class="p-4">Nombre</th>
                        <th class="p-4">Precio</th>
                        <th class="p-4">Cantidad</th>
                        <th class="p-4">Categoría</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/40">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-800/30 transition duration-150">
                            <td class="p-4 font-mono text-xs text-blue-400 font-semibold">{{ $product['code'] }}</td>
                            <td class="p-4 text-gray-200 font-medium">{{ $product['name'] }}</td>
                            <td class="p-4 text-white font-bold">${{ number_format($product['price'], 2) }}</td>
                            <td class="p-4 text-gray-300">{{ $product['quantity'] }}</td>
                            <td class="p-4">
                                <span class="bg-blue-950/60 text-blue-400 border border-blue-900/50 text-xs font-semibold px-2.5 py-1 rounded-md">
                                    {{ $product['category'] }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center items-center space-x-3">
                                    <a href="{{ route('products.edit', $product['code']) }}" class="text-yellow-500 hover:text-yellow-400 font-semibold transition">
                                        Editar
                                    </a>
                                    <span class="text-gray-700">|</span>
                                    <form action="{{ route('products.destroy', $product['code']) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-400 font-semibold transition cursor-pointer">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 font-medium">
                                No hay productos registrados en la sesión actual.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>