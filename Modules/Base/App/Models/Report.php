<?php

namespace Modules\Base\App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = ['id'];

    /**
     * A report can have many test results
     */
    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'report_id');
    }

    public function leftSignatory()
    {
        return $this->belongsTo(Signatory::class, 'left_signatory_id')->withDefault('name', 'N/A');
    }
    public function rightSignatory()
    {
        return $this->belongsTo(Signatory::class, 'right_signatory_id')->withDefault('name', 'N/A');
    }

}
