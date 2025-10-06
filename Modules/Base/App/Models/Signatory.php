<?php

namespace Modules\Base\App\Models;

use Illuminate\Database\Eloquent\Model;

class Signatory extends Model
{
    protected $guarded = ['id'];

    /**
     * Each signatory belongs to one report
     */
    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
