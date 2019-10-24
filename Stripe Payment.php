<?php
//Stripe Payment

Stripe\Stripe::setApiKey(env('STRIPE_SECRET')); 

 $payment = Stripe\Charge::create ([

                "amount" => $totalPay * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,
                "transfer_group" => $orderId,

                "description" => "Test payment from allianceparcel" 

        ]); 

//Creating Separate Charges and Transfers
//https://stripe.com/docs/connect/charges-transfers#grouping-transactions-intents



//Stripe create vendor connected account for separate payment

//https://stripe.com/docs/api/accounts/retrieve

$customer =  \Stripe\Account::create([
                'type' => 'custom',
                'country' => 'US',
                'email' => $traveler->email,
                'requested_capabilities' => [
                  'card_payments',
                  'transfers',
                ],
              ]);


   $customer = \Stripe\Account::retrieve(
                $traveler->stripe_customer_id
              );  


   $transfer = \Stripe\Transfer::create([
            "amount" => $ampunt_transfer*100,
            "currency" => "usd",
            "destination" => $customer_id,
            "transfer_group" => $orderId,
        ]);                     



 //CUSTOMER CREATE SCRIPT
 
  $customer = \Stripe\Customer::create(array(
                'email' => $traveler->email,
                'source'  => $request->stripeToken,
            )); 

  $customer = \Stripe\Customer::retrieve($traveler->stripe_customer_id);                  