<?php

namespace App\Services;

use App\Entities\Collections\ContentCollection;
use App\Entities\ContentEntity;
use App\Factories\Entities\ContentFactory;
use App\Helpers\CsvHelper;
use App\Repositories\Contracts\IContentRepository;
use App\ValueObjects\Resource;
use DateTime;
use Throwable;

class ContentService
{
    public function __construct(
        private IContentRepository $contentRepository
    )
    {
    }

    public function createFromParser(Resource $file): bool
    {
        $csvRows = CsvHelper::fromFile($file->getContent());
        $keys = [];

        try {
            foreach ($csvRows as $row) {

                if (empty($keys)) {
                    $keys = $row;
                    continue;
                }

                if (!is_array($row) && empty($row)) {
                    continue;
                }

                $data = array_combine($keys, $row);
                $content = ContentFactory::fromArray($data);

                $this->create($content);
            }

            return true;
        } catch (Throwable $throwable) {
            throw  $throwable;
        }
    }

    public function create(ContentEntity $entity)
    {
        return $this->contentRepository
            ->create($entity);
    }

    public function getContentByDueDebt(DateTime $date): ContentCollection
    {
        return $this->contentRepository
            ->getContentByDeptDueDate($date);
    }
}
