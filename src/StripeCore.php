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
     * Create a new Coupon.
     *
     * @param $id
     * @param $options
     * @return Coupon
     */
    public function newCoupon($id, $options)
    {
        return new Coupon($id, $options);
    }

}