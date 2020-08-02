<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Transaction;
use App\Note;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    /**
     * Grabs user transactions
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }

    /**
     * Get user balance
     * @return int
     */
    public function getBalanceAttribute()
    {
        $credit = $this->transactions()->whereType(Transaction::TYPE_CREDIT)->sum('amount');
        $debit = $this->transactions()->whereType(Transaction::TYPE_DEBIT)->sum('amount');
        return ($credit - $debit) / 100;
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
