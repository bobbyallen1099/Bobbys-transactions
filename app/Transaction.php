<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Transaction extends Model
{
    /**
     * Defined the type id for Credit.
     *
     * @const int
     */
    const TYPE_CREDIT = 1;

    /**
     * Defined the type id for Debit.
     *
     * @const int
     */
    const TYPE_DEBIT = 2;

    /**
     * Define the relationshop with user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Set the amount into pence.
     *
     * @var int
     */
    public function setFormattedAmountAttribute()
    {
        $this->attributes['amount'] = $value * 100;
    }

    /**
     * Get the amount in pounds
     *
     * @return int
     */
    public function getFormattedAmountAttribute()
    {
        return $this->amount / 100;
    }


    /**
     * Define note relationshop
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function notes()
    {
      return $this->morphMany(Note::class, 'entity');
    }

}
