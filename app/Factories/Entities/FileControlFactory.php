<?php

namespace App\Factories\Entities;

use App\Entities\FileControlEntity;
use App\Models\FileControl as FileControlModel;
use App\Traits\Iterator;
use App\ValueObjects\FileStatus;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class FileControlFactory
{
    use Iterator;

    public static function fromArray(array $data): FileControlEntity
    {
        $createdAt = self::getData($data, 'created_at');
        $updatedAt = self::getData($data, 'updated_at');

        return new FileControlEntity(
            uuid: isset($data['uuid']) ?
                self::getData($data, 'uuid') :
                Uuid::uuid4()->toString(),
            fileName: self::getData($data, 'file_name', 'fileName'),
            path: self::getData($data, 'path_name', 'pathName', 'path'),
            status: FileStatus::fromString(self::getData($data, 'status')),
            id: self::getData($data, 'id'),
            createdAt: !is_null($createdAt) ? new Carbon($createdAt) : null,
            updatedAt: !is_null($updatedAt) ? new Carbon($updatedAt) : null,
        );
    }

    public static function fromModel(FileControlModel $fileControl): FileControlEntity
    {
        $data = $fileControl->toArray();

        return self::fromArray($data);
    }
}
