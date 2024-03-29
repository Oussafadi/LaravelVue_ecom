<?php

namespace App\Http\Controllers;

use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class StipeCheckoutController extends Controller
{

    public function checkout_form()
    {
        return view('stripe.checkout');
    }

    public function checkout_payment_intent()
    {


        $stripe = new \Stripe\StripeClient(config('stripe.test_secret_key'));

        $cartTotal = (new CartRepository())->total();

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $cartTotal,
                'currency' => 'eur',
                // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'order_items' => (new CartRepository())->jsonOrderItems()
                ]
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
