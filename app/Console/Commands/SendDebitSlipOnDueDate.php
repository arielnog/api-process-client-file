<?php

namespace App\Console\Commands;

use App\Events\ProcessFile\SendEmailBillingSlipEvent;
use App\Services\ContentService;
use DateTime;
use Illuminate\Console\Command;

class SendDebitSlipOnDueDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-debit-slip-due-date';

    protected $description = 'Command description';

    public function handle()
    {
        $contentService = app(ContentService::class);
        $date = DateTime::createFromFormat('Y-m-d', '2022-10-05');

        $contentList = $contentService->getContentByDueDebt($date);

        foreach ($contentList as $item){
            event(SendEmailBillingSlipEvent::EVENT_NAME,$item);
        }
    }
}
