<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Note extends Model
{
    protected $guarded = [];

    public function entity() {
        return $this->morphTo();
    }
}
