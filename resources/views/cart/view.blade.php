<h1>Mi Carrito</h1>
@foreach($cart->items as $item)
    <p>{{ $item->product->name }} - {{ $item->quantity }} - ${{ $item->subtotal }}</p>
@endforeach
<p>Total: ${{ $cart->total }}</p>

<a href="{{ route('cart.paypala', $cart->id) }}">Pagar con PayPal</a>
<a href="{{ route('cart.cash', $cart->id) }}">Pagar en Efectivo</a>


