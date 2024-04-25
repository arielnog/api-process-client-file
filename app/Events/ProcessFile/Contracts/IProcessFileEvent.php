<?php

namespace App\Events\ProcessFile\Contracts;

use App\Entities\Collections\FileControlCollection;

interface IProcessFileEvent
{
    public const EVENT_NAME = 'PROCESS_FILE';

    public function handle(FileControlCollection $fileControlCollection): bool;
}
