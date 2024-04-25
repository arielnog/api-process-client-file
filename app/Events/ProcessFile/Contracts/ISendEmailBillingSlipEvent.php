<?php

namespace App\Events\ProcessFile\Contracts;

use App\Entities\ContentEntity;

interface ISendEmailBillingSlipEvent
{
    public const EVENT_NAME = 'SEND_EMAIL';
    public function handle(ContentEntity $contentEntity): bool;
}
