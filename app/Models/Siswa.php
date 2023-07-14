<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property mixed nama
 * @property mixed email
 * @property mixed telepon
 * @property mixed kehadiran
 * @property mixed jumlah_kehadiran
 * @method static create(array $validated)
 * @method static WhereNotIn(string $string, $pluck)
 * @method static find(int|string $key)
 * @method static findorfail(int|string $key)
 * @method static count()
 */
class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'email', 'telepon'];

    /**
     * @return BelongsToMany
     */
    public function mataPelajaran(): BelongsToMany
    {
        return $this->belongsToMany(MataPelajaran::class, 'mata_pelajaran_mahasiswa', 'mahasiswa_id', 'mata_pelajaran_id')->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function kehadiran(): BelongsToMany
    {
        return $this->belongsToMany(Kehadiran::class)->withPivot('status');
    }
   
    public function hadir()
    {
        return $this->belongsToMany(Kehadiran::class)->wherePivot('status', 1)->get();
    }

    public function absen()
    {
        return $this->belongsToMany(Kehadiran::class)->wherePivot('status', 0)->get();
    }

    public function dapatkanMataPelajaran($id){
        return MataPelajaran::where('id', $id)->get();
    }

    /**
     * @return int
     */
    public function jumlah_kehadiran(): int
    {
        return $this->belongsToMany(Kehadiran::class)->wherePivot('status', 1)->count();
    }

    /**
     * @return int
     */
    public function jumlah_ketidakhadiran(): int
    {
        return $this->belongsToMany(Kehadiran::class)->wherePivot('status', 0)->count();
    }
}
