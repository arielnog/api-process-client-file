<?php

namespace App\Jobs;

use App\Mail\BillingEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBillingEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $name;
    public array $attach;
    public string $email;

    public function __construct(string $name, string $email, array $attach,)
    {
        $this->name = $name;
        $this->attach = $attach;
        $this->email = $email;
    }

    public function handle(): void
    {
        $email = new BillingEmail($this->name, $this->attach);
        Mail::to($this->email)->send($email);
    }
}
