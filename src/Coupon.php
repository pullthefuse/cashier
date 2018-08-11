<?php
namespace Laravel\Cashier;

use Stripe\Coupon as StripeCoupon;

class Coupon {

    protected $id;

    protected $options;

    protected $meta_data;

    protected $duration;

    protected $duration_in_months;

    protected $currency;

    protected $max_redemptions;

    protected $name;

    protected $percent_off;

    protected $amount_off;

    protected $redeem_by;


    /**
     * Coupon constructor.
     *
     * @param $id
     * @param array $options
     */
    public function __construct($id, array $options)
    {
        $this->id = $id;
        $this->options = $options;
    }

    /**
     * Create a stripe token.
     *
     * @return StripeCoupon
     */
    public function create()
    {
        return StripeCoupon::create($this->getPayload(), ['api_key' => config('services.stripe.secret')]);
    }

    private function getPayload()
    {
        return array(
            'id' => $this->id,
            'duration' => $this->getOptions('duration'),
            'amount_off' => $this->getOptions('amount_off'),
            'currency' => $this->getOptions('currency'),
            'duration_in_months' => $this->getOptions('duration_in_months'),
            'max_redemptions' => $this->getOptions('max_redemptions'),
            'metadata' => $this->meta_data,
            'name' => $this->getOptions('name'),
            'percent_off' => $this->getOptions('percent_off'),
            'redeem_by' => $this->getOptions('redeem_by')
        );
    }

    /**
     * Get the options.
     *
     * @param $value
     * @return mixed
     */
    private function getOptions($value)
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
}