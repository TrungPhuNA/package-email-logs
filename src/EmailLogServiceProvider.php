<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 7/21/24
 */

namespace Email\Logs;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EmailLogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Event::listen(
            EmailLogEvent::class,
            EmailLogListener::class
        );
//        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->publishesConfig();
    }

    public function publishesConfig(): void
    {
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ],'email_log_migration');
    }
}