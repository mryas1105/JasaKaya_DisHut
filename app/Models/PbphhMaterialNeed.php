<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PbphhMaterialNeed extends Model
{
    protected $primaryKey = 'need_id';

    protected $fillable = [
        'pbphh_id',
        'jenis_kayu',
        'tipe',
        'kebutuhan_bulanan_m3',
        'spesifikasi_tambahan'
    ];

    public function pbphhProfile(): BelongsTo
    {
        return $this->belongsTo(PbphhProfile::class, 'pbphh_id');
    }
}
