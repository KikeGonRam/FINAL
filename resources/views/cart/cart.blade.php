
<div class="container">
    <h1 class="text-4xl font-bold mb-10">Carrito de Compras</h1>

    @foreach($cart->products as $product)
    <div class="flex justify-between items-center p-4 border-b">
        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover">
        <div class="flex flex-col">
            <span class="font-semibold">{{ $product->name }}</span>
            <span class="text-sm text-gray-600">Cantidad: {{ $product->pivot->quantity }}</span>
            <span class="text-xl font-bold">${{ $product->pivot->price * $product->pivot->quantity }}</span>
        </div>
    </div>
    @endforeach

    <div class="mt-6 flex justify-between items-center">
        <span class="text-xl font-semibold">Total: ${{ $cart->total }}</span>
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <button type="submit" name="payment_method" value="paypal" class="bg-blue-600 text-white px-4 py-2 rounded">Pagar con PayPal</button>
            <button type="submit" name="payment_method" value="cash" class="bg-green-600 text-white px-4 py-2 rounded">Pagar en Efectivo</button>
        </form>
    </div>
</div>
