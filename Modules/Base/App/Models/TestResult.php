<?php

namespace Modules\Base\App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $guarded = ['id'];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }
}
