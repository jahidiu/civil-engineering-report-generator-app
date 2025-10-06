<?php

namespace Modules\Base\App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $guarded = ['id'];
    
    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
