<?php

namespace App\Fictionary\Auth;

use App\Fictionary\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activations';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_email';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'token', 'is_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_verified' => 'boolean',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        static::creating(function($model) {
            $model->forceFill([
                'token' => static::generateToken(),
            ]);
        });
    }

    /**
     * The user that belong to the user.
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model', User::class));
    }

    /**
     * Check if the activation token has been verified
     *
     * @return boolean
     */
    public function isVerified() : bool
    {
        return $this->is_verified;
    }

    /**
     * Check if the activation token is pending
     *
     * @return boolean
     */
    public function awaitingVerification() : bool
    {
        return ! $this->isVerified() && $this->hasActivationToken();
    }

    /**
     * Check if an activation token exists
     *
     * @return boolean
     */
    public function hasActivationToken() : bool
    {
        return ! is_null($this->token);
    }

    /**
     * Regenerate a token for the activation
     *
     * @return boolean
     */
    public function regenerateToken() : boolean
    {
        $this->token = static::generateToken();
        return $this->save();
    }

    /**
     * Generate a unique activation token
     *
     * @return string
     */
    public static function generateToken() : string
    {
        $token = hash_hmac('sha256', Str::random(40), config('app.key'));

        if (static::where('token', $token)->exists()) {
            throw new Exception('Failed to generate a unique token');
        }

        return $token;
    }
}
