<?php
namespace Laravel\Cashier;

use \Stripe\Plan as StripePlan;

class PlanBuilder {

    protected $product;

    protected $amount;
    
    protected $id;

    protected $interval = 'month';

    protected $active = true;

    protected $aggregate_usage;

    protected $billing_scheme;

    protected $interval_count = 1;

    protected $nickname;

    protected $tiers = [];

    protected $tiers_mode;

    protected $transform_usage = [];

    protected $trial_period_days;

    protected $usage_type;

    protected $options = [];

    /**
     * The metadata to apply to the subscription.
     *
     * @var array|null
     */
    protected $metadata;

    public function __construct($product, $amount, array $options = [])
    {
        $this->product = $product;
        $this->amount = $amount;
        $this->options = $options;
    }

    public function create()
    {
        return StripePlan::create($this->getPayload(), ['api_key' => config('services.stripe.secret')]);
    }

    protected function getPayload()
    {
        return array(
            'id' => $this->id,
            'currency' => $this->getOptions('currency'),
            'interval' => $this->getOptions('interval'),
            'product' => $this->product,
            'amount' => $this->amount,
            'aggregate_usage' => $this->getOptions('aggregate_usage'),
            'billing_scheme' => $this->getOptions('billing_scheme'),
            'interval_count' => $this->interval_count,
            'meta_data' => $this->metadata,
            'nickname' => $this->getOptions('nickname'),
            'active' => $this->getOptions('active'),
            'tiers' => $this->tiers, // Need to manage
            'tiers_mode' => $this->getOptions('tiers_mode'),
            'transform_usage' => $this->transform_usage, // Add Later
            'trial_period_days' => $this->trial_period_days,
            'usage_type' => $this->getOptions('usage_type')
        );
    }

    protected function getOptions($value)
    {
        if(isset($this->options[$value])) {
            return $this->options[$value];
        }
        return $this->{$value};
    }

    /**
     * The metadata to apply to a new plan.
     *
     * @param  array  $metadata
     * @return $this
     */
    public function withMetadata($metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Specify the number of days of the trial.
     *
     * @param  int  $trialDays
     * @return $this
     */
    public function trialDays($trialDays)
    {
        $this->trial_period_days = $trialDays;

        return $this;
    }

    public function setInterval($count)
    {
        $this->interval_count = $count;

        return $this;
    }
}