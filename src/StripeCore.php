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
    public function newPlan($product, $amount, $options)
    {
        return new PlanBuilder($product, $amount, $options);
    }

    /**
     * Update a Strip Plan.
     *
     * @param $plan_id
     * @param $payload
     * @return \Stripe\Plan
     */
    public function updatePlan($plan_id, $payload)
    {
        return (new Plan($plan_id))->update($payload);
    }

    /**
     * Retrieve a Stripe Plan.
     * @param $plan_id
     * @return \Stripe\Plan
     */
    public function getPlan($plan_id)
    {
        return (new Plan($plan_id))->getPlan();
    }

    /**
     * Get all Stripe Plans.
     *
     * @return Plan
     */
    public function getPlans()
    {
        return new Plan;
    }
}