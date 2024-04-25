<?php

namespace App\Jobs;

use App\DataTransferObjects\ProcessFileDTO;
use App\Services\FileControlService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessContentFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(private ProcessFileDTO $fileDTO)
    {
        $this->onQueue('process_content_files');
    }

    public function handle(): void
    {
        $fileControlService = app(FileControlService::class);
        $fileControlService->processFile($this->fileDTO);
    }
}
