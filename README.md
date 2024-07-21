# Laravel Logs send email ...

Log action send email success or errors


## Description

Handle send email success or error and retry
Version v1.1.0

## Installation

```bash
composer require pigs/admin-acl-setting
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
        \Email\Logs\EmailLogServiceProvider::class
        ...
    ])->toArray(),
```
### Publish config, migrate

```bash
php artisan vendor:publish --tag="email_log_config"
```