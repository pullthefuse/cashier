<?php

namespace Laravel\Cashier;

use Stripe\Plan as StripePlan ;

class Plan {

    /**
     * The plan id.
     *
     * @var string
     */
    protected $plan_id;

    /**
     * Set Plan id when instantiating.
     *
     * @param $plan_id
     */
    public function __construct($plan_id = '')
    {
        $this->plan_id = $plan_id;
    }

    /**
     * Update a stripe plan.
     *
     * @param array $payload
     * @return StripePlan
     */
    public function update(array $payload)
    {
        $p = $this->getPlan();
        foreach($payload as $k => $v) {
            $p->{$k} = $v;
        }
        return $p->save();
    }

    /**
     * Retrieve plan from Stripe.
     *
     * @return StripePlan
     */
    public function getPlan()
    {
        return StripePlan::retrieve($this->plan_id, ['api_key' => config('services.stripe.secret')]);
    }

    /**
     * Retrieve all plans.
     *
     * @return \Stripe\Collection
     */
    public function all()
    {
        return StripePlan::all();
    }

}