<?php

namespace App\Repositories\Contracts;

use App\Entities\Collections\ContentCollection;
use App\Entities\ContentEntity;
use DateTime;

interface IContentRepository
{
    public function create(ContentEntity $fileControl);
    public function getContentByDeptDueDate(DateTime $date): ContentCollection;
}
