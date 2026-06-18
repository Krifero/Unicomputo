<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicomputo - Iniciar Sesión</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-950 text-gray-100 flex items-center justify-center h-screen antialiased">
    
    <div class="bg-gray-900 p-8 rounded-xl shadow-xl w-full max-w-md border border-gray-800 relative">
        
        <div class="mb-4">
            <a href="{{ url('/') }}" class="inline-flex items-center space-x-1 text-xs font-semibold text-gray-400 hover:text-blue-400 transition">
                <span>←</span>
                <span>Volver al Catálogo</span>
            </a>
        </div>

        <h2 class="text-2xl font-bold text-center text-white mb-6">Unicomputo - Acceso</h2>
        
        @if($errors->any())
            <div class="bg-red-950/40 border border-red-800 text-red-400 px-4 py-3 rounded mb-4 text-sm backdrop-blur-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-400 font-medium text-sm">Usuario:</label>
                <input type="text" name="email" class="w-full bg-gray-950 border border-gray-800 p-2 rounded mt-1 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="Usuario" required>
            </div>
            
            <div>
                <label class="block text-gray-400 font-medium text-sm">Contraseña:</label>
                <input type="password" id="password" name="password" class="w-full bg-gray-950 border border-gray-800 p-2 rounded mt-1 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="••••••••" required>
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="show-password" class="h-4 w-4 bg-gray-950 border-gray-800 text-blue-600 rounded focus:ring-blue-500 focus:ring-offset-gray-900 cursor-pointer">
                <label for="show-password" class="ml-2 block text-sm text-gray-400 hover:text-gray-300 cursor-pointer select-none">
                    Mostrar contraseña
                </label>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-lg font-bold hover:bg-blue-500 shadow-md shadow-blue-900/20 transition duration-200 cursor-pointer">
                Ingresar al Sistema
            </button>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const showPasswordCheckbox = document.getElementById('show-password');

        showPasswordCheckbox.addEventListener('change', function() {
            if (this.checked) {
                passwordInput.type = 'text'; // Muestra los caracteres reales
            } else {
                passwordInput.type = 'password'; // Vuelve a ocultarlos con puntos
            }
        });
    </script>
</body>
</html>