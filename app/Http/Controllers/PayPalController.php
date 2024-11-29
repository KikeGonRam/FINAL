<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Cart;

class PayPalController extends Controller
{
    public function createPayment($cartId)
    {
        // Recupera el carrito de compras
        $cart = Cart::findOrFail($cartId);

        // Verifica si el carrito tiene productos
        if ($cart->products->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'El carrito está vacío.');
        }

        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $paypalToken = $paypal->getAccessToken();
        $paypal->setAccessToken($paypalToken);

        // Crear la orden
        $response = $paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "MXN",
                        "value" => $cart->total // Usa el total del carrito
                    ]
                ]
            ]
        ]);

        // Redirigir al enlace de aprobación de PayPal
        if (isset($response['id']) && isset($response['links'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect($link['href']);
                }
            }
        }

        return redirect()->back()->with('error', 'Hubo un problema al procesar tu pago.');
    }

    public function capturePayment(Request $request)
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $paypalToken = $paypal->getAccessToken();
        $paypal->setAccessToken($paypalToken);

        $response = $paypal->capturePaymentOrder($request->get('token'));

        if ($response['status'] === 'COMPLETED') {
            return redirect()->route('success')->with('message', 'Pago completado con éxito.');
        }

        return redirect()->route('error')->with('error', 'El pago no se pudo completar.');
    }
}