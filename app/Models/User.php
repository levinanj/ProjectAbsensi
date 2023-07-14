<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed peran
 * @method static where(string $string, string $string1)
 * @method static create(array $array)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'peran'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param mixed $peran
     * @return bool
     */
    public function memilikiPeran(...$peran): bool
    {
        foreach ($peran as $peran){
            if($this->peran === $peran)
                return true;
            else
                return false;
        }
    }

    /**
     * @return BelongsToMany
     */
    public function mataPelajaran(): BelongsToMany
    {
        return $this->belongsToMany(MataPelajaran::class)->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function kelas(): BelongsToMany
    {
        return $this->belongsToMany(Kelas::class, 'kelas_pengguna', 'pengguna_id', 'kelas_id')->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function kehadiran(): HasMany
    {
        return $this->hasMany(Kehadiran::class);
    }
}
