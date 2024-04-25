<?php

namespace App\Entities\Collections;

use App\Entities\ContentEntity;
use App\Factories\Entities\ContentFactory;
use Illuminate\Support\Collection;

class ContentCollection extends Collection
{
    protected $items = [];

    public function __construct(ContentEntity ...$entity)
    {
        parent::__construct($entity);
    }

    public static function fromArray(array $contentArray): self
    {
        $contentEntities = [];

        foreach ($contentArray as $fileControl) {
            $contentEntities[] = ContentFactory::fromArray($fileControl);
        }

        return new self(...$contentEntities);
    }

    public function getEmailsList(): array
    {
        return array_map(function (ContentEntity $item) {
            return $item->getEmail();
        }, $this->items);
    }
}
