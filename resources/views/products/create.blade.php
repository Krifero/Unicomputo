<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicomputo - Crear Producto</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-950 text-gray-100 p-8 min-h-screen flex items-center justify-center antialiased">
    
    <div class="max-w-xl w-full bg-gray-900 p-6 rounded-xl shadow-xl border border-gray-800">
        <h1 class="text-xl font-bold mb-4 text-white">Agregar Nuevo Producto</h1>

        @if($errors->any())
            <div class="bg-red-950/40 border border-red-800 text-red-400 p-3 rounded-lg mb-4 text-sm backdrop-blur-xs">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-gray-400 font-medium text-sm">Código / SKU:</label>
                <input type="text" name="code" value="{{ old('code') }}" class="w-full bg-gray-950 border border-gray-800 p-2 rounded mt-1 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
            </div>
            
            <div>
                <label class="block text-gray-400 font-medium text-sm">Nombre del Producto:</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-gray-950 border border-gray-800 p-2 rounded mt-1 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-400 font-medium text-sm">Precio ($):</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full bg-gray-950 border border-gray-800 p-2 rounded mt-1 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
                </div>
                <div>
                    <label class="block text-gray-400 font-medium text-sm">Cantidad:</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" class="w-full bg-gray-950 border border-gray-800 p-2 rounded mt-1 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
                </div>
            </div>
            
            <div>
                <label for="category" class="block text-gray-400 font-medium text-sm">Categoría:</label>
                <select name="category" id="category" class="w-full bg-gray-950 border border-gray-800 p-2 rounded mt-1 text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
                    <option value="" disabled {{ old('category') == '' ? 'selected' : '' }}>-- Seleccione una categoría --</option>
                    
                    <option value="Portátiles y Laptops" {{ old('category') == 'Portátiles y Laptops' ? 'selected' : '' }}>
                        Portátiles y Laptops
                    </option>
                    
                    <option value="Periféricos y Accesorios" {{ old('category') == 'Periféricos y Accesorios' ? 'selected' : '' }}>
                        Periféricos y Accesorios
                    </option>
                    
                    <option value="Monitores y Pantallas" {{ old('category') == 'Monitores y Pantallas' ? 'selected' : '' }}>
                        Monitores y Pantallas
                    </option>
                </select>
            </div>
            
            <div class="flex justify-end space-x-2 pt-2">
                <a href="{{ route('products.index') }}" class="bg-gray-700 text-gray-200 px-4 py-2 rounded-lg font-medium hover:bg-gray-600 transition duration-150">Cancelar</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-500 shadow-md shadow-blue-900/20 transition duration-150 cursor-pointer">Guardar</button>
            </div>
        </form>
    </div>

</body>
</html>