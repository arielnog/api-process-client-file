<?php

namespace App\Repositories;

use App\Entities\Collections\FileControlCollection;
use App\Entities\FileControlEntity;
use App\Models\FileControl;
use App\Repositories\Contracts\IFileControlRepository;
use App\ValueObjects\FileStatus;
use Exception;
use Illuminate\Support\Arr;

class FileControlRepository implements IFileControlRepository
{
    public function __construct(
        private FileControl $fileControl
    )
    {
    }

    public function create(FileControlEntity $fileControlEntity)
    {
        return $this->fileControl
            ->create(
                Arr::except(
                    $fileControlEntity->toArray(),
                    [
                        'id',
                        'created_at',
                        'updated_at'
                    ]
                )
            );
    }

    public function getByStatusAndName(
        FileStatus $status,
        array      $pathNames
    ): FileControlCollection
    {
        $file = $this->fileControl
            ->where('status', $status->toString())
            ->whereIn('path', $pathNames)
            ->get()
            ->toArray();

        return FileControlCollection::fromArray($file);
    }

    public function updateStatus(
        FileStatus        $status,
        FileControlEntity $fileControl
    ): bool
    {
        return $this->fileControl
            ->where('id', $fileControl->getId())
            ->update([
                'status' => $status->toString()
            ]);
    }

    public function getAll(): FileControlCollection
    {
        $collection = $this->fileControl
            ->get()
            ->toArray();

        return FileControlCollection::fromArray($collection);
    }
}
