<?php

namespace App\Repositories;

use App\Entities\Collections\ContentCollection;
use App\Entities\ContentEntity;
use App\Models\Content;
use App\Repositories\Contracts\IContentRepository;
use DateTime;
use Illuminate\Support\Arr;

class ContentRepository implements IContentRepository
{
    public function __construct(
        private Content $model
    )
    {
    }

    public function create(ContentEntity $contentEntity)
    {
        return $this->model
            ->create(
                Arr::except(
                    $contentEntity->toArray(),
                    [
                        'id',
                        'created_at',
                        'updated_at'
                    ]
                )
            );
    }

    public function getContentByDeptDueDate(DateTime $date): ContentCollection
    {
        $content = $this->model
            ->where('debt_due_date', $date->format('Y-m-d'))
            ->get()
            ->toArray();

        return ContentCollection::fromArray($content);
    }
}
