<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * Defined the type id for credit.
     *
     * @const int
     */
    const TYPE_CREDIT = 1;

    /**
     * Set the amount into pence.
     *
     * @var int
     */
    public function setTrueAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }

    /**
     * Get the amount in pounds
     *
     * @return int
     */
    public function getTrueAmountAttribute()
    {
        return $this->amount / 100;
    }

}
