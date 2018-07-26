<?php
namespace Laravel\Cashier;

use Stripe\Product as StripeProduct;

class Product {

    public function createPlan($product, $amount, $options)
    {
        return (new Plan)->create($product, $amount, $options);
    }

}