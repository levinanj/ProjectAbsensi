<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * @method where(string $string, $kunci)
 * @method static create(mixed|string[] $pengaturan)
 */
class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'setting';

    /**
     * @var array
     */
    protected $fillable = ['kunci', 'nilai'];

    /**
     * Mendapatkan nilai pengaturan berdasarkan kunci.
     *
     * @param $kunci
     * @return void
     */
    public static function dapatkanNilai($kunci)
    {
        $setting = new self();
        $entri = $setting->where('kunci', $kunci)->first();
        if (!$entri) {
            return;
        }
        return $entri->nilai;
    }

    /**
     * Mengatur nilai pengaturan berdasarkan kunci.
     *
     * @param $kunci
     * @param null $nilai
     * @return bool
     */
    public static function aturNilai($kunci, $nilai = null): bool
    {
        $setting = new self();
        $entri = $setting->where('kunci', $kunci)->firstOrFail();
        $entri->nilai = $nilai;
        $entri->saveOrFail();
        Config::set('kunci', $nilai);
        if (Config::get($kunci) == $nilai) {
            return true;
        }
        return false;
    }
}
