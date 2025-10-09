<?php

namespace Modules\Base\App\Models;

use Illuminate\Database\Eloquent\Model;

class Signatory extends Model
{
    protected $guarded = ['id'];

    /**
     * Each signatory belongs to one certificate
     */
    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }
}
