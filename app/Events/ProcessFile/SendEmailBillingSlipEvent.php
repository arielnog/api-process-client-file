<?php

namespace App\Events\ProcessFile;

use App\DataTransferObjects\ProcessFileDTO;
use App\Entities\Collections\FileControlCollection;
use App\Entities\ContentEntity;
use App\Jobs\ProcessContentFileJob;
use App\Jobs\SendBillingEmailJob;
use Illuminate\Queue\SerializesModels;

class SendEmailBillingSlipEvent
{
    use SerializesModels;

    public const EVENT_NAME = 'SEND_EMAIL';

    public function handle(ContentEntity $contentEntity): bool
    {
        SendBillingEmailJob::dispatch(
            $contentEntity->getName(),
            $contentEntity->getEmail()->toString(),
            ['output.pdf']
        )->onQueue('send_email');

        return true;
    }
}
