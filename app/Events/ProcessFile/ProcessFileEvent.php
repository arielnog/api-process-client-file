<?php

namespace App\Events\ProcessFile;

use App\DataTransferObjects\ProcessFileDTO;
use App\Entities\Collections\FileControlCollection;
use App\Jobs\ProcessContentFileJob;
use Illuminate\Queue\SerializesModels;

class ProcessFileEvent
{
    use SerializesModels;

    public const EVENT_NAME = 'PROCESS_FILE';

    public function handle(FileControlCollection $fileControlCollection): bool
    {
        $dto = ProcessFileDTO::fromArray([
            'path_name' => $fileControlCollection->getPaths()
        ]);

        ProcessContentFileJob::dispatch($dto)
            ->onQueue('process_content_files');

        return true;
    }
}
