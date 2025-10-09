<?php

namespace Modules\Base\App\Repository\Eloquents;

use Modules\Base\App\Models\Certificate;
use App\Repository\Eloquents\BaseRepository;

class CertificateRepository extends BaseRepository
{
    public function __construct(Certificate $model)
    {
        parent::__construct($model);
    }
}
