<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $validated)
 * @property mixed id
 * @property mixed students
 */
class Kehadiran extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id', 'user_id', 'tanggal'];

    protected $dates = ['tanggal', 'created_at'];

    /**
     * Mendapatkan daftar siswa yang hadir pada kehadiran ini.
     *
     * @return BelongsToMany
     */
    public function siswa(): BelongsToMany
    {
        return $this->belongsToMany(Siswa::class, 'attendance_student', 'attendance_id','student_id')->withPivot('status');
    }

    /**
     * Mendapatkan mata pelajaran yang terkait dengan kehadiran ini.
     *
     * @return BelongsTo
     */
    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'subject_id');
    }

    /**
     * Mendapatkan pengajar yang terkait dengan kehadiran ini.
     *
     * @return BelongsTo
     */
    public function pengajar(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'user_id');
    }

    // Scopes --------------------------------------------------

    /**
     * Memfilter kehadiran berdasarkan mata pelajaran.
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeWhereMataPelajaran($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('subject_id', "$search");
        });
    }

    /**
     * Memfilter kehadiran berdasarkan tanggal.
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeWhereTanggal($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('tanggal', Carbon::parse($search)->format('Y-m-d'));
        });
    }
}
