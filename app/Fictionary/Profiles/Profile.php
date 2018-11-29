<?php

namespace App\Fictionary\Profiles;

use App\Fictionary\Auth\User;
use App\Fictionary\Genres\Genre;
use App\Fictionary\Support\Uuid\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Profile extends Model
{
    use HasUuid,
        SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles';

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
        'user_uuid',
        'first_name',
        'last_name',
        'username',
        'gender',
        'country',
        'date_of_birth',
        'about_me',
        'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * class="col-md-6">
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
        'date_of_birth' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The user that this profile belongs to
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the genres for the profile
     *
     * @return MorphToMany
     */
    public function genres()
    {
        return $this->morphToMany(Genre::class, 'genreable', 'genreables', 'genreable_uuid');
    }

    /**
     * Get the user's full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the username of the user
     *
     * @param string
     * @return string
     */
    public function getUsernameAttribute($value)
    {
        if (is_null($value)) {
            return Username::generate($this->user);
        }

        return $value;
    }

    /**
     * Get the full URL of a profile picture
     *
     * @return string
     */
    public function getPhotoPathAttribute()
    {
        $storagePath = config('filesystems.disks.profile.photos.url');
        return url("{$storagePath}/{$this->photo}");
    }
}
