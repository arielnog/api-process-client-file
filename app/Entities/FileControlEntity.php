<?php

namespace App\Entities;

use App\ValueObjects\FileStatus;
use App\ValueObjects\PathName;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileControlEntity extends BaseEntity
{

    public function __construct(
        string             $uuid,
        private string     $fileName,
        private string     $path,
        private FileStatus $status,
        ?int               $id = null,
        ?Carbon            $createdAt = null,
        ?Carbon            $updatedAt = null,
    )
    {
        parent::__construct(
            uuid: $uuid,
            id: $id,
            createdAt: $createdAt,
            updatedAt: $updatedAt
        );
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getOnStorage()
    {
      return Storage::disk('local')
          ->readStream(
              $this->getPath()
          );
    }

    public function saveOnStorage(UploadedFile $file): bool
    {
        return Storage::disk('local')
            ->put(
                $this->path,
                $file->getContent()
            );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'uuid' => $this->getUuid(),
            'file_name' => $this->fileName,
            'path' => $this->path,
            'status' => $this->status->toString(),
            'created_at' => $this->getCreatedAt()?->toDateTimeString(),
            'updated_at' => $this->getUpdatedAt()?->toDateTimeString(),
        ];
    }
}
