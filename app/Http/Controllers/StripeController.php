<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        $response = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'ngn',
                        'product_data' => ['name' => $request->product_name],
                        'unit_amount' => $request->price * 100,
                    ],

                    'quantity' => $request->quantity,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel'),
        ]);
        // return view('stripe');  
        // dd($response);

        if (isset($response->id) && $response->id != '') {
            session()->put('product_name', $request->product_name);
            session()->put('quantity', $request->quantity);
            session()->put('price', $request->price);
            session()->put('id', $request->id);
            return redirect($response->url);
        }else{
            return redirect()->route('cancel');
        }
    }

    public function success(Request $request ){
        if (isset($request->session_id)) {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
            // dd($response);
            $payment=new Payment();
            // $payment->session_id=$request->session_id;
            $payment->payment_id=$response->id;
            $payment->product_name=session()->get('product_name');
            $payment->quantity=session()->get('quantity');
            $payment->amount=session()->get('price');
            $payment->currency=$response->currency;
            $payment->customer_name=$response->customer_details->name;
            $payment->customer_email=$response->customer_details->email;
            $payment->payment_status=$response->payment_status;
            $payment->payment_method='Stripe';
            $payment->save();
            $book = Book::find(session()->get('id')); // Fetch the user by ID
            $book->increment('number_purchased');
            Alert::toast('Payment Successfull', 'success');
            return redirect()->route('marketplace.shop');
            session()->forget('product_name');
            session()->forget('quantity');
            session()->forget('price');
        }else{
            return redirect()->route('cancel');
        }
        return view('success');
    }

    public function cancel(){
        Alert::toast('Payment Cancelled', 'error');
        return redirect()->route('marketplace.shop');
    }
}
