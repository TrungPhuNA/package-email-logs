<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 7/21/24
 */

namespace Email\Logs;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class EmailLogListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(EmailLogEvent $event)
    {
        // Handle the event, e.g., log email information
        DB::table('email_logs')->insert([
            'recipient'  => $event->recipient,
            'subject'    => $event->subject,
            'body'       => $event->body,
            'status'     => $event->status,
            'error'      => $event->error,
            'created_at' => Carbon::now()
        ]);
    }
}