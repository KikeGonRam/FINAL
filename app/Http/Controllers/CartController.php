<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Mail\TicketEmail;
use Barryvdh\DomPDF\Facade as PDF;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Mail\OrderTicket;
use Illuminate\Support\Facades\Mail;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;



class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $user = auth()->user();
        $product = Product::findOrFail($productId);

        // Verifica si ya existe un carrito pendiente para el usuario
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'estado' => 'pendiente'],
            ['total' => 0]
        );

        // Verifica si el producto ya está en el carrito
        $cartProduct = $cart->products()->where('product_id', $productId)->first();

        if ($cartProduct) {
            // Si ya está, aumenta la cantidad
            $cartProduct->pivot->quantity++;
            $cartProduct->pivot->save();
        } else {
            // Si no está, lo agrega
            $cart->products()->attach($productId, [
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        // Actualiza el total del carrito
        $this->updateCartTotal($cart);

        return redirect()->route('cart.view');
    }

    public function viewCart()
    {
        $cart = Cart::where('user_id', auth()->id())->where('estado', 'pendiente')->first();
        if (!$cart) {
            return redirect()->route('user.dashboard')->with('error', 'No tienes un carrito pendiente.');
        }

        // Calcular el total si no lo hemos hecho aún
        $this->updateCartTotal($cart);

        return view('user.cart', compact('cart'));
    }

    public function payWithPaypal($cartId)
    {
        return redirect()->route('cart.paypal_unavailable');
    }

    public function payWithCash($cartId)
    {
        $cart = Cart::findOrFail($cartId);
        $cart->save();

        // Generar el ticket en PDF
        $pdf = \PDF::loadView('pdf.ticket', compact('cart'));

        // Opción 1: Mostrar el PDF en el navegador
        //return $pdf->stream('ticket.pdf'); // Esto abrirá el PDF en el navegador.

        // Opción 2: Forzar la descarga del PDF
        return $pdf->download('ticket.pdf'); // Esto descargará el PDF directamente.
    }


    public function sendTickets(Cart $cart)
    {
        $adminEmail = 'admin@darketo.com'; // Correo del administrador
        $barberEmail = 'barber@darketo.com'; // Correo del barbero

        // Generar el ticket en PDF
        $pdf = \PDF::loadView('pdf.ticket', compact('cart'));
    }

    protected function updateCartTotal(Cart $cart)
    {
        $total = $cart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });
        $cart->total = $total;
        $cart->save();
    }

    public function checkout(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->where('estado', 'pendiente')->first();
        if (!$cart) {
            return redirect()->route('cart.view')->with('error', 'No tienes un carrito pendiente.');
        }

        // Verifica el método de pago
        if ($request->payment_method == 'paypal') {
            return $this->payWithPaypal($cart->id);
        } else {
            return $this->payWithCash($cart->id);
        }
    }

    protected function sendTicket(Cart $cart)
    {
        $adminEmail = 'admin@darketo.com';  // Correo del administrador
        $barberEmail = $cart->products->first()->barbers->email;  // Correo del barbero, puedes ajustarlo según la relación

        // Generar el ticket en PDF
        $pdf = \PDF::loadView('emails.ticket', ['cart' => $cart]);

        // Enviar el ticket a admin y barbero
        Mail::to($adminEmail)->send(new TicketEmail($pdf));
        Mail::to($barberEmail)->send(new TicketEmail($pdf));
    }

    public function update(Request $request, $productId)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->where('estado', 'pendiente')->first();

        if (!$cart) {
            return redirect()->route('cart.show')->with('error', 'Carrito no encontrado.');
        }

        $product = $cart->products()->find($productId);

        if (!$product) {
            return redirect()->route('cart.show')->with('error', 'Producto no encontrado en el carrito.');
        }

        $quantity = $request->input('quantity');

        // Validar que la cantidad sea válida
        if ($quantity < 1) {
            return redirect()->route('cart.show')->with('error', 'La cantidad debe ser al menos 1.');
        }

        // Actualizar la cantidad del producto en el carrito
        $product->pivot->quantity = $quantity;
        $product->pivot->save();

        return redirect()->route('cart.show')->with('success', 'Cantidad actualizada con éxito.');
    }

    public function show()
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->where('estado', 'pendiente')->first();

        if (!$cart) {
            return redirect()->route('home')->with('error', 'No tienes un carrito pendiente.');
        }

        return view('cart.show', compact('cart'));
    }

    public function remove($productId)
    {
        $cart = auth()->user()->cart;  // O accede al carrito de alguna otra forma

        // Verificar si el carrito existe
        if (!$cart) {
            return redirect()->route('cart.show')->with('error', 'No se encontró el carrito.');
        }

        // Eliminar el producto del carrito
        $cart->products()->detach($productId);

        return redirect()->route('cart.show')->with('success', 'Producto eliminado correctamente');
    }


    public function generateTicket($cart)
    {
        // Generar el ticket en PDF
        $pdf = \Pdf::loadView('emails.ticket', compact('cart'));

        // Definir los correos electrónicos del administrador y barbero
        $adminEmail = 'admin@darketo.com';
        $barberEmail = 'barbero@darketo.com';

        // Enviar el ticket a admin y barbero
        Mail::to($adminEmail)->send(new TicketEmail($pdf));
        Mail::to($barberEmail)->send(new TicketEmail($pdf));

        return redirect()->route('cart.index')->with('success', 'Ticket enviado a admin y barbero');
    }

    public function createPayment($cartId)
    {
        // Redirigir a la vista de "funcionalidad no disponible"
        return redirect()->route('cart.paypal_unavailable');
    }
}