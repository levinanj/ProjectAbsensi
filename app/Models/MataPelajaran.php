<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed nama
 * @property mixed deskripsi
 * @property mixed students
 * @method static create(array $validated)
 * @method static withCount(string $string)
 * @method static findorfail(mixed $get)
 */
class MataPelajaran extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi'];

    protected $dates = ['created_at'];

    /**
     * Mendapatkan pengajar yang terkait dengan mata pelajaran ini.
     *
     * @return BelongsTo
     */
    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan daftar siswa yang terdaftar pada mata pelajaran ini.
     *
     * @return BelongsToMany
     */
    public function siswa(): BelongsToMany
    {
        return $this->belongsToMany(Siswa::class, 'subject_student', 'subject_id', 'student_id')->withTimestamps();
    }

    /**
     * Mendapatkan catatan kehadiran yang terkait dengan mata pelajaran ini.
     *
     * @return HasMany
     */
    public function kehadiran(): HasMany
    {
        return $this->hasMany(Kehadiran::class);
    }
}
