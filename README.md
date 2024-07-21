# Laravel Logs send email ...

Log action send email success or errors


## Description

Handle send email success or error and retry
Version v1.1.0

## Installation

```bash
composer require sendmail/logs
```

### Khai báo service  config/app.php
```php
'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        ...
        Email\Logs\EmailLogServiceProvider::class
        ...
    ])->toArray(),
```
### Publish config, migrate

```bash
php artisan vendor:publish --tag="email_log_migration"
```

### Example
```php 
<?php

namespace App\Jobs;

use App\Mail\SendMailTest;
use Email\Logs\EmailLogEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class JobSendEmailTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $mailable = new SendMailTest($this->data);
            Mail::to("codethue94@gmail.com")->send($mailable);
            event(new EmailLogEvent("codethue94@gmail.com", $this->data['title'] ?? "", $this->data['body'] ?? "", 'success'));
        } catch (\Exception $e) {
            event(new EmailLogEvent("codethue94@gmail.com", $this->data['title'] ?? "", $this->data['body'] ?? "", 'failure', $e->getMessage()));
        }
    }
}

```
