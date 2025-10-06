<?php

namespace Modules\Base\App\Repository\Eloquents;

use Modules\Base\App\Models\Signatory;
use App\Repository\Eloquents\BaseRepository;

class SignatoryRepository extends BaseRepository
{
    public function __construct(Signatory $model)
    {
        parent::__construct($model);
    }
}
