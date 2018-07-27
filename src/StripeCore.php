<?php

namespace Laravel\Cashier;

trait StripeCore {

    /**
     * Create a new Stripe plan.
     *
     * @param $product
     * @param $amount
     * @param $options
     * @return PlanBuilder
     */
    public function newStripePlan($product, $amount, $options)
    {
        $options = array_merge([
            'currency' => $this->preferredCurrency(),
        ], $options);

        return new PlanBuilder($product, $amount, $options);
    }



    /**
     * Retrieve a Stripe Plan.
     * @param $plan_id
     * @return Plan
     */
    public function findStripePlan($plan_id)
    {
        return (new Plan($plan_id))->getPlan();
    }

    /**
     * Get all Stripe Plans.
     *
     * @return Plan
     */
    public function getStripePlans()
    {
        return new Plan;
    }

    /**
     * Get the Stripe supported currency used by the entity.
     *
     * @return string
     */
    public function preferredCurrency()
    {
        return Cashier::usesCurrency();
    }
}