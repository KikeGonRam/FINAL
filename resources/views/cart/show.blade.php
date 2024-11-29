<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrito de Compras</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .animate-slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }
        .hover-card {
            transition: all 0.3s ease;
        }
        .hover-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        .quantity-badge {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }
        .empty-cart-animation {
            animation: bounce 1s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl" x-data="{ showTotal: false }">
        <h1 class="text-4xl font-bold mb-10 text-gray-800 text-center animate-slide-in">
            🛒 Carrito de Compras
        </h1>

        <div class="bg-white rounded-xl shadow-lg p-6 backdrop-blur-sm bg-opacity-95">
            @if ($cart->products->isEmpty())
                <div class="text-center py-12 empty-cart-animation">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <p class="text-xl text-gray-600 font-medium">Tu carrito está vacío</p>
                    <a href="{{ route('products.index') }}" class="mt-4 inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                        Explorar Productos
                    </a>
                </div>
            @else
                @foreach($cart->products as $product)
                    <div class="flex items-center space-x-6 p-4 border-b border-gray-200 hover-card rounded-lg mb-4" 
                         x-data="{ showDetails: false }"
                         @mouseenter="showDetails = true"
                         @mouseleave="showDetails = false">
                        <div class="flex-shrink-0 relative">
                            <img src="{{ asset('storage/'.$product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-24 h-24 object-cover rounded-lg shadow-sm">
                            <span class="absolute -top-2 -right-2 quantity-badge w-6 h-6 flex items-center justify-center text-white rounded-full text-sm">
                                {{ $product->pivot->quantity }}
                            </span>
                        </div>
                        
                        <div class="flex-grow">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                            <div class="mt-2 space-y-1">
                                <p class="text-sm text-gray-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    Cantidad: {{ $product->pivot->quantity }}
                                </p>
                                <p class="text-sm text-gray-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Precio: ${{ $product->pivot->price }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <p class="text-lg font-bold text-gray-800">${{ $product->pivot->price * $product->pivot->quantity }}</p>
                            <div x-show="showDetails" 
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 class="mt-2">
                                 @foreach ($cart as $productId => $product)
                                 <div>
                                     <form action="{{ route('cart.remove', $productId) }}" method="POST" class="inline">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit">Eliminar</button>
                                     </form>
                                 </div>
                             @endforeach
                             
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-8 border-t border-gray-200 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0"
                         x-data="{ showTotal: false }"
                         @mouseenter="showTotal = true">
                        <div class="text-2xl font-bold text-gray-800"
                             x-show="showTotal"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform -translate-x-4"
                             x-transition:enter-end="opacity-100 transform translate-x-0">
                            Total: <span class="text-green-600">${{ $cart->total }}</span>
                        </div>
                        
                        <form action="{{ route('checkout') }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                            @csrf
                            <button type="submit" 
                                    name="payment_method" 
                                    value="paypal" 
                                    class="group px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2 transform group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                        <path d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                                    </svg>
                                    Pagar con PayPal
                                </span>
                            </button>
                            
                            <button type="submit" 
                                    name="payment_method" 
                                    value="cash" 
                                    class="group px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 shadow-lg">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2 transform group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                        <path d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                                    </svg>
                                    Pagar en Efectivo
                                </span>
                            </button>

                            <button type="submit" 
                                    name="payment_method" 
                                    value="cash" 
                                    class="group px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 shadow-lg">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2 transform group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                            <path d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                                        </svg>
                                        <a href="{{ route('user.dashboard') }}" class="active bg-red-600 p-2 rounded-md text-center">Cancelar</a>
                                    </span>
                            </button>

                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>