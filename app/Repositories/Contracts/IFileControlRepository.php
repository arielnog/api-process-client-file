<?php

namespace App\Repositories\Contracts;

use App\Entities\Collections\FileControlCollection;
use App\Entities\FileControlEntity;
use App\ValueObjects\FileStatus;

interface IFileControlRepository
{
    public function create(FileControlEntity $fileControl);

    public function getByStatusAndName(FileStatus $status, array $pathNames): FileControlCollection;

    public function updateStatus(FileStatus $status, FileControlEntity $fileControl): bool;
    public function getAll(): FileControlCollection;
}
