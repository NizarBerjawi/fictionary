<?php

namespace App\Fictionary\Auth;

use Exception;
use App\Fictionary\Auth\Role;
use App\Fictionary\Auth\Activation;
use App\Fictionary\Support\Uuid\HasUuid;
use App\Fictionary\Support\Filters\Filterable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable, Filterable, HasUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

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
        'last_login' => 'datetime',
    ];

    /**
     * The roles that belong to the user.
     *
     * @return BelongsToMany
     */
    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * The user that belong to the user.
     *
     * @return HasOne
     */
    public function activation() : HasOne
    {
        return $this->hasOne(Activation::class, 'user_uuid');
    }

    /**
     * Check if the user has a role. Returns true if
     * the role is applicable, and false otherwise.
     *
     * @param string $role
     * @return boolean
     */
    public function hasRole(string $role) : bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * Check if the user has a set of roles. Returns true if
     * they are all applicable, and false otherwise.
     *
     * @param array $roles
     * @return boolean
     */
     public function hasRoles(array $roles) : bool
     {
         $query = $this->roles();

         foreach($roles as $role) {
             $query->where('name', $role);
         }

         return $query->exists();
     }

     /**
      * Check if the user is an admin
      *
      * @return boolean
      */
     public function isAdmin() : bool
     {
         return $this->hasRole('admin');
     }

     /**
      * Checks if the user has an activation
      *
      * @return boolean
      */
     public function hasActivation() : bool
     {
         return $this->activation()->exists();
     }

     /**
      * Checks if the user is activated
      *
      * @return boolean
      */
     public function isActivated() : bool
     {
         return $this->hasActivation() && $this->activation->isVerified();
     }

     /**
      * Checks if the user is pending activation
      *
      * @return boolean
      */
     public function isPendingActivation() : bool
     {
         return $this->hasActivation() && $this->activation->awaitingVerification();
     }

     /**
      * Activates a new user account
      *
      * @return boolean
      */
     public function activate() : bool
     {
         if ($this->isPendingActivation()) {
             return $this->activation()->update(['is_verified' => true]);
         }

         return false;
     }

     /**
      * Create an activation token for the user
      *
      *
      * @return Activation
      */
     public function createActivation() : Activation
     {
         // Check if the user has an email account
         if (empty($this->email)) {
             throw new Exception('User does not have an email.');
         }

         // Check if the user is already activated
         if ($this->isActivated()) {
             throw new Exception('User is already activated.');
         }

         // Create a new activation
         $activation = new Activation();
         $activation->user()->associate($this);
         $activation->save();

         return $activation;
     }

     /**
      * Get user by email
      *
      * @param Builder $query
      * @param string $email
      * @return Builder
      */
     public function scopeByEmail(Builder $query, string $email) : Builder
     {
        return $query->where('email', $email);
     }

     /**
      * Get a user with their activation
      *
      * @param Builder
      * @return Builder
      */
     public function scopeWithActivation(Builder $query) : Builder
     {
         return $query->with('activation');
     }

     /**
      * Exclude a User or multiple Users from the query
      *
      * @param Builder $query
      * @param array $users
      * @return Builder
      */
      public function scopeExclude(Builder $query, $users) : Builder
      {
          if (!is_array($users)) {
              // Check that a User object is passed
              if ($users instanceof static) {
                  return $query->where('uuid', '!=', $users->uuid);
              }
          }

          $exclude = $data->map(function($item) {
              if ($item instanceof static) {
                  return $item->uuid;
              }

              throw new Exception('Invalid user(s) provided');
          });

          return $query->whereNotIn('uuid', $exclude);
      }
}
