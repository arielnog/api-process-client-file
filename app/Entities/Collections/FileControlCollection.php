<?php

namespace App\Entities\Collections;

use App\Entities\FileControlEntity;
use App\Factories\Entities\FileControlFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class FileControlCollection extends Collection
{
    protected $items = [];

    public function __construct(FileControlEntity ...$fileControl)
    {
        parent::__construct($fileControl);
    }

    public function addFile(FileControlEntity $fileControl): self
    {
        $this->items[] = $fileControl;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public static function fromArray(array $fileControlArray): self
    {
        $filesEntities = [];

        foreach ($fileControlArray as $fileControl) {
            $filesEntities[] = FileControlFactory::fromArray($fileControl);
        }

        return new self(...$filesEntities);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function toResponse(): array
    {
        return array_map(function (FileControlEntity $item) {
            return Arr::except(
                $item->toArray(),
                ['id']
            );
        }, $this->items);
    }

    public function getPaths(): array
    {
        $arrPath = [];
        foreach ($this->items as $item) {
            $arrPath[] = $item->getPath();
        }

        return $arrPath;
    }
}
