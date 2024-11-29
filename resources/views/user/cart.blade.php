<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrito de Compras</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        .hover-scale {
            transition: transform 0.2s;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-4xl font-bold mb-10 text-gray-800 text-center">
            🛒 Carrito de Compras
        </h1>
    
        <div class="bg-white rounded-lg shadow-lg p-6 fade-in">
            @foreach($cart->products as $product)
            <div class="flex items-center space-x-6 p-4 hover:bg-gray-50 transition-colors border-b border-gray-200 hover-scale">
                <div class="flex-shrink-0">
                    <!-- Usar almacenamiento público para las imágenes -->
                    <img src="{{ asset('storage/'.$product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-24 h-24 object-cover rounded-lg shadow-sm">
                </div>
                
                <div class="flex-grow">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                    <div class="mt-1 text-sm text-gray-600 space-y-1">
                        <p class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10v10H7z"/>
                            </svg>
                            Cantidad: 
                            <form action="{{ route('cart.update', $product->id) }}" method="POST" class="inline-flex items-center space-x-2">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="1" class="w-16 p-1 text-center border border-gray-300 rounded-lg">
                                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Actualizar</button>
                            </form>
                        </p>
                        <p class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Precio unitario: 
                            <span class="font-medium ml-1">${{ number_format($product->pivot->price, 2) }}</span>
                        </p>
                    </div>
                </div>
    
                <div class="text-right">
                    <p class="text-lg font-bold text-gray-800">
                        ${{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}
                    </p>
                </div>
            </div>
            @endforeach
    
            <div class="mt-8 border-t border-gray-200 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="text-2xl font-bold text-gray-800">
                        Total: <span class="text-green-600">${{ number_format($cart->total, 2) }}</span>
                    </div>
                    
                    <form action="{{ route('checkout') }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                        @csrf
                        <button type="submit" 
                                name="payment_method" 
                                value="paypal" 
                                class="flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                            Pagar con PayPal
                        </button>
                        
                        <button type="submit" 
                                name="payment_method" 
                                value="cash" 
                                class="flex items-center justify-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                            Pagar en Efectivo
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
