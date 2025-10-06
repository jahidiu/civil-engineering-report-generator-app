<?php

namespace Modules\Base\App\Repository\Eloquents;

use Modules\Base\App\Models\Report;
use App\Repository\Eloquents\BaseRepository;

class ReportRepository extends BaseRepository
{
    public function __construct(Report $model)
    {
        parent::__construct($model);
    }
}
