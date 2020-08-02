<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Note extends Model
{
    protected $guarded = [];

    /**
     * Define morph
     * @return \Illuminate\Database\Eloquent\Relations\morphTo
     */
    public function entity() {
        return $this->morphTo();
    }
}
