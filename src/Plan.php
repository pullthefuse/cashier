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
     * The plan id.
     *
     * @var StripePlan
     */
    protected $plan;

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
        foreach($payload as $k => $v) {
            $this->plan->{$k} = $v;
        }
        return $this->plan->save();
    }

    /**
     * Retrieve plan from Stripe.
     *
     * @return Plan
     */
    public function getPlan()
    {
        $this->plan = StripePlan::retrieve($this->plan_id, ['api_key' => config('services.stripe.secret')]);

        return $this;
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